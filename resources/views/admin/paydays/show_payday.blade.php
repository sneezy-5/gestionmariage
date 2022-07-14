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

              <a class="btn btn-secondary" href="{{ route('payday.edit',['payday'=>$payday['id']])}}">Editer</a>
                     
                     <form style="display: inline-block;" action="{{ route('payday.destroy', ['payday'=>$payday['id']])}}" method="post"> 
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
                          <p>{{$payday->RequestDate}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Montant demande</label>
                        <div class="col-sm-10">
                          <p>{{$payday->amountRequested}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Date du paiement</label>
                        <div class="col-sm-10">
                          <p>{{$payday->paymentDate}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Methode de paiement</label>
                        <div class="col-sm-10">
                          <p>{{$payday->paymentMethod}}</p>
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Date de remboursement</label>
                        <div class="col-sm-10">
                        <p>{{$payday->ReimbursmentDate}}</p>
                        </div>
                      </div>
    
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Employé</label>
                     
                        <div class="col-sm-10">
                        <p>{{$co->firstName}}</p>
                        </div>
                       
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