<?php

namespace App\Imports;

use App\Models\admin\Customers;
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

        return new Customers([
            'customer_name' => $row['customer_name'],
            'customer_code' => $row['customer_code'],
            'user_id' => $row['user_id'],
            'bank_name' => $row['bank_name'],
            'account_number' => $row['account_number'],
            'ifsc_code' => $row['ifsc_code'],
            'final_amount' => $row['final_amount'],
            'created_by' => $row['created_by'],
//            'updated_at' => $row['updated_at'],
        ]);
    }
}
