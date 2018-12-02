<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GroupRegisterController extends Controller
{
    public function index()
    {
        $courses = DB::table('courses')->get();
        $users = DB::table('users')->get();
        $membership = DB::table('membership')->get();
        $studygroup = DB::table('studygroup')->get();

        return view('groupregister', ['courses' => $courses, 'users' => $users,
        'membership' => $membership, 'studygroup' => $studygroup
        ]);
    }
}
