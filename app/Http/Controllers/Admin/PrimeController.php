<?php

namespace App\Http\Controllers\Admin;

use App\Models\Primes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Utils\ImportFileCheck;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PrimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $primes = Primes::orderBy('created_at','DESC')->where('isdelete',0)->get();
        return view('admin.prime.primes',compact('primes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.prime.create_prime');
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
        Primes::create($data);
        return redirect()->route('prime.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prime = Primes::find($id);
        return view('admin.prime.show_prime', compact('prime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prime = Primes::find($id);
        return view('admin.prime.edit_prime', compact('prime'));
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
        Primes::find($id)->update($data);
        return redirect()->route('prime.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prime = Primes::find($id);
        $prime->isdelete =1;
        $prime->save();
        return redirect()->route('prime.index');
    }


    public function fileImportExport()
    {
       return view('admin.presence.presence_import');
    }
    
    public function importPrime(Request $request)
    {
     
        $file = $request->file('prime_import');
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
                Primes::create([

                    'title'=>$row[0]==null?null:$row[0],
                    'amount'=>$row[1]==null?null:$row[1],
                    'code'=>$row[2]==null?null:$row[2],
                ]);
                
                DB::commit();
                } catch (\Exception $e) {
                throw $e;
                DB::rollBack();
                }
                }
                return back();
               // return Session::put('success', 'Youe file successfully import in database!!!');
                } else {
                //no file was uploaded
                throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
                }
      }
}
