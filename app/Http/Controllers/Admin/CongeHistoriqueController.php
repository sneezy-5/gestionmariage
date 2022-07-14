<?php

namespace App\Http\Controllers\Admin;

use App\Models\Conge;
use App\Models\payslip;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\CongeHistorique;
use App\Http\Controllers\Controller;
use DateTime;

class CongeHistoriqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = collect();
        $conges = CongeHistorique::orderBy('created_at','DESC')->where('isdelete',0)->get();
        
        foreach($conges as $conge){
            
            $employe = Employee::find($conge['employee_uuid']);
           $history = CongeHistorique::find($conge['id']);
            $data->push([
                'firstName'=>$employe->firstName,
                'lastName'=>$employe->lastName,
                'matricule'=>$employe->matricule,
                'poste'=>$employe->currentPosition,
                'id'=>$history->id,
                'request_date'=>date('d-m-Y', strtotime($history->request_date)),
                'start_date'=>date('d-m-Y', strtotime($history->start_date)),
                'end_date'=>date('d-m-Y', strtotime($history->end_date)),
                'amount'=>$history->amount,
                'employe_uuid'=>$employe->id,
            ]);
        }
        return view('admin.congehistory.conges',compact('conges','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$conges = CongeHistorique::all();
        $employes = Employee::all();
        return view('admin.congehistory.create_conge', compact('employes'));
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
       
      //  dd($data);

        $payslips = payslip::where('employee_uuid',$request['employee_uuid'])->orderBy('paymentDate','DESC')->skip(0)->take(12)->get();
        $som =0; 
        
        foreach($payslips as $p){
            $som+=$p['grossIncome'];
        }
       

        $maj = 1;

        //duré de congé
        $dureconge =round( 12*2.2*$maj*1.25);
        $SMN = round($som/12);
        $alloc = round($SMN*$dureconge/30);
        $data['amount']=$alloc;
        CongeHistorique::create($data);

        return redirect()->route('congehistory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conge = CongeHistorique::find($id);

        $employe = CongeHistorique::find($id)->employee;
        return view('admin.congehistory.show_conge', compact('conge','employe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conge = CongeHistorique::find($id);
        $employes = CongeHistorique::find($id)->employee;
        return view('admin.congehistory.edit_conge', compact('conge','employes'));
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

        CongeHistorique::find($id)->update($data);
        return redirect()->route('congehistory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contract = CongeHistorique::find($id);
        $contract->isdelete =1;
         $contract->save();
 
         return redirect()->route('congehistory.index');
    }


       // calcul de congé 
       public function calconge($id){
        $employe = Employee::find($id);
       // $payslips = payslip::where('employee_uuid',$employe['id'])->orderBy('paymentDate','DESC')->skip(0)->take(12)->sum('grossIncome');
    
        $payslips = payslip::where('employee_uuid',$employe['id'])->orderBy('paymentDate','DESC')->skip(0)->take(12)->get();
        $som =0; 
        foreach($payslips as $p){
            $som+=$p['grossIncome'];
        }
        // $date1 = new DateTime($datevalue->format('Y-m-d H:i:s'));
        // $diff = $date1->diff($ohter_date);

        //seniority 
        $nowdate = New DateTime(date('y-m-d'));
        $seniority = date('y-m-d',strtotime($employe['hiringDate'] ));
        $date  = new DateTime($seniority);
       $sen = $date->diff($nowdate);
       $years = $sen->y; 

       //maj
        $maj = 1;

        //duré de congé
        $dureconge =round( 12*2.2*$maj*1.25);
        $SMN = round($som/12);
        $alloc = round($SMN*$dureconge/30);
        dd($dureconge,$SMN,$alloc);
    }
}
