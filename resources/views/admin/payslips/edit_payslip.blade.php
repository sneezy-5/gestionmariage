@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
<div class="container-fluid ">
<div class="row justify-content-center ">
<div class="col-md-10" >
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit</h3>
                @if($errors)
                {{$errors}}
                @endif
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('payslip.update',['payslip'=>$payslip->uuid])}}"  enctype="multipart/form-data">

              @csrf
              @method('put')
                <div class="card-body">
                <div class="form-group  ">
                        <select class="form-select w-100 text-center bg-info" name="employee_uuid">
                            
                            <option value="{{$employe->uuid}}">{{$employe->firstName}}</option>
                          
                        </select>
                  </div>
                
                  <div class="form-group">
                    <label for="exampleInputPrenom">serialID</label>
                    <input type="text" class="form-control" id="exampleInputPrenom" placeholder="serialID", name="serialID" value="{{$payslip->serialID}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">date d'émission</label>
                    <input type="date" class="form-control" id="exampleInputDate" placeholder="issuanceDate" name="issuanceDate" value="{{$payslip->issuanceDate}}">
                  </div>
  

                  <div class="form-group">
                    <label for="exampleInputLieu">Methode De Payement</label>
                    <input type="text" class="form-control" id="exampleInputLieu" placeholder="paymentMethod" name="paymentMethod" value="{{$payslip->paymentMethod}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputBirth">Jour de payement</label>
                    <input type="date" class="form-control" id="exampleInputBirth" placeholder="" name="paymentDate" value="{{$payslip->paymentDate}}">
                  </div>
            
                  <div class="form-group">
                  <label  for="customFile">Net A Payer</label>
                  <input type="number" class="form-control" id="customFile" name="netToPay" placeholder="netToPay" value="{{$payslip->netToPay}}"/>
                    
                  </div>

                  <div class="form-group">
                  <label  for="exampleCnps">Revenu brut</label>
                    <input type="number" class="form-control" id="grossIncome " name="grossIncome" value="{{$payslip->grossIncome}}">
                  
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Retenue sur le salaire total</label>
                    <input type="number" class="form-control" id="exampleCmu" name="TotalPayDeduction" value="{{$payslip->TotalPayDeduction}}">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Jour travailler</label>
                    <input type="number" class="form-control" id="exampleCmu" name="daysWorked" value="{{$payslip->daysWorked}}">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Nombre d'heures de Travail</label>
                    <input type="number" class="form-control" id="exampleCmu" name="hoursWorked" value="{{$payslip->hoursWorked}}">
              
                  </div>


                  <div class="form-group">
                  <label  for="exampleCmu"> Detail de Revenu brute </label>
                    <input type="text" class="form-control" id="exampleCmu" name="grossIncomeDetails" value="{{$payslip->grossIncomeDetails}}">
              
                  </div>



                  <div class="form-group">
                  <label  for="exampleCmu">Revenu non déductible</label>
                    <input type="text" class="form-control" id="exampleCmu" name="nonDeductibleIncome" value="{{$payslip->nonDeductibleIncome}}">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Déductions d'entreprise</label>
                    <input type="text" class="form-control" id="exampleCmu" name="companyDeductions" value="{{$payslip->companyDeductions}}">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Déductions des employés</label>
                    <input type="text" class="form-control" id="exampleCmu" name="employeeDeductions" value="{{$payslip->employeeDeductions}}">
              
                  </div>
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          

          
        

          </div>
    </div>
    </div>
    </div>
@endsection