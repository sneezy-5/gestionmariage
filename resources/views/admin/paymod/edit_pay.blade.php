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
              <form method="post" action="{{route('paymod.update',['paymod'=>$paymod->id])}}"  enctype="multipart/form-data">

              @csrf
              @method('put')
                <div class="card-body">
                <div class="form-group  ">
                        <select class="form-select w-100 text-center bg-info" name="employee_uuid">
                        
                            <option value="{{$employe->id}}">{{$employe->firstName}}</option>
                          
                        </select>
                  </div>
                
                  <div class="form-group">
                    <label for="exampleInputPrenom">Banque</label>
                    <input type="text" class="form-control" id="exampleInputPrenom" placeholder="bank_name", name="bank_name" value="{{$paymod->bank_name}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">Numéro de carte</label>
                    <input type="number" class="form-control" id="exampleInputDate" placeholder="carte_num" name="carte_num" value="{{$paymod->carte_num}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">Mode de pay</label>
                    <input type="text" class="form-control" id="exampleInputDate" placeholder="mode de pay" name="pay_method" value="{{$paymod->pay_method}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDate">Mode de pay préférentielle</label>
                    <input type="text" class="form-control" id="exampleInputDate" placeholder="preferential_paymentMethod" name="preferential_paymentMethod" value="{{$paymod->preferential_paymentMethod}}">
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