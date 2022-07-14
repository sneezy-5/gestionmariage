<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Utils\ImportFileCheck;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = collect();
        $presences = Presence::orderBy('created_at','DESC')->where('isdelete',0)->get();
      
        foreach($presences as $contrac){
            $employe = Employee::find($contrac['employee_uuid']);
            $pre =  Presence::find($contrac['id']);
            $data->push([
                'firstName'=>$employe->firstName,
                'lastName'=>$employe->lastName,
                'matricule'=>$employe->matricule,
                'poste'=>$employe->currentPosition,
                'id'=>$pre->id,
                'periodStart'=>date('m-d-Y',strtotime($pre->periodStart)),
                'periodEnd'=>date('m-d-Y',strtotime($pre->periodEnd)),
                'absentdays'=>$pre->absentdays,
                'presentdays'=>$pre->presentdays,
                'delays'=>$pre->delays,
            ]);
        }
        return view('admin.presence.presences',compact('presences','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employes = Employee::all();
        return view('admin.presence.create_presence',compact('employes'));
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
        //dd($data);
        Presence::create($data);
        return redirect()->route('presence.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $presence = Presence::find($id);
        $co = Presence::find($id)->employee;
        return view('admin.presence.show_presence', compact('presence','co'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $presence = Presence::find($id);
        $employe = Presence::find($id)->employee;
        return view('admin.presence.edit_presence', compact('presence','employe'));
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
        Presence::find($id)->update($data);
        return redirect()->route('presence.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presence = Presence::find($id);
        $presence->isdelete =1;
        $presence->save();
        return redirect()->route('presence.index');
    }


     //-----------------------------------------------------------------------------------------------------


     public function fileImportExport()
     {
        return view('admin.presence.presence_import');
     }
     
     public function importPresence(Request $request)
     {
      
         $file = $request->file('presence_import');
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
                // return response()->json([ "data" => $row], 200);
                 try {
                 DB::beginTransaction();
                 Presence::create([

                     'periodStart'=>$row[3]==null?null:date('Y-m-d', strtotime(str_replace('/','-',$row[3]))),
                     'periodEnd'=>$row[4]==null?null:date('Y-m-d', strtotime(str_replace('/','-',$row[4]))),
                     'absentdays'=>$row[5]==null?null:$row[5],
                     'presentdays'=>$row[6]==null?null:$row[6],
                     'delays'=>$row[7]==null?null:$row[7],
                     'normalHours'=>$row[8]==null?null:$row[8],
                     'normalHoursComplementary'=>$row[9]==null?null:$row[9],
                     'Overtime_15'=>$row[10]==null?null:$row[10],
                     'Overtime_50'=>$row[11]==null?null:$row[11],
                     'Overtime_75'=>$row[12]==null?null:$row[12],
                     'Overtime_100'=>$row[13]==null?null:$row[13],
                     'employee_uuid'=>Employee::where('matricule',$row[0])->first()==null?null:Employee::where('matricule',$row[0])->first()->id
                 ]);
                 
                 DB::commit();
                 } catch (\Exception $e) {
                 throw $e;
                 DB::rollBack();
                 }
                 }
                return redirect()->route('presence.index');;
                // return Session::put('success', 'Youe file successfully import in database!!!');
                 } else {
                 //no file was uploaded
                 throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
                 }
       }
 
}
