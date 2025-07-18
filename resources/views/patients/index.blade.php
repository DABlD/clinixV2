@extends('layouts.app')
@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-table mr-1"></i>
                            List
                        </h3>

                        @include('patients.includes.toolbar')
                    </div>

                    <div class="card-body table-responsive">
                    	<table id="table" class="table table-hover" style="width: 100%;">
                    		<thead>
                    			<tr>
                    				<th>PID</th>
                    				<th>Last Name</th>
                    				<th>First Name</th>
                    				<th>Gender</th>
                    				<th>Birthday</th>
                    				<th>Contact</th>
                    				<th>Email</th>
                    				<th>Nationality</th>
                    				<th>Actions</th>
                    			</tr>
                    		</thead>

                    		<tbody>
                    		</tbody>
                    	</table>
                    </div>
                </div>
            </section>
        </div>
    </div>

</section>

@endsection

@push('styles')
	{{-- <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/datatables.bundle.min.css') }}"> --}}
	{{-- <link rel="stylesheet" href="{{ asset('css/datatables.bootstrap4.min.css') }}"> --}}
	{{-- <link rel="stylesheet" href="{{ asset('css/datatables-jquery.min.css') }}"> --}}


	<style>
		.label{
			font-weight: bold;
		}

		.pInfo{
			color: deepskyblue !important;
		}

	    #swal2-html-container .nav-pills>li>a {
	    	border-top: 3px solid !important;
	    }

	    #swal2-html-container .nav-link.active {
	    	color: #fff !important;
	    	background-color: #337ab7 !important;
	    }
	</style>
@endpush

