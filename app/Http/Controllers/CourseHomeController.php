<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CourseHomeController extends Controller
{
    public function index()
    {
        $currentCourseID = '1';
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
