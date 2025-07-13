<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ env("APP_NAME") . " | " . "Login" }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

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
            padding-top: 100px;
            justify-content: space-evenly;
        }

        .login100-form {
            width: 500px;
        }

        select{
            border: none;
            max-height: 50px;
            overflow: scroll;
        }

        .login100-pic{
            padding-top: 80px;
        }

        img{
            border-radius: 20px;
        }

        .no-icon{
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">

                <div class="login100-pic js-tilt" data-tilt id="pic1">
                    <img src="{{ asset("images/ohn/clinic_reg.png"); }}" alt="IMG">
                </div>

                <div class="login100-pic js-tilt" data-tilt id="pic2" style="display: none;">
                    <img src="{{ asset("images/ohn/clinic_reg2.png"); }}" alt="IMG">
                </div>

                <form class="login100-form validate-form" method="POST" action="{{ route('register'); }}">
                    @csrf
                    <div id="first-form">
                        <span class="login100-form-title">
                            Clinic Information
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
                            <input class="input100" type="text" name="clinic_contact" placeholder="Contact">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="far fa-phone"></i>
                            </span>
                        </div>

                        <div class="wrap-input100">
                            <input class="input100" type="number" min="0" name="pf" placeholder="Prof. Fee">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="far fa-dollar"></i>
                            </span>
                        </div>
                    </div>

                    <div id="second-form" style="display: none;">
                        <span class="login100-form-title">
                            Personal Information
                        </span>

                        <div class="wrap-input100">
                            <input class="input100 no-icon" type="text" name="fname" placeholder="First Name">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100">
                            <input class="input100 no-icon" type="text" name="mname" placeholder="Middle Name">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100">
                            <input class="input100 no-icon" type="text" name="lname" placeholder="Last Name">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100">
                            <input class="input100 no-icon" type="text" name="suffix" placeholder="Suffix">
                            <span class="focus-input100"></span>
                        </div>

                        <div style="display: flex;">
                            <div class="wrap-input100" style="width: 55%;">
                                <input class="input100 no-icon" type="text" name="contact" placeholder="Contact Number">
                                <span class="focus-input100"></span>
                            </div>&nbsp;

                            <div class="wrap-input100">
                                <input class="input100 no-icon" type="text" name="email" placeholder="Email">
                                <span class="focus-input100"></span>
                            </div>
                        </div>
                    </div>

                    <div id="third-form" style="display: none;">
                        <span class="login100-form-title">
                            Account Information
                        </span>

                        <br>
                        <div class="wrap-input100">
                            <input class="input100 no-icon" type="text" name="username" placeholder="Username">
                            <span class="focus-input100"></span>
                        </div>

                        <br>
                        <div class="wrap-input100">
                            <input class="input100 no-icon" type="password" name="password" placeholder="Password">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100">
                            <input class="input100 no-icon" type="password" name="confirm_password" placeholder="Confirm Password">
                            <span class="focus-input100"></span>
                        </div>

                        <br>

                        <input type="checkbox" name="terms-and-condition"> 
                            I accept the <a target="_blank" href="{{ route('terms-and-conditions') }}" style="color: blue;">Terms and Condition</a> 
                    </div>
                        
                    <div class="container-register100-form-btn">
                        <div class="row" style="width: 100%; display: flex; justify-content: end;">
                            <a class="register100-form-btn" id="prv-btn" style="width: 120px; background: #5accf8; display: none;">
                                Previous
                            </a>
                            &nbsp;
                            <a class="register100-form-btn" id="nxt-btn" style="width: 80px; background: #90e691;">
                                Next
                            </a>
                            &nbsp;
                            <a class="register100-form-btn" id="save-btn" style="width: 80px; background: #90e691; display: none;">
                                Save
                            </a>
                        </div>

                        <div class="text-center p-t-136" style="padding-top: 50px;">
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

        $('#nxt-btn').on('click', e => {
            if($('#first-form').is(':visible')){
                $('#first-form').slideUp();
                $('#pic1').hide();

                $('#second-form').slideDown();
                $('#prv-btn').show();
                $('#pic2').show();
            }
            else if($('#second-form').is(':visible')){
                $('#second-form').slideUp();

                $('#third-form').slideDown();
                $('#nxt-btn').hide();

                $('#save-btn').show();
            }
        });

        $('#prv-btn').on('click', e => {
            if($('#second-form').is(':visible')){
                $('#second-form').slideUp();
                $('#prv-btn').hide();
                $('#pic2').hide();

                $('#first-form').slideDown();
                $('#pic1').show();
            }
            else if($('#third-form').is(':visible')){
                $('#third-form').slideUp();

                $('#second-form').slideDown();
                $('#nxt-btn').show();
                $('#save-btn').hide();
            }
        });

        $('#save-btn').on('click', e => {
            let flag = checkIfAnyIsEmpty(['clinic_name','location','region','clinic_contact','pf']);
            let flag2 = checkIfAnyIsEmpty(['fname','mname','lname','contact','email']);
            let flag3 = checkIfAnyIsEmpty(['username','password','confirm_password']);

            let pass = $(`[name="password"]`).val();
            let cpass = $(`[name="confirm_password"]`).val();

            if(flag){
                $('#third-form').slideUp();
                $('#prv-btn').hide();
                $('#pic2').hide();

                $('#first-form').slideDown();
                $('#pic1').show();
                $('#nxt-btn').show();
                $('#save-btn').hide();

                infoError('All Clinic Information is required');
            }
            else if(flag2){
                $('#third-form').slideUp();

                $('#second-form').slideDown();
                $('#nxt-btn').show();
                $('#save-btn').hide();

                infoError('Title, name, and contact details is required.');
            }
            else if(flag3){
                infoError('All account information is required.');
            }
            else if(pass != cpass){
                infoError('Password mismatch. Please try again.');
            }
            else if(pass.length < 6){
                infoError('Password must at least be 6 characters long.');
            }
            else if(pass.length < 6){
                infoError('Password must at least be 6 characters long.');
            }
            else if(!$('[name="terms-and-condition"]').is(':checked')){
                infoError('You must accept the terms and conditios');
            }
            else{
                let userData = {
                    fname: $('[name="fname"]').val(),
                    mname: $('[name="mname"]').val(),
                    lname: $('[name="lname"]').val(),
                    suffix: $('[name="suffix"]').val(),
                    contact: $('[name="contact"]').val(),
                    email: $('[name="email"]').val(),
                    username: $('[name="username"]').val(),
                    password: $('[name="password"]').val(),
                };

                let clinicData = {
                    name: $('[name="clinic_name"]').val(),
                    location: $('[name="location"]').val(),
                    region: $('[name="region"]').val(),
                    contact: $('[name="clinic_contact"]').val(),
                    pf: $('[name="pf"]').val(),
                };

                Swal.showLoading();
                $.ajax({
                    url: "{{ route('clinic.store') }}",
                    type: "POST",
                    data: {
                        userData: userData,
                        clinicData: clinicData,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: result => {
                        Swal.fire({
                            icon: "success",
                            title: "Successfully saved",
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = "{{ route('login') }}"
                        })
                    }
                })
            }
        });

        function infoError(title){
            Swal.fire({
                icon: 'info',
                title: title
            })
        }

        function checkIfAnyIsEmpty(columns){
            let bool = false;

            columns.forEach(column => {
                if($(`[name="${column}"]`).val() == ""){
                    bool =true;
                }
            })

            return bool;
        }
    </script>
</body>
</html>