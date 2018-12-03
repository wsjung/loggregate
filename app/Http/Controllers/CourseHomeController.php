<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CourseHomeController extends Controller
{
    public function sub($currentCourseID){
        // $currentCourseID = '1';
        $currentUserID = \Auth::user()->id;

        if(DB::table('subscribed')->where(['id' => $currentUserID, 'courseID' => $currentCourseID])->count() === 0) {
            DB::table('subscribed')->insert(['id' => $currentUserID, 'courseID' => $currentCourseID]);

            $courses = DB::table('courses')->where('courseID', $currentCourseID)->first();
            $users = DB::table('users')->get();
            $subscribed = DB::table('subscribed')->get();
            $membership = DB::table('membership')->get();
            $studygroup = DB::table('studygroup')->where('courseID', $currentCourseID)->get();

            return view('coursehome', ['courses' => $courses, 'users' => $users, 'membership' => $membership, 'studygroup' => $studygroup, 'subscribed' => $subscribed, 'subbed' => True
            ]);
        } else {
            return self::index($currentCourseID);
        }        
    }

    public function unsub($currentCourseID){
        // $currentCourseID = '1';
        $currentUserID = \Auth::user()->id;

        DB::table('subscribed')->where('courseID', $currentCourseID)->where('id', $currentUserID)->delete();

        $courses = DB::table('courses')->where('courseID', $currentCourseID)->first();
        $users = DB::table('users')->get();
        $subscribed = DB::table('subscribed')->get();
        $membership = DB::table('membership')->get();
        $studygroup = DB::table('studygroup')->where('courseID', $currentCourseID)->get();

        return view('coursehome', ['courses' => $courses, 'users' => $users,
        'membership' => $membership, 'studygroup' => $studygroup, 'subscribed' => $subscribed, 'unsubbed' => True
        ]);
    }

    public function index($currentCourseID)
    {
        $currentUserID = \Auth::user()->id;

        $courses = DB::table('courses')->where('courseID', $currentCourseID)->first();
        $users = DB::table('users')->get();
        $subscribed = DB::table('subscribed')->get();
        $membership = DB::table('membership')->get();
        $studygroup = DB::table('studygroup')->where('courseID', $currentCourseID)->get();

        return view('coursehome', ['courses' => $courses, 'users' => $users,
        'membership' => $membership, 'studygroup' => $studygroup, 'subscribed' => $subscribed
        ]);
    }
}
