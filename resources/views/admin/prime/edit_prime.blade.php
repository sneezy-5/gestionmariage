@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
<div class="container-fluid ">
<div class="row justify-content-center ">
<div class="col-md-10" >
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ajouter Prime</h3>
                @if($errors)
                {{$errors}}
                @endif
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('prime.update',['prime'=>$prime->uuid])}}"  enctype="multipart/form-data">

              @csrf
              @method('put')
                <div class="card-body">
           
                
                  <div class="form-group">
                    <label for="exampleInputPrenom">Nom</label>
                    <input type="text" class="form-control" id="exampleInputPrenom" placeholder="Nom", name="title" value="{{$prime->title}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">Code</label>
                    <input type="text" class="form-control" id="exampleInputDate" placeholder="code" name="code" value="{{$prime->code}}">
                  </div>
  

                  <div class="form-group">
                    <label for="exampleInputLieu">Montant</label>
                    <input type="text" class="form-control" id="exampleInputLieu" placeholder="Montant" name="amount" value="{{$prime->amount}}">
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