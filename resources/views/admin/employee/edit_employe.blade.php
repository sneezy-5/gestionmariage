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
              <form method="post" action="{{route('employee.update',['employee'=>$employee->id])}}"  enctype="multipart/form-data">

              @csrf
              @method('put')
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputNom">Nom </label>
                    <input type="text" class="form-control" id="exampleInputNom" placeholder="nom de l'employé" name="firstName" value="{{$employee->firstName}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPrenom">Prenom</label>
                    <input type="text" class="form-control" id="exampleInputPrenom" placeholder="prenom", name="lastName" value="{{$employee->lastName}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">Date De Naissance</label>
                    <input type="date" class="form-control" id="exampleInputDate" placeholder="Date De naissance" name="birthdate" value="{{$employee->birthdate}}">
                  </div>
  

                  <div class="form-group">
                    <label for="exampleInputLieu">Lieu De Naissance</label>
                    <input type="text" class="form-control" id="exampleInputLieu" placeholder="Lieu De naissance" name="birthplace" value="{{$employee->birthplace}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputBirth">Nationalité</label>
                    <input type="text" class="form-control" id="exampleInputBirth" placeholder="Nationalité" name="nationality" value="{{$employee->nationality}}">
                  </div>
            
                  <div class="form-group">
                  <label  for="customFile">Photo</label>
                  <input type="file" class="form-control" id="customFile" name="pictureURL"  value="{{$employee->pictureURL}}"/>
                    
                  </div>

                  <div class="form-group">
                  <label  for="exampleCnps">Numéro CNPS</label>
                    <input type="number" class="form-control" id="exampleCnps" name="CNPSnumber" value="{{$employee->CNPSnumber}}">
                  
                  </div>

                  <div class="form-group">
                  <label  for="exampleCmu">Numéro CMU</label>
                    <input type="number" class="form-control" id="exampleCmu" name="CMUnumber" value="{{$employee->CMUnumber}}">
              
                  </div>

                  <div class="form-group">
                  <label  for="exampleStreet">Rue</label>
                    <input type="text" class="form-control" id="exampleStreet" name="street" placeholder="Rue" value="{{$employee->street}}">
                   
                  </div>

                  <div class="form-group">
                  <label  for="exampleneighborhood">Commune</label>
                    <input type="text" class="form-control" id="exampleneighborhood" name="neighborhood" value="{{$employee->neighborhood}}">
                  
                  </div>

                  <div class="form-group">
                  <label  for="examplenCity">Ville</label>
                    <input type="text" class="form-control" id="examplenCity" name="city" placeholder="Ville" value="{{$employee->city}}">
                   
                  </div>

                  <div class="form-group">
                  <label  for="examplenPays">Pays</label>
                    <input type="text" class="form-control" id="examplenPays" name="country" placeholder="Pays" value="{{$employee->country}}">
                   
                  </div>

                  <div class="form-group">
                  <label  for="examplenmaritalStatus">état civil</label>
                    <input type="text" class="form-control" id="examplenmaritalStatus" name="maritalStatus" placeholder="état civil" value="{{$employee->maritalStatus}}">
                   
                  </div>

                  <div class="form-group">
                  <label  for="examplenumberOfDependents">Nombre de personnes à charge</label>
                    <input type="number" class="form-control" id="examplenumberOfDependents" name="numberOfDependents" placeholder="Nombre de personnes à charge" value="{{$employee->numberOfDependents}}">
                   
                  </div>

                  <div class="form-group">
                  <label  for="exampleNbrOfParts">Nombre de part</label>
                    <input type="number" class="form-control" id="exampleNbrOfParts" name="NbrOfParts" placeholder="Nombre de pièces" value="{{$employee->NbrOfParts}}">
                   
                  </div>

                  <div class="form-group">
                  <label  for="examplehiringDate">date d'embauche</label>
                    <input type="date" class="form-control" id="examplehiringDate" name="hiringDate" placeholder="Date d'embauche" value="{{$employee->hiringDate}}">
                   
                  </div>

                  <div class="form-group">
                  <label  for="exampleseniority">ancienneté</label>
                    <input type="number" class="form-control" id="exampleseniority" name="seniority" placeholder="ancienneté" value="{{$employee->seniority}}">
                   
                  </div>

                  <div class="form-group">
                  <label  for="examplecurrentPosition">position actuelle</label>
                    <input type="number" class="form-control" id="examplecurrentPosition" name="currentPosition" placeholder="position actuelle" value="{{$employee->currentPosition}}">
                    
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