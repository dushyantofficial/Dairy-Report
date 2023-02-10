<?php

namespace App\Http\Controllers;

use App\Models\admin\Customers;
use App\Models\admin\ItemPurchase;
use App\Models\admin\ItemSales;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $customers = Customers::count();
        $item_sales = ItemSales::count();
        $item_purchase = ItemPurchase::count();
        return view('home', compact('users',
            'customers', 'item_sales', 'item_purchase'));
    }
}
