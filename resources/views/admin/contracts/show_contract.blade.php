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
              <div class="col-6">
              <a class="btn btn-secondary" href="{{ route('contract.edit',['contract'=>$contract['id']])}}">Editer</a>
       
       <form style="display: inline-block;" action="{{ route('contract.destroy', ['contract'=>$contract['id']])}}" method="post"> 
         @csrf 
         @method('delete')
         <button class="btn btn-danger" type="submit">Suprimer</button>
       </form>
              </div>
              <div class="card-body">
                <div class="tab-content">
                 
                

                  <div class="tab-pane active" id="settings">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Type de contrat</label>
                        <div class="col-sm-10">
                          <p>{{$contract->contract_type}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Position</label>
                        <div class="col-sm-10">
                          <p>{{$contract->position}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Salaire de Base</label>
                        <div class="col-sm-10">
                          <p>{{$contract->baseSalary}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Sursalaire</label>
                        <div class="col-sm-10">
                          <p>{{$contract->extrapay}}</p>
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Transport</label>
                        <div class="col-sm-10">
                        <p>{{$contract->transportationAllowance}}</p>
                        </div>
                      </div>
    
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Prime</label>
                        <div class="col-sm-10">
                          @foreach($prime==null?[]:$prime as $key=> $prim)
                        <p>Title: {{$prim["title"]}}</p>
                        <p>Code: {{$prim["code"]}}</p>
                        @endforeach
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Employé</label>
                     
                        <div class="col-sm-10">
                        <p>{{$co->firstName}}</p>
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