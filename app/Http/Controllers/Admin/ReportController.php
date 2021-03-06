<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function order_index(Request $request)
    {
        return view('admin-views.report.order-index',compact('request'));
    }

    public function earning_index()
    {
        if (session()->has('from_date') == false) {
            session()->put('from_date', date('Y-m-01'));
            session()->put('to_date', date('Y-m-30'));

        }
        return view('admin-views.report.earning-index');
    }

    public function set_date(Request $request)
    {

        session()->put('from_date', date('Y-m-d', strtotime($request['from'])));
        session()->put('to_date', date('Y-m-d', strtotime($request['to'])));
        session()->put('user_id',$request->user_id);
        if ($request['from'] === null) {
            session()->forget('from_date');
        }
        if ($request['to'] === null) {
            session()->forget('to_date');
        }
        if ($request['user_id'] === null) {
            session()->forget('user_id');
        }
        return back();
    }
}
