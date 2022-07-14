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
                <a class="btn btn-secondary" href="{{ route('employee.edit',['employee'=>$employee->id])}}">Editer</a>
                     
                      
                     <form style="display: inline-block;" action="{{ route('employee.destroy', ['employee'=>$employee->id])}}" method="post"> 
                       @csrf 
                       @method('delete')
                       <button class="btn btn-danger" type="submit">Suprimer</button>
                     </form>
                </div>
              <div class="card-body">
                <div class="tab-content">
                 
                

                  <div class="tab-pane active" id="settings">
                  <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Matricule</label>
                        <div class="col-sm-10">
                          <p>{{$employee->matricule}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
                        <div class="col-sm-10">
                          <p>{{$employee->firstName}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Prénom</label>
                        <div class="col-sm-10">
                          <p>{{$employee->lastName}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Poste</label>
                        <div class="col-sm-10">
                          <p>{{$employee->currentPosition}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Date de naissance</label>
                        <div class="col-sm-10">
                          <p>{{$employee->birthdate}}</p>
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Lieu de naissance</label>
                        <div class="col-sm-10">
                          <p>{{$employee->birthplace}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Nationalité</label>
                        <div class="col-sm-10">
                          <p>{{$employee->nationality}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Numéro CNPS</label>
                        <div class="col-sm-10">
                          <p>{{$employee->CNPSnumber}}</p>
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