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
              <form method="post" action="{{route('conge.store')}}"  enctype="multipart/form-data">

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
                    <label for="exampleInputPrenom">montant</label>
                    <input type="number" class="form-control" id="exampleInputPrenom" placeholder="montant", name="montant">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">Jour Cumulé</label>
                    <input type="number" class="form-control" id="exampleInputDate" placeholder="cumulativeDay" name="cumulativeDay">
                  </div>
  

                  <div class="form-group">
                    <label for="exampleInputLieu">Jour Pris</label>
                    <input type="number" class="form-control" id="exampleInputLieu" placeholder="tekanDay" name="tekanDay">
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