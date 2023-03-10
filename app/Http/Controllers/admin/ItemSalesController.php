<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Customers;
use App\Models\admin\ItemName;
use App\Models\admin\ItemPurchase;
use App\Models\admin\ItemSales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class ItemSalesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role == config('constants.ROLE.ADMIN')) {
            $item_saless = ItemSales::orderBy('id','desc')->get();
            return view('admin.item_sales.index', compact('item_saless'));
        }
        $item_saless = ItemSales::where('created_by', $user->id)->orderBy('id','desc')->get();
        return view('admin.item_sales.index', compact('item_saless'));
    }


    public function create()
    {
        $user = Auth::user();
        if ($user->role == config('constants.ROLE.ADMIN')) {
            $customers = Customers::all();
            $item_namess = ItemPurchase::all();
            return view('admin.item_sales.create', compact('item_namess', 'customers'));
        }
        $customers = Customers::where('user_id', $user->id)->get();
        $item_namess = ItemPurchase::where('created_by', $user->id)->get();
        return view('admin.item_sales.create', compact('item_namess', 'customers'));
    }

    public function store(Request $request)
    {

        $request->validate(ItemSales::$rules);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        if ($request->hasFile("customer_photo")) {
            $img = $request->file("customer_photo");
            $img->store('public/images');
            $input['customer_photo'] = $img->hashName();
        }
        ItemSales::create($input);
        return redirect()->route('item_sales.index')->with('success', Lang::get('langs.flash_suc'));

    }

    public function show($id)
    {

    }

    public function edit(Request $request, $id)
    {
        $customers = Customers::all();
        $item_namess = ItemName::all();
        $item_saless = ItemSales::find($id);
        return view('admin.item_sales.edit', compact('customers', 'item_namess', 'item_saless'));
    }

    public function update(Request $request, $id)
    {
        $rules = ItemSales::$rules;
        $rules['customer_photo'] = 'nullable';
        $request->validate($rules);
        $item_saless = ItemSales::find($id);
        $input = $request->all();
        if ($request->hasFile("customer_photo")) {
            $img = $request->file("customer_photo");
            if (Storage::exists('public/images' . $item_saless->customer_photo)) {
                Storage::delete('public/images' . $item_saless->customer_photo);
            }
            $img->store('public/images');
            $input['customer_photo'] = $img->hashName();
            $item_saless->update($input);

        }

        $item_saless->update($input);

        return redirect()->route('item_sales.index')->with('info', Lang::get('langs.flash_up'));
    }

    public function destroy(Request $request, $id)
    {
        $item_saless = ItemSales::find($id);
        if (empty($item_saless)) {
            return redirect(route('item_sales.index'));
        }
        $item_saless->delete($id);
        return redirect(route('item_sales.index'))->with('danger', Lang::get('langs.flash_del'));


    }

    public function getQuantity(Request $request)
    {
        $quantity = ItemPurchase::select('item_quantity')->where('id', $request->id)->first();
        return $quantity;
    }

    public function getPayment(Request $request)
    {
        $quantity = ItemSales::select('deduct_payment')->where([['customer_id', $request->id], ['deduct_to_date', $request->to_date], ['deduct_from_date', $request->from_date]])->first();
        $final_amount = Customers::select('final_amount')->where('id', $request->id)->first();
        $data = array();
        $data['deduct_payment'] = $quantity['deduct_payment'];
        $data['final_amount'] = $final_amount['final_amount'];
        return $data;
    }

    public function remove_negative_amount(Request $request){
        $item_sales = ItemSales::find($request->id);
        $amount = $item_sales->total;
        $replace = str_ireplace( array( '\'', '"',
            ',' , '-', '<', '>' ), ' ', $amount);
        $input['total'] = $replace;
        $item_sales->update($input);
        return redirect()->back()->with('success','Remove Negative Amount');
    }
}
