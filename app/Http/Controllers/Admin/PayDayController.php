<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\PaydayAdvances;
use App\Utils\ImportFileCheck;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PayDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = collect();
        $paydays = PaydayAdvances::orderBy('created_at','DESC')->where('isdelete',0)->get();

        foreach($paydays as $pay){
            $employe = Employee::find($pay['employee_uuid']);

            $data->push([
                'firstName'=>$employe->firstName,
                'lastName'=>$employe->lastName,
                'matricule'=>$employe->matricule,
                'id'=>$pay->id,
                'RequestDate'=>date('d-m-Y',strtotime($pay->RequestDate)),
                'amountRequested'=>$pay->amountRequested,
                'paymentDate'=>date('d-m-Y',strtotime($pay->paymentDate)),
                'ReimbursmentDate'=>date('d-m-Y',strtotime($pay->ReimbursmentDate)),
            ]);
        }

      
        return view('admin.paydays.paydays',compact('paydays','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employes = Employee::all();
        return view('admin.paydays.create_payday', compact('employes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        PaydayAdvances::create($data);
        return redirect()->route('payday.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payday = PaydayAdvances::find($id);
        $co = PaydayAdvances::find($id)->employee;
        return view('admin.paydays.show_payday', compact('payday','co'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payday = PaydayAdvances::find($id);
        $employe = PaydayAdvances::find($id)->employee;
        return view('admin.paydays.edit_payday', compact('payday','employe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        PaydayAdvances::find($id)->update($data);
        return redirect()->route('payday.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payday = PaydayAdvances::find($id);
       $payday->isdelete =1;
        $payday->save();
        return redirect()->route('payday.index');
    }


    public function fileImportExport()
    {
       return view('admin.paydays.payday_import');
    }
    
    public function importPaydAy(Request $request)
    {
     
        $file = $request->file('payday_import');
                if ($file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
                $tempPath = $file->getRealPath();
                $fileSize = $file->getSize(); //Get size of uploaded file in bytes
                //Check for file extension and size

                ImportFileCheck::checkUploadedFileProperties($extension,$fileSize);
    
                //Where uploaded file will be stored on the server 
                $location = 'uploads'; //Created an "uploads" folder for that
                // Upload file
                $file->move($location, $filename);
                // In case the uploaded file path is to be stored in the database 
                $filepath = public_path($location . "/" . $filename);
                // Reading file
                $file = fopen($filepath, "r");
                $importData_arr = array(); // Read through the file and store the contents as an array
                $i = 0;
                

               
                //Read the contents of the uploaded file 
                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);
                // Skip first row (Remove below comment if you want to skip the first row)
                if ($i == 0) {
                $i++;
                continue;
                }
               // return response()->json([ "data" => $filedata], 200);
                for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
                }
                fclose($file); //Close after reading
                $j = 0;
                foreach ($importData_arr as $row) {
                    
                $j++;
                //return response()->json([ "data" => $row], 200);
                try {
                DB::beginTransaction();
                PaydayAdvances::create([

                    'RequestDate'=>$row[3]==null?null:date('Y-m-d', strtotime(str_replace('/','-',$row[3]))) ,
                    'amountRequested'=>$row[4]==null?0:$row[4],
                    'paymentDate'=>$row[5]==null?null:date('Y-m-d', strtotime(str_replace('/','-',$row[5]))),
                    'paymentMethod'=>$row[6]==null?null:$row[6],
                   // 'ReimbursmentDate'=>$row[4]==null?null:new DateTime(str_replace('/','-',strtotime($row[4])) ),
                    'employee_uuid'=> Employee::where('matricule',$row[0])->first()==null?null:Employee::where('matricule',$row[0])->first()->id
                ]);
                
                DB::commit();
                } catch (\Exception $e) {
                throw $e;
                DB::rollBack();
                }
                }
             return redirect()->route('payday.index') ;
            //return Session::put('success', 'Youe file successfully import in database!!!');
                } else {
                //no file was uploaded
                throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
                }
      }
}
