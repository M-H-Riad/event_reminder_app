<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('')}}assets/img/favicon.png" rel="icon">
  <link href="{{asset('')}}assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="{{asset('')}}https://fonts.gstatic.com" rel="preconnect">
  <link href="{{asset('')}}https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('')}}assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('')}}assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{asset('')}}assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{asset('')}}assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{asset('')}}assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="{{asset('')}}assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{asset('')}}assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('')}}assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{route('dashboard')}}" class="logo d-flex align-items-center">
        {{-- <img src="assets/img/logo.png" alt=""> --}}
        <span class="d-none d-lg-block">Event Reminder</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-flex align-items-center">
                  @csrf
                  <button type="submit" class="dropdown-item d-flex align-items-center">
                      <i class="bi bi-box-arrow-right"></i>
                      <span>Sign Out</span>
                  </button>
              </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  @include('layouts.sidebar')

  <main id="main" class="main">
    {{-- Show Success and Failure Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="dismissable-alert">
            {{ session('success') }}
        </div>

        <script>
            // Manually dismiss the alert after a certain time
            setTimeout(function() {
                document.getElementById('dismissable-alert').style.display = 'none';
            }, 3000); // Adjust the time as needed (in milliseconds)
        </script>
    @endif

    @if(session('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="dismissable-alert-error">
            {{ session('errors') }}
        </div>

        <script>
            // Manually dismiss the alert after a certain time
            setTimeout(function() {
                document.getElementById('dismissable-alert-error').style.display = 'none';
            }, 3000);
        </script>
    @endif


    
     @yield('content')

  </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('')}}assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="{{asset('')}}assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('')}}assets/vendor/chart.js/chart.umd.js"></script>
  <script src="{{asset('')}}assets/vendor/echarts/echarts.min.js"></script>
  <script src="{{asset('')}}assets/vendor/quill/quill.js"></script>
  <script src="{{asset('')}}assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="{{asset('')}}assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="{{asset('')}}assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('')}}assets/js/main.js"></script>

</body>

</html>