<?php


use App\Models\Admin\Notification;
use App\Models\Admin\User_Rating;
use Illuminate\Support\Facades\Request;


function get_currency($currency)
{
    return '$' . number_format($currency, 2, ".", ",");
}


function get_rupee_currency($rupee_currency)
{
    return '₹' . number_format($rupee_currency, 2, ".", ",");
}



function date_formate($date)
{
    return \Carbon\Carbon::parse($date)->format('Y-m-d');
}


