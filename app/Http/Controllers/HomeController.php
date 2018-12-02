<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = \Auth::user()->id;
        $studyGroups = DB::table('Membership')->join('StudyGroup', 'Membership.groupid', '=', 'StudyGroup.groupid')->where('id', '=', $userid)->get();
        $myCourses = DB::table('Subscribed')->join('Courses', 'Courses.courseid', '=', 'Subscribed.courseid')->where('id', '=', $userid)->get();
        return view('home', ['studyGroups' => $studyGroups], ['myCourses' => $myCourses]);
    }
}
