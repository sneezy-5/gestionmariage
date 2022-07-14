@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
<div class="container-fluid ">
<div class="row justify-content-center ">
<div class="col-md-10" >
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ajouter</h3>
                @if($errors)
                {{$errors}}
                @endif
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('payslip.store')}}"  enctype="multipart/form-data">

              @csrf
                <div class="card-body">
                <div class="form-group  ">
                        <select class="form-select w-100 text-center bg-info" name="employee_uuid">
                            @foreach($employes as $employe)
                            <option value="{{$employe->uuid}}">{{$employe->firstName}}</option>
                            @endforeach
                        </select>
                  </div>
                
                  <div class="form-group">
                    <label for="exampleInputPrenom">serialID</label>
                    <input type="text" class="form-control" id="exampleInputPrenom" placeholder="serialID", name="serialID">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">issuanceDate</label>
                    <input type="date" class="form-control" id="exampleInputDate" placeholder="issuanceDate" name="issuanceDate">
                  </div>
  

                  <div class="form-group">
                    <label for="exampleInputLieu">extrapay</label>
                    <input type="text" class="form-control" id="exampleInputLieu" placeholder="paymentMethod" name="paymentMethod">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputBirth">Transport</label>
                    <input type="date" class="form-control" id="exampleInputBirth" placeholder="" name="paymentDate">
                  </div>
            
                  <div class="form-group">
                  <label  for="customFile">date de signature</label>
                  <input type="number" class="form-control" id="customFile" name="netToPay" placeholder="netToPay"/>
                    
                  </div>

                  <div class="form-group">
                  <label  for="exampleCnps">Date de début</label>
                    <input type="number" class="form-control" id="grossIncome " name="grossIncome">
                  
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Date de fin</label>
                    <input type="number" class="form-control" id="exampleCmu" name="TotalPayDeduction">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Date de fin</label>
                    <input type="number" class="form-control" id="exampleCmu" name="daysWorked">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Date de fin</label>
                    <input type="number" class="form-control" id="exampleCmu" name="hoursWorked">
              
                  </div>


                  <div class="form-group">
                  <label  for="exampleCmu">Date de fin</label>
                    <input type="text" class="form-control" id="exampleCmu" name="grossIncomeDetails">
              
                  </div>



                  <div class="form-group">
                  <label  for="exampleCmu">Date de fin</label>
                    <input type="text" class="form-control" id="exampleCmu" name="nonDeductibleIncome">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Date de fin</label>
                    <input type="text" class="form-control" id="exampleCmu" name="companyDeductions">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Date de fin</label>
                    <input type="text" class="form-control" id="exampleCmu" name="employeeDeductions">
              
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