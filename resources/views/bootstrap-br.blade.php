<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="{{ url('backend/css/styles.css')}}" rel="stylesheet" />
    <!-- <script src="js/highcharts.js"></script> -->
  <!-- <script src="https://code.highcharts.com/highcharts-more.js"></script> -->
</head>

<body class="sb-nav-fixed">
    <!-- #app untuk merender vue -->
    <div id="app">
        <app-component></app-component>
        <!-- <router-view @update-back-link="handleBackLinkUpdate"></router-view> -->
    </div>






    <script src="{{ asset('backend/js/scripts.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <!-- <script src="{{ asset('backend/js/datatables-simple-demo.js')}}"></script> -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
    <!-- <script src="{{ asset('backend/assets/demo/chart-area-demo.js')}}"></script>
    <script src="{{ asset('backend/assets/demo/chart-bar-demo.js')}}"></script> -->
</body>

</html>