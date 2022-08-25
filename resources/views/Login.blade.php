<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="{{ url('backend/css/styles.css')}}" rel="stylesheet" />
    <!-- <script src="js/highcharts.js"></script> -->
  <!-- <script src="https://code.highcharts.com/highcharts-more.js"></script> -->
</head>
<style>
    .input-login {
        position: relative;
    }

    input {
        display: block;
        padding: 10px;
        border: none;
        outline: none;
        border-radius: 4px;
        font: inherit;
    }

    label {
        position: absolute;
        top: -30px;
        left: -26px;
        display: inline-flex;
        column-gap: 10px;
        align-items: center;
        transition: transform 0.25s, opacity 0.25s;
    }

    .icon {
        display: inline-flex;
        opacity: 0;
    }

    input:focus+label {
        transform: translateX(26px);
    }

    input:focus+label .icon {
        opacity: 1;
        transition-delay: 0.1s;
    }

    input::placeholder {
        transition: opacity 0.25s;
    }

    input:focus::placeholder {
        opacity: 0;
    }
</style>

<body>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center ">
            <div class="col-md-4 ">
                <div class="card border-0 rounded shadow  ">
                    <div class="card-body">
                        <h4 style="text-align:center; color:#0dcaf0; ">LOGIN</h4>
                        <hr>
                        <form method="post" action="{{url('/api/login')}}">
                            @csrf
                            <div class="input-login mt-5">
                                <input type="email" class="form-control" placeholder="Email Address" id="email" name="email">
                                <label for="email">
                                    <span class="icon"><i class="bi bi-envelope"></i></span>
                                    Email address
                                </label>
                            </div>

                            <div class="input-login mt-5 pb-3">
                                <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                                <label for="password">
                                    <span class="icon"><i class="bi bi-key-fill"></i></span>
                                    Password</label>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-outline-info" style="width: 400px;"> LOGIN </button>
                                {{-- <a href="/home" type="submit" class="btn btn-outline-info" style="width: 400px;">LOGIN</a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="{{ asset('backend/js/scripts.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <!-- <script src="{{ asset('backend/js/datatables-simple-demo.js')}}"></script> -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
    <!-- <script src="{{ asset('backend/assets/demo/chart-area-demo.js')}}"></script>
    <script src="{{ asset('backend/assets/demo/chart-bar-demo.js')}}"></script> -->
</body>

</html>
