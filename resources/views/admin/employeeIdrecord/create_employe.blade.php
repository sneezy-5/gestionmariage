@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
<div class="container-fluid ">
<div class="row justify-content-center ">
<div class="col-md-10" >
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ajouter </h3>
                @if($errors)
                {{$errors}}
                @endif
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('employeeidrecord.store')}}"  enctype="multipart/form-data">

              @csrf
                <div class="card-body">
                <div class="form-group  ">
                        <select class="form-select w-100 text-center bg-info" name="employee_uuid">
                            @foreach($employes as $employe)
                            <option value="{{$employe->uuid}}">{{$employe->firstName}}</option>
                            @endforeach
                        </select>
                  </div>
                
                  <div class="form-group">
                    <label for="exampleInputPrenom">Type</label>
                    <input type="text" class="form-control" id="exampleInputPrenom" placeholder="type", name="type">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">idnumber</label>
                    <input type="text" class="form-control" id="exampleInputDate" placeholder="idnumber" name="idnumber">
                  </div>
  

                  <div class="form-group">
                    <label for="exampleInputLieu">issuanceDate</label>
                    <input type="date" class="form-control" id="exampleInputLieu" placeholder="issuanceDate" name="issuanceDate">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputBirth">expirationDate</label>
                    <input type="date" class="form-control" id="exampleInputBirth" placeholder="expirationDate" name="expirationDate">
                  </div>
            
                  <div class="form-group">
                  <label  for="customFile">countryOfInsuance</label>
                  <input type="text" class="form-control" id="customFile" name="countryOfInsuance" placeholder="countryOfInsuance"/>
                    
                  </div>

                  <div class="form-group">
                  <label  for="exampleCnps">scanURL</label>
                    <input type="file" class="form-control" id="exampleCnps" name="scanURL">
                  
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