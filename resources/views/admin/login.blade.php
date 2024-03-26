<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <link href="{{ asset('admin/dist/images/logo.svg') }}" rel="shortcut icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{-- <meta name="description" content="Rubick admin is super flexible, powerful, clean & modern responsive bootstrap admin template with unlimited possibilities." />
    <meta name="keywords" content="admin template, Rubick Admin Template, dashboard template, flat admin template, responsive admin template, web app" />
    <meta name="author" content="LEFT4CODE" /> --}}
    <title>{{ config('app.name') }} || Login</title>
    <link rel="stylesheet" href="{{ asset('admin/dist/css/app.css') }}" />
</head>

<body class="login">
    <div class="container px-sm-10">
        <div class="grid columns-2 gap-4">
            <div class="g-col-2 g-col-xl-1 d-none d-xl-flex flex-column min-vh-screen" style="margin-left: -12%">
                <div class="my-auto text-center">
                    <img alt="Rubick Bootstrap HTML Admin Template" style="margin: auto" class="-intro-x w-1/2 mt-n16" src="{{ asset('admin/dist/images/marathi.png') }}" />
                    <h3 class="-intro-x text-white fw-medium fs-2xl lh-base mt-3 align-items-start">कल्याण डोंबिवली महानगरपालिका</h3> <br>
                    <div class="-intro-x text-white fw-medium fs-2xl lh-base mt-3 align-items-start">
                       TEMPORARY ADVERTISE PERMISSION
                    </div>
                </div>
            </div>

            <div class="g-col-2 g-col-xl-1 h-screen h-xl-auto d-flex py-5 py-xl-0 my-10 my-xl-0">
                <div class="my-auto mx-auto ms-xl-20 bg-white dark-bg-dark-1 bg-xl-transparent px-5 px-sm-8 py-8 p-xl-0 rounded-2 shadow-md shadow-xl-none w-full w-sm-3/4 w-lg-2/4 w-xl-auto">

                    <form class="theme-form login-form" id="loginForm">
                        @csrf
                        <img alt="Rubick Bootstrap HTML Admin Template" class="-intro-x w-1/2 mt-n16" src="{{ asset('admin/dist/images/marathi.png') }}" style="margin-left: 35%; width:30%!important; margin-bottom:15px" />
                        <div class="alert alert-primary d-flex align-items-center justify-content-center mb-2" role="alert"> <div><b style="font-size:18px;">TEMPORARY ADVERTISE PERMISSION</b></div> </div>
                        <div class="intro-x mt-8">
                            <input type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 d-block" id="username" name="username" placeholder="Username" />
                            <span class="pristine-error text-theme-6 mt-1 username_err"></span>

                            <input type="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 d-block mt-4" id="password" name="password" placeholder="Password" />
                            <span class="pristine-error text-theme-6 mt-1 password_err"></span>
                        </div>
                        <div class="intro-x d-flex text-gray-700 dark-text-gray-600 fs-xs fs-sm-sm mt-4">
                            <div class="d-flex align-items-center me-auto">
                                <input id="remember_me" name="remember_me" type="checkbox" class="form-check-input border me-2" />
                                <label class="cursor-pointer select-none" for="remember_me">Remember me</label>
                            </div>
                            {{-- <a href="login-light-login.html">Forgot Password?</a> --}}
                        </div>

                        <div class="intro-x mt-5 mt-xl-8 text-center text-xl-start">
                            <button type="submit" class="btn btn-twitter py-3 px-4 w-full w-xl-32 me-xl-3" id="loginForm_submit">Login</button>
                            <a href="{{ route('register') }}" class="btn btn-outline-secondary py-3 px-4 w-full w-xl-32 mt-3 mt-xl-0 align-top">
                                Sign up
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- Script for ajax login --}}
<script>
    $("#loginForm").submit(function(e) {
        e.preventDefault();
        $("#loginForm_submit").prop('disabled', true);
        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('signin') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                if (!data.error && !data.error2) {
                    window.location.href = "{{ route('dashboard') }}";
                } else {
                    if (data.error2) {
                        swal("Error!", data.error2, "error");
                        $("#loginForm_submit").prop('disabled', false);
                    } else {
                        $("#loginForm_submit").prop('disabled', false);
                        resetErrors();
                        printErrMsg(data.error);
                    }
                }
            },
            error: function(error) {
                $("#loginForm_submit").prop('disabled', false);
                swal("Error occured!", "Something went wrong please try again", "error");
            },
        });

        function resetErrors() {
            var form = document.getElementById('loginForm');
            var data = new FormData(form);
            for (var [key, value] of data) {
                console.log(key, value)
                $('.' + key + '_err').text('');
                $('#' + key).removeClass('is-invalid');
                $('#' + key).addClass('is-valid');
            }
        }

        function printErrMsg(msg) {
            $.each(msg, function(key, value) {
                console.log(key);
                $('.' + key + '_err').text(value);
                $('#' + key).addClass('is-invalid');
            });
        }

    });
</script>

{{-- Script to show hide eye --}}
<script>
    showHidePassword1 = () => {
        var password = document.getElementById('password');
        var toggler = document.getElementById('password_eye');

        if (password.type == 'password') {
            password.setAttribute('type', 'text');

            toggler.querySelector('i').classList.remove('fa-eye-slash');
            toggler.querySelector('i').classList.add('fa-eye');
        }
        else
        {
            password.setAttribute('type', 'password');
            toggler.querySelector('i').classList.remove('fa-eye');
            toggler.querySelector('i').classList.add('fa-eye-slash');
        }
    };
</script>

</html>
