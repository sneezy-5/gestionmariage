
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
                    <th>Poste</th>
                    <th>type de contract</th>
                    <th>Durée</th>
                    <th>Salaire</th>
                    <th>Primes</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                 
                  @foreach ($data as $contract) 
                    <tr>
                    <td>{{$contract['id']}}</td>
                    <td>
                      <p>Nom: {{$contract['firstName']}}</p>
                      <p>Prénom: {{$contract['lastName']}}</p>
                      <p>Matricule: {{$contract['matricule']}}</p>
                    </td>
                    <td>{{$contract['poste']}}</td>
                      <td>{{$contract['contract_type']}}</td>
                      
                      <td>
                        <p>debut: {{$contract['startDate']}}</p>
                       
                        <p>fin: {{$contract['endDate']}}</p>
                      </td>
                      <td>
                        <p>salaire: {{$contract['baseSalary']}}</p> 
                         <p>sursalaire: {{$contract['extrapay']}}</p>
                      </td>
                      
                      <td>
                        <p>nom: {{$contract['title']}}</p> 
                         <p>code: {{$contract['code']}}</p>
                         
                      </td>
                       <td class="text-end">
                        <a class="btn btn-secondary" href="{{ route('contract.show',['contract'=>$contract['id']])}}">Voir</a>
                     
                        <a class="btn btn-secondary" href="{{ route('contract.edit',['contract'=>$contract['id']])}}">Editer</a>
       
                        <form style="display: inline-block;" action="{{ route('contract.destroy', ['contract'=>$contract['id']])}}" method="post"> 
                          @csrf 
                          @method('delete')
                          <button class="btn btn-danger" type="submit">Suprimer</button>
                        </form>
                      </td> 
                    </tr>
                    @endforeach
                
                    <div class="col-6">
                    <a class="btn bg-primary" href="{{route('contract.create')}}">Ajouter </a>
                    <a class="btn bg-info" href="{{route('contract.import')}}">Importer</a>
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