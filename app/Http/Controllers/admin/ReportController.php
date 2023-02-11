<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Customers;
use App\Models\admin\ItemName;
use App\Models\admin\ItemPurchase;
use App\Models\admin\ItemSales;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
//    Customer Activity
    public function customer_report_show(Request $request)
    {
        $filter_customers = Customers::all();
        if ($request->date) {
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $filter_customers = Customers::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get();
        }
        return view('admin.report.customer.customer_report_show', compact('filter_customers'));
    }

    public function customer_report_show_pdf(Request $request)
    {
        $filter_customer_reports = Customers::all();
        if ($request->date) {
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $filter_customer_reports = Customers::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get();
        }
        $item_purchasePaper = array(0, 0, 1000.00, 900.80);
        $pdf = PDF::loadView('admin.report.customer.customer_report_show_pdf', compact('filter_customer_reports'))->setPaper($item_purchasePaper);
        if (isset($start)) {
            return $pdf->download($start . '_to_' . $end . '_' . 'customer_report.pdf');
        } else {
            return $pdf->download('customer_report.pdf');
        }

    }

    public function customer_report_pdf(Request $request)
    {
        $input = $request->all();
        $val = array_keys($input['field']);
        $customer_reports = Customers::select($val)->get();

        $customerPaper = array(0, 0, 1000.00, 900.80);
        $pdf = PDF::loadView('admin.report.customer.customer_report_pdf', compact('customer_reports', 'input'))->setPaper($customerPaper);
        if (isset($start)) {
            return $pdf->download($start . '_to_' . $end . '_' . 'customer_report.pdf');
        } else {
            return $pdf->download('customer_report.pdf');
        }
    }

    public function customer_report_export(Request $request)
    {

        $request->validate(
            [
                'field' => 'required'
            ]
        );

        $input = $request->all();
//        $users = User::find($request->name);
        $val = array_keys($input['field']);
        $customers = Customers::select($val)->get();
        if ($request->date) {
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $customers = Customers::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->select($val)->get();
        }

        return view('admin.report.customer.customer_export_report', compact('customers', 'input'));
    }


//    Item Name Activity
    public function item_name_report_show(Request $request)
    {

        $item_names = ItemName::all();
        if ($request->date || $request->item_name) {
            $item_names = ItemName::all();
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $item_names = ItemName::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get();
            return view('admin.report.item_name.item_name_report_show', compact('item_names', 'item_names'));

        }
        return view('admin.report.item_name.item_name_report_show', compact('item_names'));

    }

    public function item_name_report_show_pdf(Request $request)
    {
        $item_name_reports = ItemName::all();
        if ($request->date) {
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $item_name_reports = ItemName::whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $end)->get();
        }
        $item_salesPaper = array(0, 0, 1000.00, 900.80);
        $pdf = PDF::loadView('admin.report.item_name.item_name_report_show_pdf', compact('item_name_reports'))->setPaper($item_salesPaper);
        if (isset($start)) {
            return $pdf->download($start . '_to_' . $end . '_' . 'item_name_report.pdf');
        } else {
            return $pdf->download('item_name_report.pdf');
        }

    }

    public function item_name_report_pdf(Request $request)
    {
        $input = $request->all();
        $val = array_keys($input['field']);
        $item_name_reports = ItemName::select($val)->get();
        $item_namePaper = array(0, 0, 1000.00, 900.80);
        $pdf = PDF::loadView('admin.report.item_name.item_name_report_pdf', compact('item_name_reports', 'input'))->setPaper($item_namePaper);
        if (isset($start)) {
            return $pdf->download($start . '_to_' . $end . '_' . 'customer_report.pdf');
        } else {
            return $pdf->download('item_name_report.pdf');
        }
    }

    public function item_name_report_export(Request $request)
    {
        $request->validate(
            [
                'field' => 'required'
            ]
        );

        $input = $request->all();
        $val = array_keys($input['field']);
        $item_name_reports = ItemName::select($val)->get();
        if ($request->date) {
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $item_name_reports = ItemName::whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $end)->select($val)->get();
        }
        return view('admin.report.item_name.item_name_export_report', compact('item_name_reports', 'input'));
    }

