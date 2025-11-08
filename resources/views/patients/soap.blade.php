@extends('layouts.app')
@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <section class="col-lg-12 connectedSortable">

                @include('patients.includes.toolbar2')

                <br>
                <div class="row">
				<!-- LEFT COLUMN -->
				<div class="col-md-4">
				    <!-- Patient Card -->
				    <div class="card shadow-sm mb-3">
				        <div class="card-header bg-info text-white justify-content-between align-items-center">
				            <span class="text-bold" style="font-size: 24px;">Px</span>
				            <i class="fas fa-clipboard-prescription fa-2x" style="float: right;"></i>
				        </div>
				        <div class="card-body text-center" id="patient-card">
				            <img src="{{ asset('images/default_avatar.png') }}" class="rounded-circle mb-2" alt="Avatar" width="200px" height="200px">

				            <br>  

				            <div class="row">
				            	<div class="col-md-3">
				            		<strong>Patient ID:</strong>
				            	</div>
				            	<div class="col-md-9">
				            		<div style="text-align: left;" id="pid">-</div>
				            	</div>
				            </div>

				            <div class="row">
				            	<div class="col-md-3">
				            		<strong>Name:</strong>
				            	</div>
				            	<div class="col-md-9">
				            		<div style="text-align: left;" id="pname">-</div>
				            	</div>
				            </div>

				            <div class="row">
				            	<div class="col-md-3">
				            		<strong>Contact No:</strong>
				            	</div>
				            	<div class="col-md-3">
				            		<div style="text-align: left;" id="pcontact">-</div>
				            	</div>
				            	<div class="col-md-3">
				            		<strong>Birthday:</strong>
				            	</div>
				            	<div class="col-md-3">
				            		<div style="text-align: left;" id="pbirthday">-</div>
				            	</div>
				            </div>

				            <div class="row">
				            	<div class="col-md-3">
				            		<strong>Gender:</strong>
				            	</div>
				            	<div class="col-md-3">
				            		<div style="text-align: left;" id="pgender">-</div>
				            	</div>
				            	<div class="col-md-3">
				            		<strong>Age:</strong>
				            	</div>
				            	<div class="col-md-3">
				            		<div style="text-align: left;" id="page">-</div>
				            	</div>
				            </div>

				            <div class="row">
				            	<div class="col-md-3">
				            		<strong>Civil Status:</strong>
				            	</div>
				            	<div class="col-md-3">
				            		<div style="text-align: left;" id="pcivilstatus">-</div>
				            	</div>
				            	<div class="col-md-3">
				            		<strong>Religion:</strong>
				            	</div>
				            	<div class="col-md-3">
				            		<div style="text-align: left;" id="preligion">-</div>
				            	</div>
				            </div>

				            <div class="row">
				            	<div class="col-md-3">
				            		<strong>Nationality:</strong>
				            	</div>
				            	<div class="col-md-9">
				            		<div style="text-align: left;" id="pnationality">-</div>
				            	</div>
				            </div>

				            <div class="row">
				            	<div class="col-md-3">
				            		<strong>Address:</strong>
				            	</div>
				            	<div class="col-md-9">
				            		<div style="text-align: left;" id="paddress">-</div>
				            	</div>
				            </div>

				            <div class="row">
				            	<div class="col-md-3">
				            		<strong>HMO:</strong>
				            	</div>
				            	<div class="col-md-9">
				            		<div style="text-align: left;" id="phmo">-</div>
				            	</div>
				            </div>

				            <hr>

				            <div class="mt-2 float-right">
				                <button class="btn btn-outline-dark btn-sm"><i class="fas fa-phone"></i></button>
				                <button class="btn btn-outline-secondary btn-sm">TELEMED</button>
				            </div>
				        </div>
				    </div>
				    <!-- Calendar -->
				    <div class="card shadow-sm">
				        <div class="card-header bg-info text-white" style="font-size: 24px; font-weight: bold;">Calendar</div>
				        <div class="card-body">
				            <div id="calendar"></div>
				        </div>
				    </div>
				</div><!-- /LEFT -->

				<!-- RIGHT COLUMN -->
				<div class="col-md-8">
				    <!-- Charts -->
				    <div class="card shadow-sm mb-3">
				        <div class="card-header bg-info text-white" style="font-size: 24px; font-weight: bold;">Charts</div>
				        <div class="card-body d-flex flex-wrap align-items-center gap-2">
		                    <img src="{{ asset('images/icons/med_history.png') }}" class="action-icon" title="Medical History" onclick="medicalHistoryChart()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                    <img src="{{ asset('images/icons/clinic_history.png') }}" class="action-icon" title="Clinic History" onclick="clinicHistoryChart()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                    <img src="{{ asset('images/icons/vital_sign.png') }}" class="action-icon" title="Vital Signs" onclick="vitalSignsChart()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                    <img src="{{ asset('images/icons/prescription.png') }}" class="action-icon" title="Prescription" onclick="prescriptionChart()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                    <img src="{{ asset('images/icons/lab_request.png') }}" class="action-icon" title="Lab Request" onclick="labRequestChart()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                    <img src="{{ asset('images/icons/imaging.png') }}" class="action-icon" title="Imaging" onclick="imagingChart()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                    <img src="{{ asset('images/icons/files.png') }}" class="action-icon" title="Files" onclick="filesChart()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                    <img src="{{ asset('images/icons/vaccine.png') }}" class="action-icon" title="Vaccine" onclick="vaccineChart()">
				        </div>
				    </div>
				    <!-- SOAP -->
				    <div class="card shadow-sm" id="soapCard">
				        <div class="card-header bg-info text-white justify-content-between align-items-center">
				            <span style="font-size: 24px; font-weight: bold;">SOAP</span>
				            <div style="float: right;">
				                <button class="btn btn-outline-light btn-sm"><i class="fas fa-save"></i></button>
				                <button class="btn btn-outline-light btn-sm"><i class="fas fa-cog"></i></button>
				            </div>
				        </div>
				        <div class="card-body">
				            <ul class="nav nav-tabs mb-3" role="tablist">
				                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#subj">Subjective</button></li>
				                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#obj">Objective</button></li>
				                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#assess">Assessment</button></li>
			                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#plan">Plan</button></li>
			            </ul>
			            <div class="tab-content">
			                <div class="tab-pane fade show active" id="subj">
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
			                        </div>
			                    </div>
			                </div>
			                <div class="tab-pane fade" id="obj">
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
			                </div>
			                <div class="tab-pane fade" id="assess">
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
			                </div>
			                <div class="tab-pane fade" id="plan">
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
			                </div>
			            </div>
			        </div>
			    </div>

            </section>
        </div>
    </div>

    {{-- MODALS --}}
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

