@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
<div class="container-fluid ">
<div class="row justify-content-center ">
<div class="col-md-10" >
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ajouter Contrat</h3>
                @if($errors)
                {{$errors}}
                @endif
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('contract.store')}}"  enctype="multipart/form-data">

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
                    <label for="exampleInputPrenom">Position</label>
                    <input type="text" class="form-control" id="exampleInputPrenom" placeholder="Position", name="baseSalary">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">Salaire de Base</label>
                    <input type="number" class="form-control" id="exampleInputDate" placeholder="Saaire de Base" name="baseSalary">
                  </div>
  

                  <div class="form-group">
                    <label for="exampleInputLieu">extrapay</label>
                    <input type="number" class="form-control" id="exampleInputLieu" placeholder="extrapay" name="extrapay">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputBirth">Transport</label>
                    <input type="number" class="form-control" id="exampleInputBirth" placeholder="indemnité de transport" name="transportationAllowance">
                  </div>
            
                  <div class="form-group">
                  <label  for="customFile">date de signature</label>
                  <input type="date" class="form-control" id="customFile" name="signingDate" placeholder="date de signature"/>
                    
                  </div>

                  <div class="form-group">
                  <label  for="exampleCnps">Date de début</label>
                    <input type="date" class="form-control" id="exampleCnps" name="startDate">
                  
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Date de fin</label>
                    <input type="date" class="form-control" id="exampleCmu" name="endDate">
              
                  </div>

                  <div class="form-group  ">

                    <select multiple class="form-select w-100 bg-info text-center" name="prime[]">
                      @foreach($primes as $prime)
                        <option value="{{$prime->uuid}}" >{{$prime->title}}</option>
                      @endforeach
                    </select>
                </div>

                  <div class="form-group  ">
                        <select class="form-select w-100 bg-info text-center" name="contract_type">
                            <option value="CDD" selected>CDD</option>
                            <option value="CDI">CDI</option>
                            <option value="STAGE">STAGE</option>
                        </select>
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


    <script>
      $("element").mousedown(function(e){
    e.preventDefault();
    
		var select = this;
    var scroll = select.scrollTop;
    
    e.target.selected = !e.target.selected;
    
    setTimeout(function(){select.scrollTop = scroll;}, 0);
    
    $(select).focus();
}).mousemove(function(e){e.preventDefault()});
    </script>
@endsection