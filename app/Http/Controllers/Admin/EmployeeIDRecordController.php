<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\EmployeeIDRecord;
use App\Http\Controllers\Controller;

class EmployeeIDRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = EmployeeIDRecord::orderBy('created_at','DESC')->where('isdelete',0)->get();
        return view('admin.employeeIdrecord.employees',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employes = Employee::all();
        return view('admin.employeeIdrecord.create_employe',compact('employes'));
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
        EmployeeIDRecord::create($data);
        return redirect()->route('employeeidrecord.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employes = EmployeeIDRecord::find($id);
        $co = EmployeeIDRecord::find($id)->employee;
        return view('admin.employeeIdrecord.show_employe', compact('employes','co'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employe = EmployeeIDRecord::find($id);
        $employes = $employe->employee;
        return view('admin.employeeIdrecord.edit_employe', compact('employes','employes'));
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
        EmployeeIDRecord::find($id)->update($data);
        return redirect()->route('employeeidrecord.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employe = EmployeeIDRecord::find($id);
       $employe->isdelete =1;
        $employe->save();
        return redirect()->route('employeeidrecord.index');
    }
}
