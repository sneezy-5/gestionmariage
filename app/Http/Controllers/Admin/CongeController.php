<?php

namespace App\Http\Controllers\Admin;

use App\Models\Conge;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\payslip;

class CongeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = collect();
        $conges = Conge::orderBy('created_at','DESC')->where('isdelete',0)->get();
        foreach($conges as $conge){
            $employe = Employee::find($conge['employee_uuid']);
            $cong =  Conge::find($conge['id']);
            $data->push([
                'firstName'=>$employe->firstName,
                'lastName'=>$employe->lastName,
                'matricule'=>$employe->matricule,
                'poste'=>$employe->currentPosition,
                'id'=>$cong->id,
                'cumulativeDay'=>$cong->cumulativeDay,
                'tekanDay'=>$cong->tekanDay,
                'restant'=>$cong->cumulativeDay-$cong->tekanDay,
            ]);
        }
        return view('admin.conges.conges',compact('conges','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employes = Employee::all();

       
        return view('admin.conges.create_conge', compact('employes'));
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

        Conge::create($data);
        return redirect()->route('conge.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conge = Conge::find($id);
        $employe = Conge::find($id)->employee;
        return view('admin.conges.show_conge', compact('conge','employe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conge = Conge::find($id);
        $employes =Conge::find($id)->employee;
        return view('admin.conges.edit_conge', compact('conge','employes'));
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

        Conge::find($id)->update($data);
        return redirect()->route('conge.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contract = Conge::find($id);
        $contract->isdelete =1;
         $contract->save();
 
         return redirect()->route('conge.index');
    }





 
}
