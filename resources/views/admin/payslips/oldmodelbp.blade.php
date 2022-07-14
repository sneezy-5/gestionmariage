<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{asset('css/Delivery.css')}}">

    <title>BP</title>
    <!-- link font  -->
    <link rel="stylesheet" href="{{asset('fonts/css/all.css')}}">
    <!-- bootstrap css cdn -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container-fluid mt-3">
        <div class="row">
            
            <div class="col-sm-3">
                <img cla src="{{asset('images/Logo_IVOIRRAPID.png')}}" alt="IVOIRRAPID_LOGO" class="LOGO mb-0">

                <p class="Addresse mb-0 text-capitalize fw-bold ">Addresse:<span class="label text-capitalize fw-light">Label</span></p>
                <p class="Addresse mb-0 text-uppercase fw-bold">bp:<span class="label text-capitalize fw-light ">Label</span></p>
                <p class="Addresse mb-0 text-uppercase fw-bold">tel:<span class="label text-capitalize fw-light">Label</span></p>
                <p class="Addresse mb-0 text-uppercase fw-bold">n cnps:<span class="label text-capitalize fw-light ">Label</span></p>
            </div>
            <div class="row">
            <div class="col-m-8">

        <h1 class="title d-flex justify-content-center text-uppercase text-white ">bulletin de paie</h1>
        <div class="methode col-m-8">
          <div class="col-m-4">
            <p class="mb-0 text-uppercase fw-bold">periode:<span class="label text-capitalize fw-light">DU 01/05/2022 AU 31/05/2022</span></p>
            <p class="mb-0 text-uppercase fw-bold">methode de paiement:<span class="label text-capitalize fw-light">{{$payslip->paymentMethod}}</span></p>
          </div>
          <div class="col-m-6 lcol-m-6">
            <p class="mb-0 text-uppercase fw-bold">jours travaillés:<span class="label text-capitalize fw-light">{{$presences->presentdays}}</span></p>
            <p class="mb-0 text-uppercase fw-bold">nombre d'absences:<span class="label text-capitalize fw-light">{{$presences->absentdays==null?0:$presences->absentdays}}</span></p>
            <p class="mb-0 text-uppercase fw-bold">nombre de retards     :<span class="label text-capitalize fw-light">{{$presences->delays==null?0:$presences->delays}}</span></p>
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
              <p  class=" nom ml-12 fw-bold  mb-0 border-bottom  d-flex justify-content-center bg-light">Nom et Prnéoms</p>
              <p  class="prenom fw-bold  mb-0 d-flex justify-content-center m-5">{{$payslips->firstName}} {{$payslips->lastName}}</p>
            </div>
          <!-- information sur le Travailleur stop here (nom et prenom) -->

            <div class="Identification col-8 border border-1 mt-0 ">
              <div class="Travailleur row  ">
                <div class=" col">
                  <p class="fw-bold text-capitalize mb-0">emploi :</p>
                  <p class="fw-bold text-capitalize  mb-0">catégorie:</p>
                  <p class="fw-bold  mb-0">Nbr d'Enfants:</p>
                  <p class="fw-bold text-capitalize  mb-0">situation maritale:</p>
                  <p class="fw-bold text-uppercase  mb-0">n cnps</p>
                  <p class="fw-bold text-uppercase  mb-0">n cmu</p>
                  <p class="fw-bold  mb-0">Date d'Embauche</p>
                  <p class="fw-bold  mb-0">Date de Paiement</p>
                </div>
                <div class="col">
                  <p class="mb-0">{{$contracts->position}}</p>
                  <p class="mb-0">&nbsp</p>
                  <p class="mb-0">@php
                  $displayvar=$payslips->numberOfDependents;
                    if($payslips->numberOfDependents==null){
                    $displayvar=0;
                    }
                    echo $displayvar;
                    @endphp</p>
                  <p class="mb-0">{{$payslips->maritalStatus}}</p>
                  <p class="mb-0">{{$payslips->CNPSnumber}}</p>
                  <p class="mb-0">&nbsp</p>
                  <p class="mb-0">{{$payslips->hiringDate}}</p>
                  <p class="mb-0">Label</p>
                </div>
                <div class="col">
                  <p class="fw-bold text-capitalize mb-4">matricule:</p>
                  <p class="Nbr fw-bold mb-4">Nbr de Parts IGR:</p>
                  <p class="conge fw-bold text-capitalize mb-4">dernier congé:</p>
                  <p class="anciennete fw-bold text-capitalize mb-0">ancienneté:</p>
                </div>
                <div class="col">
                  <p >{{$payslips->matricule}}</p>
                  <p class="Label">{{$payslips->NbrOfParts}}</p>
                  <p class="Label1">&nbsp</p>
                  <p class="Label0">&nbsp</p>
                </div>
              </div>
          </div>
        </div>
