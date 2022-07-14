@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
<div class="container-fluid ">
<div class="row justify-content-center ">
          <div class="col-md-3">

            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
    
              <div class="card-body">
                <div class="tab-content">
                 
                

                  <div class="tab-pane active" id="settings">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Type de contrat</label>
                        <div class="col-sm-10">
                          <p>{{$company->contract_type}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Position</label>
                        <div class="col-sm-10">
                          <p>{{$compny->position}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Salaire de Base</label>
                        <div class="col-sm-10">
                          <p>{{$company->baseSalary}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">entrapay</label>
                        <div class="col-sm-10">
                          <p>{{$company->extrapay}}</p>
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Transport</label>
                        <div class="col-sm-10">
                        <p>{{$company->transportationAllowance}}</p>
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
          
@endsection