<?php
$cartbooks = \Cart::getContent();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Buy BOOK</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Core theme CSS (includes Bootstrap)-->

    <link href="{{ asset('storage/css/styles.css') }}" rel="stylesheet" />
    @yield('styles')


    <style>

.blink {
  animation: blink 6s infinite;
}

@keyframes blink {
  0% {
    opacity: 9;
  }
  50% {
    opacity: 0;
    transform: scale(1);
  }
  51% {
    opacity: 0;
    transform: scale(0);
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

html {
  position: relative;
  min-height: 100%;
}
body {
  margin-bottom: 0px; /* Margin bottom by footer height */
}
.footer {
  position: absolute;
  bottom: -12%;
  width: 100%;
  height: 60px; /* Set the fixed height of the footer here */
  line-height: 60px; /* Vertically center the text there */
}

/* resources/css/app.css or a separate CSS file */
.loader {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8);
    text-align: center;
    z-index: 9999;
}

.loading-spinner {
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-top: 4px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    margin: 0 auto 20px;
    animation: spin 2s linear infinite;
}

.loading-message {
    margin-top: 30px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.completed {
  color: green;
}

.incomplete {
  color: red;
}

.pending {
  color: orange;
}



    </style>
</head>

<body style="background-color: rgb(222, 230, 230)">
    <!-- Navigation-->
    <div style="height:120%; background-color:rgba(199, 230, 216, 0.274)">
        <div class=" container ">
            <i class="fa fa-envelope" aria-hidden="true">&nbsp;KIMATHIGEORGE@gmail.com</i> &nbsp;&nbsp;
            <i class="fa fa-phone" aria-hidden="true">&nbsp;0721589890</i> &nbsp;
            <span> Mpesa&nbsp;Till:12345 </i> </span>
        </div>
    </div>

<div>
    <nav class=" containerx navbar navbar-expand-lg navbar-dark bg-successx mt-2" style="background-color: rgb(21, 181, 90);text-transform:uppercase">
        <div class="container px-4 px-lg-5">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 ">
                    <li class="nav-item"><a class="nav-link active " aria-current="page" href="/">Home</a></li>
                    {{-- <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Recently
                            added</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('itemCategory', 4)}}">Schemes of
                            work</a></li> --}}





                            @if($check==2)
                            @foreach($bookss as $category)
                            <li class="nav-item"><a class="nav-link active"   href="{{route('itemCategory', $category->category_id  )}}">{{ $category->categories->name }}</a>
                            </li>

                        @endforeach
                              @else
                              @foreach($bookss1 as $category1)
                            <li class="nav-item"><a class="nav-link active"   href="{{route('itemCategory', $category1->category_id  )}}">{{ $category1->categories->name }}</a></li>
                        @endforeach
                        @endif


                  {{--
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" style="color:white ">Lesson plans</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/">Termly lesson plans</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li><a class="dropdown-item" href="/">General lesson plans</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                        </ul>
                    </li> --}}



                </ul>

            </div>

        </div>

    </nav>

</div>

    <!-- Header-->
    @yield('content')

    <!-- Footer-->
    <footer class="footer mt-auto py-3 bg-dark">
        <div class="container">
            <span class="m-0 text-block text-white">Copyright &copy; 2023:</span>
            <a href="/admin" class="text-end" style="text-decoration: none">ELIBRARY </a>
        </div>

      </footer>



    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('storage/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('myForm');
    const loader = document.getElementById('loader');

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission
        showLoader();
        submitForm();
    });

    function showLoader() {
        loader.style.display = 'block';
    }

    function hideLoader() {
        loader.style.display = 'none';
    }

    function submitForm() {
        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();
        xhr.open('POST', form.getAttribute('action'), true);
        xhr.onload = function () {
          if (xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);

        if (response.message) {
            // Display a success message, e.g., using an alert
           // alert(response.message);

            swal("SUCCESS!!", response.message  ,'success',{
                 button:true,
                 button:"OK",
                 timer:20000,
                 dangerMode:true,

            }).then(function () {

                        // Redirect to a new page after the SweetAlert is closed
                        window.location.href = 'http://127.0.0.1:8000'; // Replace with your desired URL
                    });

        }
        if (response.error) {
            // Display a success message, e.g., using an alert
           // alert(response.message);

            swal("ERROR!", response.error  ,'error',{
                 button:true,
                 button:"OK",
                 timer:8000,
                 dangerMode:true,

            });

        }

        if (response.data) {
            // Update the page with data from the response
            const dataElement = document.getElementById('data-container');
            dataElement.textContent = `Data: ${response.data.key}`;
        }
    }
            hideLoader(); // Hide the loader after form submission is complete
        };
        xhr.send(formData);
    }
});


</script>

</body>

</html>
