<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSales extends Model
{
    use HasFactory;


    public static $rules = [
        'PayFromDT' => 'required',
        'PayToDT' => 'required',
        'itemQuantity' => 'required',
        'CustPhoto' => 'required',
        'item_name_id' => 'required',
        'customer_id' => 'required',
        'Payment_Rate' => 'required',
        'DeductFromDT' => 'required',
        'DeductToDT' => 'required',
        'Deduct_Rate' => 'required',
        'Total_DT' => 'required',
        'Total_Rate' => 'required',
    ];
    public $table = 'item_sales';
    protected $fillable = [
        'PayFromDT',
        'PayToDT',
        'Payment_Rate',
        'DeductFromDT',
        'DeductToDT',
        'Deduct_Rate',
        'Total_DT',
        'Total_Rate',
        'customer_id',
        'item_name_id',
        'itemQuantity',
        'CustPhoto',
        'created_by',
    ];

    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function item_names()
    {
        return $this->belongsTo(ItemName::class, 'item_name_id');
    }
}
