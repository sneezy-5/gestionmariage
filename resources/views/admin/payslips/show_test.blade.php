<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{asset('css/Delivery.css')}}">

    <title>BP-{{date('mY', strtotime($payslip->start_payement_date))}}-{{$payslips->matricule}}-{{$payslips->firstName}} {{$payslips->lastName}} </title>
    <!-- link font  -->
    <link rel="stylesheet" href="{{asset('fonts/css/all.css')}}">
    <!-- bootstrap css cdn -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body>
   @php 
            $compDeductions=json_decode($payslip->companyDeductions,True);
            $grossIncome=json_decode($payslip->grossIncomeDetails,True);
            $empDeductions=json_decode($payslip->employeeDeductions,True);
            $ndIncome=json_decode($payslip->nonDeductibleIncome,True);
         
//dd($grossIncome['sommeprime'],$ndIncome['totalprime'],$ndIncome['totalprime']-$ndIncome['primetransport'])

            @endphp
            
<div>
  <!-- <button id="print">Print</button> -->
</div>
    <div class="container-fluid mt-3" id="element-to-print">
    <div class="row">
            
            <div class="col-sm-3">
                <img cla src="../../images/Logo_IVOIRRAPID.png" alt="IVOIRRAPID_LOGO" class="LOGO mb-0">

                <p class="Addresse mb-0 text-capitalize fw-bold ">Addresse:<span class="label text-capitalize fw-light">Marcory-Biétry</span></p>
                <p class="Addresse mb-0 text-uppercase fw-bold">bp:<span class="label text-capitalize fw-light ">26 BP 711 ABIDJAN 26</span></p>
                <p class="Addresse mb-0 text-uppercase fw-bold">tel:<span class="label text-capitalize fw-light">21 21 37 43 46</span></p>
                <p class="Addresse mb-0 text-uppercase fw-bold">n cnps:<span class="label text-capitalize fw-light ">335328</span></p>            </div>
            <div class="row">
            <div class="col-m-8">

        <h1 class="title d-flex justify-content-center text-uppercase text-white ">bulletin de paie</h1>
        <div class="methode col-m-8">
          <div class="col-m-4">
            <p class="mb-0 text-uppercase fw-bold">periode:<span class="label fw-light">Du {{date('d-m-Y', strtotime($payslip->start_payement_date))}} au {{date('d-m-Y', strtotime($payslip->end_payement_date))}}</span></p>
            <p class="mb-0 text-uppercase fw-bold">methode de paiement:<span class="label text-capitalize fw-light"></span></p>
            <p class="mb-0 text-uppercase fw-bold">numéro de compte:<span class="label text-capitalize fw-light"></span></p>
            <p class="mb-0 text-uppercase fw-bold">banque:<span class="label text-capitalize fw-light"></span></p>
          </div>
          <div class="col-m-6 lcol-m-6">
            <p class="mb-0 text-uppercase fw-bold">jours travaillés:<span class="label text-capitalize fw-light">{{$presences->presentdays}}</span></p>
            <p class="mb-0 text-uppercase fw-bold">nombre d'absences:<span class="label text-capitalize fw-light">{{$presences->absentdays==null?0:$presences->absentdays}}</span></p>
            <p class="mb-0 text-uppercase fw-bold">nombre de retards:<span class="label text-capitalize fw-light">{{$presences->delays==null?0:$presences->delays}}</span></p>
          </div>

        </div>
          
    </div>
    
    </div>
