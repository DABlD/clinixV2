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
                    		<tbody>

                    			<!-- Patient 1 -->
								{{-- <div class="patient-card d-flex align-items-center justify-content-between flex-wrap">
								    <div class="d-flex align-items-center">
								        <img src="https://placehold.co/64" class="avatar me-3" alt="Avatar">
								        <div>
								            <h6 class="mb-0 text-uppercase fw-bold">Doe, John</h6>
								            <div class="text-muted small">Male</div>
								            <div class="text-secondary small">PATIENT_ID</div>
								            <a class="visit-link" onclick="toggleVisit(this)">visit ↑</a>
								            <div class="visit-actions">
								                <div class="d-flex gap-2 mt-2 flex-wrap">
								                    <img src="https://placehold.co/40?text=H" class="action-icon" title="History">
								                    <img src="https://placehold.co/40?text=V" class="action-icon" title="Vitals">
								                    <img src="https://placehold.co/40?text=P" class="action-icon" title="Prescription">
								                    <img src="https://placehold.co/40?text=L" class="action-icon" title="Lab">
								                </div>
								            </div>
								        </div>
								    </div>
								    <div class="text-end">
								        <button class="btn btn-primary btn-sm mb-2">SOAP Note</button><br>
								        <div class="form-check form-switch d-inline-flex align-items-center">
								            <input class="form-check-input" type="checkbox" checked>
								            <label class="form-check-label small ms-1">Active Patient</label>
								        </div>
								    </div>
								</div> --}}


                    		</tbody>
                    	</table>
                    </div>
                </div>
            </section>

			<div class="modal fade" id="bs-diagnosis" tabindex="-1">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h5>Select a Diagnosis</h5>
			            </div>

			            <div class="modal-body">
			            	<table class="table table-hover">
			            		<thead>
			            			<tr>
			            				<th>Name</th>
			            				<th>Action</th>
			            			</tr>
			            		</thead>
			            		<tbody>
			            		</tbody>
			            	</table>
			            </div>

			            <div class="modal-footer">
			                <button id="bs-diagnosis-submit" class="btn btn-primary">Confirm</button>
			            </div>
			        </div>
			    </div>
			</div>

			<div class="modal fade" id="bs-icd" tabindex="-1">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h5>Select an ICD</h5>
			            </div>

			            <div class="modal-body">
			            	<table class="table table-hover">
			            		<thead>
			            			<tr>
			            				<th>Code</th>
			            				<th>ICD</th>
			            				<th>Action</th>
			            			</tr>
			            		</thead>
			            		<tbody>
			            		</tbody>
			            	</table>
			            </div>

			            <div class="modal-footer">
			                <button id="bs-icd-submit" class="btn btn-primary">Confirm</button>
			            </div>
			        </div>
			    </div>
			</div>

			<div class="modal fade" id="bs-rvu" tabindex="-1">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h5>Select an RVU</h5>
			            </div>

			            <div class="modal-body">
			            	<table class="table table-hover">
			            		<thead>
			            			<tr>
			            				<th>Code</th>
			            				<th>RVU</th>
			            				<th>Action</th>
			            			</tr>
			            		</thead>
			            		<tbody>
			            		</tbody>
			            	</table>
			            </div>

			            <div class="modal-footer">
			                <button id="bs-rvu-submit" class="btn btn-primary">Confirm</button>
			            </div>
			        </div>
			    </div>
			</div>

        </div>
    </div>

</section>

@endsection

