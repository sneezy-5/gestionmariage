@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
<div class="container-fluid ">
<div class="row justify-content-center ">
          <div class="col-md-3">
              <a  href="{{route('payslip.download',['payslip'=>$payslip->uuid])}}" class="btn btn-primary download">Télécharger</a>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
    
              <div class="card-body">
                <div class="tab-content">
                 
                

                  <div class="tab-pane active" id="settings">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">serialId</label>
                        <div class="col-sm-10">
                          <p>{{$payslip->serialID}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Date d'emmission</label>
                        <div class="col-sm-10">
                          <p>{{$payslip->issuanceDate}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Date de Payement</label>
                        <div class="col-sm-10">
                          <p>{{$payslip->paymentDate}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Methode de payement</label>
                        <div class="col-sm-10">
                          <p>{{$payslip->paymentMethod}}</p>
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Net à Payer</label>
                        <div class="col-sm-10">
                        <p>{{$payslip->netToPay}}</p>
                        </div>
                      </div>
    
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">grossIncomeDetails</label>
                     
                        <div class="col-sm-10">
                         
                      {{$payslip->grossIncomeDetails}}
                        </div>
                       
                      </div>
                
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">nonDeductibleIncome</label>
                     
                        <div class="col-sm-10">
                        <p> {{$payslip->nonDeductibleIncome}}</p>
                        </div>
                       
                      </div>

                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">companyDeductions</label>
                     
                        <div class="col-sm-10">
                        <p> {{$payslip->companyDeductions}}</p>
                        </div>
                       
                      </div>

                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">employeeDeductions</label>
                     
                        <div class="col-sm-10">
                        <p> {{$payslip->employeeDeductions}}</p>
                        </div>
                       
                      </div>
                      
                  </div>
                  
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
    </div>
    </div>

    <script>
  var link = document.createElement('a');
link.href = url;
link.download = 'file.pdf';
link.dispatchEvent(new MouseEvent('click'));
    </script>
          
@endsection