@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
<div class="container-fluid ">
<div class="row justify-content-center ">
          <div class="col-md-3">

            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
              <div class="col-6">
              <a class="btn btn-secondary" href="{{ route('prime.edit',['prime'=>$prime->uuid])}}">Editer</a>
              
              <form style="display: inline-block;" action="{{ route('prime.destroy', ['prime'=>$prime->uuid])}}" method="post"> 
                @csrf 
                @method('delete')
                <button class="btn btn-danger" type="submit">Suprimer</button>
              </form>
              </div>
              <div class="card-body">
                <div class="tab-content">
                 
                

                  <div class="tab-pane active" id="settings">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Code</label>
                        <div class="col-sm-10">
                          <p>{{$prime->code}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
                        <div class="col-sm-10">
                          <p>{{$prime->title}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Montant</label>
                        <div class="col-sm-10">
                          <p>{{$prime->amount}}</p>
                        </div>
                      </div>
                     
                      </div>
                     
                 
                
                      
                  </div>
                  
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
    </div>
    </div>
          
@endsection