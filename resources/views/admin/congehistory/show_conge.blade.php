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
              <a class="btn btn-secondary" href="{{ route('congehistory.edit',['congehistory'=>$conge['id']])}}">Editer</a>
                    
                    <form style="display: inline-block;" action="{{ route('congehistory.destroy',['congehistory'=>$conge['id']])}}" method="post"> 
                      @csrf 
                      @method('delete')
                      <button class="btn btn-danger" type="submit">Suprimer</button>
                    </form>
              </div>
              <div class="card-body">
                <div class="tab-content">
                 
                

                  <div class="tab-pane active" id="settings">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Date de la demande</label>
                        <div class="col-sm-10">
                          <p>{{$conge->request_date}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Debut de Congé</label>
                        <div class="col-sm-10">
                          <p>{{$conge->start_date}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Nombre de Jour</label>
                        <div class="col-sm-10">
                          <p>{{$conge->nbrDate}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Montant</label>
                        <div class="col-sm-10">
                          <p>{{$conge->amount}}</p>
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