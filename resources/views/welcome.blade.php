<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="colorlib.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <script src="{{asset('bootstrap/js/jquery-3.6.0.js')}}"></script>
	<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <link href="../css/main.css" rel="stylesheet" />
  </head>

  <body>

    <div class="s003">
    <form action="{{route('guest.search')}}" method="POST" id="searchForm" >

    @csrf
        <div class="inner-form">

          <div class="input-field second-wrap">
            <input id="search" type="text" placeholder="Entrer votre nom" name="search" class="search" />
          </div>
          <div class="input-field third-wrap">
            <button  type="submit" class="search-btn btn-search">
              <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
              </svg>
            </button>
          </div>

        </div>
      </form>
    </div>

    <div class="container  d-flex  align-items-center justify-content-center">
    <div class=" center-content">

    </div>
    </div>

    <script src="../js/extention/choices.js"></script>
    <script>
      const choices = new Choices('[data-trigger]',
      {
        searchEnabled: false,
        itemSelectText: '',
      });

    </script>


  </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>


<script>
    var searchfilter = document.querySelector('.search');
    var searchbtn = document.querySelector('.search-btn');
    var form = document.getElementById('searchForm');

    searchbtn.addEventListener('click', function (event) {
      event.preventDefault();
      var formData = new FormData(form);
      filterSearch(formData.get('search'));
   }, true);

    searchfilter.addEventListener('input', function (event) {
      event.preventDefault();
      var formData = new FormData(form);
      filterSearch(formData.get('search'));
   }, true);

   function filterSearch(searchTerm, domaine, entreprise) {
      var payload = {
        "search": searchTerm,
      }

      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': '<?php echo csrf_token(); ?>'
         }
      });

      $.ajax({
         type: 'POST',
         dataType: "json",
         url: "{{ route('guest.search') }}",
         data: payload,
         timeout: 5000,
         success: function (data) {
            console.log("SUCCESS", data.response);

            // Update the content based on the AJAX response
            var contentContainer = document.querySelector('.center-content');
            contentContainer.innerHTML = '';

            if (data.response.length > 0) {
               data.response.forEach(function (fourni) {
                  var newDiv = document.createElement('div');
                  newDiv.className = 'text-white';
                  newDiv.style.backgroundColor = '#C69774'; // Adjust background color as needed
                  newDiv.style.borderRadius = '10px';
                  newDiv.style.padding = '20px';
                  newDiv.style.marginBottom = '20px';

                  newDiv.innerHTML = `
                     <h4 class="text-primary">Nom:</h4>
                     <p class="p-3 mb-2 text-white">${fourni.name}</p>
                     <h4 class="text-primary">Fonction:</h4>
                     <p class="p-3 mb-2 text-white">${fourni.function}</p>
                     <h4 class="text-primary">Table:</h4>
                     <p class="p-3 mb-2 text-white">${fourni.table_name}</p>
                  `;

                  contentContainer.appendChild(newDiv);
               });
            } else {
               contentContainer.innerHTML = '<p>Aucun résultat trouvé</p>';
            }
         },
         error: function (data) {
            console.error("ERROR...", data)
            alert("Something went wrong.")
         },
         error: function (jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error:", textStatus, errorThrown);
         },
      });
   }
</script>

