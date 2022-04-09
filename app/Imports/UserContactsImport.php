<?php

namespace App\Imports;

use Auth;
use App\UserContact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserContactsImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new UserContact([
            'user_id' => Auth::id(),
            'contact_name' => $row['name'],
            'contact_phone' => $row['phone'],
            'contact_email' => $row['email'],
            'company_name' => isset($row['company']) ? $row['company'] : '',
            'notes' => isset($row['notes']) ? $row['notes'] : '',
        ]);
    }
}
