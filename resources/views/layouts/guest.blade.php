<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- fav-icon --}}
    <link rel="shortcut icon" href="{{ asset('storage/images/carlyti-logo.png') }} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            /* background-color: #d3d3d3 !important; */
            background-color: #f0f0f0 !important;
            /* font-family: cursive !important; */
            font-family: sans-serif !important;
        }

        .logo-login {
            width: 200px;
            height: 200px;
            margin: auto;
        }

        .logo-login img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }

        .cstm-width-form {
            width: 70%;
            margin: auto;
        }

        .card {
            border: none !important;
            border-radius: 12px !important;
            background-image: linear-gradient(to bottom right, rgba(255, 0, 0, 0), rgb(219 219 219)) !important;
            box-shadow: 0px 0px 10px 0px #57575738 !important;
        }

        .form-control:focus {
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            border: var(--bs-border-width) solid var(--bs-border-color) !important;
            outline: 0;
            box-shadow: none !important;
        }

        .btn-primary {
            color: #fff;
            background-color: #ae0814 !important;
            border-color: #ae0814 !important;
            padding-left: 24px !important;
            padding-right: 24px !important;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: transparent !important;
            background-image: linear-gradient(to bottom right, rgb(60 60 60), rgb(0 0 0)) !important;
            border-color: #000 !important;
        }

        .login-image {
            width: 100%;
            height: 100vh;
            background-image: linear-gradient(to bottom right, rgb(48 48 48), rgb(0 0 0)) !important;
        }

        .login-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .create-text {
            color: #6c757d;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
        }

        .create-text:hover {
            text-decoration: underline;
        }

        label {
            color: #6c757d;
        }

        input {
            background-color: #ffffff33 !important;
            outline: none !important;
        }
    </style>


    <title>{{ config('app.name', 'Toyota') }}</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body class="font-sans text-gray-900">
    <div class="min-vh-100">
        <div class="row w-100 align-items-center">
            <div class="col-lg-6">
                <div class="login-image">
                    <img src="{{ asset('storage/images/login-img.png') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <a href="/">
                    <div class="logo-login">
                        <img src="{{ asset('storage/images/carlyti-logo.png') }}" class="text-gray-500"
                            alt="Application Logo">
                    </div>
                </a>
                <div class="cstm-width-form">
                    <div class="card mt-3">
                        <div class="card-body">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <!-- Bootstrap JS and dependencies CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>