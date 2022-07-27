<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Models\Contract;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Utils\ImportFileCheck;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Primes;
use PhpParser\Node\Expr\AssignOp\Concat;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = collect();
        $contracts = Contract::orderBy('created_at','DESC')->where('isdelete',0)->get();
        $primes = collect();
        $p =[];
        foreach($contracts as $contrac){
            $employe = Employee::find($contrac['employee_uuid']);
            $contract =  Contract::find($contrac['id']);

            $contracts =  Contract::where('id',$contrac['id'])->where('prime','!=','NULL')->first();
           // $p = json_decode($contract['prime'],true);
            //array_push($p,json_decode($contract['prime'],true));
          
        //        foreach ($p as $key=>$prime){
   
        //         $prime = Primes::find($prime);
     
        //         $primes->push([
        //             "prime"=>$prime[0]
        //         ]);
        //       //  dd($prime[1]);
            
  
        // }

            $data->push([
                'firstName'=>$employe->firstName,
                'lastName'=>$employe->lastName,
                'matricule'=>$employe->matricule,
                'poste'=>$employe->currentPosition,
                'id'=>$contract->id,
                'contract_type'=>$contract->contract_type,
                'startDate'=>date('d-m-Y',strtotime($contract->startDate)),
                'endDate'=>date('d-m-Y',strtotime($contract->endDate)),
                'baseSalary'=>$contract->baseSalary,
                'extrapay'=>$contract->extrapay,
                'title'=> json_decode($contract['prime'],true)==null? "":json_decode($contract['prime'],true)[0]["title"],
                'code'=> json_decode($contract['prime'],true)==null? "":json_decode($contract['prime'],true)[0]["code"],
                'amount'=> json_decode($contract['prime'],true)==null? "":json_decode($contract['prime'],true)[0]["amount"],
            ]);
          // dd(json_decode($contract['prime'],true)[0]["title"]);
        }


       
       
        return view('admin.contracts.contracts',compact('contracts','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employes = Employee::all();
        $primes =Primes::all();
        return view('admin.contracts.create_contract', compact('employes','primes'));
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

        //save data
       // dd($data);
       $dat = [];
       foreach($request['prime'] as $key=>$prime){
        $p = Primes::find($prime);

        array_push($dat,['title'=>$p->title,'amount'=>$p->amount,'code'=>$p->code,'uuid'=>$p->uuid]);
       
       }
       $data['prime']=json_encode($dat);
        Contract::create($data);
        return redirect()->route('contract.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contract = Contract::find($id);
        $co = Employee::find($contract['employee_uuid']);
        $prime = json_decode($contract['prime'],true);
       // dd($prime);
        return view('admin.contracts.show_contract', compact('contract','co','prime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract = Contract::find($id);
        $employes =Contract::find($id)->employee;
        $primes =Primes::all();
        return view('admin.contracts.edit_contract', compact('contract','employes','primes'));
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

        //save data
       //dd($data);
       $dat = [];
       if($request->has('prime')){
            foreach($request['prime'] as $key=>$prime){
                $p = Primes::find($prime);
        
                array_push($dat,['title'=>$p->title,'amount'=>$p->amount,'code'=>$p->code,'uuid'=>$p->uuid]);
            
            }
            $data['prime']=json_encode( $dat);
       }else{
        $data['prime']= Contract::find($id)->prime;
       }
     
       
       
        Contract::find($id)->update($data);
        return redirect()->route('contract.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contract = Contract::find($id);
        $contract->isdelete =1;
         $contract->save();
 
         return redirect()->route('contract.index');
    }


    //-----------------------------------------------------------------------------------------------------


    public function fileImportExport()
    {
       return view('admin.contracts.contract_import');
    }
    
    public function importContract(Request $request)
    {
     
        $file = $request->file('contract_import');
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
               
                //$d=Employee::where('matricule',$row[10])->first()->id;
               // return response()->json([ "data" => $d], 200);
                // return response()->json([ "data" =>$row], 200);
                try {
                DB::beginTransaction();
                Contract::create([
                    'employee_uuid'=> Employee::where('matricule',$row[0])->first()==null?0:Employee::where('matricule',$row[0])->first()->id,
                    'contract_type'=>$row[3]==null?null:$row[3],
                    'position'=>$row[4]==null?null:$row[4],
                    'baseSalary'=>$row[5]==null?null:$row[5],
                    'extrapay'=>$row[6]==null?null:$row[6],
                    'transportationAllowance'=>$row[7]==null?null:$row[7],
                    'signingDate'=>$row[8]==null?null:str_replace('/','-',$row[8]),
                    'startDate'=>$row[9]==null?null:str_replace('/','-',$row[9]),
                    'endDate'=>$row[10]==null?null:str_replace('/','-',$row[10]),
                    
                ]);
                
                DB::commit();
                } catch (\Exception $e) {
                throw $e;
                DB::rollBack();
                }
                }
                return redirect()->route('contract.index');;
               // return Session::put('success', 'Youe file successfully import in database!!!');
                } else {
                //no file was uploaded
                throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
                }
      }

}
