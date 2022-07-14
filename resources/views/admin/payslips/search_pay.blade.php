 
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

    <div class="col6">
    <form action="{{route('payslip.search')}}" method="get" >
                    <div class="input-group justify-content-center">
                                <input class=" border-end-0 border rounded-pill" type="date" id="example-search-input">
                                <input class=" border-end-0 border rounded-pill" type="date" id="example-search-input">
                                <span class="input-group-append">
                                    <button  type="submit" class="btn bg-info rounded-pill">
                                         <i class="fa fa-search"></i> 
                                        
                                    </button>
                                </span>
                    </div>
            </form>
            
    </div>
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
                    <th>Période</th>
                    <th>Net à Payer</th>
                    <th>Méthode de Payement</th>
                    
                    <th>Date de création</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                 
                  @foreach ($data as $payslip) 
                    <tr>
                    <td>{{$payslip['uuid']}}</td>
                    <td>
                      
                      <p>Nom:{{$payslip['firstName']}}</p>
                      <p>Prénom:{{$payslip['lastName']}}</p>
                      <p>Matricule:{{$payslip['matricule']}}</p>
                    </td>

                    <td>
                        <p>Debut: {{$payslip['paymentDate'] }}</p>
                     
                    </td>

                      <td>{{$payslip['paymentMethod']}}</td>
                      <td> {{$payslip['netToPay']}}</td>
                      <td> {{$payslip['paymentDate'] }}</td>
                      <td> {{$payslip['created_at'] }}</td>
                      <td class="text-end">
                        <a class="btn btn-secondary" href="{{ route('payslip.show',['payslip'=>$payslip['uuid']])}}">Voir</a>
                      

                        <a class="btn btn-secondary" href="{{ route('payslip.edit',['payslip'=>$payslip['uuid']])}}">Editer</a>
                      
                      
                        <form style="display: inline-block;" action="{{ route('payslip.destroy', ['payslip'=>$payslip['uuid']])}}" method="post"> 
                          @csrf 
                          @method('delete')
                          <button class="btn btn-danger" type="submit">Suprimer</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                    <!-- <div class="col-6">
                    <a class="btn bg-primary" href="{{route('payslip.create')}}">Ajouter</a>
                    <a  class="btn bg-info" href="{{route('payslip.fileter_view')}}">générer</a>
                    
                    </div> -->
                
                    
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