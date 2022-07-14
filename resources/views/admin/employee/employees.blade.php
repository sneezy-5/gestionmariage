
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
                  <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Poste</th>
                    <th>Ancienneté</th>
                    <th>Nationalité</th>

                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                 
                  @foreach ($employes as $employe) 
                    <tr>
                    <td>{{$employe->id}}</td>
                    <td>{{$employe->matricule}}</td>
                      <td>{{$employe->firstName}}</td>
                      <td>{{$employe->lastName}}</td>
                      <td>{{$employe->currentPosition}}</td>
                      <td> {{$employe->seniority}}</td>
                      <td> {{$employe->nationality}}</td>
                      <td class="text-end">
                      <a class="btn btn-secondary" href="{{ route('pays.pay',['payslip'=>$employe->id])}}">PaySlip</a>
                        <a class="btn btn-secondary" href="{{ route('employee.show',['employee'=>$employe->id])}}">Voir</a>
                   
                     
                        <a class="btn btn-secondary" href="{{ route('employee.edit',['employee'=>$employe->id])}}">Editer</a>
                     
                      
                        <form style="display: inline-block;" action="{{ route('employee.destroy', ['employee'=>$employe->id])}}" method="post"> 
                          @csrf 
                          @method('delete')
                          <button class="btn btn-danger" type="submit">Suprimer</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                    <div class="col-6">
                    <a class="btn bg-primary" href="{{route('employee.create')}}">Ajouter Employé</a>
                    <a class="btn bg-info" href="{{route('employe.import')}}">Importer</a>
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