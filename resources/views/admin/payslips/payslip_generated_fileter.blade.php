@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
<div class="container-fluid ">
<div class="row justify-content-center ">
<div class="col-md-10" >
            <!-- general form elements -->
            <div class="card card-">
              <div class="card-header">
                <h3 class="card-title"> Générer bulletin</h3>
                
           
            
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
              <div class="row justify-content-center">
              <form action="{{route('payslip.filter')}}" method="get" >
                    <div class="input-group">
                                <input class="form-control border-end-0 border rounded-pill" type="date" id="example-search-input" name="start_date">
                                <input class="form-control border-end-0 border rounded-pill" type="date" id="example-search-input" name="end_date">
                                <span class="input-group-append">
                                    <button  type="submit" class="btn bg-warning rounded-pill">
                                        <!-- <i class="fa fa-search"></i> -->
                                        générer par filtre
                                    </button>
                                    
                                   
                                </span>
                                <span> <a  class="btn bg-info rounded-pill" href="{{route('payslip.filter')}}">Tout générer</a></span>

                                
                    </div>
         
            </form>

            </div>
            
            </div>
            <!-- /.card -->

          

          
        

          </div>
    </div>
    </div>
    </div>
@endsection