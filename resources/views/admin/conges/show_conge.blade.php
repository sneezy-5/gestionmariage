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
              <a class="btn btn-secondary" href="{{ route('conge.edit',['conge'=>$conge['id']])}}">Editer</a>
                     
                     <form style="display: inline-block;" action="{{ route('conge.destroy', ['conge'=>$conge['id']])}}" method="post"> 
                       @csrf 
                       @method('delete')
                       <button class="btn btn-danger" type="submit">Suprimer</button>
                     </form>
              </div>
              <div class="card-body">
                <div class="tab-content">
                 
                

                  <div class="tab-pane active" id="settings">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Montant</label>
                        <div class="col-sm-10">
                          <p>{{$conge->montant}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Jour Cumulé</label>
                        <div class="col-sm-10">
                          <p>{{$conge->cumulativeDay}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Jour Pris</label>
                        <div class="col-sm-10">
                          <p>{{$conge->tekanDay}}</p>
                        </div>
                      </div>
                    
                
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Employé</label>
                     
                        <div class="col-sm-10">
                        <p>{{$employe->firstName}}</p>
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