<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Show a list of all of the application's courses.
     *
     * @return Response
     */
    public function index()
    {
        // $courses = DB::table('courses')->select('subject')->groupBy('subject')->get();
        $courses = DB::table('courses')->get();

        return view('search', ['courses' => $courses]);
    }

    public function enroll() {       
        $order = Order::where('order_id', $orderId)->first();
        if (!$order) {
            App::abort(404);
    }

        $paid = Input::get('paid');
        $order->save();

        return Redirect::to('/admin/orders');
    }

    public function subList(){
        //grab user ID
        $currentUserID = \Auth::user()->id;

        #loop through user subscribed list
        $size = count($_GET);
        for ($i=0; $i<$size; $i++){
           //get current coursenum and subject
            $v = $_GET[$i];
            $s = explode(' ', $v);

            $subject = $s[0];
            $courseNum = $s[2];

            // echo $currentUserID . " " . $subject . " " . $courseNum . '<br>';


            //grab course ID
            $courseID = DB::table('courses')
                ->select('courseID')
                ->where([
                ['subject', '=', $subject],
                ['courseNum', '=', $courseNum],
                ])->first();

            //subscribe user by entry in subscribed
            DB::table('subscribed')->insert(['id' => $currentUserID, 'courseID' => $courseID->courseID]);

        }

        return self::subbed('subbed');
    }

    public function subbed($subbed) {
        $courses = DB::table('courses')->get();

        return view('search', ['courses' => $courses, 'subbed' => $subbed]);
    }
}