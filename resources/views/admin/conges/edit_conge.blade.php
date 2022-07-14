@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
<div class="container-fluid ">
<div class="row justify-content-center ">
<div class="col-md-10" >
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Editer Congé</h3>
                @if($errors)
                {{$errors}}
                @endif
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('contract.update',['contract'=>$contract->uuid])}}"  enctype="multipart/form-data">

              @csrf
              @method('put')
                <div class="card-body">
                <div class="form-group  ">
                        <select class="form-select w-100 text-center bg-info" name="employee_uuid">
                            @foreach($employes as $employe)
                            <option value="{{$employe->uuid}}">{{$employe->firstName}}</option>
                            @endforeach
                        </select>
                  </div>
                
                  <div class="form-group">
                    <label for="exampleInputPrenom">montant</label>
                    <input type="text" class="form-control" id="exampleInputPrenom" placeholder="montant", name="montant" value="{{$conge->montant}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">Jour Cumulé</label>
                    <input type="number" class="form-control" id="exampleInputDate" placeholder="cumulativeDay" name="cumulativeDay" value="{{$conge->cumulativeDay}}">
                  </div>
  

                  <div class="form-group">
                    <label for="exampleInputLieu">Jour Pris</label>
                    <input type="number" class="form-control" id="exampleInputLieu" placeholder="tekanDay" name="tekanDay"  value="{{$conge->tekanDay}}">
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