</section>

@endsection

@push('styles')
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/vanilla-calendar.min.css') }}">

	<style>
		#patient-card .col-md-3{
			text-align: left;
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

	    .header-row			{ border-left: 4px solid #FAFAFA !important; background-color: #FAFAFA !important; }
	    .section-subjective { border-left: 4px solid #E6F4EA !important; background-color: #E6F4EA !important; }
	    .section-objective  { border-left: 4px solid #E7F0FA !important; background-color: #E7F0FA !important; }
	    .section-assessment { border-left: 4px solid #F2E8F9 !important; background-color: #F2E8F9 !important; }
	    .section-plan       { border-left: 4px solid #FFF2E6 !important; background-color: #FFF2E6 !important; }

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

	    /* highlight style for event dates */
	     .has-event button::after {
    content: '';
    position: absolute;
    bottom: 4px;
    left: 50%;
    transform: translateX(-50%);
    width: 6px;
    height: 6px;
    background: #ff4444;
    border-radius: 50%;
  }
	</style>
@endpush

@push('scripts')
	{{-- <script src="{{ asset('js/datatables.min.js') }}"></script> --}}
	<script src="{{ asset('js/datatables.bundle.min.js') }}"></script>
	<script src="{{ asset('js/select2.min.js') }}"></script>
	{{-- <script src="{{ asset('js/datatables.bootstrap4.min.js') }}"></script> --}}
	{{-- <script src="{{ asset('js/datatables-jquery.min.js') }}"></script> --}}
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('js/vanilla-calendar.min.js') }}"></script>

	<script>
		var subjective = [], objective = [], assessment = [], plan = [];
		var stream = null;

		var search = null;
		var page = 0;

		var uid = {{ $userid }};
		{{-- uid = 3; //for testing --}}

		const { Calendar } = window.VanillaCalendarPro;
		var eventDates = [];

		$(document).ready(()=> {
			$('#searchInput').select2({
				placeholder: 'Search patient...',
				ajax: {
					url: '{{ route("user.get") }}',
					dataType: 'json',
					delay: 250, // delay for typing
					data: params => ({
						page: params.page || 1,
						select: "*",
						where: ['clinic_id', "{{ auth()->user()->clinic_id }}"],
						where2: ['role', 'Patient'],
						q: params.term // search term
					}),
					processResults: data => ({
						results: data.map(item => ({
							id: item.id,
							text: `${item.lname}, ${item.fname} ${item.mname}`
						}))
					})
				}
			});

			$('#searchInput').on('select2:select', function (e) {
				let data = e.params.data; // contains the selected item
				uid = data.id;
				getPatientData();
			});

			initDrawingCanvas();
            getPatientData();
            initSoapForm();

			calendar = new Calendar('#calendar', {selectedTheme: 'light'});
  			calendar.init();
		});

		function initSoapForm(){
			let complaints = [
				"Abdominal pain and watery stool for 3 days",
				"Abdominal pain with an acidic feel of vomiting",
				"Cataract",
				"Check up",
				"Chest pain during activity exertion",
				"Consultation",
				"Vaccine schedule"
			];

			$('#type_of_visit').select2();
			$('#chief_complaint').select2({
				data: complaints,
				tags: true
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

		function initDrawingCanvas(){
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
		}

		function getPatientData(){
			eventDates = [];

			if(uid){
				$.ajax({
					url: "{{ route('patient.get') }}",
					data: {
						where: ["user_id", uid],
						load: ["user"]
					},
					success: patient => {
						patient = JSON.parse(patient)[0];
						
						$('#pid').html(patient.patient_id);
						$('#pname').html(patient.user.lname + ", " + patient.user.fname + " " + patient.user.mname);
						$('#pcontact').html(patient.user.contact);
						$('#pgender').html(patient.user.gender);
						$('#pcivilstatus').html((patient.civil_status != "null" && patient.civil_status != null) ? patient.civil_status : "-");
						$('#paddress').html((patient.user.address != "null" && patient.user.address != null) ? patient.user.address : "-");
						$('#pnationality').html((patient.nationality != "null" && patient.nationality != null) ? patient.nationality : "-");
						$('#phmo').html((patient.hmo_provider != "null" && patient.hmo_provider != null) ? patient.hmo_provider : "-");
						$('#preligion').html((patient.religion != "null" && patient.religion != null) ? patient.religion : "-");

						$('#pbirthday').html(moment(patient.birthday).format("MMM DD, YYYY"));
						$('#page').html(moment().diff(moment(patient.user.birthday), 'years'));
					}
				});
			}

			$.ajax({
				url: "{{ route('soap.get') }}",
				data: {
					select: 'created_at',
					where: ["user_id", uid]
				},
				success: result => {
					result = JSON.parse(result);

					result.forEach(soap => {
						eventDates.push(toDate(soap.created_at, dateFormat));
					});

					console.log(eventDates);

					calendar = new Calendar('#calendar', {
						selectedTheme: 'light',
						onCreateDateEls(self, dateEl) {
							if (eventDates.includes($(dateEl).data("vc-date"))) {
								const btn = dateEl.querySelector('.vc-date__btn');
								const day = btn.textContent.trim();
								btn.innerHTML = `${day} <span style="color:#0000FF; font-size:10px;">●</span>`;
								btn.style.display = "flex";
								btn.style.alignItems = "top";
								btn.style.gap = "3px"; // small space between number and dot
							}
						},
					});

		  			calendar.init();
				}
			})
		}

		function medicalHistoryChart(){
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

		function clinicHistoryChart(){
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

		function vitalSignsChart(){
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

		function filesChart(){
			console.log(uid);
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
							console.log(soap);
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

		function template(){
			if(uid){
				Swal.fire({
					title: "Personal Medical History",
					html: `<hr>${string}`,
					showClass: { popup: '' },
					hideClass: { popup: '' },
					width: '1000px',
				})
			}
			else{
				se('No selected patient');
			}
		}
	</script>
@endpush