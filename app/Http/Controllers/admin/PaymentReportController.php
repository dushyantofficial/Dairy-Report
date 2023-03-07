<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Customers;
use App\Models\admin\ItemSales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentReportController extends Controller
{
    public function payment_register_report(Request $request){
        $user = Auth::user();
        if ($user->role == config('constants.ROLE.ADMIN')) {
            $filter_payment_register = Customers::orderBy('id', 'desc')->get();
            $bank_names = Customers::orderBy('bank_name', 'asc')->distinct()->get();
            if ($request->date) {
                $date = $request->date;
                $name = explode(' ', $date);
                $start = date('Y-m-d', strtotime($name[0]));
                $end = date('Y-m-d', strtotime($name[2]));

                $filter_payment_register = Customers::where(function ($query) use ($request,$start,$end){
                    $query->whereBetween('customer_code',[$request->customer_from_code,$request->customer_to_code]);
                    $query->orWhere('bank_name','==',$request->bank_name);
                    $query->whereDate('created_at', '>=', $start);
                    $query->whereDate('created_at', '>=', $end);
                })->get();

//                $filter_payment_register = Customers::where('customer_code',$request->customer_from_code)->orWhere('customer_code',$request->customer_to_code)->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get();
//           dd($filter_payment_register);
            }
            return view('admin.payment.payment_register_report', compact('filter_payment_register', 'bank_names'));
        }
        $filter_payment_register = Customers::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        $bank_names = Customers::where('user_id', $user->id)->orderBy('bank_name', 'desc')->get();
        if ($request->date) {
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $filter_customers = Customers::where('user_id', $user->id)->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get();
        }
        return view('admin.payment.payment_register_report', compact('filter_payment_register', 'bank_names'));
    }

    public function payment_deduct_report(Request $request){
        $user = Auth::user();
        if ($user->role == config('constants.ROLE.ADMIN')) {
            $filter_payment_deduct = ItemSales::orderBy('id', 'desc')->get();
            $bank_names = Customers::orderBy('bank_name', 'asc')->distinct()->get();
            if ($request->date) {
                $date = $request->date;
                $name = explode(' ', $date);
                $start = date('Y-m-d', strtotime($name[0]));
                $end = date('Y-m-d', strtotime($name[2]));

                $filter_payment_deduct = Customers::where(function ($query) use ($request,$start,$end){
                    $query->whereBetween('customer_code',[$request->customer_from_code,$request->customer_to_code]);
                    $query->orWhere('bank_name','==',$request->bank_name);
                    $query->whereDate('created_at', '>=', $start);
                    $query->whereDate('created_at', '>=', $end);
                })->get();

            }
            return view('admin.payment.payment_deduct_report', compact('filter_payment_deduct', 'bank_names'));
        }
        $filter_payment_deduct = ItemSales::where('created_by', $user->id)->orderBy('id', 'desc')->get();
        $bank_names = Customers::where('user_id', $user->id)->orderBy('bank_name', 'desc')->get();
        if ($request->date) {
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $filter_customers = Customers::where('user_id', $user->id)->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get();
        }
        return view('admin.payment.payment_deduct_report', compact('filter_payment_deduct', 'bank_names'));
    }


}
