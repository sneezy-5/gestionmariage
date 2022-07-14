@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
<div class="container-fluid ">
<div class="row justify-content-center ">
<div class="col-md-10" >
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Editer Presence</h3>
                @if($errors)
                {{$errors}}
                @endif
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('presence.update',['presence'=>$presence->uuid])}}"  enctype="multipart/form-data">

              @csrf
              @method('put')
                <div class="card-body">
           
                <div class="form-group  ">
                        <select class="form-select w-100 text-center bg-info" name="employee_uuid">
                           
                            <option value="{{$employe->uuid}}">{{$employe->firstName}}</option>
                         
                        </select>
                  </div>
                
                  <div class="form-group">
                    <label for="periodStart">periodStart</label>
                    <input type="text" class="form-control" id="periodStart" placeholder="periodStart ", name="periodStart" value="{{$presence->periodStart}}">
                  </div>

                  <div class="form-group">
                    <label for="periodStart">periodStart</label>
                    <input type="text" class="form-control" id="periodStart" placeholder="periodStart " name="periodStart" value="{{$presence->periodStart}}">
                  </div>
  

                  <div class="form-group">
                    <label for="exampleInputLieu">absentdays</label>
                    <input type="text" class="form-control" id="exampleInputLieu" placeholder="absentdays" name="absentdays" value="{{$presence->absentdays}}">
                  </div>

                  <div class="form-group">
                    <label for="presentdays">presentdays</label>
                    <input type="text" class="form-control" id="presentdays" placeholder="presentdays " name="presentdays" value="{{$presence->presentdays}}">
                  </div>
            
                  <div class="form-group">
                  <label  for="delays">delays</label>
                  <input type="text" class="form-control" id="delays" name="delays" placeholder="delays" value="{{$presence->delays}}"/>
                    
                  </div>

                  <div class="form-group">
                  <label  for="exampleCnps">normalHours</label>
                    <input type="text" class="form-control" id="exampleCnps " name="normalHours" value="{{$presence->normalHours}}">
                  
                  </div>

                  <div class="form-group">
                  <label  for="normalHoursComplementary">normalHoursComplementary</label>
                    <input type="text" class="form-control" id="email" name="normalHoursComplementary" value="{{$presence->normalHoursComplementary}}">
              
                  </div>

                  <div class="form-group">
                  <label  for="Overtime_15">Overtime_15</label>
                    <input type="text" class="form-control" id="website" name="Overtime_15" value="{{$presence->Overtime_15}}">
              
                  </div>

                  <div class="form-group">
                  <label  for="Overtime_50">Overtime_50</label>
                    <input type="text" class="form-control" id="fax" name="Overtime_50" value="{{$presence->Overtime_50}}">
              
                  </div>


                  <div class="form-group">
                  <label  for="Overtime_75">Overtime_75</label>
                    <input type="text" class="form-control" id="logo" name="Overtime_75" value="{{$presence->Overtime_75}}">
              
                  </div>



                  <div class="form-group">
                  <label  for="Overtime_100">Overtime_100</label>
                    <input type="text" class="form-control" id="Overtime_100" name="Overtime_100" value="{{$presence->Overtime_100}}">
              
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