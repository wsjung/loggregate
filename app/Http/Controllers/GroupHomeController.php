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
        $courses = DB::table('courses')->get();
        $users = DB::table('users')->get();
        $membership = DB::table('membership')->get();
        $studygroup = DB::table('studygroup')->where('groupID', $groupID)->get();
        $comments = DB::table('comments')->where('groupID', $groupID)->orderBy('timeStamp','desc')->get();

        return view('grouphome', ['courses' => $courses, 'users' => $users,
        'membership' => $membership, 'studygroup' => $studygroup, 'comments' => $comments, 'memcheck' => $memcheck
        ]);
    }

    public function join($groupID)
    {
        $currentUserID = \Auth::user()->id;

        DB::table('membership')->insert(['id' => $currentUserID, 'groupID' => $groupID]);

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
        $courses = DB::table('courses')->get();
        $users = DB::table('users')->get();
        $membership = DB::table('membership')->get();
        $studygroup = DB::table('studygroup')->where('groupID', $groupID)->get();
        $comments = DB::table('comments')->where('groupID', $groupID)->orderBy('timeStamp', 'desc')->get();

        return view('grouphome', ['courses' => $courses, 'users' => $users,
        'membership' => $membership, 'studygroup' => $studygroup, 'comments' => $comments, 'memcheck' => $memcheck
        ]);
    }

}
