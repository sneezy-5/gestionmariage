
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
                    <th>Date de demande</th>
                    <th>Debut</th>
                    <th>Fin</th>
                    <th>Montant Payé</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                 
                  @foreach ($data as $conge) 
                    <tr>
                    <td>{{$conge['id']}}</td>
                    <td>
                      
                      <p>Nom:{{$conge['firstName']}}</p>
                      <p>Prénom:{{$conge['lastName']}}</p>
                      <p>Matricule:{{$conge['matricule']}}</p>
                    </td>
                      <td>{{$conge['request_date']}}</td>
                      <td>{{$conge['start_date']}}</td>
                      <td>{{$conge['end_date']}}</td>
                      <td> {{$conge['amount']}}</td>
                      <td class="text-end">
                        <a class="btn btn-secondary" href="{{ route('congehistory.show',['congehistory'=>$conge['id']])}}">Voir</a>
                   
                        <a class="btn btn-secondary" href="{{ route('congehistory.edit',['congehistory'=>$conge['id']])}}">Editer</a>
                    
                        <form style="display: inline-block;" action="{{ route('congehistory.destroy',['congehistory'=>$conge['id']])}}" method="post"> 
                          @csrf 
                          @method('delete')
                          <button class="btn btn-danger" type="submit">Suprimer</button>
                        </form>
                        <a class="btn bg-primary" href="{{route('conge.conge',['id'=>$conge['employe_uuid']])}}">c </a>
                      </td>
                    </tr>
                    @endforeach
                
                    <div class="col-6">
                    <a class="btn bg-primary" href="{{route('congehistory.create')}}">Ajouter </a>
                   
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