<?php

namespace App\Imports;

use App\Models\Saving;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSavings implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Saving([
            //

            'user_id' => $row[0],
            'savings_amount' => $row[1],
            'month' => $row[2],
            'status' => $row[3],
        ]);
    }
}
