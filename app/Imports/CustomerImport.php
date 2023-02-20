<?php

namespace App\Imports;

use App\Models\admin\Customers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        Validator::make($row, [
            'user_id' => 'required',
            'customer_name' => 'required',
            'customer_code' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required|unique:customers,account_number',
            'ifsc_code' => 'required',
            'final_amount' => 'required',
        ])->validate();

        $input = collect($row)->toArray();
        $customer = Customers::create($input);

        $input['payment_from_date'] = '10-02-2023';
        $input['payment_to_date'] = '10-03-2023';
        $input['created_by'] = Auth::user()->id;
        $payment = $customer->customer()->create($input);


//       return redirect()->back();

//       return new Customers([
//            'customer_name' => $row['customer_name'],
//            'customer_code' => $row['customer_code'],
//            'user_id' => $row['user_id'],
//            'bank_name' => $row['bank_name'],
//            'account_number' => $row['account_number'],
//            'ifsc_code' => $row['ifsc_code'],
//            'final_amount' => $row['final_amount'],
//            'created_by' => $row['created_by'],
////            'updated_at' => $row['updated_at'],
//        ]);

//        return new Payment([
//            'customer_id' => 1,
//            'created_by' => $row['created_by'],
//            'payment_from_date' => '10-02-2023',
//            'payment_to_date' => '10-03-2023',
////            'updated_at' => $row['updated_at'],
//        ]);

//        return $customer;
    }

}
