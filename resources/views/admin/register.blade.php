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
    <title>{{ config('app.name') }} || Register</title>
    <link rel="stylesheet" href="{{ asset('admin/dist/css/app.css') }}" />
</head>

<body class="login">
    <div class="container px-sm-10">
        <div class="grid columns-2 gap-4">
            <div class="g-col-2 g-col-xl-1 d-none d-xl-flex flex-column min-vh-screen">
                {{-- <a href="{{ route('frontend.home') }}" class="-intro-x d-flex align-items-center pt-5">
                    <img alt="Rubick Bootstrap HTML Admin Template" class="w-6" src="{{ asset('admin/dist/images/logo.svg') }}" />
                    <span class="text-white fs-lg ms-3">
                        {{ config('app.name') }}
                    </span>
                </a> --}}
                <div class="my-auto text-center">
                    <img alt="Rubick Bootstrap HTML Admin Template" class="-intro-x w-1/2 mt-n16" style="margin: auto" src="{{ asset('admin/dist/images/english.png') }}" />
                    <div class="-intro-x text-white fw-medium fs-4xl lh-base mt-10 align-items-start">
                       KDMC-Advertise Permission

                    </div>
                </div>
            </div>

            <div class="g-col-2 g-col-xl-1 h-screen h-xl-auto d-flex py-5 py-xl-0 my-10 my-xl-0">
                <div class="my-auto mx-auto ms-xl-20 bg-white dark-bg-dark-1 bg-xl-transparent px-5 px-sm-8 py-8 p-xl-0 rounded-2 shadow-md shadow-xl-none w-full w-sm-3/4 w-lg-2/4 w-xl-auto">

                    <form class="theme-form login-form" id="loginForm">
                        @csrf

                        <h2 class="intro-x fw-bold fs-2xl fs-xl-3xl text-center text-xl-start">
                            Sign Up
                        </h2>

                        <div class="intro-x mt-2 text-gray-500 d-xl-none text-center">
                            A few more clicks to sign up to your account. Manage
                            all your information in one place
                        </div>
                        <div class="intro-x mt-8">
                            <input type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 d-block mt-4" id="name" name="name" placeholder="Full Name" />
                            <span class="pristine-error text-theme-6 mt-1 name_err"></span>

                            <input type="email" class="intro-x login__input form-control py-3 px-4 border-gray-300 d-block mt-4" id="email" name="email" placeholder="Email" />
                            <span class="pristine-error text-theme-6 mt-1 email_err"></span>

                            <input type="number" class="intro-x login__input form-control py-3 px-4 border-gray-300 d-block mt-4" id="mobile" name="mobile" placeholder="Mobile" />
                            <span class="pristine-error text-theme-6 mt-1 mobile_err"></span>

                            <input type="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 d-block mt-4" id="password" name="password" placeholder="Password" />
                            <span class="pristine-error text-theme-6 mt-1 password_err"></span>

                            <input type="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 d-block mt-4" id="confirm_password" name="confirm_password" placeholder="Confirm Password" />
                            <span class="pristine-error text-theme-6 mt-1 confirm_password_err"></span>
                        </div>
                        <div class="intro-x d-flex text-gray-700 dark-text-gray-600 fs-xs fs-sm-sm mt-4">
                            {{-- <div class="d-flex align-items-center me-auto">
                                <input id="remember_me" name="remember_me" type="checkbox" class="form-check-input border me-2" />
                                <label class="cursor-pointer select-none" for="remember_me">Remember me</label>
                            </div> --}}
                            {{-- <a href="login-light-login.html">Forgot Password?</a> --}}
                        </div>

                        <div class="intro-x mt-5 mt-xl-8 text-center text-xl-start">
                            <button type="submit" class="btn btn-primary py-3 px-4 w-full w-xl-32 me-xl-3 align-top" id="loginForm_submit">Sign Up</button>
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
            url: '{{ route('signup') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                if (!data.error && !data.error2) {
                    window.location.href = "{{ route('frontend.home') }}";
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
                $('.' + key + '_err').text('');
                $('#' + key).removeClass('is-invalid');
                $('#' + key).addClass('is-valid');
            }
        }

        function printErrMsg(msg) {
            $.each(msg, function(key, value) {
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
