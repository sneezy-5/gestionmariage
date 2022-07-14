
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
                    <th>Date de la demande</th>
                    <th>Montant demande</th>
                    <th>Date de paiement </th>
                    <th>Date de remboursement </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                 
                  @foreach ($data as $payday) 
                    <tr>
                    <td>{{$payday['id'] }}</td>
                    <td>
                      <p>Nom: {{$payday['firstName']}}</p>
                      <p>Prénom: {{$payday['lastName']}}</p>
                      <p>Matricule: {{$payday['matricule']}}</p>
                    </td>
                      <td>{{$payday['RequestDate']}}</td>
                      <td>{{$payday['amountRequested']}}</td>
                      <td>{{$payday['paymentDate']}}</td>
                      <td> {{$payday['ReimbursmentDate']}}</td>
                      <td class="text-end">
                        <a class="btn btn-secondary" href="{{ route('payday.show',['payday'=>$payday['id']])}}">Voir</a>
                     
        
                        <a class="btn btn-secondary" href="{{ route('payday.edit',['payday'=>$payday['id']])}}">Editer</a>
                     
                        <form style="display: inline-block;" action="{{ route('payday.destroy', ['payday'=>$payday['id']])}}" method="post"> 
                          @csrf 
                          @method('delete')
                          <button class="btn btn-danger" type="submit">Suprimer</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                    <div class="col-6">
                    <a class="btn bg-primary" href="{{route('payday.create')}}">Ajouter </a>
                    <a class="btn bg-info" href="{{route('payday.import')}}">Importer</a>
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