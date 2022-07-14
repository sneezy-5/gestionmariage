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
              <form method="post" action="{{route('payday.store')}}"  enctype="multipart/form-data">

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
                    <label for="exampleInputPrenom">RequestDate</label>
                    <input type="date" class="form-control" id="exampleInputPrenom" placeholder="RequestDate", name="RequestDate">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">amountRequested</label>
                    <input type="number" class="form-control" id="exampleInputDate" placeholder="amountRequested" name="amountRequested">
                  </div>
  

                  <div class="form-group">
                    <label for="exampleInputLieu">paymentDate</label>
                    <input type="date" class="form-control" id="exampleInputLieu" placeholder="paymentDate" name="paymentDate">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputBirth">paymentMethod</label>
                    <input type="text" class="form-control" id="exampleInputBirth" placeholder="paymentMethod" name="paymentMethod">
                  </div>
            
                  <div class="form-group">
                  <label  for="customFile">ReimbursmentDate</label>
                  <input type="date" class="form-control" id="customFile" name="ReimbursmentDate" placeholder="ReimbursmentDate"/>
                    
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