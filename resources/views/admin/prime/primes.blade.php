  
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
                    <th>Code</th>
                    <th>Tritre</th>
                    <th>Montant</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                 
                  @foreach ($primes as $prime) 
                    <tr>
                      <td>{{$prime->code}}</td>
                      <td>{{$prime->title}}</td>
                      <td> {{$prime->amount}}</td>
                      <td class="text-end">
                        <a class="btn btn-secondary" href="{{ route('prime.show',['prime'=>$prime->uuid])}}">Voir</a>
      
                        <a class="btn btn-secondary" href="{{ route('prime.edit',['prime'=>$prime->uuid])}}">Editer</a>
              
                        <form style="display: inline-block;" action="{{ route('prime.destroy', ['prime'=>$prime->uuid])}}" method="post"> 
                          @csrf 
                          @method('delete')
                          <button class="btn btn-danger" type="submit">Suprimer</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                    <div class="col">
                      <a class="btn btn-primary" href="{{route('prime.create')}}">Ajouter</a>
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