<!-- /*Identification du Travailleur part start here -->

            <div class="row">
            <div class="col-m-8">
  <!-- /* title of Identification du Travailleur start here  -->
  
  <h2 class="titre text-white d-flex justify-content-center">Identification du Travailleur </h2>
  <!-- /* title of Identification du Travailleur start here  -->

        <div class="container-fluid ">
          <!-- information sur le Travailleur start here (nom et prenom) -->
          <div class="row">
            <div class="col-4 border border-1">
              <p  class=" nom ml-12 fw-bold  mb-0 border-bottom  d-flex justify-content-center bg-light">Nom et Prénoms</p>
              <p  class="prenom fw-bold  mb-0 d-flex justify-content-center m-5">{{$payslips->firstName}} {{$payslips->lastName}}</p>
            </div>
          <!-- information sur le Travailleur stop here (nom et prenom) -->

            <div class="Identification col-8 border border-1 mt-0 ">
              <div class="Travailleur row  ">
                <div class="col">
                  <p class="fw-bold text-capitalize mb-0">emploi:</p>
                  <p class="fw-bold text-capitalize  mb-0">catégorie:</p>
                  <p class="fw-bold  mb-0">Nbr d'Enfants:</p>
                  <p class="fw-bold text-capitalize  mb-0">situation maritale:</p>
                  <p class="fw-bold text-uppercase  mb-0">n cnps</p>
                  <p class="fw-bold text-uppercase  mb-0">n cmu</p>
                  <p class="fw-bold  mb-0">Date d'Embauche</p>
                  <p class="fw-bold  mb-0">Date de Paiement</p>
                </div>
                <div class="col">
                  <p class="mb-0 fw-normal"> {{$contracts->position}}</p>
                  <p class="mb-0 fw-normal">&nbsp</p>
                  <p class="mb-0 fw-normal"> @php
                  $displayvar=$payslips->numberOfDependents;
                    if($payslips->numberOfDependents==null){
                    $displayvar=0;
                    }
                    echo $displayvar;
                    @endphp </p>
                  <p class="mb-0 fw-normal"> @php
                  $displayvar=$payslips->maritalStatus;
                  if($displayvar=='celibataire'){
                    $displayvar='CELIBATAIRE';
                  }
                  else{
                    $displayvar='MARIE(E)';
                  }
                  echo $displayvar;
                    @endphp
                    </p>
                  <p class="mb-0 fw-normal"> 
                  @php
                  $displayvar=$payslips->CNPSnumber;
                    if($displayvar==null){
                    $displayvar='&nbsp';
                    }
                    echo $displayvar;
                    @endphp </p>
                  <p class="mb-0 fw-normal">&nbsp</p>
                  <p class="mb-0 fw-normal">{{date('d-m-Y', strtotime($payslips->hiringDate))}} </p>
                  <p class="mb-0 fw-normal">03/06/2022</p>
                </div>
                <div class="col">
                  <p class="fw-bold text-capitalize mb-4">matricule:</p>
                  <p class="Nbr fw-bold mb-4">Nbr de Parts IGR:</p>
                  <p class="conge fw-bold text-capitalize mb-4">dernier congé:</p>
                  <p class="anciennete fw-bold text-capitalize mb-0">ancienneté:</p>
                </div>
                <div class="col">
                  <p > @php
                  $displayvar=$payslips->matricule;
                    if(str_contains($payslips->matricule,'TEMP')){
                    $displayvar='&nbsp';
                    }
                    echo $displayvar;
                    @endphp </p>
                  <p class="Label">
                  {{$payslips->NbrOfParts}}
                  </p>
                  <p class="Label1">&nbsp</p>
                  <p class="Label0">{{$grossIncome["ancienneteInYR"]["y"]}} an(s) {{$grossIncome["ancienneteInYR"]["m"]}} mois </p>
                </div>
              </div>
          </div>
        </div>
<!-- /*Identification du Travailleur part stop here -->

<!-- /*table part start here -->
 <div class="container-fluid">
   <div class="row">
     
    
     
     <table class="table-bordered mt-3">
       <thead class="bg-light">
        <div>
         <tr  class="" style="border:none; ">
           <th class="emptyline  " style="visibility:hidden;border:none;"></th>
           <th class="tdlibelle "  style="background-color:white;border:none;"></th>
           <th class="tdnombre "  style="background-color:white;border:none"></th>
           
           <th class="tdmontsal text-uppercase " colspan="3" style="border-top:solid 0.25px">salariés</th>
          
           <th class="tdmontpat text-uppercase"  colspan="2" style="border-top:solid 0.25px" >employeur</th>
           
   
   
         </tr>
        </div>
       
        <tr class="thead text-black text-center">
          <th>CODE</th>
          <th>LIBELLES/RUBRIQUES</th>

          <th>BASE</th>

          <th>TAUX</th>
          <th>GAINS</th>
          <th>RETENUES</th>
          <th>TAUX</th>
          <th>MONTANT</th>
          
         
        </tr>
      </thead> 
  <!-- /* start of tbody -->
  
      <tbody class="tbody">
        <tr class="emptyline">
          <td class="tdcode"></td>
          <td class="tdlibelle"></td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
  <!-- /* tr G100 start here  -->

        <tr >
        <td class="tdcode">G100</td>
          <td class="tdlibelle">Salaire de Base</td>
          <td class="tdbase">{{number_format($contracts->baseSalary==null?0:$contracts->baseSalary,0,","," ")}}</td>
          <td class="tdnombre">{{$presences->presentdays}} </td>
          <td class="tdmontsal">{{number_format($grossIncome["salairBase"]==null?0:$grossIncome["salairBase"],0,","," ")}}</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>
        </tr>
  <!-- /* tr G100 stop here  -->

  <!-- /* tr G200 start here  -->

        <tr >
          <td class="tdcode">G200</td>
          <td class="tdlibelle">Sursalaire</td>
          <td class="tdbase">{{number_format($grossIncome["sursal"]==null?0:$grossIncome["sursal"],0,","," ")}}</td>
          <td class="tdnombre">{{$presences->presentdays}}</td>
          <td class="tdmontsal">{{number_format($grossIncome["sursal"]==null?0:$grossIncome["sursal"],0,","," ")}}</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>
        </tr>
  <!-- /* tr G200 stop here  -->

  <!-- /* tr G300 start here  -->

  <tr >
          <td class="tdcode">G300</td>
          <td class="tdlibelle">Congés Payés</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal">{{number_format($grossIncome["conge"]==null?"0":$grossIncome["conge"],0,","," ")}}</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
  <!-- /* tr G300 stop here  -->

  <!-- /* tr G400 start here  -->

        <tr >
          <td class="tdcode">G400</td>
          <td class="tdlibelle">Gratifications</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
  <!-- /* tr G400 stop here  -->

  <!-- /* tr G500 start here  -->

        <tr >
          <td class="tdcode">G500</td>
          <td class="tdlibelle">Primes diverses</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal">@php 
            $displayvar=json_decode($payslip->nonDeductibleIncome,True);
            
            echo number_format(($displayvar["totalprime"]-$displayvar["primetransport"]),0,","," ");
            @endphp</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>
        </tr>
      
  <!-- /* tr G500 stop here  -->

        <!-- <tr >
          <td class="tdcode">G601</td>
          <td class="tdlibelle">Autres Indemnités Imposable</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr> -->
        <tr >
          <td class="tdcode"></td>
          <td class="tdlibelle fw-bold" >Heures supplémentaires :</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <tr class="hee">
          <td class="tdcode">G701</td>
          <td class="tdlibelle ">Heures à 15%</td>
          <td class="tdnombre">{{number_format(round((($contracts->baseSalary)/173.33)*1.15),0,","," ")}}</td>
          <td class="tdbase"></td>
          <td class="tdmontsal">{{number_format($grossIncome["hs15"],0,","," ")}}</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <tr class="hee">
          <td class="tdcode">G702</td>
          <td class="tdlibelle"> Heures à 50%</td>
          <td class="tdnombre">{{number_format(round((($contracts->baseSalary)/173.33)*1.50),0,","," ")}}</td>
          <td class="tdbase"></td>
          <td class="tdmontsal">{{number_format($grossIncome["hs50"],0,","," ")}}</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <tr class="hee">
          <td class="tdcode">G703</td>
          <td class="tdlibelle">Heures à 75%</td>
          <td class="tdnombre">{{number_format(round((($contracts->baseSalary)/173.33)*1.75),0,","," ")}}</td>
          <td class="tdbase"></td>
          <td class="tdmontsal">{{number_format($grossIncome["hs75"],0,","," ")}}</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <tr class="hee">
          <td class="tdcode">G704</td>
          <td class="tdlibelle"> Heures à 100%</td>
          <td class="tdnombre">{{number_format(round((($contracts->baseSalary)/173.33)*2),0,","," ")}}</td>
          <td class="tdbase"></td>
          <td class="tdmontsal">{{number_format($grossIncome["hs100"],0,","," ")}}</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <tr class="">
          <td class="tdcode">G800</td>
          <td class="tdlibelle">Prime d'ancienneté</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal">
          {{number_format($grossIncome["seniority"],0,","," ")}}
          </td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        
       
        <tr class="">
          <td class="tdcode"></td>
          <td class="tdlibelle fw-bold text-uppercase">Brut imposable fiscal</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal fw-bold">
          {{number_format($grossIncome["brutImposableFiscal"],0,","," ")}}
          </td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <tr class="">
          <td class="tdcode"></td>
          <td class="tdlibelle fw-bold text-uppercase">Brut imposable Social</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal fw-bold">
          {{number_format($grossIncome["brutImposableSocial"],0,","," ")}}
          </td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <tr class="emptyline">
          <td class="tdcode"></td>
          <td class="tdlibelle"></td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        
        <tr class="emptyline">
          <td class="tdcode"></td>
          <td class="tdlibelle"></td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <tr class="">
          <td class="tdcode">R130</td>
          <td class="tdlibelle">Impôt sur Salaire</td>
          <td class="tdnombre">
          </td>
          <td class="tdbase">
          1,2%
          </td>
          <td class="tdmontsal">
          
          </td>
          <td class="tdtauxpat">{{number_format($empDeductions["IS"],0,","," ")}}</td>
          <td class="tdmontpat">
          1,2%
          </td>
          <td class="tdmontpat">{{number_format($compDeductions["is"],0,","," ")}}</td>

        </tr>
        <tr class="">
          <td class="tdcode">R140</td>
          <td class="tdlibelle">Contribution Nationale</td>
          <td class="tdnombre">

          </td>
          <td class="tdbase"></td>
          <td class="tdmontsal">
            
          </td>
          <td class="tdtauxpat">{{number_format($empDeductions["cn"],0,","," ")}}</td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <tr class="">
          <td class="tdcode">R150</td>
          <td class="tdlibelle">Impôt Général sur le Revenu</td>
          <td class="tdnombre">{{number_format($grossIncome["brutImposableFiscal"],0,","," ")}}</td>
          <td class="tdbase"></td>
          <td class="tdmontsal">
            
          </td>
          <td class="tdtauxpat">{{number_format($empDeductions["IGR"],0,","," ")}}</td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <tr class="">
          <td class="tdcode">R200</td>
          <td class="tdlibelle">Cotisation de Retraite</td>
          <td class="tdnombre">{{number_format($grossIncome["brutImposableSocial"],0,","," ")}}</td>
          <td class="tdbase">
          6,3%
          </td>
          <td class="tdmontsal">
          </td>
          <td class="tdtauxpat">{{number_format($empDeductions["cnps"],0,","," ")}}</td>
          <td class="tdmontpat">
          7.7%
          </td>
          <td class="tdmontpat">{{number_format($compDeductions["cnpsPat"],0,","," ")}}</td>

        </tr>
        <tr class="">
          <td class="tdcode">R203</td>
          <td class="tdlibelle">Couverture Maladie Universelle</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat">{{number_format($empDeductions["cmu"],0,","," ")}}</td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <tr class="emptyline">
          <td class="tdcode"></td>
          <td class="tdlibelle"></td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <tr class="emptyline">
          <td class="tdcode"></td>
          <td class="tdlibelle"></td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <!--
        <tr class="">
          <td class="tdcode">R170</td>
          <td class="tdlibelle">Contribution Employeur (CE)</td>
          <td class="tdnombre">0</td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat">1.2%</td>
          <td class="tdmontpat">0</td>
        </tr>
        -->
        <tr class="">
          <td class="tdcode">R171</td>
          <td class="tdlibelle">Taxe d'apprentissage</td>
          <td class="tdnombre">{{number_format($grossIncome["brutImposableFiscal"],0,","," ")}}</td>
          <td class="tdbase">
          </td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat">
          0.4%
          </td>
          <td class="tdmontpat">{{number_format($compDeductions["taxtApp"],0,","," ")}}</td>

        </tr>
        
        <tr class="">
          <td class="tdcode">R172</td>
          <td class="tdlibelle">Formation Prof Continue</td>
          <td class="tdnombre">{{number_format($grossIncome["brutImposableFiscal"],0,","," ")}}</td>
          <td class="tdbase">
          </td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat">
          0,6%
          </td>
          <td class="tdmontpat">{{number_format($compDeductions["taxForm"],0,","," ")}}</td>
          

        </tr>
        <!-- <tr class="">
          <td class="tdcode">R201</td>
          <td class="tdlibelle">Prestation Familiale</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat">5.75%</td>
          <td class="tdmontpat">0</td>
        </tr>
        <tr class="">
          <td class="tdcode">R202</td>
          <td class="tdlibelle">Accident de Travail</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat">3.0%</td>
          <td class="tdmontpat">0</td>
        </tr> -->
        <tr class="emptyline">
          <td class="tdcode"></td>
          <td class="tdlibelle"></td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <tr class="emptyline">
          <td class="tdcode"></td>
          <td class="tdlibelle"></td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>
          

        </tr>
        <tr class="">
          <td class="tdcode">R300</td>
          <td class="tdlibelle">Avances sur Salaire</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal">
          </td>
          <td class="tdtauxpat">{{number_format($empDeductions["payday"],0,","," ")}}</td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <!-- <tr class="">
          <td class="tdcode">R301</td>
          <td class="tdlibelle">Prêt Scolaire</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>

        <tr class="">
          <td class="tdcode">R302</td>
          <td class="tdlibelle">Prêts Ordinaires</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>
          

        </tr> -->
        <tr >
          <td class="tdcode"></td>
          <td class="tdlibelle fw-bold text-uppercase" >total retenues</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal fw-bold">
          </td>
          <td class="tdtauxpat ">
            {{number_format($empDeductions["totret"],0,","," ")}}
          </td>
          <td class="tdmontpat fw-bold">
          </td>
          <td class="tdmontpat">
            {{number_format($compDeductions["total"],0,","," ")}}
          </td>

        </tr>
        <!-- <tr >
          <td class="tdcode"></td>
          <td class="tdlibelle fw-bold text-uppercase" >brut imposable</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal fw-bold">0</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr >
          <td class="tdcode"></td>
          <td class="tdlibelle fw-bold text-uppercase" >net imposable</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal fw-bold">0</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
      -->
        <tr>
          <td class="tdcode"></td>
          <td class="tdlibelle" >Prime de Transport</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal">@php 
            $displayvar=json_decode($payslip->nonDeductibleIncome,True);
            
            echo number_format($displayvar["primetransport"],0,","," ");
            @endphp</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr>
        <tr class="">
        <!--    
          <td class="tdcode">G800</td>
          <td class="tdlibelle">Prime d'ancienneté</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal">0</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        -->
        <!-- <tr>
          <td class="tdcode">G900</td>
          <td class="tdlibelle" >Autres Ind. non imposables</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="tdmontpat"></td>

        </tr> -->
        <!-- 
        <tr>
          <td class="tdcode">G602</td>
          <td class="tdlibelle fw-bold" >Arrondi</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal fw-bold">0</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
      -->

        <tr class="lastrow">
          <td class="tdcode"></td>
          <td class="tdlibelle fw-bold text-uppercase" >net a payer </td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal fw-bold">
          {{number_format($payslip->netToPay,0,","," ")}}
          </td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
          <td class="montant"></td>

        </tr>
        
        
      </tbody>
  <!-- /*  end of tbody -->
    </table>
  <div class="sptable"></div>
    <table>
      <thead class="btable">
          <th class="border cotisation ">cumul</th>
          <th class="border cotisation ">SAL.brut</th>
          <th class="border cotisation ">Brut Fisc.</th>
          <th class="border cotisation ">Brut Soc.</th>
          <th class="border cotisation ">charges SAL.</th>
          <th class="border cotisation ">charges pat.</th>                  
          <th class="border cotisation">net</th>
          <th class="border cotisation ">MONT.PAT</th>
      </thead>
      <tbody class="btable">
          <td class="border ">periode</td>
          <td class="border ">{{number_format(($totrevenue=$empDeductions["totret"]+$payslip->netToPay),0,","," ")}}</td>
          <td class="border ">{{number_format($grossIncome["brutImposableSocial"],0,","," ")}}</td>
          <td class="border ">{{number_format($grossIncome["brutImposableFiscal"],0,","," ")}}</td>
          <td class="border ">{{number_format($empDeductions["totret"]-$empDeductions["payday"],0,","," ")}}</td>
          <td class="border ">{{number_format($compDeductions["total"],0,","," ")}}</td>
          <td class="border ">{{number_format(($payslip->netToPay),0,","," ")}}</td>
          <td class="border">{{number_format(($compDeductions["total"]+$totrevenue),0,","," ")}}</td>
          
      </tbody>
    </table>
  <div class="sptable"></div>

    <table class="">
      <thead class="btable">
          <th class="border cotisation">cotisation</th>
          <th class="border cotisation ">iS</th>
          <th class="border cotisation ">CN</th>
          <th class="border cotisation ">igr</th>
          <th class="border cotisation ">cnps</th>
          <th class="border spleft">base Conges</th>
          <th class="border cotisation">0 jours</th>
      </thead>
      <tbody class="btable">
          <td class="border ">periode</td>
          <td class="border ">{{number_format($compDeductions["is"]+$empDeductions["IS"],0,","," ")}}</td>
          <td class="border ">
            {{number_format($empDeductions["cn"],0,","," ")}}
          </td>
          <td class="border ">
            {{number_format($empDeductions["IGR"],0,","," ")}}
          </td>
          <td class="border ">{{number_format(($empDeductions["cnps"]+$compDeductions["cnpsPat"]),0,","," ")}}</td>
          <td class="border spleft ">Conges acquis</td>
          <td class="border ">0 jours</td>
  
      </tbody>
    </table>
<!-- /*table part stop here -->

            </div>
          </div>
    </div>

      </div>
    </div>
 <!-- js jquery cdn -->
 <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/jquery-3.6.0.js')}}"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js" integrity="sha512-01CJ9/g7e8cUmY0DFTMcUw/ikS799FHiOA0eyHsUWfOetgbx/t6oV4otQ5zXKQyIrQGTHSmRVPIgrgLcZi/WMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js" integrity="sha512-z8IYLHO8bTgFqj+yrPyIJnzBDf7DDhWwiEsk4sY+Oe6J2M+WQequeGS7qioI5vT6rXgVRb4K1UVQC5ER7MKzKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      
       function printf(){
        const element = document.getElementById("element-to-print");     
        var doc = new jsPDF("p", "mm", "a4");
        element.style.border='1px solid white';
        element.style.backgroundColor='white';
        element.style.position='relative';
        element.style.top='-0.5%';
        var img = domtoimage.toJpeg(document.getElementById('element-to-print'), { quality: 0.99 }, {bgcolor: 'white'})
          .then(function (dataUrl) {
            var imgData=dataUrl;
           
            var width = doc.internal.pageSize.getWidth();
            var height = doc.internal.pageSize.getHeight();
            doc.addImage(imgData, 'JPEG', 0,-2,width,height)
            doc.save('sample-file.pdf');


            // var link = document.createElement('a');
            // link.download = 'my-image-name.jpeg';
            // link.href = dataUrl;
            // link.click();
          })
       }


        var print = document.getElementById('print');
        print.addEventListener('click',()=>{
          printf();
        })
    </script>
</body>
</html>