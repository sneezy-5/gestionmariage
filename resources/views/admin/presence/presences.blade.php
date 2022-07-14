 
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
                    <th>Periode</th>
                    <th>Absences</th>
                    <th>Presences</th>
                    <th>Retards</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                 
                  @foreach ($data as $presence) 
                    <tr>
                    <td>{{$presence['id'] }}</td>
                    <td>
                      <p>Nom: {{$presence['firstName']}}</p>
                      <p>Prénom: {{$presence['lastName']}}</p>
                      <p>Matricule: {{$presence['matricule']}}</p>
                    </td>
                      <td>
                        <p>Debut: {{$presence['periodStart'] }}</p>
                        <p>fin: {{$presence['periodEnd'] }}</p>
                      </td>
                      <td>{{$presence['absentdays']}}</td>
                      <td> {{$presence['presentdays']}}</td>
                      <td> {{$presence['delays']}}</td>
                      <td class="text-end">
                        <a class="btn btn-secondary" href="{{ route('presence.show',['presence'=>$presence['id']])}}">Voir</a>
                      
                        <a class="btn btn-secondary" href="{{ route('presence.edit',['presence'=>$presence['id']])}}">Editer</a>
                    
                        <form style="display: inline-block;" action="{{ route('presence.destroy', ['presence'=>$presence['id']])}}" method="post"> 
                          @csrf 
                          @method('delete')
                          <button class="btn btn-danger" type="submit">Suprimer</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                    <div class="col-6">
                    <a class="btn bg-primary" href="{{route('presence.create')}}">Ajouter </a>
                    <a class="btn bg-info" href="{{route('presence.import')}}">Importer</a>
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