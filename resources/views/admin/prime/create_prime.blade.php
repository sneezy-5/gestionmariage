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
              <form method="post" action="{{route('prime.store')}}"  enctype="multipart/form-data">

              @csrf
                <div class="card-body">
           
                
                  <div class="form-group">
                    <label for="exampleInputPrenom">Titre</label>
                    <input type="text" class="form-control" id="exampleInputPrenom" placeholder="title", name="title">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">Montant</label>
                    <input type="number" class="form-control" id="exampleInputDate" placeholder="amount" name="amount">
                  </div>
  

                  <div class="form-group">
                    <label for="exampleInputLieu">Code</label>
                    <input type="text" class="form-control" id="exampleInputLieu" placeholder="code" name="code">
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