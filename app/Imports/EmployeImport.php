<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeImport implements ToModel
{
       // Excel file header    
   public $header = [
    'firstName',
    'lastName',
    'birthdate',
    'birthplace',
    'nationality',
    'pictureURL',
    'CNPSnumber',
    'CMUnumber',
    'street',
    'neighborhood',
    'city',
    'country',
    'maritalStatus',
    'numberOfDependents',
    'NbrOfParts',
    'hiringDate',
    'seniority',
    'currentPosition',
    'exitDate',
    'phonenumbers',
    'email',
    'firstContract_uuid',
    'currentContract_uuid',
];
public $verifyHeader = true; // Header verification toggle
    
public $truncate = true; // We want to truncate table before the import

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Validator::make($row, [

        //     'firstName' => 'required',

        //     'lastName' => 'required',

        //     //'birthdate' => 'required',

        // ])->validate();
            //dd($row);

        return  Employee::create([
            'firstName'=>$row[0]==null?null:$row[0],
            'lastName'=>$row[1]==null?null:$row[0],
            // 'birthdate'=>$row[2]==null?null:$row[2],
            // 'birthplace'=>$row[3]==null?null:$row[3],
            // 'nationality'=>$row[4]==null?null:$row[4],
            // 'pictureURL'=>$row[5]==null?null:$row[5],
            // 'CNPSnumber'=>$row[6]==null?null:$row[6],
            // 'CMUnumber'=>$row[7]==null?null:$row[7],
            // 'street'=>$row[8]==null?null:$row[8],
            // 'neighborhood'=>$row[9]==null?null:$row[9],
            // 'city'=>$row[10]==null?null:$row[10],
            // 'country'=>$row[11]==null?null:$row[11],
            // 'maritalStatus'=>$row[12]==null?null:$row[12],
            // 'numberOfDependents'=>$row[13]==null?null:$row[13],
            // 'NbrOfParts'=>$row[14]==null?null:$row[14],
            // 'hiringDate'=>$row[15]==null?null:$row[15],
            // 'seniority'=>$row[16]==null?null:$row[16],
            // 'currentPosition'=>$row[17]==null?null:$row[17],
            // 'exitDate'=>$row[18]==null?null:$row[18],
            // 'phonenumbers'=>$row[19]==null?null:$row[19],
            // 'email'=>$row[20]==null?null:$row[20],
            // 'firstContract_uuid'=>$row[21]==null?null:$row[21],
            // 'currentContract_uuid'=>$row[22]==null?null:$row[22]
        ]);
    }

   
}
