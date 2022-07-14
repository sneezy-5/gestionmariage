@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
<div class="container-fluid ">
<div class="row justify-content-center ">
<div class="col-md-10" >
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ajouter Presence</h3>
                @if($errors)
                {{$errors}}
                @endif
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('presence.store')}}"  enctype="multipart/form-data">

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
                    <label for="exampleInputPrenom">Debut</label>
                    <input type="date" class="form-control" id="exampleInputPrenom" placeholder="periodStart ", name="periodStart">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">fin</label>
                    <input type="date" class="form-control" id="exampleInputDate" placeholder="periodEnd " name="periodEnd">
                  </div>
  

                  <div class="form-group">
                    <label for="exampleInputLieu">absence</label>
                    <input type="number" class="form-control" id="exampleInputLieu" placeholder="absentdays" name="absentdays">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputBirth">presentdays</label>
                    <input type="number" class="form-control" id="exampleInputBirth" placeholder="presentdays " name="presentdays">
                  </div>
            
                  <div class="form-group">
                  <label  for="customFile">delays</label>
                  <input type="text" class="form-control" id="customFile" name="delays" placeholder="delays"/>
                    
                  </div>

                  <div class="form-group">
                  <label  for="exampleCnps">normalHours	</label>
                    <input type="number" class="form-control" id="exampleCnps " name="normalHours">
                  
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">normalHoursComplementary</label>
                    <input type="number" class="form-control" id="email" name="normalHoursComplementary">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Overtime_15</label>
                    <input type="number" class="form-control" id="website" name="Overtime_15">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Overtime_50</label>
                    <input type="number" class="form-control" id="fax" name="Overtime_50">
              
                  </div>


                  <div class="form-group">
                  <label  for="exampleCmu">Overtime_75</label>
                    <input type="number" class="form-control" id="logo" name="Overtime_75">
              
                  </div>



                  <div class="form-group">
                  <label  for="exampleCmu">Overtime_100</label>
                    <input type="number" class="form-control" id="CNPSNumber" name="Overtime_100">
              
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