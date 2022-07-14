<?php

namespace App\Http\Controllers\Admin;

use PDF;
use DateTime;
use Nette\Utils\Json;
use App\Models\Primes;
use App\Models\PayMode;
use App\Models\payslip;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Presence;
use DivisionByZeroError;
use Illuminate\Http\Request;
use App\Models\PaydayAdvances;
use App\Http\Controllers\Controller;
use App\Models\CongeHistorique;

class PayslipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=collect();
        $payslips = payslip::orderBy('created_at','DESC')->where('isdelete',0)->get();
        foreach($payslips as $payslip){
            $employe = Employee::find($payslip['employee_uuid']);
           // $paysli =  payslip::find($payslip['uuid']);
            $data->push([
                "uuid"=>$payslip->uuid,
                'firstName'=>$employe->firstName,
                'lastName'=>$employe->lastName,
                'matricule'=>$employe->matricule,
                'id'=>$payslip->uuid,
                'paymentDate'=>$payslip->paymentDate,
                'netToPay'=>$payslip->netToPay,
                'paymentMethod'=>$payslip->paymentMethod,
                'created_at'=>$payslip->created_at,
            ]);
        }
        //dd($payslip,$employe);
        return view('admin.payslips.payslips',compact('payslips','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payslips = payslip::all();
        $employes = Employee::all();
        return view('admin.payslips.create_payslip', compact('payslips','employes'));
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
        
        payslip::create($data);
        return redirect()->route('payslip.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // $totalNetAPayer=0;
        $payslip = payslip::find($id);
        $payslips = Employee::find($payslip->employee_uuid);
        $payslipsAll = payslip::all();
        $test=$payslip->employee_uuid;
        $employeeid=Employee::find($test);
         dd($payslip);
       $presences=Presence::where('employee_uuid',$test)->first();
        $contracts=Contract::find($test);
        $contracts=Contract::where('employee_uuid',$test)->first();

        $totalNetAPayer = $payslipsAll->sum('netToPay');
        //return response()->json($totalNetAPayer);
    
        return view('admin.payslips.show_test', compact('payslips','payslip','totalNetAPayer','contracts','presences'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payslip = payslip::find($id);
        $employe = payslip::find($id)->employee;
       
        
        return view('admin.payslips.edit_payslip', compact('payslip','employe'));
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
        payslip::find($id)->update($data);
        return redirect()->route('payslip.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payslip = payslip::find($id);
       $payslip->isdelete =1;
        $payslip->save();
        return redirect()->route('payslip.index');
    }


    public function search(Request $request){
       $payslips = payslip::whereBetween('end_payement_date', [$request['start_date'], $request['end_date']])->get();
       $data=collect();
       foreach($payslips as $payslip){
           $employe = Employee::find($payslip['employee_uuid']);
          // $paysli =  payslip::find($payslip['uuid']);
           $data->push([
               "uuid"=>$payslip->uuid,
               'firstName'=>$employe->firstName,
               'lastName'=>$employe->lastName,
               'matricule'=>$employe->matricule,
               'id'=>$payslip->uuid,
               'paymentDate'=>$payslip->paymentDate,
               'netToPay'=>$payslip->netToPay,
               'paymentMethod'=>$payslip->issuanceDate,
               'created_at'=>$payslip->created_at,
           ]);
       }

        return view('admin.payslips.search_pay', compact('payslips','data'));
    }



    public function filter_pay_view(){
         return view('admin.payslips.payslip_generated_fileter');
     }



    public function filtre_pay(Request $request){
        $employees = Employee::all();
        // dd($employees);
        $values=0;
        $sommeprime = 0;
        $totalprime =0;
       
        $totalprime =0;
        $heuresupTotal =0;
        $primeseniority=0;
        $brutImposableFix = 0;
        $startPayPeriod=$request['start_date'];
        $endPayPeriod=$request['end_date'];
        // dd($startPayPeriod,$endPayPeriod);
        
        foreach($employees as $employee){
            $conge=0;
            $payadvances = 0;
            $sommeprime = 0;
                //check on other tables 
                if(Contract::where('employee_uuid',$employee['id'])->whereBetween('endDate', [$request['start_date'], $request['end_date']])->exists()){
                    $contract = Contract::where('employee_uuid',$employee['id'])->whereBetween('endDate', [$request['start_date'], $request['end_date']])->first();
        
                    }else{
                        $contract = Contract::where('employee_uuid',$employee['id'])->where('endDate', null)->first();
                    }
           
            
                    $presence = Presence::where('employee_uuid',$employee['id'])->whereBetween('periodEnd', [$request['start_date'], $request['end_date']])->first();
                    $payadvance = PaydayAdvances::where('employee_uuid',$employee['id'])->whereBetween('RequestDate', [$request['start_date'], $request['end_date']])->first();
                    $conges = CongeHistorique::where('employee_uuid',$employee['id'])->where('start_date','>=',date('y-m-d'))->first(); //congÃ© en cour 
            //  dd(Presence::where('employee_uuid',$employee['id'])->whereBetween('periodEnd', [$request['start_date'], $request['end_date']])->first());   
            $heuresup15 =round(($presence['Overtime_15'])*($contract['baseSalary']/173.33)*1.15);
            $heuresup50 = round($presence['Overtime_50']*($contract['baseSalary']/173.33)*1.5);
            $heuresup75 = round($presence['Overtime_75']*($contract['baseSalary']/173.33)*1.75);
            $heuresup100 = round($presence['Overtime_100']*($contract['baseSalary']/173.33)*2);
            $heuresupTotal = $heuresup15+$heuresup50+$heuresup100+$heuresup75;
            // $heuresupTotal = 0;
         
            try {
                $salmois = ($contract==null?1:$contract->baseSalary) /30; // calcul du salaire mensuelle$
                $nbr=$presence->presentdays;
                //$salmois = $salmois*($presence==null)?1: $presence->presentdays;
                $salmois = $salmois*$nbr;
            } catch(DivisionByZeroError $e){
               // echo "got $e";
               $salmois=0;
            } 


                  //calcul de congÃ©
                  if($conges !=null){
                    $conge = $conges['amount'];
                  } 

             //seniority 
        $nowdate = New DateTime(date('y-m-d'));
        $seniority = date('y-m-d',strtotime($employee['hiringDate'] ));
        $date  = new DateTime($seniority);
       $sen = $date->diff($nowdate);
       $years = $sen->y; 
       
       if($years>=2){
        $primeseniority = round((($years-2)*0.01+0.02)*$contract->baseSalary);
       }
       
            $sursalaire=$contract==null?0:$contract->extrapay;
            // $anciennete=$employee['seniority'];
            $Primettransport=1000*$presence->presentdays;
            $brutImposable= round($conge+$salmois+$sursalaire+$primeseniority+$heuresupTotal);



              //calcul de prime 
              $Test=$contract['prime'];
               //dd($Test);
            
              $p = json_decode($contract['prime'],true);
             
              foreach($p==null?[]:$p as $key=>$value){
               
                //$sommeprime += $value['amount'];
               
                $sommeprime += Primes::find($value['uuid'])->amount;

                  
                    
              }  
         
              $totalprime= $sommeprime+$Primettransport;

            // if($employee['id']==43){
            //     dd($contract,$employee['id'], $sommeprime);
            // }
          
            $brutImposableFix = round($brutImposable+$sommeprime);
            // dd($sommeprime,$employee['id'],$brutImposable,$brutImposableFix);
            //  $sommeprime=0;
              //IS

            $IS=round($brutImposableFix*0.012);
            $CNPSTrav=round($brutImposable*0.063);
            $CMU=500;

            $primes=$Primettransport;
            $pret=0;
            //Calcul du CN
            $testvar=$brutImposableFix*0.8;
            switch ($testvar) {
                case $testvar<50000:
                    $CN=0;
                    break;
                case $testvar<130000:
                    $CN=round(($testvar-50000)*0.015);
                    break;
                case $testvar<200000:
                    $CN=round(($testvar-130000)*0.05+1200);
                    break;
                case $testvar>200000:
                    $CN=round(($testvar-200000)*0.1+4700);
                    break;
                
                default:
                    # code...
                    break;
            }
           


            $baseIGR=0.85*(0.8*$brutImposableFix-$IS-$CN);
            $QR=($baseIGR==0?1:$baseIGR)/($employee['NbrOfParts']==0?1:$employee['NbrOfParts']);


            //Calcul du IGR

            $testvar=$QR;

            switch ($testvar) {
                //correction ligne 187: 2500->25000
                case $QR<25000:
                    $IGR=0;
                    break;
                case $QR<45583:
                    $IGR=round((($baseIGR*10)/110)-(2273*$employee['NbrOfParts']));
                    break;
                case $QR<81583:
                    $IGR=round((($baseIGR*15)/115)-(4076*$employee['NbrOfParts']));
                    break;
                case $QR<126583:
                    $IGR=round((($baseIGR*20)/120)-(7031*$employee['NbrOfParts']));
                    break;

                case $QR<220333:
                        $IGR=round((($baseIGR*25)/125)-(11250*$employee['NbrOfParts']));
                        break;
                
                case $QR<389083:
                        $IGR=round((($baseIGR*35)/135)-(24309*$employee['NbrOfParts']));
                        break;

                case $QR<842167:
                    $IGR=round((($baseIGR*45)/145)-(44181*$employee['NbrOfParts']));
                    break;
                default:
                    $IGR=round((($baseIGR*60)/160)-(98633*$employee['NbrOfParts']));
                    break;
            }

            $totRetenu=round($IS+$IGR+$CN+$CNPSTrav+$CMU+($payadvance==null?0:$payadvance->amountRequested)+$pret);

            $netAPayer=round($primes+$brutImposableFix-$totRetenu);
            // dd($netAPayer);
            //Calcul CNPSPatronale

            if($brutImposable>70000){
                $CNPSPatronale=round(0.0875*70000+$brutImposable*0.077);
            }else{
                $CNPSPatronale=round($brutImposable*0.1645);
            }
          

            //$presta_familliale = 0.0575* $brutImposable;
            //$accident_travail =0.03*$brutImposable;
            $taxapprentissage=round(0.004*$brutImposableFix);
            $formationcontinue=round(0.006*$brutImposableFix);
            $totalRetenuEmployeur=$CNPSPatronale+$taxapprentissage+$formationcontinue+$IS;
            $serialId = 'BTP-000'.$values++;

            $revenueFixBrut = array(
                "sommeprime"=>$Test,
                "hs15"=>$heuresup15,
                "hs50"=>$heuresup50,
                "hs75"=>$heuresup75,
                "hs100"=>$heuresup100,
                "hstotal"=>$heuresupTotal,
                "sursal"=>$sursalaire,
                "brutImposableSocial"=>$brutImposable,
                "brutImposableFiscal"=>$brutImposableFix,
                "salairBase"=>$contract['baseSalary'],
                "conge"=>$conge, //exple
                "sursalaire"=>$contract['extrapay'], //exple
                "seniority"=>$primeseniority, //exple
                "ancienneteInYR"=>$sen
            );

           

            if(!PaydayAdvances::where('employee_uuid',$employee['id'])->whereBetween('RequestDate', [$request['start_date'], $request['end_date']])->exists()){
                $payadvances = 0;
            }else{
                $payadvances = $payadvance['amountRequested'];
            }

            $retenueEmployee = array(
                'totret'=>$totRetenu,
                'cnps'=>$CNPSTrav,
                "IS"=>$IS,
                'IGR'=>$IGR,
                'cn'=>$CN,
                'cmu'=>$CMU,
                'payday'=>$payadvances,

                
    
            );

            $retenueEmployeur= array(
                "cnpsPat"=>$CNPSPatronale,
                'is'=>$IS,
                'taxtApp'=>$taxapprentissage,
                'taxForm'=>$formationcontinue,
                'total'=>$IS+$taxapprentissage+$formationcontinue+$CNPSPatronale
    
            );

       
                    $revenuNonImposable = array(
                    "primetransport"=>$Primettransport,
                    'totalprime'=>$totalprime,
                    'p'=>$p
        
                );

       
            //jour travailler
            // $presenceDay = array(
            //     "presence"=>$presence->presentdays,
            //     "absence"=>$presence->absentdays,
            //     "retard"=>$presence->delays,
            // );
        $revenueFixBruts = json_encode($revenueFixBrut,JSON_FORCE_OBJECT);
        $revenuNonImposables = json_encode($revenuNonImposable,JSON_FORCE_OBJECT);
        $retenueEmployees = json_encode($retenueEmployee,JSON_FORCE_OBJECT);
        $retenueEmployeurs = json_encode($retenueEmployeur,JSON_FORCE_OBJECT);
        $p=[];
        // dd($p);
            //return response()->json([$brutImposable, $totRetenu,round($netAPayer)]);
            payslip::create([
                'serialID'=>$employee['matricule'],
                'issuanceDate'=>date('y-m-d'),
                'paymentMethod'=>'cash',
                'paymentDate'=>date('y-m-d'),
                'netToPay'=>round($netAPayer),
                'grossIncome'=>$salmois,
                //'TotalPayDeduction'=>$totalRetenuEmployeur,
               // 'daysWorked'=>$,
                // 'hoursWorked'=>$,
                 'grossIncomeDetails'=>$revenueFixBruts,
                 'nonDeductibleIncome'=>$revenuNonImposables,
                 'companyDeductions'=>$retenueEmployeurs,
                 'employeeDeductions'=>$retenueEmployees,
                'employee_uuid'=>$employee['id'],
                'start_payement_date'=>$startPayPeriod,
                'end_payement_date'=>$endPayPeriod
            ]);
      
        
        
    } 
   // return response()->json(['created'=>true]);
   return redirect()->route('payslip.index');
}  


    public function pay_function(){
        $employees = Employee::all();
        $values=0;
        $sommeprime = 0;
        $totalprime =0;
        $sommeprime = 0;
        $totalprime =0;
        $heuresupTotal =0;
        $primeseniority=0;

        foreach($employees as $employee){
            $conge=0;
            $payadvances = 0;

            //check on other tables 
            $contract = Contract::where('employee_uuid',$employee['id'])->first();
            
            $presence = Presence::where('employee_uuid',$employee['id'])->first();
            $payadvance = PaydayAdvances::where('employee_uuid',$employee['id'])->first();
            $conges = CongeHistorique::where('employee_uuid',$employee['id'])->where('start_date','>=',date('y-m-d'))->first(); //congÃ© en cour 

      
             //calcul d'heure sup
             $heuresup15 = $presence['Overtime_15']*$contract['baseSalary']*0.15;
             $heuresup50 = $presence['Overtime_50']*$contract['baseSalary']*0.5;
             $heuresup75 = $presence['Overtime_75']*$contract['baseSalary']*0.75;
             $heuresup100 = $presence['Overtime_100']*$contract['baseSalary']*1;
             $heuresupTotal = $heuresup15+$heuresup50+$heuresup100+$heuresup75;
             try {
                 $salmois = ($contract==null?1:$contract->baseSalary) /30; // calcul du salaire mensuelle$
                 $nbr=$presence->presentdays;
                 //$salmois = $salmois*($presence==null)?1: $presence->presentdays;
                 $salmois = $salmois*$nbr;
             } catch(DivisionByZeroError $e){
                // echo "got $e";
                $salmois=0;
             } 
 
 
                   //calcul de congÃ©
                   if($conges !=null){
                     $conge = $conges['amount'];
                   } 
 
              //seniority 
         $nowdate = New DateTime(date('y-m-d'));
         $seniority = date('y-m-d',strtotime($employee['hiringDate'] ));
         $date  = new DateTime($seniority);
        $sen = $date->diff($nowdate);
        $years = $sen->y; 
        
        if($years>=2){
         $primeseniority = (($years-2)*0.01+0.02)*$contract->baseSalary;
        }
 
             $sursalaire=$contract==null?0:$contract->extrapay;
             $anciennete=$employee['seniority'];
             $Primettransport=1000*$presence->presentdays;
             $brutImposable= $conge+$salmois+$sursalaire+$primeseniority+$heuresupTotal;
 
 
 
               //calcul de prime 
               $p = json_decode($contract['prime'],true);
               foreach($p==null?[]:$p as $key=>$value){
                   $sommeprime += $value['amount'];
 
               }
               $totalprime= $sommeprime+$Primettransport;
             //dd($totalprime);
 
         
              
               //dd($conge);
 
             $IS=$brutImposable*0.012;
             $CNPSTrav=$brutImposable*0.063;
             $CMU=1000;
 
             $primes=$Primettransport;
             $pret=0;
             //Calcul du CN
             $testvar=$brutImposable*0.8;
             switch ($testvar) {
                 case $testvar<50000:
                     $CN=0;
                     break;
                 case $testvar<130000:
                     $CN=($testvar-50000)*0.015;
                     break;
                 case $testvar<200000:
                     $CN=($testvar-130000)*0.05+1200;
                     break;
                 case $testvar>200000:
                     $CN=($testvar-200000)*0.1+4700;
                     break;
                 
                 default:
                     # code...
                     break;
             }
            
 
 
             $baseIGR=0.85*(0.8*$brutImposable-$IS-$CN);
             $QR=($baseIGR==0?1:$baseIGR)/($employee['NbrOfParts']==0?1:$employee['NbrOfParts']);
 
 
             //Calcul du IGR
 
             $testvar=$QR;
 
             switch ($testvar) {
                 //correction ligne 187: 2500->25000
                 case $QR<25000:
                     $IGR=0;
                     break;
                 case $QR<45583:
                     $IGR=(($baseIGR*10)/110)-(2273*$employee['NbrOfParts']);
                     break;
                 case $QR<81583:
                     $IGR=(($baseIGR*15)/115)-(4076*$employee['NbrOfParts']);
                     break;
                 case $QR<126583:
                     $IGR=(($baseIGR*20)/120)-(7031*$employee['NbrOfParts']);
                     break;
 
                 case $QR<220333:
                         $IGR=(($baseIGR*25)/125)-(11250*$employee['NbrOfParts']);
                         break;
                 
                 case $QR<389083:
                         $IGR=(($baseIGR*35)/135)-(24309*$employee['NbrOfParts']);
                         break;
 
                 case $QR<842167:
                     $IGR=(($baseIGR*45)/145)-(44181*$employee['NbrOfParts']);
                     break;
                 default:
                     $IGR=(($baseIGR*60)/160)-(98633*$employee['NbrOfParts']);
                     break;
             }
 
             $totRetenu=$IS+$IGR+$CN+$CNPSTrav+$CMU+($payadvance==null?0:$payadvance->amountRequested)+$pret;
 
 
             $netAPayer=$totalprime+$brutImposable-$totRetenu;
             
             //Calcul CNPSPatronale
 
             if($brutImposable>70000){
                 $CNPSPatronale=0.0875*70000+$brutImposable*0.077;
             }else{
                 $CNPSPatronale=$brutImposable*0.1645;
             }
           
 
             //$presta_familliale = 0.0575* $brutImposable;
             //$accident_travail =0.03*$brutImposable;
             $taxapprentissage=0.004*$brutImposable;
             $formationcontinue=0.006*$brutImposable;
             $totalRetenuEmployeur=$CNPSPatronale+$taxapprentissage+$formationcontinue+$IS;
             $serialId = 'BTP-000'.$values++;
 
             $revenueFixBrut = array(
                 "hs15"=>$heuresup15,
                 "hs50"=>$heuresup50,
                 "hs75"=>$heuresup75,
                 "hs100"=>$heuresup100,
                 "hstotal"=>$heuresupTotal,
                 "sursal"=>$sursalaire,
                 "brutImposable"=>$brutImposable,
                 "salairBase"=>$contract['baseSalary'],
                 "conge"=>$conge, //exple
                 "sursalaire"=>$contract['extrapay'], //exple
                 "seniority"=>$contract['seniority'] //exple
             );
 
             $revenuNonImposable = array(
                 "primetransport"=>$Primettransport,
                 'totalprime'=>$totalprime,
                 'p'=>$p
     
             );
 
             if(!PaydayAdvances::where('employee_uuid',$employee['id'])->exists()){
                 $payadvances = 0;
             }else{
                 $payadvances = $payadvance['amountRequested'];
             }
 
             $retenueEmployee = array(
                 'totret'=>$totRetenu,
                 'cnps'=>$CNPSTrav,
                 "IS"=>$IS,
                 'IGR'=>$IGR,
                 'cn'=>$CN,
                 'cmu'=>$CMU,
                 'payday'=>$payadvances,
 
                 
     
             );
 
             $retenueEmployeur= array(
                 "cnpsPat"=>$CNPSPatronale,
                 'is'=>$IS,
                 'taxtApp'=>$taxapprentissage,
                 'taxForm'=>$formationcontinue,
                 'total'=>$IS+$taxapprentissage+$formationcontinue+$CNPSPatronale
     
             );
 
        
 
        
             //jour travailler
             // $presenceDay = array(
             //     "presence"=>$presence->presentdays,
             //     "absence"=>$presence->absentdays,
             //     "retard"=>$presence->delays,
             // );
         $revenueFixBruts = json_encode($revenueFixBrut,JSON_FORCE_OBJECT);
         $revenuNonImposables = json_encode($revenuNonImposable,JSON_FORCE_OBJECT);
         $retenueEmployees = json_encode($retenueEmployee,JSON_FORCE_OBJECT);
         $retenueEmployeurs = json_encode($retenueEmployeur,JSON_FORCE_OBJECT);
             //return response()->json([$brutImposable, $totRetenu,round($netAPayer)]);
             payslip::create([
                 'serialID'=>$employee['matricule'],
                 'issuanceDate'=>date('y-m-d'),
                 'paymentMethod'=>'cash',
                 'paymentDate'=>date('y-m-d'),
                 'netToPay'=>round($netAPayer),
                 'grossIncome'=>$salmois,
                 //'TotalPayDeduction'=>$totalRetenuEmployeur,
                // 'daysWorked'=>$,
                 // 'hoursWorked'=>$,
                  'grossIncomeDetails'=>$revenueFixBruts,
                  'nonDeductibleIncome'=>$revenuNonImposables,
                  'companyDeductions'=>$retenueEmployeurs,
                  'employeeDeductions'=>$retenueEmployees,
                 'employee_uuid'=>$employee['id']
             ]);
         
        
        
    } 
   // return response()->json(['created'=>true]);
   return redirect()->route('payslip.index');
}  



//pay for a single employee

    public function pay_test(Request $request, $id){
        $employee = Employee::find($id);
        $values=0;
        $conge=0;
        $sommeprime = 0;
        $totalprime =0;
        $heuresupTotal =0;
        $primeseniority=0;

            //check on other tables 
            //return response()->json($employee['uuid']);
            $contract = Contract::where('employee_uuid',$employee['id'])->first();
            
            #$presence = Presence::where('employee_uuid',$employee['id'])->first();
            $payadvance = PaydayAdvances::where('employee_uuid',$employee['id'])->first();
            $date_start = date('y-m');
            $conges = CongeHistorique::where('employee_uuid',$employee['id'])->where('start_date','>=',date('y-m-d'))->first(); //congÃ© en cour 

            //--------------------------------------------------------------------------------------------------------------------------------------------------------

           // $contract = Contract::where('employee_uuid',$employee['id'])->whereBetween('endDate', ["2022-05-01", "2022-05-31"])->orWhere('endDate', null)->first();

            #$payadvance = PaydayAdvances::where('employee_uuid',$employee['id'])->whereBetween('paymentDate', ["2022-05-01", "2022-05-31"])->first();
          // dd($contract);
            
           //we ckeck if last element update is egual now date else we update last morth
        //    if(date("y-m",strtotime($conges))>date("y-m")){
        //     $conge = $conges['amount'];
        //    }
        //-----------------------------------------------------------------------------------------------------------------------------------------------------
        $presence = Presence::where('employee_uuid',$employee['id'])->whereBetween('periodEnd', ["2022-06-01", "2022-06-30"])->first();
        //calcul d'heure sup
        $heuresup15 =($presence['Overtime_15'])*($contract['baseSalary']/173.33)*1.15;
        $heuresup50 = $presence['Overtime_50']*($contract['baseSalary']/173.33)*1.5;
        $heuresup75 = $presence['Overtime_75']*($contract['baseSalary']/173.33)*1.75;
        $heuresup100 = $presence['Overtime_100']*($contract['baseSalary']/173.33)*2;
        // $heuresupTotal = $heuresup15+$heuresup50+$heuresup100+$heuresup75;
        $heuresupTotal = 0;
        try {
            $salmois = ($contract==null?1:$contract->baseSalary) /30; // calcul du salaire mensuelle$
            $nbr=$presence->presentdays;
            //$salmois = $salmois*($presence==null)?1: $presence->presentdays;
            $salmois = $salmois*$nbr;
        } catch(DivisionByZeroError $e){
           // echo "got $e";
           $salmois=0;
        } 


              //calcul de congÃ©
              if($conges !=null){
                $conge = $conges['amount'];
              } 

         //seniority 
    $nowdate = New DateTime(date('y-m-d'));
    $seniority = date('y-m-d',strtotime($employee['hiringDate'] ));
    $date  = new DateTime($seniority);
   $sen = $date->diff($nowdate);
   $years = $sen->y; 
   
   if($years>=2){
    $primeseniority = (($years-2)*0.01+0.02)*$contract->baseSalary;
   }
   
        $sursalaire=$contract==null?0:$contract->extrapay;
        $anciennete=$employee['seniority'];
        $Primettransport=1000*$presence->presentdays;
        $brutImposable= $conge+$salmois+$sursalaire+$primeseniority+$heuresupTotal;



          //calcul de prime 
        //   $p = json_decode($contract['prime'],true);
        //   foreach($p==null?[]:$p as $key=>$value){
        //       $sommeprime += $value['amount'];

        //   }
        //   $totalprime= $sommeprime+$Primettransport;
        // //dd($totalprime);

        // $brutImposableFix = $brutImposable+$sommeprime;
    
        $p = json_decode($contract['prime'],true);
        if($p!=null){
        foreach($p as $key=>$value){
            $sommeprime += $value['amount'];

        }
      }
      else{
          $sommeprime=0;
      }
        $totalprime= $sommeprime+$Primettransport;
      //dd($totalprime);

      $brutImposableFix = round($brutImposable+$sommeprime);
      dd($sommeprime,$p,$brutImposable,$brutImposableFix);
          //IS

        $IS=$brutImposableFix*0.012;
        $CNPSTrav=$brutImposable*0.063;
        $CMU=500;

        $primes=$Primettransport;
        $pret=0;
        //Calcul du CN
        $testvar=$brutImposableFix*0.8;
        switch ($testvar) {
            case $testvar<50000:
                $CN=0;
                break;
            case $testvar<130000:
                $CN=($testvar-50000)*0.015;
                break;
            case $testvar<200000:
                $CN=($testvar-130000)*0.05+1200;
                break;
            case $testvar>200000:
                $CN=($testvar-200000)*0.1+4700;
                break;
            
            default:
                # code...
                break;
        }
       


        $baseIGR=0.85*(0.8*$brutImposableFix-$IS-$CN);
        $QR=($baseIGR==0?1:$baseIGR)/($employee['NbrOfParts']==0?1:$employee['NbrOfParts']);


        //Calcul du IGR

        $testvar=$QR;

        switch ($testvar) {
            //correction ligne 187: 2500->25000
            case $QR<25000:
                $IGR=0;
                break;
            case $QR<45583:
                $IGR=(($baseIGR*10)/110)-(2273*$employee['NbrOfParts']);
                break;
            case $QR<81583:
                $IGR=(($baseIGR*15)/115)-(4076*$employee['NbrOfParts']);
                break;
            case $QR<126583:
                $IGR=(($baseIGR*20)/120)-(7031*$employee['NbrOfParts']);
                break;

            case $QR<220333:
                    $IGR=(($baseIGR*25)/125)-(11250*$employee['NbrOfParts']);
                    break;
            
            case $QR<389083:
                    $IGR=(($baseIGR*35)/135)-(24309*$employee['NbrOfParts']);
                    break;

            case $QR<842167:
                $IGR=(($baseIGR*45)/145)-(44181*$employee['NbrOfParts']);
                break;
            default:
                $IGR=(($baseIGR*60)/160)-(98633*$employee['NbrOfParts']);
                break;
        }

        $totRetenu=$IS+$IGR+$CN+$CNPSTrav+$CMU+($payadvance==null?0:$payadvance->amountRequested)+$pret;

        $netAPayer=$primes+$brutImposableFix-$totRetenu;
        // dd($netAPayer);
        //Calcul CNPSPatronale

        if($brutImposable>70000){
            $CNPSPatronale=0.0875*70000+$brutImposable*0.077;
        }else{
            $CNPSPatronale=$brutImposable*0.1645;
        }
      

        //$presta_familliale = 0.0575* $brutImposable;
        //$accident_travail =0.03*$brutImposable;
        $taxapprentissage=0.004*$brutImposable;
        $formationcontinue=0.006*$brutImposable;
        $totalRetenuEmployeur=$CNPSPatronale+$taxapprentissage+$formationcontinue+$IS;
        $serialId = 'BTP-000'.$values++;

        $revenueFixBrut = array(
            "hs15"=>$heuresup15,
            "hs50"=>$heuresup50,
            "hs75"=>$heuresup75,
            "hs100"=>$heuresup100,
            "hstotal"=>$heuresupTotal,
            "sursal"=>$sursalaire,
            "brutImposableSocial"=>$brutImposable,
            "brutImposableFiscal"=>$brutImposableFix,
            "salairBase"=>$contract['baseSalary'],
            "conge"=>$conge, //exple
            "sursalaire"=>$contract['extrapay'], //exple
            "seniority"=>$contract['seniority'] //exple
        );

        $revenuNonImposable = array(
            "primetransport"=>$Primettransport,
            'totalprime'=>$totalprime,
            'p'=>$p

        );

        if(!PaydayAdvances::where('employee_uuid',$employee['id'])->exists()){
            $payadvances = 0;
        }else{
            $payadvances = $payadvance['amountRequested'];
        }

        $retenueEmployee = array(
            'totret'=>$totRetenu,
            'cnps'=>$CNPSTrav,
            "IS"=>$IS,
            'IGR'=>$IGR,
            'cn'=>$CN,
            'cmu'=>$CMU,
            'payday'=>$payadvances,

            

        );

        $retenueEmployeur= array(
            "cnpsPat"=>$CNPSPatronale,
            'is'=>$IS,
            'taxtApp'=>$taxapprentissage,
            'taxForm'=>$formationcontinue,
            'total'=>$IS+$taxapprentissage+$formationcontinue+$CNPSPatronale

        );

   

   dd($netAPayer);
        //jour travailler
        // $presenceDay = array(
        //     "presence"=>$presence->presentdays,
        //     "absence"=>$presence->absentdays,
        //     "retard"=>$presence->delays,
        // );
    $revenueFixBruts = json_encode($revenueFixBrut,JSON_FORCE_OBJECT);
    $revenuNonImposables = json_encode($revenuNonImposable,JSON_FORCE_OBJECT);
    $retenueEmployees = json_encode($retenueEmployee,JSON_FORCE_OBJECT);
    $retenueEmployeurs = json_encode($retenueEmployeur,JSON_FORCE_OBJECT);
        //return response()->json([$brutImposable, $totRetenu,round($netAPayer)]);
        payslip::create([
            'serialID'=>$employee['matricule'],
            'issuanceDate'=>date('y-m-d'),
            'paymentMethod'=>'cash',
            'paymentDate'=>date('y-m-d'),
            'netToPay'=>round($netAPayer),
            'grossIncome'=>$salmois,
            //'TotalPayDeduction'=>$totalRetenuEmployeur,
           // 'daysWorked'=>$,
            // 'hoursWorked'=>$,
             'grossIncomeDetails'=>$revenueFixBruts,
             'nonDeductibleIncome'=>$revenuNonImposables,
             'companyDeductions'=>$retenueEmployeurs,
             'employeeDeductions'=>$retenueEmployees,
            'employee_uuid'=>$employee['id']
            
        ]);
    
        
     
        
        return response()->json(['created'=>true]);
    }   


    public function downloadPDF($id){
        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 130
            ]);
            
        $payslip = payslip::find($id);
        $payslips = payslip::find($id)->employee;
        $pdf = PDF::loadView('admin.payslips.show', compact('payslip','payslips')); //->setOptions(['defaultFont' => 'sans-serif']);;
        return $pdf->download('payslip.pdf');
      }
}