 
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
                    <th>type de contract</th>
                    <th>position</th>
                    <th>Salaire de base</th>
                    <th>entra paye</th>
                    <th>indemnité de transport</th>
                    <th>Voir Plus</th>
                    <th>Editer</th>
                    <th>Suprimer</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                 
                  @foreach ($companies as $company) 
                    <tr>
                      <td>{{$company->contract_type}}</td>
                      <td>{{$company->position}}</td>
                      <td>{{$company->baseSalary}}</td>
                      <td> {{$company->extrapay}}</td>
                      <td> {{$company->transportationAllowance}}</td>
                      <td class="text-end">
                        <a class="btn btn-secondary" href="{{ route('company.show',['company'=>$company->uuid])}}">Voir</a>
                      </td>
                      <td class="text-end">
                        <a class="btn btn-secondary" href="{{ route('company.edit',['company'=>$company->uuid])}}">Editer</a>
                      </td>
                      <td>
                        <form style="display: inline-block;" action="{{ route('company.destroy', ['company'=>$company->uuid])}}" method="post"> 
                          @csrf 
                          @method('delete')
                          <button class="btn btn-danger" type="submit">Suprimer</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                    <a href="{{route('company.create')}}">Ajouter</a>
                    
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