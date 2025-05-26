<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ env("APP_NAME") . " | " . "Login" }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('fonts/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/hamburgers.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/util.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

    <style>
        .container-login100{
            background: -webkit-linear-gradient(-150deg, #f9f9f9, #b6e3ff, #58cdfa);
            background: -o-linear-gradient(-150deg, #f9f9f9, #b6e3ff, #58cdfa);
            background: -moz-linear-gradient(-150deg, #f9f9f9, #b6e3ff, #58cdfa);
            background: linear-gradient(-150deg, #f9f9f9, #b6e3ff, #58cdfa);
        }

        .wrap-login100{
            width: 1300px;
        }

        .login100-form {
            width: 500px;
        }

        select{
            border: none;
        }
    </style>
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ asset("images/ohn/clinic_reg.png"); }}" alt="IMG">
                </div>

                <form class="login100-form validate-form" method="POST" action="{{ route('register'); }}">
                    @csrf
                    <span class="login100-form-title">
                        Registration
                    </span>

                    <div class="wrap-input100">
                        <input class="input100" type="text" name="clinic_name" placeholder="Clinic Name">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="far fa-id-card"></i>
                        </span>
                    </div>

                    <div class="wrap-input100">
                        <input class="input100" type="text" name="location" placeholder="Location">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="far fa-location-pin"></i>
                        </span>
                    </div>

                    <div class="wrap-input100">
                        <select class="input100" type="text" name="region">
                            <option value="" selected="" disabled="">Select Region</option>
                            <option value="Ilocos Region (Region I) ">Ilocos Region (Region I)</option>
                            <option value="Cagayan Valley (Region II) ">Cagayan Valley (Region II)</option>
                            <option value="Central Luzon (Region III) ">Central Luzon (Region III)</option>
                            <option value="CALABARZON (Region IV-A) ">CALABARZON (Region IV-A)</option>
                            <option value="MIMAROPA (Region IV-B) ">MIMAROPA (Region IV-B)</option>
                            <option value="Bicol Region (Region V) ">Bicol Region (Region V)</option>
                            <option value="Cordillera Administrative Region (CAR) ">Cordillera
                                Administrative
                                Region (CAR)
                            </option>
                            <option value="National Capital Region (NCR) (Metro Manila) ">National Capital
                                Region (NCR) (Metro Manila)
                            </option>
                            <option value="Western Visayas (Region VI) ">Western Visayas (Region VI)
                            </option>
                            <option value="Central Visayas (Region VII) ">Central Visayas (Region VII)
                            </option>
                            <option value="Eastern Visayas (Region VIII) ">Eastern Visayas (Region VIII)
                            </option>
                            <option value="Zamboanga Peninsula (Region IX) ">Zamboanga Peninsula (Region IX)
                            </option>
                            <option value="Northern Mindanao (Region X) ">Northern Mindanao (Region X)
                            </option>
                            <option value="Davao Region (Region XI) ">Davao Region (Region XI)</option>
                            <option value="SOCSARGEN (Region XII) ">SOCSARGEN (Region XII)</option>
                            <option value="Caraga (Region XIII) ">Caraga (Region XIII)</option>
                            <option value="Autonomous Region in Muslim Mindanao (ARMM)">Autonomous Region in
                                Muslim Mindanao (ARMM)
                            </option>
                        </select>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="far fa-map-location-dot"></i>
                        </span>
                    </div>

                    <div class="wrap-input100">
                        <input class="input100" type="text" name="contact" placeholder="Contact">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="far fa-phone"></i>
                        </span>
                    </div>

                    <div class="wrap-input100">
                        <input class="input100" type="text" name="pf" placeholder="Prof. Fee">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="far fa-dollar"></i>
                        </span>
                    </div>
                    
                    <div class="container-register100-form-btn">
                        <a class="register100-form-btn">
                            Next
                        </a>

                        <div class="text-center p-t-136">
                            <a class="txt2" href="{{ route('login') }}">
                                Already have an account?
                            </a>
                        </div>
                    </div>
                    
                    {{-- <div class="container-register100-form-btn">
                    </div> --}}

                    {{-- <div class="text-center p-t-12">
                        <span class="txt1">
                        </span>
                        <a class="txt2" href="#">
                        </a>
                    </div> --}}

                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-bundle.min.js') }}"></script>
    <script src="{{ asset('js/auth/tilt.js') }}"></script>
    <script src="{{ asset('js/auth/main.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })

        @if($errors->all())
            Swal.fire({
                icon: 'error',
                html: `
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br/>
                    @endforeach
                `,
            });
        @endif
    </script>
</body>
</html>