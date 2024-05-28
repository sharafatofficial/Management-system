<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ strtoupper(Auth::user()->name) }} | Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('css/admin.css')}}" />
    <!-- <>====== fontawesome cdn ======<> -->
   <link rel="stylesheet"href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> -->
    <style>
        table {
            min-width: 600px !important;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="navbar-side">
            <h6>
                <!-- <span class="icon"><i class="fas fa-code"></i></span> -->
                <img src="assets/images/logo.png" alt="" width="0px"> <i>SIS</i> 
                <span class="link-text"><small>STEPINSOLUTION</small></span>
            </h6>
            <ul>
                @include('employee.menu')
            </ul>
        </div>
        <div class="content">
            <nav class="navbar navbar-dark bg-dark py-1">
                <!-- <div class="d-flex justify-content-baseline"> -->
                <a href="javascript:" id="navBtn">
                    <span id="changeIcon" class="fa fa-bars text-light"></span>
                </a>
                <h5 class="text-white"> Employee Panel ({{ Auth::user()->name }}) </h5>
                <!-- </div> -->

                <div class="d-flex">
                    <!-- <a class="nav-link text-light px-2" href="#"><i class="fas fa-search"></i></a> -->
                    <a class="nav-link text-light px-2" href="#"><i class="fas fa-bell"></i></a>
                    <a class="nav-link text-light px-2" href="{{url('/logout')}}"><i class="fas fa-sign-out-alt"></i></a>
                </div>

            </nav>
            <div class="container-fluid"  style="min-height: 92vh; background: #d9d4c7;">
                @yield('content')
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="script.js"></script>
        <script src="https://cdn.tiny.cloud/1/40hwrxqtxiltawg4b1pxoinz9c9xpi3stcq6dosz0d2l55oo/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            $(document).ready(function () {
                $("#navBtn").click(function () {
                    $(".main").toggleClass('animate');
                });
            });
            
        </script>
        @stack('scripts')
</body>

</html>