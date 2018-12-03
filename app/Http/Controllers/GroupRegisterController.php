<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GroupRegisterController extends Controller
{
    public function index($id)
    {
        $courses = DB::table('courses')->where('courseID', $id)->get();
        $users = DB::table('users')->get();
        $membership = DB::table('membership')->get();
        $studygroup = DB::table('studygroup')->get();

        return view('groupregister', ['courses' => $courses, 'users' => $users,
        'membership' => $membership, 'studygroup' => $studygroup, 'id' => $id
        ]);
    }

    public function create($id) {
        $days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');

        // parse form input
        $groupName = $_GET['groupName'];
        $meetTime = $_GET['meetTime'];
        $meetLocation = $_GET['meetLocation'];
        // parse description (nullable)
        $desc = null;
        if(isset($_GET['groupDescription'])) {
            $desc = $_GET['groupDescription'];
        }
        // parse the meet day
        $meetDay = "";
        foreach($days as $day) {
            if(isset($_GET[$day])) {
                $meetDay .= ' ' . $_GET[$day];
            }
        }

        $currentUserID = \Auth::user()->id;

        // check if already exists
        $groupExists = DB::table('studygroup')->where(['courseID' => $id, 'groupName' => $groupName, 'description' => $desc, 'meetTime' => $meetTime, 'meetDay' => $meetDay, 'meetLocation' => $meetLocation, 'ownerID' => $currentUserID])->count();

        // group doesn't exist -> pass
        if($groupExists == 0) {
            // add new study group
            DB::table('studygroup')->insert(['courseID' => $id, 'groupName' => $groupName, 'description' => $desc, 'meetTime' => $meetTime, 'meetDay' => $meetDay, 'meetLocation' => $meetLocation, 'ownerID' => $currentUserID]);

            // groupID of study group we just created
            $groupID = DB::table('studygroup')->select('groupID')->where(['courseID' => $id, 'groupName' => $groupName, 'description' => $desc, 'meetTime' => $meetTime, 'meetDay' => $meetDay, 'meetLocation' => $meetLocation, 'ownerID' => $currentUserID])->first()->groupID;

            // add user to study group
            DB::table('membership')->insert(['id' => $currentUserID, 'groupID' => $groupID]);

            $memcheck = DB::table('membership')->where(['groupID' => $groupID, 'id' => $currentUserID])->count();
            $courses = DB::table('courses')->where('courseID', $id)->get();
            $users = DB::table('users')->get();
            $membership = DB::table('membership')->get();
            $studygroup = DB::table('studygroup')->where('groupID',$groupID)->get();
            $comments = DB::table('comments')->where('groupID', $groupID)->get();

            return view('grouphome', ['courses' => $courses, 'users' => $users,
            'membership' => $membership, 'studygroup' => $studygroup, 'id' => $id, 'created' => True, 'memcheck' => $memcheck, 'comments' => $comments, 'groupID' => $groupID
            ]);
        // group already exists -> duplicate or refresh.
        } else {
            $courses = DB::table('courses')->where('courseID', $id)->get();
            $users = DB::table('users')->get();
            $membership = DB::table('membership')->get();
            $studygroup = DB::table('studygroup')->get();

            return view('groupregister', ['courses' => $courses, 'users' => $users, 'membership' => $membership, 'studygroup' => $studygroup, 'id' => $id, 'PHgroupName' => $groupName, 'PHdesc' => $desc, 'PHmeetTime' => $meetTime, 'PHmeetDay' => $meetDay, 'PHmeetLocation' => $meetLocation]);
        }        
    }
}
