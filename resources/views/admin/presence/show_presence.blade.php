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
                        <label for="inputName" class="col-sm-2 col-form-label">debut de la periode de paie</label>
                        <div class="col-sm-10">
                          <p>{{$presence->periodStart}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Fin de la periode de paie</label>
                        <div class="col-sm-10">
                          <p>{{$presence->periodEnd}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Jours d'absence</label>
                        <div class="col-sm-10">
                          <p>{{$presence->absentdays}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Jours de presence</label>
                        <div class="col-sm-10">
                          <p>{{$presence->presentdays}}</p>
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Nombre de retards</label>
                        <div class="col-sm-10">
                        <p>{{$presence->delays}}</p>
                        </div>
                      </div>
    
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Heures normales /40h</label>
                     
                        <div class="col-sm-10">
                        <p>{{$presence->normalHours }}</p>
                        </div>
                       
                      </div>
                
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">heures normales complementaires</label>
                     
                        <div class="col-sm-10">
                        <p>{{$presence->normalHoursComplementary }}</p>
                        </div>
                       
                      </div>

                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">HS 15%</label>
                     
                        <div class="col-sm-10">
                        <p>{{$presence->Overtime_15 }}</p>
                        </div>
                       
                      </div>

                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">HS 15%</label>
                     
                        <div class="col-sm-10">
                        <p>{{$presence->Overtime_15 }}</p>
                        </div>
                       
                      </div>

                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">HS 15%</label>
                     
                        <div class="col-sm-10">
                        <p>{{$presence->Overtime_50 }}</p>
                        </div>
                       
                      </div>

                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">HS 15%</label>
                     
                        <div class="col-sm-10">
                        <p>{{$presence->Overtime_75 }}</p>
                        </div>
                       
                      </div>

                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">HS 15%</label>
                     
                        <div class="col-sm-10">
                        <p>{{$presence->Overtime_100 }}</p>
                        </div>
                       
                      </div>

                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Employé</label>
                     
                        <div class="col-sm-10">
                        <p>{{$co->firstName }}</p>
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