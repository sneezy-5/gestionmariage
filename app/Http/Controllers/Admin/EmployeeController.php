<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Models\Contract;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Imports\EmployeImport;
use App\Utils\ImportFileCheck;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employes = Employee::orderBy('id','DESC')->get();
       // dd($employes);
        //return response()->json($employes);
        return view('admin.employee.employees',compact('employes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contracts = Contract::all();
        return view('admin.employee.create_employe',compact('contracts'));
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

        if ($request->hasFile('pictureURL')) {
            $filenameWithExt = $request->file('pictureURL')->getClientOriginalName ();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('pictureURL')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename. ''. time().'.'.$extension;
            // Upload Image
            $path = $request->file('pictureURL')->storeAs('public/image', $fileNameToStore);
            $data['pictureURL']=$fileNameToStore;
            }

           
        // Else add a dummy image
        else {
            $fileNameToStore = 'noimage.jpg';
            $data['pictureURL']=$fileNameToStore;
            }

       // dd($data);
        //save data
        Employee::create($data);

        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
       
        return view('admin.employee.show_employe', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('admin.employee.edit_employe', compact('employee'));
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

        if ($request->hasFile('pictureURL')) {
            $filenameWithExt = $request->file('pictureURL')->getClientOriginalName ();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('pictureURL')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename. ''. time().'.'.$extension;
            // Upload Image
            $path = $request->file('pictureURL')->storeAs('public/image', $fileNameToStore);
            $data['pictureURL']=$fileNameToStore;
            }

           
        // Else add a dummy image
        else {
            $fileNameToStore = 'noimage.jpg';
            $data['pictureURL']= Employee::find($id)->pictureURL;
            }

        //save data
        Employee::find($id)->update($data);

        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $employe = Employee::find($id);
       $employe->isdelete =1;
        $employe->save();

        return redirect()->route('employee.index');
    }


    public function fileImportExport()
    {
       return view('admin.employee.employe_import');
    }
   


    public function fileImport(Request $request) 
    {
        
        Excel::import(new EmployeImport, $request->file('employe_import')->store('temp'));
        Session::put('success', 'Youe file successfully import in database!!!');
        return back();
    }

    

    public function fileExport() 
    {
       // return Excel::download(new UsersExport, 'users-collection.xlsx');
    }   
    //-------------------------------------------------------------------------------------------------------

    public function importEmploye(Request $request)
    {
     
        $file = $request->file('employe_import');
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
                //return response()->json([ "data" => $filedata], 200);
                for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
                }
                fclose($file); //Close after reading
                $j = 0;
                foreach ($importData_arr as $row) {
                    
                $j++;
    
                try {
                  //erreur dans le calcul du nombre de part: recuperait row 13 au lieu de 14  pour les enfants et row 12 au lieu de 13 pour le statut marital
                //dd($row);
                DB::beginTransaction();
                Employee::create([
                    'name'=>$row[1]==null?null:$row[1],
                    'function'=>$row[2]==null?null:$row[2],
                    'table_name'=>$row[3]==null?null:$row[3],
                ]);
                
                DB::commit();
                } catch (\Exception $e) {
                throw $e;
                DB::rollBack();
                }
                }
                return redirect()->route('employee.index');;
               // return Session::put('success', 'Youe file successfully import in database!!!');
                } else {
                //no file was uploaded
                throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
                }
      }

      public function search(Request $request)
    {
        $search = Employee::where('name','LIKE','%'.strtoupper($request['search']).'%')->get();
        return view('search', compact('search'));
    }
}