<!-- /*Identification du Travailleur part stop here -->

<!-- /*table part start here -->
 <div class="container-fluid">
  <div class="row">
    <table class="table-bordered mt-3">
      <thead class="bg-light ">
        <tr class="thead text-black text-center">
          <th>CODE</th>
          <th>LIBELLES/RUBRIQUES</th>
          <th>NOMBRE</th>
          <th>BASE</th>
          <th>MONT.SAL</th>
          <th>TAUX.PAT</th>
          <th>MONT.PAT</th>
          
         
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
        </tr>
  <!-- /* tr G100 start here  -->

        <tr >
          <td class="tdcode">G100</td>
          <td class="tdlibelle">salaire de Base</td>
          <td class="tdnombre">@php 
            $displayvar=json_decode($payslip->grossIncomeDetails,True);
            
            echo $displayvar["salairBase"];
            @endphp</td>
          <td class="tdbase">{{$presences->presentdays}}</td>
          <td class="tdmontsal">@php 
            $displayvar=json_decode($payslip->grossIncomeDetails,True);
            
            echo $displayvar["salairBase"];
            @endphp</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
  <!-- /* tr G100 stop here  -->

  <!-- /* tr G200 start here  -->

        <tr >
          <td class="tdcode">G200</td>
          <td class="tdlibelle">Sursalaire</td>
          <td class="tdnombre">@php 
            $displayvar=json_decode($payslip->grossIncomeDetails,True);
            
            echo $displayvar["sursal"]==null?0:displayvar["sursal"];
            @endphp </td>
          <td class="tdbase">{{$presences->presentdays}}</td>
          <td class="tdmontsal">@php 
            $displayvar=json_decode($payslip->grossIncomeDetails,True);
            
            echo $displayvar["sursal"]==null?0:displayvar["sursal"];
            @endphp</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
  <!-- /* tr G200 stop here  -->

  <!-- /* tr G300 start here  -->

        <tr >
          <td class="tdcode">G300</td>
          <td class="tdlibelle">Congés Payés</td>
          <td class="tdnombre">@php 
            $displayvar=json_decode($payslip->grossIncomeDetails,True);
            
            echo $displayvar["conge"]==null?0:displayvar["sursal"];
            @endphp</td>
          <td class="tdbase">{{$presences->presentdays}}</td>
          <td class="tdmontsal">@php 
            $displayvar=json_decode($payslip->grossIncomeDetails,True);
            
            echo $displayvar["conge"]==null?0:displayvar["conge"];
            @endphp</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
  <!-- /* tr G300 stop here  -->

  <!-- /* tr G400 start here  -->

        <tr >
          <td class="tdcode">G400</td>
          <td class="tdlibelle">Gratifications</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal">0</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
  <!-- /* tr G400 stop here  -->

  <!-- /* tr G500 start here  -->

        <tr >
          <td class="tdcode">G500</td>
          <td class="tdlibelle">Primes diverses</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal">0</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
  <!-- /* tr G500 stop here  -->

        <tr >
          <td class="tdcode">G601</td>
          <td class="tdlibelle">Autres Indemnités Imposable</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal">0</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr >
          <td class="tdcode"></td>
          <td class="tdlibelle fw-bold" >Heures supplémentaires :</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr class="hee">
          <td class="tdcode">G701</td>
          <td class="tdlibelle ">Heure à 15%</td>
          <td class="tdnombre">0.00</td>
          <td class="tdbase">0.00</td>
          <td class="tdmontsal">0.00</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr class="hee">
          <td class="tdcode">G702</td>
          <td class="tdlibelle"> Heure à 50%</td>
          <td class="tdnombre">0.00</td>
          <td class="tdbase">0.00</td>
          <td class="tdmontsal">0.00</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr class="hee">
          <td class="tdcode">G703</td>
          <td class="tdlibelle">Heure à 75%</td>
          <td class="tdnombre">0.00</td>
          <td class="tdbase">0.00</td>
          <td class="tdmontsal">0.00</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr class="hee">
          <td class="tdcode">G704</td>
          <td class="tdlibelle"> Heure à 100%</td>
          <td class="tdnombre">0.00</td>
          <td class="tdbase">0.00</td>
          <td class="tdmontsal">0.00</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr class="">
          <td class="tdcode">G800</td>
          <td class="tdlibelle">Primes d'ancienneté</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal">{{$payslips->seniority==null?0:$payslips->seniority}}</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr class="">
          <td class="tdcode"></td>
          <td class="tdlibelle fw-bold">Total Soumis Fiscal</td>
          <td class="tdnombre">0</td>
          <td class="tdbase"></td>
          <td class="tdmontsal">0</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr class="">
          <td class="tdcode"></td>
          <td class="tdlibelle fw-bold">Total Soumis Social</td>
          <td class="tdnombre">0</td>
          <td class="tdbase"></td>
          <td class="tdmontsal ">0</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr class="">
          <td class="tdcode"></td>
          <td class="tdlibelle fw-bold text-uppercase">Salaire brut</td>
          <td class="tdnombre">0</td>
          <td class="tdbase"></td>
          <td class="tdmontsal fw-bold">{{$payslip->grossIncome}}</td>
          <td class="tdtauxpat"></td>
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
        </tr>
        <tr class="emptyline">
          <td class="tdcode"></td>
          <td class="tdlibelle"></td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr class="">
          <td class="tdcode">R130</td>
          <td class="tdlibelle">Impôts sur les salaires</td>
          <td class="tdnombre">0</td>
          <td class="tdbase">1.5%</td>
          <td class="tdmontsal">(@php 
            $displayvar=json_decode($payslip->employeeDeductions,True);
            
            echo $displayvar["IS"]==null?0:$displayvar["IS"];
            @endphp)</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr class="">
          <td class="tdcode">R140</td>
          <td class="tdlibelle">Contribution Nationale</td>
          <td class="tdnombre">0</td>
          <td class="tdbase"></td>
          <td class="tdmontsal">(@php 
            $displayvar=json_decode($payslip->employeeDeductions,True);
            
            echo $displayvar["cn"]==null?0:$displayvar["cn"];
            @endphp)</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr class="">
          <td class="tdcode">R150</td>
          <td class="tdlibelle">Impôts Général sur les Revenues</td>
          <td class="tdnombre">0</td>
          <td class="tdbase">0</td>
          <td class="tdmontsal">(@php 
            $displayvar=json_decode($payslip->employeeDeductions,True);
            
            echo $displayvar["IGR"]==null?0:$displayvar["IGR"];
            @endphp)</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr class="">
          <td class="tdcode">R200</td>
          <td class="tdlibelle">Cotisation de Retraite</td>
          <td class="tdnombre">0</td>
          <td class="tdbase">6.3%</td>
          <td class="tdmontsal">(@php 
            $displayvar=json_decode($payslip->employeeDeductions,True);
            
            echo $displayvar["cnps"]==null?0:$displayvar["cnps"];
            @endphp)</td>
          <td class="tdtauxpat">7.7%</td>
          <td class="tdmontpat">(@php 
            $displayvar=json_decode($payslip->companyDeductions,True);
            
            echo $displayvar["cnpsPat"]==null?0:$displayvar["cnpsPat"];
            @endphp)</td>
        </tr>
        <tr class="">
          <td class="tdcode">R203</td>
          <td class="tdlibelle">Couverture Maladie Universelle</td>
          <td class="tdnombre">0</td>
          <td class="tdbase"></td>
          <td class="tdmontsal">1000</td>
          <td class="tdtauxpat"></td>
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
        </tr>
        <tr class="emptyline">
          <td class="tdcode"></td>
          <td class="tdlibelle"></td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr class="">
          <td class="tdcode">R170</td>
          <td class="tdlibelle">Contribution Employeur (CE)</td>
          <td class="tdnombre">0</td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat">1.2%</td>
          <td class="tdmontpat">(@php 
            $displayvar=json_decode($payslip->companyDeductions,True);
            
            echo $displayvar["cnpsPat"]==null?0:$displayvar["cnpsPat"];
            @endphp)</td>
        </tr>
        <tr class="">
          <td class="tdcode">R171</td>
          <td class="tdlibelle">Taxe d'apprentissage</td>
          <td class="tdnombre">0</td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat">0.4%</td>
          <td class="tdmontpat">(@php 
            $displayvar=json_decode($payslip->companyDeductions,True);
            
            echo $displayvar["taxtApp"]==null?0:$displayvar["taxtApp"];
            @endphp)</td>
        </tr>
        <tr class="">
          <td class="tdcode">R172</td>
          <td class="tdlibelle">Formation Prof Continue</td>
          <td class="tdnombre">0</td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat">1.2%</td>
          <td class="tdmontpat">(@php 
            $displayvar=json_decode($payslip->companyDeductions,True);
            
            echo $displayvar["taxForm"]==null?0:$displayvar["taxForm"];
            @endphp)</td>
        </tr>
        <tr class="">
          <td class="tdcode">R201</td>
          <td class="tdlibelle">Prestation Familiale</td>
          <td class="tdnombre">0</td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat">5.75%</td>
          <td class="tdmontpat">0</td>
        </tr>
        <tr class="">
          <td class="tdcode">R202</td>
          <td class="tdlibelle">Accident de Travail</td>
          <td class="tdnombre">0</td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat">5.0%</td>
          <td class="tdmontpat">0</td>
        </tr>
        <tr class="emptyline">
          <td class="tdcode"></td>
          <td class="tdlibelle"></td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal"></td>
          <td class="tdtauxpat"></td>
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
        </tr>
        <tr class="">
          <td class="tdcode">R300</td>
          <td class="tdlibelle">Avances sur Salaires</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal">(@php 
            $displayvar=json_decode($payslip->employeeDeductions,True);
            
            echo $displayvar["payday"]==null?0:$displayvar["payday"];
            @endphp)</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr class="">
          <td class="tdcode">R301</td>
          <td class="tdlibelle">Prêts Scolaires</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal">0</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr class="">
          <td class="tdcode">R302</td>
          <td class="tdlibelle">Prêts Ordinaires</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal">0</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr >
          <td class="tdcode"></td>
          <td class="tdlibelle fw-bold text-uppercase" >total retenues</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal fw-bold">@php 
            $displayvar=json_decode($payslip->employeeDeductions,True);
            
            echo $displayvar["totret"]==null?0:$displayvar["totret"];
            @endphp</td>
          <td class="tdtauxpat "></td>
          <td class="tdmontpat fw-bold">0</td>
        </tr>
        <tr >
          <td class="tdcode"></td>
          <td class="tdlibelle fw-bold text-uppercase" >brut imposable</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal fw-bold">@php 
            $displayvar=json_decode($payslip->grossIncomeDetails,True);
            
            echo $displayvar["brutImposable"]==null?0:$displayvar["brutImposable"];
            @endphp</td>
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
        <tr>
          <td class="tdcode"></td>
          <td class="tdlibelle fw-bold text-uppercase" >transport</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal fw-bold">@php 
            $displayvar=json_decode($payslip->nonDeductibleIncome,True);
            
            echo $displayvar["primeTrasport"]==null?0:$displayvar["primeTrasport"];
            @endphp</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr>
          <td class="tdcode">G900</td>
          <td class="tdlibelle" >Autres Ind. non imposables</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal">0</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        
        <tr>
          <td class="tdcode">G602</td>
          <td class="tdlibelle fw-bold" >Arrondi</td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal fw-bold">0</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        <tr>
          <td class="tdcode"></td>
          <td class="tdlibelle fw-bold text-uppercase" >net a payer </td>
          <td class="tdnombre"></td>
          <td class="tdbase"></td>
          <td class="tdmontsal fw-bold">{{$payslip->netToPay}}</td>
          <td class="tdtauxpat"></td>
          <td class="tdmontpat"></td>
        </tr>
        
        
      </tbody>
  <!-- /*  end of tbody -->
    </table>
  <div class="sptable"></div>
    <table>
      <thead class="btable">
          <th class="border cotisation ">cumul</th>
          <th class="border cotisation ">SAL.brut</th>
          <th class="border cotisation ">SAL.brut imp.</th>
          <th class="border cotisation ">charges SAL.</th>
          <th class="border cotisation ">charges pat.</th>                  
          <th class="border cotisation">net</th>
          <th class="border cotisation ">MONT.PAT</th>
      </thead>
      <tbody class="btable">
          <td class="border ">periode</td>
          <td class="border ">0</td>
          <td class="border ">0</td>
          <td class="border ">0</td>
          <td class="border ">0</td>
          <td class="border ">0</td>
          <td class="border">0</td>
          
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
          <td class="border ">0</td>
          <td class="border ">0</td>
          <td class="border ">0</td>
          <td class="border ">0</td>
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
</body>
</html>