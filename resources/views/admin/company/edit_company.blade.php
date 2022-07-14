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
              <form method="post" action="{{route('company.update',['company'=>$company->uuid])}}"  enctype="multipart/form-data">

              @csrf
              @method('put')
                <div class="card-body">
           
                
                  <div class="form-group">
                    <label for="exampleInputPrenom">serialID</label>
                    <input type="text" class="form-control" id="exampleInputPrenom" placeholder="company_type", name="company_type">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">issuanceDate</label>
                    <input type="text" class="form-control" id="exampleInputDate" placeholder="street" name="street">
                  </div>
  

                  <div class="form-group">
                    <label for="exampleInputLieu">extrapay</label>
                    <input type="text" class="form-control" id="exampleInputLieu" placeholder="neighborhood" name="neighborhood">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputBirth">Transport</label>
                    <input type="text" class="form-control" id="exampleInputBirth" placeholder="city" name="city">
                  </div>
            
                  <div class="form-group">
                  <label  for="customFile">date de signature</label>
                  <input type="text" class="form-control" id="customFile" name="country" placeholder="country"/>
                    
                  </div>

                  <div class="form-group">
                  <label  for="exampleCnps">Date de début</label>
                    <input type="text" class="form-control" id="phone_number " name="phone_number">
                  
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Date de fin</label>
                    <input type="text" class="form-control" id="email" name="email">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Date de fin</label>
                    <input type="text" class="form-control" id="website" name="website">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Date de fin</label>
                    <input type="text" class="form-control" id="fax" name="fax">
              
                  </div>


                  <div class="form-group">
                  <label  for="exampleCmu">Date de fin</label>
                    <input type="text" class="form-control" id="logo" name="logo">
              
                  </div>



                  <div class="form-group">
                  <label  for="exampleCmu">Date de fin</label>
                    <input type="text" class="form-control" id="CNPSNumber" name="CNPSNumber">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Date de fin</label>
                    <input type="text" class="form-control" id="POBox" name="POBox">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Date de fin</label>
                    <input type="number" class="form-control" id="CNPSRate" name="CNPSRate">
              
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