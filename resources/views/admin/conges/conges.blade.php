
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
                  <th>id</th>
                    <th>Employé</th>
                    <th>Poste</th>
                    <th>Jours restant </th>
                    <th>Congés acquis </th>
                    <th>Congés pris </th>
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
                    <td>{{$conge['poste']}}</td>
                      <td>{{$conge['restant']}}</td>
                      <td>{{$conge['cumulativeDay']}}</td>
                      <td>{{$conge['tekanDay']}}</td>
                      <td class="text-end">
                        <a class="btn btn-secondary" href="{{ route('conge.show',['conge'=>$conge['id']])}}">Voir</a>
                    
                        <a class="btn btn-secondary" href="{{ route('conge.edit',['conge'=>$conge['id']])}}">Editer</a>
                     
                        <form style="display: inline-block;" action="{{ route('conge.destroy', ['conge'=>$conge['id']])}}" method="post"> 
                          @csrf 
                          @method('delete')
                          <button class="btn btn-danger" type="submit">Suprimer</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                
                    <div class="col-6">
                    <a class="btn bg-primary" href="{{route('conge.create')}}">Ajouter </a>
                    
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