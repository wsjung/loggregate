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

    public function update($id) {
        $currentUserID = \Auth::user()->id;

        // update all info but days
        DB::table('studygroup')->where('groupID',$id)->update(['groupName' => $_GET['groupName'], 'description' => $_GET['groupDesc'], 'meetTime' => $_GET['meetTime'], 'meetLocation' => $_GET['meetLocation']]);

        // parse through days and update meeting day
        $days = array('M','Tu','W','Th','F','Sa','Su');

        // parse the meet day and update
        $meetDay = "";
        foreach($days as $day) {
            if(isset($_GET[$day])) {
                $meetDay .= ' ' . $_GET[$day];
            }
        }
        DB::table('studygroup')->where('groupID',$id)->update(['meetDay' => $meetDay]);;


        $memcheck = DB::table('membership')->where('groupID', $id)->where('id', $currentUserID)->count();
        $courses = DB::table('courses')->get();
        $users = DB::table('users')->get();
        $membership = DB::table('membership')->get();
        $members = DB::table('membership')->where('groupID',$id)->get();
        $studygroup = DB::table('studygroup')->where('groupID', $id)->get();
        $comments = DB::table('comments')->where('groupID', $id)->orderBy('timeStamp','desc')->get();

        return view('grouphome', ['courses' => $courses, 'users' => $users,
        'membership' => $membership, 'studygroup' => $studygroup, 'comments' => $comments, 'memcheck' => $memcheck, 'members' => $members
        ]);
    }

    public function delete($id) {

        $userid = \Auth::user()->id;
        // check that specified group even exists
        $exists = DB::table('studygroup')->where('groupID',$id)->get();
        if($exists->count() === 0) {
            // if not exist, redirect to home
            return redirect()->route('home');
        } else {
            // delete specified group
            $name = DB::table('studygroup')->where('groupID',$id)->get();
            DB::table('studygroup')->where('groupID',$id)->delete();

            // redirect to home page with banner
            $studyGroups = DB::table('Membership')->join('StudyGroup', 'Membership.groupid', '=', 'StudyGroup.groupid')->where('id', '=', $userid)->get();
            $myCourses = DB::table('Subscribed')->join('Courses', 'Courses.courseid', '=', 'Subscribed.courseid')->where('id', '=', $userid)->get();

            return view('home', ['studyGroups' => $studyGroups, 'myCourses' => $myCourses, 'deletedGroupName' => $name[0]->groupName]);
        }
    }

    public function create($id) {
        $days = array('M','Tu','W','Th','F','Sa','Su');

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
        $groupOverlap = DB::table('studygroup')->where(['courseID' => $id, 'meetTime' => $meetTime])->get();
        $overlap = False;

        foreach($groupOverlap as $group){
            $sim = similar_text($group->meetDay, $meetDay, $per);
            if($sim >= 2){
                $overlap = True;
                break;
            }
        }

        // group doesn't exist -> pass
        if($groupExists == 0) {
            if($overlap){
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
                $members = DB::table('membership')->where('groupID',$groupID)->get();
                $studygroup = DB::table('studygroup')->where('groupID',$groupID)->get();
                $comments = DB::table('comments')->where('groupID', $groupID)->get();

                return view('grouphome', ['courses' => $courses, 'users' => $users,
                'membership' => $membership, 'studygroup' => $studygroup, 'id' => $id, 'overlap' => True, 'memcheck' => $memcheck, 'comments' => $comments, 'groupID' => $groupID, 'members' => $members
                ]);
            } else {
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
                $members = DB::table('membership')->where('groupID',$groupID)->get();
                
                $studygroup = DB::table('studygroup')->where('groupID',$groupID)->get();
                $comments = DB::table('comments')->where('groupID', $groupID)->get();

                return view('grouphome', ['courses' => $courses, 'users' => $users,
                'membership' => $membership, 'studygroup' => $studygroup, 'id' => $id, 'created' => True, 'memcheck' => $memcheck, 'comments' => $comments, 'groupID' => $groupID, 'members' => $members
                ]);
            }
        }
        // group already exists -> duplicate or refresh.
        else {
            $courses = DB::table('courses')->where('courseID', $id)->get();
            $users = DB::table('users')->get();
            $membership = DB::table('membership')->get();
            $studygroup = DB::table('studygroup')->get();

            return view('groupregister', ['courses' => $courses, 'users' => $users, 'membership' => $membership, 'studygroup' => $studygroup, 'id' => $id, 'PHgroupName' => $groupName, 'PHdesc' => $desc, 'PHmeetTime' => $meetTime, 'PHmeetDay' => $meetDay, 'PHmeetLocation' => $meetLocation]);
        }
    }
}
