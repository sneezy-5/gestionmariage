
@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Employé</th>
                    <th>Méthode préférentielle</th>
                    <th>banque</th>
                    <th>numéro de compte</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                 
                  @foreach ($data as $paymod) 
                    <tr>
                    <td>{{$paymod['id']}}</td>
                    <td>
                      
                      <p>Nom: {{$paymod['firstName']}}</p>
                      <p>Prénom: {{$paymod['lastName']}}</p>
                      <p>Matricule: {{$paymod['matricule']}}</p>
                    </td>
                      <td>{{$paymod['bank_name']}}</td>
                      <td>{{$paymod['carte_num']}}</td>
                      <td>{{$paymod['pay_method']}}</td>
                      <td class="text-end">
                        <a class="btn btn-secondary" href="{{ route('paymod.show',['paymod'=>$paymod['id']])}}">Voir</a>
                   
                        <a class="btn btn-secondary" href="{{ route('paymod.edit',['paymod'=>$paymod['id']])}}">Editer</a>
                      
                        <form style="display: inline-block;" action="{{ route('paymod.destroy', ['paymod'=>$paymod['id']])}}" method="post"> 
                          @csrf 
                          @method('delete')
                          <button class="btn btn-danger" type="submit">Suprimer</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                
                    <div class="col-6">
                    <a class="btn bg-primary" href="{{route('paymod.create')}}">Ajouter </a>
                    </div>
                  </tbody>
                 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
      
    </section>
    
</div>

@endsection