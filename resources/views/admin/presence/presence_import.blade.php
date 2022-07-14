@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
<div class="container-fluid ">
<div class="row justify-content-center ">
<div class="col-md-10" >
            <!-- general form elements -->
            <div class="card card-">
              <div class="card-header">
                <h3 class="card-title">Impoter </h3>
                @if($message = Session::get('success'))
		<div class="alert bg-info alert-dismissible fade in" role="alert">
	      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">×</span>
	      </button>
	      <strong>Success!</strong> {{ $message }}
	    </div>
	@endif

                <!-- @if($errors)
                {{$errors}}
                @endif -->
              </div>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('presence.import_store')}}"  enctype="multipart/form-data">

              @csrf
              <div class="card-body">
              <div class="form-group">
                    <label for="exampleInputNom">Importer </label>
                    <input type="file" class="form-control" id="exampleInputNom" placeholder="Importer" name="presence_import">
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