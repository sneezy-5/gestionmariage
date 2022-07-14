
@extends('layouts.admin')

@section('content')

<div class="content-wrapper">


    <!-- Content Header (Page header) -->
 

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
        <!-- /.row -->

        <!-- =========================================================== -->
  

        <!-- =========================================================== -->
     

        <!-- =========================================================== -->
 
        <!-- /.row -->

        <!-- =========================================================== -->

        <!-- Small Box (Stat card) -->
        <h5 class="mb-2 mt-4"></h5>
        <!--<div class="col6">
                  
                    <div class="input-group justify-content-center">
                                <input class=" border-end-0 border rounded-pill start_date" type="date" id="example-search-input" name="start_date"  value="">
                                <input class=" border-end-0 border rounded-pill end_date" type="date" id="example-search-input" name="end_date"  value="">
                                <span class="input-group-append"> -->
                                    <!-- <button  class="btn bg-info rounded-pill search_filter">
                                         <i class="fa fa-search"></i> 
                                        
                                    </button>
                                </span>
                    </div>-->
                  
    </div>
    
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$employes}}</h3>

                <p>Employés</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="{{route('employee.index')}}" class="small-box-footer">
                Plus d'info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$congesH}}<sup style="font-size: 20px"></sup></h3>

                <p>Congé en cours </p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$contract}}</h3>

                <p>Contrats</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$presences}}</h3>

                <p>Fiches de Présences</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          
          <div class="container-fluid">
       
       <!-- /.row -->

       <!-- =========================================================== -->
 

       <!-- =========================================================== -->
    

       <!-- =========================================================== -->

       <!-- /.row -->

       <!-- =========================================================== -->

       <!-- Small Box (Stat card) -->
   
       <h5 class="mb-3 mt-4 text-center">Cumuls Paie</h5>
       <div class="col6">
                 
                   <div class="input-group justify-content-center">
                               <input class=" border-end-0 border rounded-pill start_date" type="date" id="example-search-input" name="start_date"  value="">
                               <input class=" border-end-0 border rounded-pill end_date" type="date" id="example-search-input" name="end_date"  value="">
                               <span class="input-group-append">
                                   <button  class="btn bg-info rounded-pill search_filter">
                                        <i class="fa fa-search"></i> 
                                       
                                   </button>
                               </span>
                   </div>
</div>
<div class="row mt-4 justify-content-around">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 class="net">0</h3>

                <p>NET A PAYER</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 class="its">0</h3>

                <p>ITS TOTAL</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
</div>


          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 class="cnps">0</h3>

                <p>CNPS TOTAL</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 class="fdfp">0</h3>

                <p >FDFP TOTAL</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 class="total">0</h3>

                <p >TOTAL DES CUMULS</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
      </div>
        
        <!-- =========================================================== -->
        <!-- <h4 class="mb-2 mt-4">Cards</h4>
        <h5 class="mb-2">Abilities</h5> -->

  </div>
  </div>



  <script>

var btn = document.querySelector('.search_filter');
var start_date = document.querySelector('.start_date');
  var end_date = document.querySelector('.end_date');
btn.addEventListener('click',(event)=>{
 
  //alert(start_date.value);
  filtersearch(start_date.value,end_date.value);
},true);


function filtersearch(start_date,end_date){

			payload = {
				
				"start_date": start_date,
        "end_date": end_date
			}

			$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '<?php echo csrf_token(); ?>'
    }
});
			
			$.ajax({
				type: 'POST',
				dataType: "json",
				url: "{{ route('posts.filter') }}", // production
				data: payload,
				timeout: 5000,
				success: function(data) {

					console.log("SUCCESS", data.response);

					document.querySelector('.cnps').textContent=data.response.CNPStot;
          document.querySelector('.fdfp').textContent=data.response.fdfp;
          document.querySelector('.its').textContent=data.response.ITS;
          document.querySelector('.net').textContent=data.response.net;
          document.querySelector('.total').textContent=data.response.total;
					
				},
				error: function(data) {
					console.error("ERROR...", data)
					alert("Something went wrong.")
				},
			});
			}

  </script>
  @endsection