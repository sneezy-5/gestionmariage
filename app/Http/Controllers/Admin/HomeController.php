<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CongeHistorique;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\payslip;
use App\Models\Presence;
use App\Models\Primes;

class HomeController extends Controller
{
    public function index(){
        $employes = Employee::count();
        $contract = Contract::count();
        $payslips = payslip::count();
        $primes = Primes::count();
        $presences = Presence::count();
        $congesH = CongeHistorique::count();
        return view('admin.dashboard',compact('employes','contract','payslips','primes','presences','congesH'));
    }


//     public function tsearch(Request $request){
//         $payslips = payslip::whereBetween('end_payement_date', [$request['start_date'], $request['end_date']])->get();
//         $data=collect();
    
//         $IS =0;
//         $IGR =0;
//         $CNPSemp = 0;
//         $net=0;
//         $CNPScomp=0;
//         $taxApp=0;
//         $taxform=0;
//         $CN=0;
//         $net=0;
//         $ITS=0;
//         $CNPStot=0;
//         $FDFPtot=0;
//         foreach($payslips as $p){
//             // $som+=$p['grossIncome'];
//             // dd($p);
//              $d=json_decode($p['employeeDeductions'],true);
//             //  $f=json_decode($p['companyDeductions'],true);
//              $IS+=$d['IS'];
//              $IGR += $d['IGR'];
//              $CNPSemp += $d['cnps'];
//              $CNPScomp+=0;//$f["cnpsPat"];
//              $taxApp+=0;//$f["taxtApp"];
//              $taxform+=0;//$f["taxform"];
//              $CN+=$d['cn'];
//              $net+=$p['netToPay'];
//          }
//          //dd($IS,$IGR,$CNPS);
//          $ITS=$IS*2+$IGR+$CN;
//          $CNPStot=$CNPSemp+$CNPScomp;
//          $FDFPtot=$taxApp+$taxform;
//          return response()->json(['response'=>["ITS"=>$IS,"cnps"=>$CNPStot,"fdfp"=>$FDFPtot,"net"=>$net]]);
//         // return view('admin.payslips.search_pay', compact('payslips','data'));
//      }
// }
public function tsearch(Request $request){
    $payslips = payslip::whereBetween('end_payement_date', [$request['start_date'], $request['end_date']])->get();
    $data=collect();

    $IS =0;
    $IGR =0;
    $CNPSemp = 0;
    $CN=0;
    $CNPSPat=0;
    $CNPS=0;
    $netapayer=0;
    
    $taxeApp=0;
    $taxeform=0;
    $FDFP=0;
    foreach($payslips as $p){
        // $som+=$p['grossIncome'];

         $d= json_decode($p['employeeDeductions'],true);
         $emp=json_decode($p['companyDeductions'],true);
         $IS +=$d['IS'];
         $IGR += $d['IGR'];
         $CNPSemp += $d['cnps'];
         $CN += $d['cn'];
         $CNPSPat +=$emp['cnpsPat'];
         $netapayer +=$p['netToPay'];
         $taxeApp +=$emp['taxtApp'];
         $taxeform +=$emp['taxForm'];

     }
     $ITS=$IS+$CN+$IGR;
     $CNPS=$CNPSemp+$CNPSPat;
     $FDFP=$taxeApp+$taxeform;
     $total=$ITS+$CNPS+$FDFP+$netapayer;

     return response()->json(['response'=>["ITS"=>number_format($ITS,0,","," "),"fdfp"=>number_format($FDFP,0,","," "),"CNPStot"=>number_format($CNPS,0,","," "),"net"=>number_format($netapayer,0,","," "),"total"=>number_format($total,0,","," ")]]);
    // return view('admin.payslips.search_pay', compact('payslips','data'));
 }
}