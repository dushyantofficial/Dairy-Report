<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentReportController extends Controller
{
    public function payment_register_report(Request $request){
        $user = Auth::user();
        if ($user->role == config('constants.ROLE.ADMIN')) {
            $filter_payment_register = Customers::orderBy('id','desc')->get();
            if ($request->date) {
                $date = $request->date;
                $name = explode(' ', $date);
                $start = date('Y-m-d', strtotime($name[0]));
                $end = date('Y-m-d', strtotime($name[2]));
                $filter_payment_register = Customers::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get();
            }
            return view('admin.payment.payment_register_report', compact('filter_payment_register'));
        }
        $filter_payment_register = Customers::where('user_id', $user->id)->orderBy('id','desc')->get();
        if ($request->date) {
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $filter_customers = Customers::where('user_id', $user->id)->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get();
        }
        return view('admin.payment.payment_register_report', compact('filter_payment_register'));
    }

    public function payment_deduct_report(Request $request){
        $user = Auth::user();
        if ($user->role == config('constants.ROLE.ADMIN')) {
            $filter_customers = Customers::orderBy('id','desc')->get();
            if ($request->date) {
                $date = $request->date;
                $name = explode(' ', $date);
                $start = date('Y-m-d', strtotime($name[0]));
                $end = date('Y-m-d', strtotime($name[2]));
                $filter_customers = Customers::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get();
            }
            return view('admin.report.customer.customer_report_show', compact('filter_customers'));
        }
        $filter_customers = Customers::where('user_id', $user->id)->orderBy('id','desc')->get();
        if ($request->date) {
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $filter_customers = Customers::where('user_id', $user->id)->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get();
        }
        return view('admin.report.customer.customer_report_show', compact('filter_customers'));
    }


}
