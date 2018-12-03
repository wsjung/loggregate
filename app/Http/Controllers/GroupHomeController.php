<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GroupHomeController extends Controller
{
    public function comment($groupID){

        // parse form input
        $content = $_GET['content'];
        date_default_timezone_set('America/Vancouver');
        $datetime=date('m/d/Y H:i:s');

        $currentUserID = \Auth::user()->id;

        DB::table('comments')->insert(['id' => $currentUserID, 'groupID' => $groupID, 'content' => $content, 'timeStamp' => $datetime]);

        $memcheck = DB::table('membership')->where('groupID', $groupID)->where('id', $currentUserID)->count();
        $studygroup = DB::table('studygroup')->where('groupID', $groupID)->get();
        $courses = DB::table('courses')->where('courseID',$studygroup[0]->courseID)->get();
        $users = DB::table('users')->get();
        $membership = DB::table('membership')->get();
        $comments = DB::table('comments')->where('groupID', $groupID)->orderBy('timeStamp','desc')->get();

        return view('grouphome', ['courses' => $courses, 'users' => $users,
        'membership' => $membership, 'studygroup' => $studygroup, 'comments' => $comments, 'memcheck' => $memcheck
        ]);
    }

    public function join($groupID)
    {
        $currentUserID = \Auth::user()->id;

        $memcheck = DB::table('membership')->where('groupID', $groupID)->where('id', $currentUserID)->count();

        if($memcheck === 0) {
            DB::table('membership')->insert(['id' => $currentUserID, 'groupID' => $groupID]);    
        }

        $memcheck = DB::table('membership')->where('groupID', $groupID)->where('id', $currentUserID)->count();
        $courses = DB::table('courses')->get();
        $users = DB::table('users')->get();
        $membership = DB::table('membership')->get();
        $studygroup = DB::table('studygroup')->where('groupID', $groupID)->get();
        $comments = DB::table('comments')->where('groupID', $groupID)->orderBy('timeStamp','desc')->get();

        return view('grouphome', ['courses' => $courses, 'users' => $users,
        'membership' => $membership, 'studygroup' => $studygroup, 'comments' => $comments, 'memcheck' => $memcheck, 'join' => True
        ]);
    }

    public function leave($groupID)
    {
        $currentUserID = \Auth::user()->id;

        DB::table('membership')->where(['id' => $currentUserID, 'groupID' => $groupID])->delete();

        // if no user is part of this group then delete the group
        $numMembers = DB::table('membership')->where(['groupID' => $groupID])->count();

        if($numMembers === 0) {
            // delete group
            $name = DB::table('studygroup')->where('groupID',$groupID)->get();
            DB::table('studygroup')->where(['groupID' => $groupID])->delete();


            // redirect to home page with banner
            $studyGroups = DB::table('Membership')->join('StudyGroup', 'Membership.groupid', '=', 'StudyGroup.groupid')->where('id', '=', $currentUserID)->get();
            $myCourses = DB::table('Subscribed')->join('Courses', 'Courses.courseid', '=', 'Subscribed.courseid')->where('id', '=', $currentUserID)->get();

            return view('home', ['studyGroups' => $studyGroups, 'myCourses' => $myCourses, 'leftGroupName' => $name[0]->groupName]);
        }

        $memcheck = DB::table('membership')->where('groupID', $groupID)->where('id', $currentUserID)->count();
        $courses = DB::table('courses')->get();
        $users = DB::table('users')->get();
        $membership = DB::table('membership')->get();
        $studygroup = DB::table('studygroup')->where('groupID', $groupID)->get();
        $comments = DB::table('comments')->where('groupID', $groupID)->orderBy('timeStamp','desc')->get();

        return view('grouphome', ['courses' => $courses, 'users' => $users,
        'membership' => $membership, 'studygroup' => $studygroup, 'comments' => $comments, 'memcheck' => $memcheck, 'leave' => True
        ]);
    }

    public function index($groupID)
    {
        $currentUserID = \Auth::user()->id;

        $memcheck = DB::table('membership')->where('groupID', $groupID)->where('id', $currentUserID)->count();
        $users = DB::table('users')->get();
        $membership = DB::table('membership')->get();
        $studygroup = DB::table('studygroup')->where('groupID', $groupID)->get();
        $courses = DB::table('courses')->where('courseID',$studygroup[0]->courseID)->get();
        $comments = DB::table('comments')->where('groupID', $groupID)->orderBy('timeStamp', 'desc')->get();

        return view('grouphome', ['courses' => $courses, 'users' => $users,
        'membership' => $membership, 'studygroup' => $studygroup, 'comments' => $comments, 'memcheck' => $memcheck
        ]);
    }

}
