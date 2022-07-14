@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
<div class="container-fluid ">
<div class="row justify-content-center ">
<div class="col-md-10" >
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ajouter Historique de Congé</h3>
                @if($errors)
                {{$errors}}
                @endif
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('congehistory.store')}}"  enctype="multipart/form-data">

              @csrf
                <div class="card-body">
                <div class="form-group  ">
                        <select class="form-select w-100 text-center bg-info" name="employee_uuid">
                            @foreach($employes as $employe)
                            <option value="{{$employe->id}}">{{$employe->firstName}}</option>
                            @endforeach
                        </select>
                  </div>
                
                  <div class="form-group">
                    <label for="exampleInputPrenom">Jour de La demande</label>
                    <input type="date" class="form-control" id="exampleInputPrenom" placeholder="Jour de la demande", name="request_date">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">Debut du congé</label>
                    <input type="date" class="form-control" id="exampleInputDate" placeholder="Debut de congé" name="start_date">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">Fin du congé</label>
                    <input type="date" class="form-control" id="exampleInputDate" placeholder="Debut de congé" name="end_date">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputLieu">Jour pris</label>
                    <input type="number" class="form-control" id="exampleInputLieu" placeholder="Nobre de jour pris" name="nbrDate">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputBirth">Montant</label>
                    <input type="number" class="form-control" id="exampleInputBirth" placeholder="amount" name="amount">
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