@push('scripts')
	{{-- <script src="{{ asset('js/datatables.min.js') }}"></script> --}}
	<script src="{{ asset('js/datatables.bundle.min.js') }}"></script>
	{{-- <script src="{{ asset('js/datatables.bootstrap4.min.js') }}"></script> --}}
	{{-- <script src="{{ asset('js/datatables-jquery.min.js') }}"></script> --}}

	<script>
		$(document).ready(()=> {
			var table = $('#table').DataTable({
				ajax: {
					url: "{{ route('datatable.patient') }}",
                	dataType: "json",
                	dataSrc: "",
					data: {
						select: "*",
						load: ['user']
					}
				},
				columns: [
					{data: 'patient_id'},
					{data: 'user.lname'},
					{data: 'user.fname'},
					{data: 'user.gender'},
					{data: 'user.birthday'},
					{data: 'user.contact'},
					{data: 'user.email'},
					{data: 'nationality'},
					{data: 'actions'},
				],
        		pageLength: 25,
	            columnDefs: [
	                {
	                    targets: 4,
	                    render: birthday => {
	                        if(birthday){
	                        	return toDate(birthday) + ` (${moment().diff(birthday, 'years')})`;
	                        }
	                        else{
	                        	return "";
	                        }
	                    },
	                }
	            ],
	            order: [[0]]
				// drawCallback: function(){
				// 	init();
				// }
			});
		});

		function create(){
			let imageData = null;

			Swal.fire({
				title: "Patient Information",
    			confirmButtonText: "Save",
				allowEscapeKey: false,
				allowOutsideClick: false,
				showCancelButton: true,
				cancelButtonColor: errorColor,
				cancelButtonText: 'Cancel',
				html: `
					<br>
	                <div class="row">

	                	<section class="col-lg-3">
		                    <div class="card">
		                        <div class="card-header row">
		                            <div class="col-md-12">
		                                <h3 class="card-title" style="width: 100%; text-align: left;">
		                                    <i class="fas fa-user mr-1"></i>

		                                    Basic Information

		                                </h3>
		                            </div>
		                        </div>

		                        <div class="card-body">

	                    			<div class="col-md-12">
										<video id="webcam" autoplay playsinline style="width: 200px; height: 150px;"></video>
										<canvas id="snapshot"></canvas>
										<button id="captureImage">📸 Capture Image</button>
	                    			</div>

	                    			<br>

	                    			<div class="col-md-12 pInfo-left">
	                    				<span class="label">HMO Provider</span>
	                    				<br>
	                    				<span class="pInfo">
	                    					<input type="text" id="hmo_provider" class="form-control">
	                    				</span>
	                    			</div>
	                    			
	                    			<br>
	                    			
	                    			<div class="col-md-12 pInfo-left">
	                    				<span class="label">HMO Number</span>
	                    				<br>
	                    				<span class="pInfo">
	                    					<input type="text" id="hmo_number" class="form-control">
	                    				</span>
	                    			</div>

		                        </div>
		                    </div>
		                </section>

                    	<section class="col-lg-9">
    	                    <div class="card">
    	                        <div class="card-header row">
    	                            <div class="col-md-12">
    	                                <h3 class="card-title" style="width: 100%; text-align: left;">
    	                                    <i class="fas fa-user mr-1"></i>

    	                                    General Information

    	                                </h3>
    	                            </div>
    	                        </div>

    	                        <div class="card-body">

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">First Name</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="fname" class="form-control">
		                    				</span>
                        				</div>
                        				<div class="col-md-3">
                        					<span class="label">Middle Name</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="mname" class="form-control">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Last Name</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="lname" class="form-control">
		                    				</span>
                        				</div>
                        				<div class="col-md-1">
                        					<span class="label">Suffix</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="suffix" class="form-control">
		                    				</span>
                        				</div>
                        			</div>

                        			<br>

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">Birthday</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="birthday" class="form-control">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Birth Place</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="birth_place" class="form-control">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Gender</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="gender" class="form-control">
		                    				</span>
                        				</div>
                        			</div>

                        			<br>

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">Civil Status</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="civil_status" class="form-control">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Nationality</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="nationality" class="form-control">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Religion</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="religion" class="form-control">
		                    				</span>
                        				</div>
                        			</div>

                        			<br>
                        			
                        			<div class="row">
                        				<div class="col-md-12">
                        					<span class="label">Address</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="address" class="form-control">
		                    				</span>
                        				</div>
                        			</div>

    	                        </div>
    	                    </div>
    	                </section>
	                </div>

	                <div class="row">
	                	<section class="col-lg-3">
		                    <div class="card">
		                        <div class="card-header row">
		                            <div class="col-md-12">
		                                <h3 class="card-title" style="width: 100%; text-align: left;">
		                                    <i class="fas fa-phone mr-1"></i>

		                                    Contact Information

		                                </h3>
		                            </div>
		                        </div>

		                        <div class="card-body">
	                    			
	                    			<div class="col-md-12 pInfo-left">
	                    				<span class="label">Email</span>
	                    				<br>
	                    				<span class="pInfo">
	                    					<input type="email" id="email" class="form-control">
	                    				</span>
	                    			</div>

	                    			<br>

	                    			<div class="col-md-12 pInfo-left">
	                    				<span class="label">Contact</span>
	                    				<br>
	                    				<span class="pInfo">
	                    					<input type="text" id="contact" class="form-control">
	                    				</span>
	                    			</div>
		                        </div>
		                    </div>
		                </section>

		                <section class="col-lg-9">
    	                    <div class="card">
    	                        <div class="card-header row">
    	                            <div class="col-md-12">
    	                                <h3 class="card-title" style="width: 100%; text-align: left;">
    	                                    <i class="fas fa-briefcase mr-1"></i>

    	                                    Employment Information

    	                                </h3>
    	                            </div>
    	                        </div>

    	                        <div class="card-body">

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">Employment Status</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="employment_status" class="form-control">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Company Name</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="company_name" class="form-control">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Position</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="company_position" class="form-control">
		                    				</span>
                        				</div>
                        			</div>

                        			<br>

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">Company Contact</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="company_contact" class="form-control">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">SSS</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="sss" class="form-control">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">TIN</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="tin_number" class="form-control">
		                    				</span>
                        				</div>
                        			</div>

    	                        </div>
    	                    </div>
    	                </section>
	                </div>
				`,
				width: '1200px',
				didOpen: () => {
					$('.pInfo').parent().css('text-align', 'left');
					$('#swal2-html-container .card-header').css('margin', "1px");
					$('#swal2-html-container .card-header').css('background-color', "#83c8e5");
					$('#swal2-html-container .card-body').css('border', "1px solid rgba(0,0,0,0.125)");

					$('#birthday').flatpickr({
						altInput: true,
						altFormat: "M j, Y",
						dateFormat: "Y-m-d",
						maxDate: moment().format("YYYY-MM-DD")
					});

					$('#snapshot').hide();

					const video = document.getElementById('webcam');
					const canvas = document.getElementById('snapshot');
					const ctx = canvas.getContext('2d');
					let stream = null;

					async function initWebcam() {
					try {
						stream = await navigator.mediaDevices.getUserMedia({ video: true });
						video.srcObject = stream;
					} catch (err) {
							console.error('Webcam access denied or not available.', err);
						}
					}

					$('#captureImage').click(e => {
						// Set canvas size to match video
						canvas.width = 200;
						canvas.height = 150;

						// Draw current frame
						$('#webcam').hide();
						$('#snapshot').show();
						ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

						// Convert to base64
						imageData = canvas.toDataURL('image/png');
						console.log('Captured image:', imageData);

						// TODO: Upload to server using fetch() if needed
					});

					// Start webcam on page load
					initWebcam();
				},
				preConfirm: () => {
				    swal.showLoading();
				    return new Promise(resolve => {
				    	let bool = true;

				    	let check = ["fname","lname","gender","contact"];
				    	let flag = false;

				    	check.forEach(field => {
				    		$(`#${field}`).removeClass('border-danger');
				    		if($(`#${field}`).val() == ""){
				    			$(`#${field}`).addClass('border-danger');
				    			flag = true;
				    		}
				    	});

			            if(flag){
			                Swal.showValidationMessage('Highlighted fields are required');
			            }
			            
			            bool ? setTimeout(() => {resolve()}, 500) : "";
				    });
				},
			}).then(result => {
				if(result.value){
					swal.showLoading();
					uploadPatient({
						fname: $("#fname").val(),
						mname: $("#mname").val(),
						lname: $("#lname").val(),
						suffix: $("#suffix").val(),
						birthday: $("#birthday").val(),
						birth_place: $("#birth_place").val(),
						gender: $("#gender").val(),
						civil_status: $("#civil_status").val(),
						nationality: $("#nationality").val(),
						religion: $("#religion").val(),
						contact: $("#contact").val(),
						email: $("#email").val(),
						address: $("#address").val(),
						hmo_provider: $("#hmo_provider").val(),
						hmo_number: $("#hmo_number").val(),
						employment_status: $("#employment_status").val(),
						company_name: $("#company_name").val(),
						company_position: $("#company_position").val(),
						company_contact: $("#company_contact").val(),
						sss: $("#sss").val(),
						tin_number: $("#tin_number").val(),
						imageData: imageData,
						_token: $('meta[name="csrf-token"]').attr('content')
					});
				}
			});
		}

		async function uploadPatient(data){
		    let formData = new FormData();
		    formData.append('fname', data.fname);
		    formData.append('mname', data.mname);
		    formData.append('lname', data.lname);
		    formData.append('suffix', data.suffix);
		    formData.append('birthday', data.birthday);
		    formData.append('birth_place', data.birth_place);
		    formData.append('gender', data.gender);
		    formData.append('civil_status', data.civil_status);
		    formData.append('nationality', data.nationality);
		    formData.append('religion', data.religion);
		    formData.append('contact', data.contact);
		    formData.append('email', data.email);
		    formData.append('address', data.address);
		    formData.append('hmo_provider', data.hmo_provider);
		    formData.append('hmo_number', data.hmo_number);
		    formData.append('employment_status', data.employment_status);
		    formData.append('company_name', data.company_name);
		    formData.append('company_position', data.company_position);
		    formData.append('company_contact', data.company_contact);
		    formData.append('sss', data.sss);
		    formData.append('tin_number', data.tin_number);
		    formData.append('imageData', data.imageData);
		    formData.append('_token', data._token);
	        await fetch('{{ route('patient.store') }}', {
	    		method: "POST", 
	    		body: formData
	        });
	        ss('Success');
	        reload();
		}

		function view(id){
			$.ajax({
				url: "{{ route('user.get') }}",
				data: {
					select: '*',
					where: ['id', id],
					load: ['patient']
				},
				success: patient => {
					patient = JSON.parse(patient)[0];
					showDetails(patient);
				}
			})
		}

		function showDetails(user){
			Swal.fire({
				title: "Patient Information",
				html: `
					<br>
	                <div class="row">

	                	<section class="col-lg-3">
		                    <div class="card">
		                        <div class="card-header row">
		                            <div class="col-md-12">
		                                <h3 class="card-title" style="width: 100%; text-align: left;">
		                                    <i class="fas fa-user mr-1"></i>

		                                    Basic Information

		                                </h3>
		                            </div>
		                        </div>

		                        <div class="card-body">

	                    			<div class="col-md-12">
	    	                			<img src="${user.avatar}" alt="avatar" width="200" height="150">
	                    			</div>

	                    			<br>
	                    			
	                    			<div class="col-md-12 pInfo-left">
	                    				<span class="label">Patient ID</span>
	                    				<br>
	                    				<span class="pInfo">${user.patient.patient_id ?? "-"}</span>
	                    			</div>

	                    			<br>

	                    			<div class="col-md-12 pInfo-left">
	                    				<span class="label">HMO Provider</span>
	                    				<br>
	                    				<span class="pInfo">${user.patient.hmo_provider ?? "-"}</span>
	                    			</div>
	                    			
	                    			<br>
	                    			
	                    			<div class="col-md-12 pInfo-left">
	                    				<span class="label">HMO Number</span>
	                    				<br>
	                    				<span class="pInfo">${user.patient.hmo_number ?? "-"}</span>
	                    			</div>

		                        </div>
		                    </div>
		                </section>

                    	<section class="col-lg-9">
    	                    <div class="card">
    	                        <div class="card-header row">
    	                            <div class="col-md-12">
    	                                <h3 class="card-title" style="width: 100%; text-align: left;">
    	                                    <i class="fas fa-user mr-1"></i>

    	                                    General Information

    	                                </h3>
    	                            </div>
    	                        </div>

    	                        <div class="card-body">

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">First Name</span>
                        					<br>
                        					<span class="pInfo">${user.fname ?? "-"}</span>
                        				</div>
                        				<div class="col-md-3">
                        					<span class="label">Middle Name</span>
                        					<br>
                        					<span class="pInfo">${user.mname ?? "-"}</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Last Name</span>
                        					<br>
                        					<span class="pInfo">${user.lname ?? "-"}</span>
                        				</div>
                        				<div class="col-md-1">
                        					<span class="label">Suffix</span>
                        					<br>
                        					<span class="pInfo">${user.suffix ?? "-"}</span>
                        				</div>
                        			</div>

                        			<br>

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">Birthday</span>
                        					<br>
                        					<span class="pInfo">${toDate(user.birthday)}</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Age</span>
                        					<br>
                        					<span class="pInfo">${moment().diff(user.birthday, 'years')}</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Birth Place</span>
                        					<br>
                        					<span class="pInfo">${user.birth_place ?? "-"}</span>
                        				</div>
                        			</div>

                        			<br>

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">Gender</span>
                        					<br>
                        					<span class="pInfo">${user.gender ?? "-"}</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Civil Status</span>
                        					<br>
                        					<span class="pInfo">${user.patient.civil_status ?? "-"}</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Nationality</span>
                        					<br>
                        					<span class="pInfo">${user.patient.nationality ?? "-"}</span>
                        				</div>
                        			</div>

                        			<br>

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">Religion</span>
                        					<br>
                        					<span class="pInfo">${user.patient.religion ?? "-"}</span>
                        				</div>
                        			</div>

                        			<br>
                        			
                        			<div class="row">
                        				<div class="col-md-12">
                        					<span class="label">Address</span>
                        					<br>
                        					<span class="pInfo">${user.address ?? "-"}</span>
                        				</div>
                        			</div>

    	                        </div>
    	                    </div>
    	                </section>
	                </div>

	                <div class="row">
	                	<section class="col-lg-3">
		                    <div class="card">
		                        <div class="card-header row">
		                            <div class="col-md-12">
		                                <h3 class="card-title" style="width: 100%; text-align: left;">
		                                    <i class="fas fa-phone mr-1"></i>

		                                    Contact Information

		                                </h3>
		                            </div>
		                        </div>

		                        <div class="card-body">
	                    			
	                    			<div class="col-md-12 pInfo-left">
	                    				<span class="label">Email</span>
	                    				<br>
	                    				<span class="pInfo">${user.email ?? "-"}</span>
	                    			</div>

	                    			<br>

	                    			<div class="col-md-12 pInfo-left">
	                    				<span class="label">Contact</span>
	                    				<br>
	                    				<span class="pInfo">${user.contact ?? "-"}</span>
	                    			</div>
		                        </div>
		                    </div>
		                </section>

		                <section class="col-lg-9">
    	                    <div class="card">
    	                        <div class="card-header row">
    	                            <div class="col-md-12">
    	                                <h3 class="card-title" style="width: 100%; text-align: left;">
    	                                    <i class="fas fa-briefcase mr-1"></i>

    	                                    Employment Information

    	                                </h3>
    	                            </div>
    	                        </div>

    	                        <div class="card-body">

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">Employment Status</span>
                        					<br>
                        					<span class="pInfo">${user.patient.employment_status ?? "-"}</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Company Name</span>
                        					<br>
                        					<span class="pInfo">${user.patient.company_name ?? "-"}</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Position</span>
                        					<br>
                        					<span class="pInfo">${user.patient.company_position ?? "-"}</span>
                        				</div>
                        			</div>

                        			<br>

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">Position</span>
                        					<br>
                        					<span class="pInfo">${user.patient.company_contact ?? "-"}</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">SSS</span>
                        					<br>
                        					<span class="pInfo">${user.patient.sss ?? "-"}</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">TIN</span>
                        					<br>
                        					<span class="pInfo">${user.patient.tin_number ?? "-"}</span>
                        				</div>
                        			</div>

    	                        </div>
    	                    </div>
    	                </section>
	                </div>
				`,
				width: '1200px',
				confirmButtonText: 'OK',
				// showCancelButton: true,
				// cancelButtonColor: errorColor,
				// cancelButtonText: 'Cancel',
				didOpen: () => {
					$('.pInfo').parent().css('text-align', 'left');
					$('#swal2-html-container .card-header').css('margin', "1px");
					$('#swal2-html-container .card-header').css('background-color', "#83c8e5");
					$('#swal2-html-container .card-body').css('border', "1px solid rgba(0,0,0,0.125)");
				}
			});
		}

		function edit(id){
			$.ajax({
				url: "{{ route('user.get') }}",
				data: {
					select: "*",
					where: ["id", id],
					load: ['patient']
				},
				success: user => {
					user = JSON.parse(user)[0];
					showEdit(user);
				}
			});
		}

		function showEdit(user){
			let imageData = null;

			Swal.fire({
				title: "Patient Information",
    			confirmButtonText: "Save",
				allowEscapeKey: false,
				allowOutsideClick: false,
				showCancelButton: true,
				cancelButtonColor: errorColor,
				cancelButtonText: 'Cancel',
				html: `
					<br>
	                <div class="row">

	                	<section class="col-lg-3">
		                    <div class="card">
		                        <div class="card-header row">
		                            <div class="col-md-12">
		                                <h3 class="card-title" style="width: 100%; text-align: left;">
		                                    <i class="fas fa-user mr-1"></i>

		                                    Basic Information

		                                </h3>
		                            </div>
		                        </div>

		                        <div class="card-body">

	                    			<div class="col-md-12">
	    	                			<img src="images/default_avatar.png" alt="avatar" width="200" height="150">
	                    			</div>

	                    			<br>

	                    			<div class="col-md-12">
										<video id="webcam" autoplay playsinline style="width: 200px; height: 150px;"></video>
										<canvas id="snapshot"></canvas>
										<button id="captureImage">📸 Capture Image</button>
	                    			</div>

	                    			<br>
	                    			
	                    			<div class="col-md-12 pInfo-left">
	                    				<span class="label">Patient ID</span>
	                    				<br>
	                    				<span class="pInfo">${user.patient.patient_id}</span>
	                    			</div>

	                    			<br>

	                    			<div class="col-md-12 pInfo-left">
	                    				<span class="label">HMO Provider</span>
	                    				<br>
	                    				<span class="pInfo">
	                    					<input type="text" id="hmo_provider" class="form-control" value="${user.patient.hmo_provider ?? ""}">
	                    				</span>
	                    			</div>
	                    			
	                    			<br>
	                    			
	                    			<div class="col-md-12 pInfo-left">
	                    				<span class="label">HMO Number</span>
	                    				<br>
	                    				<span class="pInfo">
	                    					<input type="text" id="hmo_number" class="form-control" value="${user.patient.hmo_number ?? ""}">
	                    				</span>
	                    			</div>

		                        </div>
		                    </div>
		                </section>

                    	<section class="col-lg-9">
    	                    <div class="card">
    	                        <div class="card-header row">
    	                            <div class="col-md-12">
    	                                <h3 class="card-title" style="width: 100%; text-align: left;">
    	                                    <i class="fas fa-user mr-1"></i>

    	                                    General Information

    	                                </h3>
    	                            </div>
    	                        </div>

    	                        <div class="card-body">

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">First Name</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="fname" class="form-control" value="${user.fname ?? ""}">
		                    				</span>
                        				</div>
                        				<div class="col-md-3">
                        					<span class="label">Middle Name</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="mname" class="form-control" value="${user.mname ?? ""}">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Last Name</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="lname" class="form-control" value="${user.lname ?? ""}">
		                    				</span>
                        				</div>
                        				<div class="col-md-1">
                        					<span class="label">Suffix</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="suffix" class="form-control" value="${user.suffix ?? ""}">
		                    				</span>
                        				</div>
                        			</div>

                        			<br>

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">Birthday</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="birthday" class="form-control">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Birth Place</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="birth_place" class="form-control" value="${user.patient.birth_place ?? ""}">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Gender</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="gender" class="form-control" value="${user.gender ?? ""}">
		                    				</span>
                        				</div>
                        			</div>

                        			<br>

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">Civil Status</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="civil_status" class="form-control" value="${user.patient.civil_status ?? ""}">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Nationality</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="nationality" class="form-control" value="${user.patient.nationality ?? ""}">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Religion</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="religion" class="form-control" value="${user.patient.religion ?? ""}">
		                    				</span>
                        				</div>
                        			</div>

                        			<br>
                        			
                        			<div class="row">
                        				<div class="col-md-12">
                        					<span class="label">Address</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="address" class="form-control" value="${user.address ?? ""}">
		                    				</span>
                        				</div>
                        			</div>

    	                        </div>
    	                    </div>
    	                </section>
	                </div>

	                <div class="row">
	                	<section class="col-lg-3">
		                    <div class="card">
		                        <div class="card-header row">
		                            <div class="col-md-12">
		                                <h3 class="card-title" style="width: 100%; text-align: left;">
		                                    <i class="fas fa-phone mr-1"></i>

		                                    Contact Information

		                                </h3>
		                            </div>
		                        </div>

		                        <div class="card-body">
	                    			
	                    			<div class="col-md-12 pInfo-left">
	                    				<span class="label">Email</span>
	                    				<br>
	                    				<span class="pInfo">
	                    					<input type="email" id="email" class="form-control" value="${user.email ?? ""}">
	                    				</span>
	                    			</div>

	                    			<br>

	                    			<div class="col-md-12 pInfo-left">
	                    				<span class="label">Contact</span>
	                    				<br>
	                    				<span class="pInfo">
	                    					<input type="text" id="contact" class="form-control" value="${user.contact ?? ""}">
	                    				</span>
	                    			</div>
		                        </div>
		                    </div>
		                </section>

		                <section class="col-lg-9">
    	                    <div class="card">
    	                        <div class="card-header row">
    	                            <div class="col-md-12">
    	                                <h3 class="card-title" style="width: 100%; text-align: left;">
    	                                    <i class="fas fa-briefcase mr-1"></i>

    	                                    Employment Information

    	                                </h3>
    	                            </div>
    	                        </div>

    	                        <div class="card-body">

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">Employment Status</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="employment_status" class="form-control" value="${user.patient.employment_status ?? ""}">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Company Name</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="company_name" class="form-control" value="${user.patient.company_name ?? ""}">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">Position</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="company_position" class="form-control" value="${user.patient.company_position ?? ""}">
		                    				</span>
                        				</div>
                        			</div>

                        			<br>

                        			<div class="row">
                        				<div class="col-md-4">
                        					<span class="label">Company Contact</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="company_contact" class="form-control" value="${user.patient.company_contact ?? ""}">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">SSS</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="sss" class="form-control" value="${user.patient.sss ?? ""}">
		                    				</span>
                        				</div>
                        				<div class="col-md-4">
                        					<span class="label">TIN</span>
                        					<br>
		                    				<span class="pInfo">
		                    					<input type="text" id="tin_number" class="form-control" value="${user.patient.tin_number ?? ""}">
		                    				</span>
                        				</div>
                        			</div>

    	                        </div>
    	                    </div>
    	                </section>
	                </div>
				`,
				width: '1200px',
				didOpen: () => {
					$('.pInfo').parent().css('text-align', 'left');
					$('#swal2-html-container .card-header').css('margin', "1px");
					$('#swal2-html-container .card-header').css('background-color', "#83c8e5");
					$('#swal2-html-container .card-body').css('border', "1px solid rgba(0,0,0,0.125)");

					$('#birthday').flatpickr({
						altInput: true,
						altFormat: "M j, Y",
						dateFormat: "Y-m-d",
						maxDate: moment().format("YYYY-MM-DD"),
						defaultDate: user.birthday
					});

					$('#snapshot').hide();

					const video = document.getElementById('webcam');
					const canvas = document.getElementById('snapshot');
					const ctx = canvas.getContext('2d');
					let stream = null;

					async function initWebcam() {
					try {
						stream = await navigator.mediaDevices.getUserMedia({ video: true });
						video.srcObject = stream;
					} catch (err) {
							console.error('Webcam access denied or not available.', err);
						}
					}

					$('#captureImage').click(e => {
						// Set canvas size to match video
						canvas.width = 200;
						canvas.height = 150;

						// Draw current frame
						$('#webcam').hide();
						$('#snapshot').show();
						ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

						// Convert to base64
						imageData = canvas.toDataURL('image/png');
						console.log('Captured image:', imageData);

						// TODO: Upload to server using fetch() if needed
					});

					// Start webcam on page load
					initWebcam();
				},
				preConfirm: () => {
				    swal.showLoading();
				    return new Promise(resolve => {
				    	let bool = true;

				    	let check = ["fname","lname","gender","contact"];
				    	let flag = false;

				    	check.forEach(field => {
				    		$(`#${field}`).removeClass('border-danger');
				    		if($(`#${field}`).val() == ""){
				    			$(`#${field}`).addClass('border-danger');
				    			flag = true;
				    		}
				    	});

			            if(flag){
			                Swal.showValidationMessage('Highlighted fields are required');
			            }
			            
			            bool ? setTimeout(() => {resolve()}, 500) : "";
				    });
				},
			}).then(result => {
				if(result.value){
					swal.showLoading();
					let userData = {
						id: user.id,
						fname: $("#fname").val(),
						mname: $("#mname").val(),
						lname: $("#lname").val(),
						suffix: $("#suffix").val(),
						birthday: $("#birthday").val(),
						gender: $("#gender").val(),
						contact: $("#contact").val(),
						email: $("#email").val(),
						address: $("#address").val(),
					};

					let patientData = {
						id: user.patient.id,
						birth_place: $("#birth_place").val(),
						civil_status: $("#civil_status").val(),
						nationality: $("#nationality").val(),
						religion: $("#religion").val(),
						hmo_provider: $("#hmo_provider").val(),
						hmo_number: $("#hmo_number").val(),
						employment_status: $("#employment_status").val(),
						company_name: $("#company_name").val(),
						company_position: $("#company_position").val(),
						company_contact: $("#company_contact").val(),
						sss: $("#sss").val(),
						tin_number: $("#tin_number").val(),
						imageData: imageData
					};

					update({
						url: "{{ route('user.update') }}",
						data: userData
					}, () => {
						update({
							url: "{{ route('patient.update') }}",
							data: patientData,
							message: "Successfully Updated"
						}, () => {
							reload();
						})
					});
				}
			});
		}

		function soap(user){

			Swal.fire({
    			confirmButtonText: "OK",
				allowEscapeKey: false,
				allowOutsideClick: false,
				showCancelButton: true,
				cancelButtonColor: errorColor,
				cancelButtonText: 'Cancel',
				html: `
	                <div class="row">
                    	<section class="col-lg-12">
                    		<ul class="nav nav-pills ml-auto" style="padding-left: revert;">
                    		    <li class="nav-item">
                    		        <a class="nav-link active" href="#charts" data-toggle="tab">
                    		            Charts
                    		        </a>
                    		    </li>
                    		    &nbsp;
                    		    <li class="nav-item">
                    		        <a class="nav-link" href="#soap" data-toggle="tab">
                    		            SOAP
                    		        </a>
                    		    </li>
                    		</ul>

        					<br>

        					{{-- CONTENT START --}}
        					<div class="tab-content p-0">

        						{{-- CHARTS START --}}
        					    <div class="chart tab-pane active" id="charts" style="position: relative;">
		    	                    <div class="card">
		    	                        <div class="card-header row">
		    	                            <div class="col-md-12">
		    	                                <h3 class="card-title" style="width: 100%; text-align: left;">
		    	                                    <i class="fas fa-chart-user mr-1"></i>

		    	                                    Charts

		    	                                </h3>
		    	                            </div>
		    	                        </div>

		    	                        <div class="card-body">
				                    		<ul class="nav nav-pills ml-auto" style="padding-left: revert;">
				                    		    <li class="nav-item">
				                    		        <a class="nav-link active" href="#history" data-toggle="tab">
				                    		            History
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#clinic_history" data-toggle="tab">
				                    		            Clinic History
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#vital_signs" data-toggle="tab">
				                    		            Vital Signs
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#prescriptions" data-toggle="tab">
				                    		            Prescriptions
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#laboratory" data-toggle="tab">
				                    		            Prescriptions
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#imaging" data-toggle="tab">
				                    		            Prescriptions
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#files" data-toggle="tab">
				                    		            Prescriptions
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#vaccine" data-toggle="tab">
				                    		            Prescriptions
				                    		        </a>
				                    		    </li>
				                    		</ul>

				        					<br>

				        					<div class="tab-content p-0">
				        					    <div class="chart tab-pane active" id="history" style="position: relative;">
				        					    	History
				        					    </div>

				        					    <div class="chart tab-pane" id="clinic_history" style="position: relative;">
				        					    	Clinic History
				        					    </div>

				        					    <div class="chart tab-pane" id="vital_signs" style="position: relative;">
				        					    	Vital Signs
				        					    </div>

				        					    <div class="chart tab-pane" id="prescriptions" style="position: relative;">
				        					    	Prescriptions
				        					    </div>

				        					    <div class="chart tab-pane" id="laboratory" style="position: relative;">
				        					    	Laboratory
				        					    </div>

				        					    <div class="chart tab-pane" id="imaging" style="position: relative;">
				        					    	Imaging
				        					    </div>

				        					    <div class="chart tab-pane" id="files" style="position: relative;">
				        					    	Files
				        					    </div>

				        					    <div class="chart tab-pane" id="vaccine" style="position: relative;">
				        					    	Vaccine
				        					    </div>
				        					</div>
		    	                        </div>
		    	                    </div>
        					    </div>
        					    {{-- CHARTS END --}}

        					    {{-- SOAP START --}}
        					    <div class="chart tab-pane" id="soap" style="position: relative;">
		    	                    <div class="card">
		    	                        <div class="card-header row">
		    	                            <div class="col-md-12">
		    	                                <h3 class="card-title" style="width: 100%; text-align: left;">
		    	                                    <i class="fas fa-notes-medical mr-1"></i>

		    	                                    SOAP

		    	                                </h3>
		    	                            </div>
		    	                        </div>

		    	                        <div class="card-body">
				                    		<ul class="nav nav-pills ml-auto" style="padding-left: revert;">
				                    		    <li class="nav-item">
				                    		        <a class="nav-link active" href="#subjective" data-toggle="tab">
				                    		            Subjective
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#objective" data-toggle="tab">
				                    		            Objective
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#assessment" data-toggle="tab">
				                    		            Assessment
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#plan" data-toggle="tab">
				                    		            Plan
				                    		        </a>
				                    		    </li>
				                    		</ul>

				        					<br>

				        					<div class="tab-content p-0">
				        					    <div class="chart tab-pane active" id="subjective" style="position: relative;">
				        					    	Subjective
				        					    </div>

				        					    <div class="chart tab-pane" id="objective" style="position: relative;">
				        					    	Objective
				        					    </div>

				        					    <div class="chart tab-pane" id="assessment" style="position: relative;">
				        					    	Assessment
				        					    </div>

				        					    <div class="chart tab-pane" id="plan" style="position: relative;">
				        					    	Plan
				        					    </div>
				        					</div>
		    	                        </div>
		    	                    </div>
		    	                    {{-- SOAP END --}}
        					    </div>
        					</div>
    	                </section>
	                </div>
				`,
				width: '1200px',
				didOpen: () => {
					$('.pInfo').parent().css('text-align', 'left');
					$('#swal2-html-container .card-header').css('margin', "1px");
					$('#swal2-html-container .card-header').css('background-color', "#83c8e5");
					$('#swal2-html-container .card-body').css('border', "1px solid rgba(0,0,0,0.125)");

					$('#birthday').flatpickr({
						altInput: true,
						altFormat: "M j, Y",
						dateFormat: "Y-m-d",
						maxDate: moment().format("YYYY-MM-DD")
					});
				},
				preConfirm: () => {
				    swal.showLoading();
				    return new Promise(resolve => {
				    	let bool = true;

				    	let check = ["fname","lname","gender","contact"];
				    	let flag = false;

				    	check.forEach(field => {
				    		$(`#${field}`).removeClass('border-danger');
				    		if($(`#${field}`).val() == ""){
				    			$(`#${field}`).addClass('border-danger');
				    			flag = true;
				    		}
				    	});

			            if(flag){
			                Swal.showValidationMessage('Highlighted fields are required');
			            }
			            
			            bool ? setTimeout(() => {resolve()}, 500) : "";
				    });
				},
			}).then(result => {
				if(result.value){
					swal.showLoading();
					uploadPatient({
						fname: $("#fname").val(),
						mname: $("#mname").val(),
						lname: $("#lname").val(),
						suffix: $("#suffix").val(),
						birthday: $("#birthday").val(),
						birth_place: $("#birth_place").val(),
						gender: $("#gender").val(),
						civil_status: $("#civil_status").val(),
						nationality: $("#nationality").val(),
						religion: $("#religion").val(),
						contact: $("#contact").val(),
						email: $("#email").val(),
						address: $("#address").val(),
						hmo_provider: $("#hmo_provider").val(),
						hmo_number: $("#hmo_number").val(),
						employment_status: $("#employment_status").val(),
						company_name: $("#company_name").val(),
						company_position: $("#company_position").val(),
						company_contact: $("#company_contact").val(),
						sss: $("#sss").val(),
						tin_number: $("#tin_number").val(),
						_token: $('meta[name="csrf-token"]').attr('content')
					});
				}
			});
		}
	</script>
@endpush