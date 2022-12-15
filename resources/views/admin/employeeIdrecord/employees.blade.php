
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
                    <th>type </th>
                    <th>idnumber</th>
                    <th>issuanceDate</th>
                    <th>expirationDate</th>
                    <th>countryOfInsuance</th>
                    <th>Voir Plus</th>
                    <th>Editer</th>
                    <th>Suprimer</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                 
                  @foreach ($employees as $employeeidrecord) 
                    <tr>
                      <td>{{$employeeidrecord->name}}</td>
                      <td>{{$employeeidrecord->function }}</td>
                      <td>{{$employeeidrecord->table_name}}</td>
                      <td class="text-end">
                        <a class="btn btn-secondary" href="{{ route('employeeidrecord.show',['employeeidrecord'=>$employeeidrecord->uuid])}}">Voir</a>
                      </td>
                      <td class="text-end">
                        <a class="btn btn-secondary" href="{{ route('employeeidrecord.edit',['employeeidrecord'=>$employeeidrecord->uuid])}}">Editer</a>
                      </td>
                      <td>
                        <form style="display: inline-block;" action="{{ route('employeeidrecord.destroy', ['employeeidrecord'=>$employeeidrecord->uuid])}}" method="post"> 
                          @csrf 
                          @method('delete')
                          <button class="btn btn-danger" type="submit">Suprimer</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                    <a href="{{route('employeeidrecord.create')}}">Ajouter</a>
                    
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