<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    /**
     * Show a list of all of the application's courses.
     *
     * @return Response
     */
    public function index()
    {
        $courses = DB::table('courses')->get();

        return view('course', ['courses' => $courses]);
    }
}