//    Item Sales Activity
    public function item_sales_report_show(Request $request)
    {
        $filter_item_sales = ItemSales::all();
        if ($request->date) {
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $filter_item_sales = ItemSales::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get();
            //    return view('admin.report.item_sales.item_sales_report',compact('filter_item_sales'));

        }
        return view('admin.report.item_sales.item_sales_report_show', compact('filter_item_sales'));

    }

    public function item_sales_report_show_pdf(Request $request)
    {
        $item_sales_reports = ItemSales::all();
        if ($request->date) {
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $item_sales_reports = ItemSales::whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $end)->get();
        }
        $item_salesPaper = array(0, 0, 1000.00, 900.80);
        $pdf = PDF::loadView('admin.report.item_sales.item_sales_report_show_pdf', compact('item_sales_reports'))->setPaper($item_salesPaper);
        if (isset($start)) {
            return $pdf->download($start . '_to_' . $end . '_' . 'item_sales_report.pdf');
        } else {
            return $pdf->download('item_sales_report.pdf');
        }
    }

    public function item_sales_report_export(Request $request)
    {

        $request->validate(
            [
                'field' => 'required'
            ]
        );

        $input = $request->all();
        $val = array_keys($input['field']);
        $item_saless = ItemSales::select($val)->get();
        if ($request->date) {
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $item_saless = ItemSales::whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $end)->select($val)->get();
        }
        return view('admin.report.item_sales.item_sales_export_report', compact('item_saless', 'input'));
    }

    public function item_sales_filter()
    {

        return view('admin.report.item_sales.item_sales_filter');
    }

//    Item purchase Activity
    public function item_purchase_report_show(Request $request)
    {
        $filter_item_purchase = ItemPurchase::all();
        if ($request->date) {
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $filter_item_purchase = ItemPurchase::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get();
//            return view('admin.report.item_purchase.item_purchase_report',compact('filter_item_purchase'));

        }
        return view('admin.report.item_purchase.item_purchase_report_show', compact('filter_item_purchase'));

    }

    public function item_purchase_report_show_pdf(Request $request)
    {
        $item_purchase_reports = ItemPurchase::all();
        if ($request->date) {
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $item_purchase_reports = ItemPurchase::whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $end)->get();
        }
        $item_purchasePaper = array(0, 0, 1000.00, 900.80);
        $pdf = PDF::loadView('admin.report.item_purchase.item_purchase_report_show_pdf', compact('item_purchase_reports'))->setPaper($item_purchasePaper);
        if (isset($start)) {
            return $pdf->download($start . '_to_' . $end . '_' . 'item_purchase_report.pdf');
        } else {
            return $pdf->download('item_purchase_report.pdf');
        }
    }

    public function item_purchase_report_pdf(Request $request)
    {

        $input = $request->all();


        $val = array_keys($input['field']);
        $item_purchase_reports = ItemPurchase::select($val)->get();
        $item_purchasePaper = array(0, 0, 1000.00, 900.80);
        $pdf = PDF::loadView('admin.report.item_purchase.item_purchase_report_pdf', compact('item_purchase_reports', 'input'))->setPaper($item_purchasePaper);
        if (isset($start)) {
            return $pdf->download($start . '_to_' . $end . '_' . 'item_purchase_report.pdf');
        } else {
            return $pdf->download('item_purchase_report.pdf');
        }
    }

    public function item_purchase_report_export(Request $request)
    {

        $request->validate(
            [
                'field' => 'required'
            ]
        );

        $input = $request->all();
        $val = array_keys($input['field']);
        $item_purchases = ItemPurchase::select($val)->get();

        if ($request->date) {
            $date = $request->date;
            $name = explode(' ', $date);
            $start = date('Y-m-d', strtotime($name[0]));
            $end = date('Y-m-d', strtotime($name[2]));
            $item_purchases = ItemPurchase::whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $end)->select($val)->get();
        }
        return view('admin.report.item_purchase.item_purchase_export_report', compact('item_purchases', 'input'));
    }

}


