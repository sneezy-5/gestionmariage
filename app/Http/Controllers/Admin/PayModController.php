<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\PayMode;
use Illuminate\Http\Request;

class PayModController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = collect();
        $paymods = PayMode::orderBy('created_at','DESC')->where('isdelete',0)->get();
        foreach($paymods as $pay){
            $employe = Employee::find($pay['employee_uuid']);
            
          

            $data->push([
                'firstName'=>$employe->firstName,
                'lastName'=>$employe->lastName,
                'matricule'=>$employe->matricule,
                'poste'=>$employe->currentPosition,
                'id'=>$pay->id,
                'bank_name'=>$pay->bank_name,
                'carte_num'=>$pay->carte_num,
                'pay_method'=>$pay->pay_method,
                'preferential_paymentMethod'=>$pay->preferential_paymentMethod,
            ]);
        }
        return view('admin.paymod.pay',compact('paymods','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employes = Employee::all();
        return view('admin.paymod.create_pay', compact('employes'));
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

        PayMode::create($data);
        return redirect()->route('paymod.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymod = PayMode::find($id);
        $employe = PayMode::find($id)->employee;
        return view('admin.paymod.show_pay', compact('paymod','employe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymod = PayMode::find($id);
        $employe =PayMode::find($id)->employee;
        return view('admin.paymod.edit_pay', compact('paymod','employe'));
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

        PayMode::find($id)->update($data);
        return redirect()->route('paymod.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contract = PayMode::find($id);
        $contract->isdelete =1;
         $contract->save();
 
         return redirect()->route('paymod.index');
    }
}