@push('styles')
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

	<style>
		.patient-card {
		      background: #fff;
		      border-radius: 10px;
		      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
		      padding: 1rem 1.5rem;
		      margin-bottom: 1rem;
		      transition: box-shadow .3s;
		    }
		    .patient-card:hover {
		      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
		    }
		    .avatar {
		      width: 64px;
		      height: 64px;
		      border-radius: 50%;
		      object-fit: cover;
		      margin-right: 10px;
		    }
		    .visit-actions {
		      display: none;
		      margin-top: .5rem;
		    }
		    .visit-link {
		      font-size: 0.9rem;
		      font-weight: 500;
		      color: #0d6efd;
		      cursor: pointer;
		      text-decoration: none;
		    }
		    .visit-link:hover { text-decoration: underline; }
		    .action-icon {
		      width: 50px;
		      height: 50px;
		      border-radius: 8px;
		      border: 1px solid #ddd;
		      padding: 5px;
		      transition: background .2s;
		      background: #fafafa;
		    }
		    .action-icon:hover {
		      background: #e8f0ff;
		    }

		.action-icon {
			width: 40px;
			height: 40px;
			border-radius: 8px;
			transition: transform 0.25s ease, box-shadow 0.25s ease;
		}

		.action-icon:hover {
			transform: scale(1.15);
			box-shadow: 0 0 10px rgba(13, 110, 253, 0.5);
		}

		.action-icon {
			transition: transform 0.25s ease, filter 0.25s ease;
		}

		.action-icon:hover {
			transform: translateY(-4px);
			filter: brightness(1.3);
		}
		#vital_signs .card {
			background-color: #f7fdfc;
			border: none;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(180, 180, 180, 0.2);
		}
		#vital_signs th {
			background-color: #d5f4e6; /* pastel green */
			color: #333;
		}
		#vital_signs  td {
			background-color: #fef9e7; /* pastel yellow */
			color: #555;
		}
		#vital_signs .table > :not(caption) > * > * {
			vertical-align: middle;
			text-align: center;
		}

		#soapCard .nav-pills>li>a {
	    	border-top: 3px solid !important;
	    }

	    #soapCard .nav-link.active {
	    	color: #fff !important;
	    	background-color: #337ab7 !important;
	    }

	    .header-row			{ border-left: 4px solid #FAFAFA !important; background-color: #FAFAFA !important; }
	    .section-subjective { border-left: 4px solid #E6F4EA !important; background-color: #E6F4EA !important; }
	    .section-objective  { border-left: 4px solid #E7F0FA !important; background-color: #E7F0FA !important; }
	    .section-assessment { border-left: 4px solid #F2E8F9 !important; background-color: #F2E8F9 !important; }
	    .section-plan       { border-left: 4px solid #FFF2E6 !important; background-color: #FFF2E6 !important; }
	</style>
@endpush

@push('scripts')
	{{-- <script src="{{ asset('js/datatables.min.js') }}"></script> --}}
	<script src="{{ asset('js/datatables.bundle.min.js') }}"></script>
	<script src="{{ asset('js/select2.min.js') }}"></script>
	{{-- <script src="{{ asset('js/datatables.bootstrap4.min.js') }}"></script> --}}
	{{-- <script src="{{ asset('js/datatables-jquery.min.js') }}"></script> --}}
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

	<script>
		var subjective = [], objective = [], assessment = [], plan = [];
		var stream = null;

		var search = null;
		var page = 0;

		$(document).ready(()=> {
			getPatients();
		});

		function proceedSearch() {
			search = document.getElementById('searchInput').value;
			console.log(search);
			getPatients();
		}

		function toggleVisit(link) {
		    const actions = link.nextElementSibling;
		    const isVisible = actions.style.display === 'block';
		    actions.style.display = isVisible ? 'none' : 'block';
		    link.textContent = isVisible ? 'Visit ↑' : 'Visit ↓';
		  }

		function getPatients(){
			const limit = 10;
			$.ajax({
				url: "{{ route('patient.get') }}",
				data: {
					select: "patients.*",
					load: ['user'],
					filters: true,
					search: search,
					offset: page * limit,
					limit: limit
				},
				success: patients => {
					patients = JSON.parse(patients);
					let tc = patients.tc;

					patients = patients.patients;


					let patientString = "";

					if(patients.length){
						patients.forEach(patient => {
							patientString += `
								<div class="patient-card d-flex align-items-center justify-content-between flex-wrap">
								    <div class="d-flex align-items-center">
								        <img src="${patient.user.avatar}" class="avatar me-3" alt="Avatar">
								        <div>
								            <h6 class="mb-0 text-uppercase fw-bold">${patient.user.lname}, ${patient.user.fname} ${patient.user.mname}</h6>
								            <div class="text-muted small">${patient.user.gender}</div>
								            <div class="text-secondary small">${patient.patient_id}</div>
								            <a class="visit-link" onclick="toggleVisit(this)">visit ↑</a>
								            <div class="visit-actions">
								                <div class="d-flex gap-2 mt-2 flex-wrap">
								                    <img src="{{ asset('images/icons/med_history.png') }}" class="action-icon" onclick="medicalHistoryChart(${patient.user_id})" title="Medical History"> &nbsp;
								                    <img src="{{ asset('images/icons/clinic_history.png') }}" class="action-icon" onclick="clinicHistoryChart(${patient.user_id})" title="Clinic History"> &nbsp;
								                    <img src="{{ asset('images/icons/vital_sign.png') }}" class="action-icon" onclick="vitalSignsChart(${patient.user_id})" title="Vital Signs"> &nbsp;
								                    <img src="{{ asset('images/icons/prescription.png') }}" class="action-icon" onclick="prescriptionChart(${patient.user_id})" title="Prescription"> &nbsp;
								                    <img src="{{ asset('images/icons/lab_request.png') }}" class="action-icon" onclick="labRequestChart(${patient.user_id})" title="Lab Request"> &nbsp;
								                    <img src="{{ asset('images/icons/imaging.png') }}" class="action-icon" onclick="imagingChart(${patient.user_id})" title="Imaging"> &nbsp;
								                    <img src="{{ asset('images/icons/files.png') }}" class="action-icon" onclick="filesChart(${patient.user_id})" title="Files"> &nbsp;
								                    <img src="{{ asset('images/icons/vaccine.png') }}" class="action-icon" onclick="vaccineChart(${patient.user_id})" title="Vaccine">
								                </div>
								            </div>
								        </div>
								    </div>
								    <div class="text-end">
								        <a class="btn btn-primary btn-sm mb-2" href="{{ url('soap') }}?userid=${patient.user_id}">SOAP Note</a><br>
								        <div class="form-check form-switch d-inline-flex align-items-center">
								            <input class="form-check-input" type="checkbox">
								            <label class="form-check-label small ms-1">Active Patient</label>
								        </div>
								    </div>
								</div>
							`;
						});
					}
					else{
						patientString = `
							<div class="row">
								<div class="col-md-12">
									No patient record yet.
								</div>
							</div>
						`;
					}

					let prevBtn = "";
					let nextBtn = "";

					if(page > 0){
						prevBtn += `
							<button class="btn btn-outline-primary btn-sm" id="prevBtn" onclick="goPrev()">
								<i class="fas fa-chevron-left"></i> Previous
							</button>
						`;
					}

					console.log(page, (tc / limit));
					if(page < (tc / limit) - 1){
						nextBtn += `
							<button class="btn btn-outline-primary btn-sm" id="nextBtn" onclick="goNext()">
								Next <i class="fas fa-chevron-right"></i>
							</button>
						`;
					}

					$('#table tbody').html(`
						${patientString}

						<div class="d-flex justify-content-end align-items-center mt-3 gap-3 mt-3 flex-wrap">
							<span class="text-muted small" id="pageInfo">Page ${page+1} of ${Math.ceil(tc / limit)}</span>
							&nbsp;
							&nbsp;
							${prevBtn}
							${nextBtn}
						</div>
						<br>
					`);
				}
			})
		}

		function goPrev(){
			page--;
			getPatients();
		}

		function goNext(){
			page++;
			getPatients();
		}

		function medicalHistoryChart(uid){
			if(uid){
				$.ajax({
					url: "{{ route('user.get') }}",
					data: {
						select: "*",
						where: ['id', uid],
						load: ['patient.mhr']
					},
					success: result => {
						result = JSON.parse(result)[0];
						let mhr = result.patient.mhr;
						let qwa = JSON.parse(mhr.qwa);

						let string = "";
						let bool = false;

						qwa.forEach(row => {
							if(row.type == "Category"){
								if(bool){
									string += `
										</tbody>
										</table>
									`;
								}

								string += `
									<div class="row ">
	                                    <div class="col-md-12" style="text-align: left;">
	                                        <b style="font-size: 1.5rem;">${row.question}</b>
	                                    </div>
	                                </div>

									<table class="table table-hover">
										<thead>
											<tr>
												<th style="width: 40%;">Name</th>
												<th style="width: 30%;">Answer</th>
												<th style="width: 30%;">Remark</th>
											</tr>
										</thead>
										<tbody>
								`;

								bool = true;
							}
							else{
								string += `
									<tr>
										<td style="text-align: left;">${row.question}</td>
										<td>${row.answer ?? "-"}</td>
										<td>${row.remark ?? "-"}</td>
									</tr>
								`;
							}
						});

						Swal.fire({
							title: "Personal Medical History",
							html: `<hr>${string}`,
							showClass: { popup: '' },
							hideClass: { popup: '' },
							width: '1000px',
						})
					}
				});
			}
			else{
				se('No selected patient');
			}
		}

		function clinicHistoryChart(uid){
			if(uid){
				$.ajax({
					url: "{{ route('soap.get') }}",
					data: {
						select: "*",
						where: ['user_id', uid]
					}, 
					success: result => {
						result = JSON.parse(result);

						let string = "";

						result.forEach(soap => {
							string += `
								<div class="container my-4">
								    <!-- Header Row -->
								    <div class="d-flex justify-content-between align-items-center border p-2 rounded header-row">
								        <div>
								            <strong>Date:</strong> ${toDate(soap.created_at, 'ddd MMM DD, YYYY hh:MM A')}
								        </div>
								        <button class="btn btn-sm btn-info caret-soap" data-bs-toggle="collapse" data-bs-target="#soapDetails${soap.id}" aria-expanded="true">
								            <i class='fas fa-caret-up'></i>
								        </button>
								    </div>
								    <!-- Collapsible SOAP Section -->
								    <div class="collapse mt-3 soapDetails" id="soapDetails${soap.id}">
								        <div class="row g-3">
								            <!-- Subjective -->
								            <div class="col-12">
								                <div class="card border-start border-4 border-success">
								                    <div class="card-header fw-bold section-subjective">Subjective</div>
								                    <div class="card-body">
								                        <p><strong>Type of Visit:</strong> ${soap.s_type_of_visit}</p>
								                        <p><strong>Chief Complaint:</strong> ${soap.s_chief_complaint}</p>
								                    </div>
								                </div>
								            </div>
								            <!-- Objective -->
								            <div class="col-12">
								                <div class="card border-start border-4 border-primary">
								                    <div class="card-header fw-bold section-objective">Objective</div>
								                    <div class="card-body">
								                    	<div class="row" style="width: 100%;">
								                    		<div class="col-md-6">
										                        <p><strong>Vitals:</strong> ${soap.o_systolic}/${soap.o_diastolic}</p>
										                        <p><strong>Pulse:</strong> ${soap.o_pulse} ${soap.o_pulse_type}</p>
										                        <p><strong>Temperature:</strong> ${soap.o_temperature} ${soap.o_temperature_unit} (${soap.o_temperature_location})</p>
										                        <p><strong>Respiration:</strong> ${soap.o_respiration_rate} ${soap.o_respiration_type}</p>
										                    </div>
								                    		<div class="col-md-6">
										                        <p><strong>O2 Sat:</strong> ${soap.o_o2_sat}</p>
										                        <p><strong>Height:</strong> ${soap.o_height} ${soap.o_height_unit}</p>
										                        <p><strong>Weight:</strong> ${soap.o_weight} ${soap.o_weight_unit}</p>
										                    </div>
										                </div>
								                    </div>
								                </div>
								            </div>
								            <!-- Assessment -->
								            <div class="col-12">
								                <div class="card border-start border-4 border-warning">
								                    <div class="card-header fw-bold section-assessment">Assessment</div>
								                    <div class="card-body">
								                        <p><strong>Diagnosis:</strong> ${soap.a_diagnosis}</p>
								                    </div>
								                </div>
								            </div>
								            <!-- Plan -->
								            <div class="col-12">
								                <div class="card border-start border-4 border-info">
								                    <div class="card-header fw-bold section-plan">Plan</div>
								                    <div class="card-body">
								                        <p><strong>Diagnostic Care Plan:</strong> ${soap.p_diagnosis_care_plan}</p>
								                        <p><strong>Therapeutic Care Plan:</strong> ${soap.p_therapeutic_care_plan}</p>
								                        <p><strong>Doctor's Note:</strong> ${soap.p_doctors_note}</p>
								                    </div>
								                </div>
								            </div>
								        </div>
								    </div>
								</div>
							`;
						});

						Swal.fire({
							title: "Clinic History",
							html: `<hr>${string}`,
							showClass: { popup: '' },
							hideClass: { popup: '' },
							width: '1000px',
						})
					}
				})
			}
			else{
				se('No selected patient');
			}
		}

		function vitalSignsChart(uid){
			if(uid){
				$.ajax({
					url: "{{ route('soap.get') }}",
					data: {
						select: "*",
						where: ['user_id', uid]
					}, 
					success: result => {
						result = JSON.parse(result);

						let string = `
							<div id="vital_signs">
							<table class="table table-bordered rounded">
							    <thead>
							        <tr>
							            <th>Date</th>
							            <th>Blood Pressure</th>
							            <th>Pulse Rate</th>
							            <th>Temperature</th>
							            <th>Respiratory Rate</th>
							            <th>O2 SAT</th>
							            <th>Weight</th>
							            <th>Height</th>
							        </tr>
							    </thead>
							    <tbody>
						`;

						result.forEach(soap => {
							string += `
						        <tr>
						            <td>${toDate(soap.created_at)}</td>
						            <td>${soap.o_systolic}/${soap.o_diastolic}</td>
						            <td>${soap.o_pulse}</td>
						            <td>${soap.o_temperature}</td>
						            <td>${soap.o_respiration_rate}</td>
						            <td>${soap.o_o2_sat}</td>
						            <td>${soap.o_weight} ${soap.o_weight_unit}</td>
						            <td>${soap.o_height} ${soap.o_height_unit}</td>
						        </tr>
							`;
						});

						string += `
							    </tbody>
							</table>
							</div>
						`;

						$('#vital_signs').html(string);

						Swal.fire({
							title: "Vital Signs",
							html: `<hr>${string}`,
							showClass: { popup: '' },
							hideClass: { popup: '' },
							width: '1000px',
						})
					}
				})
			}
			else{
				se('No selected patient');
			}
		}

		function filesChart(uid){
			if(uid){
				$.ajax({
					url: "{{ route('soap.get') }}",
					data: {
						select: "*",
						where: ['user_id', uid]
					}, 
					success: result => {
						result = JSON.parse(result);

						let string = `
							<table class="table table-bordered rounded">
							    <thead>
							        <tr>
							            <th>File</th>
							            <th>Date</th>
							            <th>Actions</th>
							        </tr>
							    </thead>
							    <tbody>
						`;

						result.forEach(soap => {
							let fn = soap.o_drawing.split("/").pop();
							string += `
								        <tr>
								            <td>${fn}</td>
								            <td>${moment.unix(fn.match(/(\d{10})/)[0]).format("MMM DD, YYYY")}</td>
								            <td>
								            	<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" href="${soap.o_drawing}" target="_blank">
								            		<i class="fas fa-search"></i>
								            	</a>
								            </td>
								        </tr>
							`;

							let files = JSON.parse(soap.p_files);
							if(files.length){
								files.forEach(file => {
									let fn = file.split("/").pop();
									
									string += `
										<tr>
										    <td>${fn}</td>
										    <td>${moment.unix(fn.match(/(\d{10})/)[0]).format("MMM DD, YYYY")}</td>
										    <td>
										    	<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" href="${file}" target="_blank">
										    		<i class="fas fa-search"></i>
										    	</a>
										    </td>
										</tr>
									`;
								});
							}
						});

						string += `
							    </tbody>
							</table>
						`;
				
						Swal.fire({
							title: "Uploaded Files",
							html: `<hr>${string}`,
							showClass: { popup: '' },
							hideClass: { popup: '' },
							width: '1000px',
						})
					}
				})
			}
			else{
				se('No selected patient');
			}
		}

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
		                    					<input type="text" id="gender" class="form-control" list="genders">
		                    				</span>
		                    				<datalist id="genders">
		                    					<option value="Male">
		                    					<option value="Female">
		                    				</datalist>
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
					stream = null;

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
				stream.getTracks()[0].stop();;
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
		                    					<input type="text" id="gender" class="form-control" value="${user.gender ?? ""}" list="genders">
		                    				</span>
		                    				<datalist id="genders">
		                    					<option value="Male">
		                    					<option value="Female">
		                    				</datalist>
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
					stream = null;

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
				stream.getTracks()[0].stop();;
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

		function soap(uid){
			subjective = [], objective = [], assessment = [], plan = [];

			Swal.fire({
    			confirmButtonText: "Save",
				allowEscapeKey: false,
				allowOutsideClick: false,
				showCancelButton: true,
				cancelButtonColor: errorColor,
				cancelButtonText: 'Cancel',
				position: 'top',
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
                    		        <a class="nav-link" href="#soap" data-toggle="tab" data-href="subjective">
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
				                    		<ul class="nav nav-pills ml-auto" style="padding-left: revert;" style="text-align: center;">
				                    		    <li class="nav-item">
				                    		        <a class="nav-link active" href="#history" data-toggle="tab" data-href="history">
				                    		            <img src="{{ asset('images/icons/med_history.png') }}" width="30px">
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#clinic_history" data-toggle="tab" data-href="clinic_history">
				                    		            <img src="{{ asset('images/icons/clinic_history.png') }}" width="30px">
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#vital_signs" data-toggle="tab" data-href="vital_signs">
				                    		            <img src="{{ asset('images/icons/vital_sign.png') }}" width="30px">
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#prescriptions" data-toggle="tab" data-href="prescriptions">
				                    		            <img src="{{ asset('images/icons/prescription.png') }}" width="30px">
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#laboratory" data-toggle="tab" data-href="laboratory">
				                    		            <img src="{{ asset('images/icons/lab_request.png') }}" width="30px">
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#imaging" data-toggle="tab" data-href="imaging">
				                    		            <img src="{{ asset('images/icons/imaging.png') }}" width="30px">
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#files" data-toggle="tab" data-href="files">
				                    		            <img src="{{ asset('images/icons/files.png') }}" width="30px">
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#vaccine" data-toggle="tab" data-href="vaccine">
				                    		            <img src="{{ asset('images/icons/vaccine.png') }}" width="30px">
				                    		        </a>
				                    		    </li>
				                    		</ul>

				        					<br>

				        					<div class="tab-content p-0">
				        					    <div class="chart tab-pane active" id="history" style="position: relative;"></div>
												<div class="chart tab-pane" id="clinic_history" style="position: relative;"></div>
												<div class="chart tab-pane" id="vital_signs" style="position: relative;"></div>

				        					    <div class="chart tab-pane" id="prescriptions" style="position: relative;">
				        					    	Prescriptions
				        					    </div>

				        					    <div class="chart tab-pane" id="laboratory" style="position: relative;">
				        					    	Laboratory
				        					    </div>

				        					    <div class="chart tab-pane" id="imaging" style="position: relative;">
				        					    	Imaging
				        					    </div>

				        					    <div class="chart tab-pane" id="files" style="position: relative;"></div>

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
				                    		        <a class="nav-link active" href="#subjective" data-toggle="tab" data-href="subjective">
				                    		            Subjective
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#objective" data-toggle="tab" data-href="objective">
				                    		            Objective
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#assessment" data-toggle="tab" data-href="assessment">
				                    		            Assessment
				                    		        </a>
				                    		    </li>
				                    		    &nbsp;
				                    		    <li class="nav-item">
				                    		        <a class="nav-link" href="#plan" data-toggle="tab" data-href="plan">
				                    		            Plan
				                    		        </a>
				                    		    </li>
				                    		</ul>

				        					<br>

				        					<div class="tab-content p-0">
				        					    <div class="chart tab-pane active" id="subjective" style="position: relative;">
				        					    </div>

				        					    <div class="chart tab-pane" id="objective" style="position: relative;">
				        					    </div>

				        					    <div class="chart tab-pane" id="assessment" style="position: relative;">
				        					    </div>

				        					    <div class="chart tab-pane" id="plan" style="position: relative;">
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

					$('[data-toggle="tab"').on('show.bs.tab', e => {
						let target = $(e.target).data('href');
						$(`#${target}`).prepend('<div class="preloader"></div>');
						
						if(target == "history"){
							getHistory(uid);
						}
						else if(target == "clinic_history"){
							getClinicHistory(uid);
						}
						else if(target == "vital_signs"){
							getVitalSigns(uid);
						}
						else if(target == "files"){
							getFiles(uid);
						}
						else if(target == "subjective"){
							getSubjective(uid);
						}
						else if(target == "objective"){
							getObjective(uid);
						}
						else if(target == "assessment"){
							getAssessment(uid);
						}
						else if(target == "plan"){
							getPlan(uid);
						}
					});
					$('.swal2-html-container .tab-pane').css('min-height', '100px');
					$('[data-href="history"]').trigger('show.bs.tab');
				},
				preConfirm: () => {
				    swal.showLoading();
				    return new Promise(resolve => {
				    	let bool = true;

				    	{{-- let check = ["fname","lname","gender","contact"];
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
			            } --}}
			            
			            bool ? setTimeout(() => {resolve()}, 500) : "";
				    });
				},
			}).then(result => {
				if(result.value){
					swal.showLoading();

					let formData = new FormData();

					let soapS = {
						's_type_of_visit': $('#type_of_visit').val(),
						's_chief_complaint': $('#chief_complaint').val(),
						's_history_of_present_illness': $('#history_of_present_illness').val(),
					};

					let soapO = {
						'o_systolic': $('#bp_systolic').val(),
						'o_diastolic': $('#bp_diastolic').val(),
						'o_pulse': $('#pulse_rate').val(),
						'o_pulse_type': $('#pulse_type').val(),
						'o_temperature': $('#temperature').val(),
						'o_temperature_unit': $('#temp_unit').val(),
						'o_temperature_location': $('#temp_location').val(),
						'o_respiration_rate': $('#respiration_rate').val(),
						'o_respiration_type': $('#respiration_type').val(),
						'o_weight': $('#weight').val(),
						'o_weight_unit': $('#weight_unit').val(),
						'o_height': $('#height').val(),
						'o_height_unit': $('#height_unit').val(),
						'o_o2_sat': $('#o2_sat').val(),
						'o_drawing': (history.length ? canvas.toDataURL("image/png") : null),
						'o_physical_examination': $('#physical_examination').val(),
					};

					let soapA = {
						'a_diagnosis': $('#diagnosis').val(),
					};

					let soapP = {
						'p_diagnosis_care_plan': $('#diagnosis_care_plan').val(),
						'p_therapeutic_care_plan': $('#therapeutic_care_plan').val(),
						'p_doctors_note': $('#doctors_note').val(),
					};

					formData.append('uid', uid);
					formData.append('soapS', JSON.stringify(soapS));
					formData.append('soapO', JSON.stringify(soapO));
					formData.append('soapA', JSON.stringify(soapA));
					formData.append('soapP', JSON.stringify(soapP));

					let fileInput = document.getElementById("p_files");
				    for (let i = 0; i < fileInput.files.length; i++) {
				        formData.append("files[]", fileInput.files[i]);
				    }

		    		formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

				    fetch("{{ route('soap.store') }}", {
			            method: "POST",
			            body: formData
			        }).then(result => {
			        	console.log(result);
			        	ss('Successfully saved SOAP');
			        	setTimeout(() => {
			        		soap(uid);
			        	}, 1000);
			        })
				}
			});
		}

		function getHistory(uid){
			$.ajax({
				url: "{{ route('user.get') }}",
				data: {
					select: "*",
					where: ['id', uid],
					load: ['patient.mhr']
				},
				success: result => {
					result = JSON.parse(result)[0];
					let mhr = result.patient.mhr;
					let qwa = JSON.parse(mhr.qwa);

					let string = "";
					let bool = false;

					qwa.forEach(row => {
						if(row.type == "Category"){
							if(bool){
								string += `
									</tbody>
									</table>
								`;
							}

							string += `
								<div class="row ">
                                    <div class="col-md-12" style="text-align: left;">
                                        <b style="font-size: 1.5rem;">${row.question}</b>
                                    </div>
                                </div>

								<table class="table table-hover">
									<thead>
										<tr>
											<th style="width: 40%;">Name</th>
											<th style="width: 30%;">Answer</th>
											<th style="width: 30%;">Remark</th>
										</tr>
									</thead>
									<tbody>
							`;

							bool = true;
						}
						else{
							string += `
								<tr>
									<td style="text-align: left;">${row.question}</td>
									<td>${row.answer ?? "-"}</td>
									<td>${row.remark ?? "-"}</td>
								</tr>
							`;
						}
					});

					$(`#history`).append(string);
				}
			});

			removeLoader();
		}

		function getClinicHistory(uid){
			$.ajax({
				url: "{{ route('soap.get') }}",
				data: {
					select: "*",
					where: ['user_id', uid]
				}, 
				success: result => {
					result = JSON.parse(result);

					let string = "";

					result.forEach(soap => {
						string += `
							<div class="container my-4">
							    <!-- Header Row -->
							    <div class="d-flex justify-content-between align-items-center border p-2 rounded header-row">
							        <div>
							            <strong>Date:</strong> ${toDate(soap.created_at, 'ddd MMM DD, YYYY hh:MM A')}
							        </div>
							        <button class="btn btn-sm btn-info caret-soap" data-bs-toggle="collapse" data-bs-target="#soapDetails${soap.id}" aria-expanded="true">
							            <i class='fas fa-caret-up'></i>
							        </button>
							    </div>
							    <!-- Collapsible SOAP Section -->
							    <div class="collapse mt-3 soapDetails" id="soapDetails${soap.id}">
							        <div class="row g-3">
							            <!-- Subjective -->
							            <div class="col-12">
							                <div class="card border-start border-4 border-success">
							                    <div class="card-header fw-bold section-subjective">Subjective</div>
							                    <div class="card-body">
							                        <p><strong>Type of Visit:</strong> ${soap.s_type_of_visit}</p>
							                        <p><strong>Chief Complaint:</strong> ${soap.s_chief_complaint}</p>
							                    </div>
							                </div>
							            </div>
							            <!-- Objective -->
							            <div class="col-12">
							                <div class="card border-start border-4 border-primary">
							                    <div class="card-header fw-bold section-objective">Objective</div>
							                    <div class="card-body">
							                    	<div class="row" style="width: 100%;">
							                    		<div class="col-md-6">
									                        <p><strong>Vitals:</strong> ${soap.o_systolic}/${soap.o_diastolic}</p>
									                        <p><strong>Pulse:</strong> ${soap.o_pulse} ${soap.o_pulse_type}</p>
									                        <p><strong>Temperature:</strong> ${soap.o_temperature} ${soap.o_temperature_unit} (${soap.o_temperature_location})</p>
									                        <p><strong>Respiration:</strong> ${soap.o_respiration_rate} ${soap.o_respiration_type}</p>
									                    </div>
							                    		<div class="col-md-6">
									                        <p><strong>O2 Sat:</strong> ${soap.o_o2_sat}</p>
									                        <p><strong>Height:</strong> ${soap.o_height} ${soap.o_height_unit}</p>
									                        <p><strong>Weight:</strong> ${soap.o_weight} ${soap.o_weight_unit}</p>
									                    </div>
									                </div>
							                    </div>
							                </div>
							            </div>
							            <!-- Assessment -->
							            <div class="col-12">
							                <div class="card border-start border-4 border-warning">
							                    <div class="card-header fw-bold section-assessment">Assessment</div>
							                    <div class="card-body">
							                        <p><strong>Diagnosis:</strong> ${soap.a_diagnosis}</p>
							                    </div>
							                </div>
							            </div>
							            <!-- Plan -->
							            <div class="col-12">
							                <div class="card border-start border-4 border-info">
							                    <div class="card-header fw-bold section-plan">Plan</div>
							                    <div class="card-body">
							                        <p><strong>Diagnostic Care Plan:</strong> ${soap.p_diagnosis_care_plan}</p>
							                        <p><strong>Therapeutic Care Plan:</strong> ${soap.p_therapeutic_care_plan}</p>
							                        <p><strong>Doctor's Note:</strong> ${soap.p_doctors_note}</p>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
							</div>
						`;
					});

					$('#clinic_history').html(string);
				}
			})
		}

		function getVitalSigns(uid){
			$.ajax({
				url: "{{ route('soap.get') }}",
				data: {
					select: "*",
					where: ['user_id', uid]
				}, 
				success: result => {
					result = JSON.parse(result);

					let string = `
						<table class="table table-bordered rounded">
						    <thead>
						        <tr>
						            <th>Date</th>
						            <th>Blood Pressure</th>
						            <th>Pulse Rate</th>
						            <th>Temperature</th>
						            <th>Respiratory Rate</th>
						            <th>O2 SAT</th>
						            <th>Weight</th>
						            <th>Height</th>
						        </tr>
						    </thead>
						    <tbody>
					`;

					result.forEach(soap => {
						string += `
							        <tr>
							            <td>${toDate(soap.created_at)}</td>
							            <td>${soap.o_systolic}/${soap.o_diastolic}</td>
							            <td>${soap.o_pulse}</td>
							            <td>${soap.o_temperature}</td>
							            <td>${soap.o_respiration_rate}</td>
							            <td>${soap.o_o2_sat}</td>
							            <td>${soap.o_weight} ${soap.o_weight_unit}</td>
							            <td>${soap.o_height} ${soap.o_height_unit}</td>
							        </tr>
						`;
					});

					string += `
						    </tbody>
						</table>
					`;

					$('#vital_signs').html(string);
				}
			})
		}

		function getFiles(uid){
			$.ajax({
				url: "{{ route('soap.get') }}",
				data: {
					select: "*",
					where: ['user_id', uid]
				}, 
				success: result => {
					result = JSON.parse(result);

					let string = `
						<table class="table table-bordered rounded">
						    <thead>
						        <tr>
						            <th>File</th>
						            <th>Date</th>
						            <th>Actions</th>
						        </tr>
						    </thead>
						    <tbody>
					`;

					result.forEach(soap => {
						let fn = soap.o_drawing.split("/").pop();
						string += `
							        <tr>
							            <td>${fn}</td>
							            <td>${moment.unix(fn.match(/(\d{10})/)[0]).format("MMM DD, YYYY")}</td>
							            <td>
							            	<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" href="${soap.o_drawing}" target="_blank">
							            		<i class="fas fa-search"></i>
							            	</a>
							            </td>
							        </tr>
						`;

						let files = JSON.parse(soap.p_files);
						if(files.length){
							files.forEach(file => {
								let fn = file.split("/").pop();
								
								string += `
									<tr>
									    <td>${fn}</td>
									    <td>${moment.unix(fn.match(/(\d{10})/)[0]).format("MMM DD, YYYY")}</td>
									    <td>
									    	<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" href="${file}" target="_blank">
									    		<i class="fas fa-search"></i>
									    	</a>
									    </td>
									</tr>
								`;
							});
						}
					});

					string += `
						    </tbody>
						</table>
					`;

					$('#files').html(string);
				}
			})
		}
		
		function getSubjective(uid){
			// do not proceed if already initiated
			if(subjective.length){
				removeLoader();
				return;
			}

			let string = "";

			let complaints = [
				"Abdominal pain and watery stool for 3 days",
				"Abdominal pain with an acidic feel of vomiting",
				"Cataract",
				"Check up",
				"Chest pain during activity exertion",
				"Consultation",
				"Vaccine schedule"
			];

			string += `
				<div class="row iRow" style="margin-bottom: 10px;">
				    <div class="col-md-3 iLabel">
				        Type of Visit
				    </div>
				    <div class="col-md-9 iInput">
				        <select id="type_of_visit" style="width: 100%;">
				        	<option value="">Select One</option>
				        	<option value="Walk-in Patient">Walk-in Patient</option>
				        	<option value="Referral Patient">Referral Patient</option>
				        	<option value="Follow-up Patient">Follow-up Patient</option>
				        </select>
				    </div>
				</div>

				<div class="row iRow" style="margin-bottom: 10px;">
				    <div class="col-md-3 iLabel">
				        Chief Complaint
				    </div>
				    <div class="col-md-9 iInput">
				        <select id="chief_complaint" style="width: 100%;">
				        	<option value="">Select One</option>
				        </select>
				    </div>
				</div>

				<div class="row iRow">
				    <div class="col-md-3 iLabel">
				        History of Present Illness
				    </div>
				    <div class="col-md-9 iInput">
				        <textarea id="history_of_present_illness" class="form-control" rows="7"></textarea>
				    </div
				</div>
			`;

			$('#subjective').append(string);
			$('#type_of_visit').select2();
			$('#chief_complaint').select2({
				data: complaints,
				tags: true
			});

			subjective['type_of_visit'] = null;
			subjective['chief_complaint'] = null;
			subjective['history_of_present_illness'] = null;
			subjective.length = 1;

			removeLoader();
		}

		function getObjective(uid){
			// do not proceed if already initiated
			if(objective.length){
				removeLoader();
				return;
			}

			let string = "";

			string += `
                <div class="row">
                	<section class="col-lg-12">
                		<ul class="nav nav-pills ml-auto" style="padding-left: revert;">
                		    <li class="nav-item" style="width: 30%;">
                		        <a class="nav-link active" href="#vitals" data-toggle="tab">
                		            Vitals
                		        </a>
                		    </li>
                		    &nbsp;
                		    <li class="nav-item" style="width: 30%;">
                		        <a class="nav-link" href="#drawing" data-toggle="tab">
                		            Drawing
                		        </a>
                		    </li>
                		    &nbsp;
                		    <li class="nav-item" style="width: 30%;">
                		        <a class="nav-link" href="#exam" data-toggle="tab">
                		            Exam
                		        </a>
                		    </li>
                		</ul>

    					<br>

    					{{-- CONTENT START --}}
    					<div class="tab-content p-0">

    					    <div class="chart tab-pane active" id="vitals" style="position: relative;">
	    	                    <div class="card">
	    	                        <div class="card-body">

			                    		<div class="row">
			                    			<div class="col-md-6">
												<label class="form-label" style="float: left;">Blood Pressure</label>
												<div class="input-group">
													<input type="text" class="form-control" id="bp_systolic" placeholder="Systolic">
													<strong class="input-group-text">/</strong>
													<input type="text" class="form-control" id="bp_diastolic" placeholder="Diastolic">
												</div>
			                    			</div>

											<div class="col-md-6">
												<label class="form-label" style="float: left;">Pulse</label>
												<div class="input-group">
												    <input type="text" class="form-control" id="pulse_rate" placeholder="Pulse">
												    <select class="form-control" id="pulse_type">
												        <option>Regular</option>
												        <option>Irregular</option>
												    </select>
												</div>
											</div>
			                    		</div>

			                    		<div class="row" style="margin-top: 15px;">
			                    			<div class="col-md-6">
												<label class="form-label" style="float: left;">Temperature</label>
												<div class="input-group">
												    <input type="text" class="form-control" id="temperature" placeholder="Temp">
												    <select class="form-control" id="temp_unit">
												        <option>Celsius</option>
												        <option>Farenheit</option>
												    </select>
												    <select class="form-control" id="temp_location">
												        <option>Underarm</option>
												        <option>Mouth</option>
												        <option>Rectal</option>
												        <option>Skin</option>
												        <option>Ear</option>
												    </select>
												</div>
			                    			</div>

											<div class="col-md-6">
												<label class="form-label" style="float: left;">Respiration Rate</label>
												<div class="input-group">
												    <input type="text" class="form-control" id="respiration_rate" placeholder="Rate">
												    <select class="form-control" id="respiration_type">
												        <option>Regular</option>
												        <option>Irregular</option>
												    </select>
												</div>
											</div>
			                    		</div>

			                    		<div class="row" style="margin-top: 15px;">
			                    			<div class="col-md-6">
												<label class="form-label" style="float: left;">Weight</label>
												<div class="input-group">
												    <input type="text" class="form-control" id="weight" placeholder="Weight">
												    <select class="form-control" id="weight_unit">
												        <option>Kg</option>
												        <option>Lbs</option>
												    </select>
												</div>
			                    			</div>

											<div class="col-md-6">
												<label class="form-label" style="float: left;">O2 SAT</label>
											    <input type="text" class="form-control" id="o2_sat" placeholder="O2 SAT">
											</div>
			                    		</div>

			                    		<div class="row" style="margin-top: 15px;">
			                    			<div class="col-md-6">
												<label class="form-label" style="float: left;">Height</label>
												<div class="input-group">
												    <input type="text" class="form-control" id="height" placeholder="Height">
												    <select class="form-control" id="height_unit">
												        <option>Cm</option>
												        <option>Ft</option>
												    </select>
												</div>
			                    			</div>
			                    		</div>

			                    	</div>
	    	                    </div>
    					    </div>

    					    <div class="chart tab-pane" id="drawing" style="position: relative;">
	    	                    <div class="card">
	    	                        <div class="card-body">
	    	                        	<div class="row">
	    	                        		<div class="col-md-2" style="overflow-y: scroll;" id="drawing_templates">
	    	                        		</div>

	    	                        		<div class="col-md-10">
			                    				<canvas style="border: 1px solid black; cursor: crosshair;" id="canvas"></canvas>
	    	                        		</div>
	    	                        	</div>
			                    		
										<div id="controls">
											<label>Color:
											    <input type="color" id="colorPicker" value="#FF0000">
											</label>
											<label>Brush Size:
											    <input type="range" id="brushSize" min="1" max="50" value="3">
											    <span id="sizeDisplay">3</span> px
											</label>
										</div>

										<br>

										<button id="undoBtn" class="btn btn-primary">Undo</button>
									    <button id="clearBtn" class="btn btn-warning">Clear</button>
									    <button id="saveBtn" class="btn btn-success">Save</button>

			                    	</div>
	    	                    </div>
    					    </div>

    					    <div class="chart tab-pane" id="exam" style="position: relative;">
	    	                    <div class="card">
	    	                        <div class="card-body">
			                    		<div class="row">
			                    			<div class="col-md-12">
												<label class="form-label" style="float: left;">(Physical Examination)</label>
												<div class="input-group">
													<textarea id="physical_examination" class="form-control" rows="7"></textarea>
												</div>
			                    			</div>
			                    		</div>
			                    	</div>
	    	                    </div>
    					    </div>

    					</div>
	                </section>
                </div>
			`;

			$('#objective').append(string);
			let canvas = document.getElementById('canvas');
			let ctx = canvas.getContext('2d');
		    let colorPicker = document.getElementById('colorPicker');
		    let brushSize = document.getElementById('brushSize');
		    let sizeDisplay = document.getElementById('sizeDisplay');

		    let undoBtn = document.getElementById('undoBtn');
	        let clearBtn = document.getElementById('clearBtn');
	        let saveBtn = document.getElementById('saveBtn');

		    let drawing = false;
		    let prevX = 0, prevY = 0;
    		let history = [];

		    canvas.width = 800;
  			canvas.height = 400;

		    canvas.addEventListener('mousedown', (e) => {
		    	saveState(); //Save before drawing
				drawing = true;
				const rect = canvas.getBoundingClientRect();
				prevX = e.clientX - rect.left;
				prevY = e.clientY - rect.top;
		    });

	        canvas.addEventListener('mouseup', () => drawing = false);
	        canvas.addEventListener('mouseleave', () => drawing = false);

	        brushSize.addEventListener('input', () => {
	        	sizeDisplay.textContent = brushSize.value;
	        });

	        canvas.addEventListener('mousemove', (e) => {
				if (!drawing) return;

				const rect = canvas.getBoundingClientRect();
				const x = e.clientX - rect.left;
				const y = e.clientY - rect.top;

				ctx.lineWidth = brushSize.value;
				ctx.lineCap = 'round';
				ctx.strokeStyle = colorPicker.value;

				ctx.beginPath();
				ctx.moveTo(prevX, prevY);
				ctx.lineTo(x, y);
				ctx.stroke();

				prevX = x;
				prevY = y;
            });

            {{-- FOR UNDO --}}
            function saveState() {
				if (history.length >= 50) history.shift(); // Limit to 50 states
				history.push(ctx.getImageData(0, 0, canvas.width, canvas.height));
            }

		    // Restore previous state
		    function undo() {
				if (history.length > 0) {
					const imageData = history.pop();
					ctx.putImageData(imageData, 0, 0);
				}
		    }

		    // Undo button
			undoBtn.addEventListener('click', undo);

		    // Clear canvas
		    clearBtn.addEventListener('click', () => {
				saveState();
				ctx.clearRect(0, 0, canvas.width, canvas.height);
		    });

		    // Save as PNG
		    saveBtn.addEventListener('click', () => {
				const link = document.createElement('a');
				link.download = 'drawing.png';
				link.href = canvas.toDataURL('image/png');
				link.click();
		    });

            // Reset path when mouse is up
            canvas.addEventListener('mouseup', () => ctx.beginPath());

            {{-- LOAD DRAWINGS --}}
            $.ajax({
            	url: "{{ route('template.getDrawing') }}",
            	success: result => {
            		result = JSON.parse(result);

            		let string = "";

            		result.forEach(drawing => {
            			string += `
            				<div class="row shadow" style="margin-bottom: 10px; cursor: pointer;">
            					<div class="col-md-12">
            						<img src="${drawing.image}" width="100%" class="imageToCanvas">
            					</div>
            				</div>
            			`;
            		});

            		$('#drawing_templates').append(string);
            		$('.imageToCanvas').on('click', e => {
            			base_image = new Image();
            			base_image.onload = function(){
            				// Compute scale to fit height
            				const scale = canvas.height / base_image.height;
            				const newWidth = base_image.width * scale;
            				const newHeight = canvas.height;

            				// Optional: Center horizontally
            				const x = (canvas.width - newWidth) / 2;
            				const y = 0;

            				// Draw scaled image
            				ctx.drawImage(base_image, x, y, newWidth, newHeight);
            			}
            			base_image.src = $(e.target).attr('src');
					});
            	}
            });

			objective['bp_systolic'] = null;
			objective['bp_diastolic'] = null;
			objective['pulse_rate'] = null;
			objective['pulse_type'] = null;
			objective['temperature'] = null;
			objective['temp_unit'] = null;
			objective['temp_location'] = null;
			objective['respiration_rate'] = null;
			objective['respiration_type'] = null;
			objective['weight'] = null;
			objective['weight_unit'] = null;
			objective['o2_sat'] = null;
			objective['height'] = null;
			objective['height_unit'] = null;
			objective.length = 1;

			removeLoader();
		}

		function getAssessment(uid){
			// do not proceed if already initiated
			if(assessment.length){
				removeLoader();
				return;
			}

			let string = "";

			string += `
                <div class="card">
                    <div class="card-body">
                		<div class="row">
                			<div class="col-md-12">
								<label class="form-label" style="float: left;">Previous Diagnosis</label>
								
								<textarea class="form-control" rows="4" disabled></textarea>
                			</div>
                		</div>

                		<br>

                		<div class="row">
                			<div class="col-md-12">
								<label class="form-label" style="float: left;">
									Diagnosis
								</label>

								<div style="float: right;">
									<button class="btn btn-primary" id="callPreviousDiagnosis">Previous Diagnosis</button>
									<button class="btn btn-primary" id="callDiagnosis">Diagnosis</button>
									<button class="btn btn-primary" id="callICD">ICD</button>
								</div>

								<br>
								<br>

								<textarea id="diagnosis" class="form-control" rows="7"></textarea>
                			</div>
                		</div>
                	</div>
                </div>
			`;

			assessment['diagnosis'] = null;
			assessment.length = 1;

			$('#assessment').append(string);
			removeLoader();

			$('#callDiagnosis').on('click', e => {
				modalOne = new bootstrap.Modal(document.getElementById('bs-diagnosis'), {
					backdrop: 'static',
					keyboard: false
				});
				modalOne.show();

				$.ajax({
					url: "{{ route('template.getDiagnosis') }}",
					success: result => {
						result = JSON.parse(result);

						let string = "";
						if(result.length){
							result.forEach(temp => {
								string += `
									<tr>
										<td>${temp.name}</td>
										<td>
											<input type="checkbox" value="${temp.name}">
										</td>
									</tr>
								`;
							});
						}
						else{
							string += `
								<tr>
									<td colspan="2">No entry. Check in Template Manager</td>
								</tr>
							`;
						}

						$('#bs-diagnosis table tbody').html(string);
					}
				})

				document.getElementById('bs-diagnosis-submit').onclick = function () {
					$('#bs-diagnosis [type="checkbox"]:checked').each((i, cbox) => {
						$('#diagnosis').val($('#diagnosis').val() + ($('#diagnosis').val() ? ", " : "") + cbox.value);
					});

					modalOne.hide();
				};
			});

			$('#callICD').on('click', e => {
				modalTwo = new bootstrap.Modal(document.getElementById('bs-icd'), {
					backdrop: 'static',
					keyboard: false
				});
				modalTwo.show();

				$.ajax({
					url: "{{ route('template.getICD') }}",
					success: result => {
						result = JSON.parse(result);

						let string = "";
						if(result.length){
							result.forEach(temp => {
								string += `
									<tr>
										<td>${temp.code}</td>
										<td>${temp.description}</td>
										<td>
											<input type="checkbox" value="${temp.code + " " + temp.description}">
										</td>
									</tr>
								`;
							});
						}
						else{
							string += `
								<tr>
									<td colspan="2">No entry. Check in Template Manager</td>
								</tr>
							`;
						}

						$('#bs-icd table tbody').html(string);
					}
				})

				document.getElementById('bs-icd-submit').onclick = function () {
					$('#bs-icd [type="checkbox"]:checked').each((i, cbox) => {
						$('#diagnosis').val($('#diagnosis').val() + ($('#diagnosis').val() ? "\n" : "") + cbox.value);
					});

					modalTwo.hide();
				};
			});
		}

		function getPlan(uid){
			// do not proceed if already initiated
			if(plan.length){
				removeLoader();
				return;
			}

			let string = "";

			string += `
                <div class="card">
                    <div class="card-body">
                		<div class="row">
                			<div class="col-md-12">
								<label class="form-label" style="float: left;">
									Diagnosis Care Plan
								</label>

								<div style="float: right;">
									<button class="btn btn-primary">Laboratory Request</button>
									<button class="btn btn-primary">Imaging Request</button>
								</div>

								<br>
								<br>

								<textarea id="diagnosis_care_plan" class="form-control" rows="7"></textarea>
                			</div>
                		</div>

						<br>

                		<div class="row">
                			<div class="col-md-12">
								<label class="form-label" style="float: left;">
									Therapeutic Care Plan
								</label>

								<div style="float: right;">
									<button class="btn btn-primary" id="callPreviousMedication">Previous Medication</button>
									<button class="btn btn-primary" id="callPrescription">Prescription</button>
									<button class="btn btn-primary" id="callCertificate">Certificate</button>
									<button class="btn btn-primary" id="callRVU">RVU</button>
									<button class="btn btn-primary" id="callPediaVaccine">Pedia Vaccine</button>
								</div>

								<br>
								<br>

								<textarea id="therapeutic_care_plan" class="form-control" rows="7"></textarea>
                			</div>
                		</div>
						
						<br>
                		<div class="row">
                			<div class="col-md-12">
								<label class="form-label" style="float: left;">
									File Upload
								</label>

								<input type="file" id="p_files" class="form-control" multiple>
                			</div>
                		</div>
						
						<br>
                		<div class="row">
                			<div class="col-md-12">
								<label class="form-label" style="float: left;">
									Doctors Note
								</label>

								<textarea id="doctors_note" class="form-control" rows="7"></textarea>
                			</div>
                		</div>
                	</div>
                </div>
			`;

			plan['diagnosis_care_plan'] = null;
			plan['therapeutic_care_plan'] = null;
			plan['file'] = null;
			plan['doctors_note'] = null;
			plan.length = 1;

			$('#plan').append(string);
			removeLoader();

			$('#callRVU').on('click', e => {
				modalThree = new bootstrap.Modal(document.getElementById('bs-rvu'), {
					backdrop: 'static',
					keyboard: false
				});
				modalThree.show();

				$.ajax({
					url: "{{ route('template.getRVU') }}",
					success: result => {
						result = JSON.parse(result);

						let string = "";
						if(result.length){
							result.forEach(temp => {
								string += `
									<tr>
										<td>${temp.code}</td>
										<td>${temp.description}</td>
										<td>
											<input type="checkbox" value="${temp.code + " " + temp.description}">
										</td>
									</tr>
								`;
							});
						}
						else{
							string += `
								<tr>
									<td colspan="2">No entry. Check in Template Manager</td>
								</tr>
							`;
						}

						$('#bs-rvu table tbody').html(string);
					}
				})

				document.getElementById('bs-rvu-submit').onclick = function () {
					$('#bs-rvu [type="checkbox"]:checked').each((i, cbox) => {
						$('#therapeutic_care_plan').val($('#therapeutic_care_plan').val() + ($('#therapeutic_care_plan').val() ? "\n" : "") + cbox.value);
					});

					modalThree.hide();
				};
			});
		}

		function removeLoader(){
			setTimeout(() => {
				$('.preloader').remove();
			}, 500);
		}
	</script>
@endpush