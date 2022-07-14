@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
<div class="container-fluid ">
<div class="row justify-content-center ">
<div class="col-md-10" >
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ajouter Employé</h3>
                @if($errors)
                {{$errors}}
                @endif
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('employee.store')}}"  enctype="multipart/form-data">

              @csrf

                <div class="card-body">
                <div class="form-group  ">
                        <select class="form-select w-100 bg-info text-center" name="civility">
                            <option value="HOMME" selected>HOMME</option>
                            <option value="FEMME">FEMME</option>
                        </select>
                  </div>

    
                  <div class="form-group">
                    <label for="exampleInputNom">Nom </label>
                    <input type="text" class="form-control" id="exampleInputNom" placeholder="nom de l'employé" name="firstName">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPrenom">Prenom</label>
                    <input type="text" class="form-control" id="exampleInputPrenom" placeholder="prenom", name="lastName">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">Date De Naissance</label>
                    <input type="date" class="form-control" id="exampleInputDate" placeholder="Date De naissance" name="birthdate">
                  </div>
  

                  <div class="form-group">
                    <label for="exampleInputLieu">Lieu De Naissance</label>
                    <input type="text" class="form-control" id="exampleInputLieu" placeholder="Lieu De naissance" name="birthplace">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputBirth">Nationalité</label>
                    <input type="text" class="form-control" id="exampleInputBirth" placeholder="Nationalité" name="nationality">
                  </div>
            
                  <div class="form-group">
                  <label  for="customFile">Photo</label>
                  <input type="file" class="form-control" id="customFile" name="pictureURL"/>
                    
                  </div>

                  <div class="form-group">
                  <label  for="exampleCnps">Numéro CNPS</label>
                    <input type="number" class="form-control" id="exampleCnps" name="CNPSnumber">
                  
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Numéro CMU</label>
                    <input type="number" class="form-control" id="exampleCmu" name="CMUnumber">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleStreet">Rue</label>
                    <input type="text" class="form-control" id="exampleStreet" name="street" placeholder="Rue">
                   
                  </div>

                  <div class="form-group">
                  <label  for="exampleneighborhood">Commune</label>
                    <input type="text" class="form-control" id="exampleneighborhood" name="neighborhood">
                  
                  </div>

                  <div class="form-group">
                  <label  for="examplenCity">Ville</label>
                    <input type="text" class="form-control" id="examplenCity" name="city" placeholder="Ville">
                   
                  </div>

                  <div class="form-group">
                  <label  for="examplenPays">Pays</label>
                    <input type="text" class="form-control" id="examplenPays" name="country" placeholder="Pays">
                   
                  </div>

                  <div class="form-group">
                  <label  for="examplenmaritalStatus">état civil</label>
                    <input type="text" class="form-control" id="examplenmaritalStatus" name="maritalStatus" placeholder="état civil">
                   
                  </div>

                  <div class="form-group">
                  <label  for="examplenumberOfDependents">Nombre de personnes à charge</label>
                    <input type="number" class="form-control" id="examplenumberOfDependents" name="numberOfDependents" placeholder="Nombre de personnes à charge">
                   
                  </div>

                  <div class="form-group">
                  <label  for="exampleNbrOfParts">Nombre de part</label>
                    <input type="number" class="form-control" id="exampleNbrOfParts" name="NbrOfParts" placeholder="Nombre de pièces">
                   
                  </div>

                  <div class="form-group">
                  <label  for="examplehiringDate">date d'embauche</label>
                    <input type="date" class="form-control" id="examplehiringDate" name="hiringDate" placeholder="Date d'embauche">
                   
                  </div>

                  <div class="form-group">
                  <label  for="exampleseniority">ancienneté</label>
                    <input type="number" class="form-control" id="exampleseniority" name="seniority" placeholder="ancienneté">
                   
                  </div>

                  <div class="form-group">
                  <label  for="examplecurrentPosition">position actuelle</label>
                    <input type="text" class="form-control" id="examplecurrentPosition" name="currentPosition" placeholder="position actuelle">
                    
                  </div>

                  <!-- <div class="form-group  ">
                        <select class="form-select w-100 text-center bg-info" name="employee_uuid">
                            @foreach($contracts as $contract)
                            <option value="{{$contract->uuid}}">{{$contract->contract_type}}</option>
                            @endforeach
                        </select>
                  </div> -->
                
<!-- 
                  <div class="form-group  ">
                        <select class="form-select w-100 text-center bg-info" name="employee_uuid">
                            @foreach($contracts as $contract)
                            <option value="{{$contract->uuid}}">{{$contract->contract_type}}</option>
                            @endforeach
                        </select>
                  </div> -->
                
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