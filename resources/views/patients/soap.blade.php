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
				            <a class="zoom-hover" onclick="createPrescription()" style="float: right;" data-toggle="tooltip" title="Create Prescription">
				            	<i class="fas fa-clipboard-prescription fa-2x"></i>
				            </a>
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
				                <button class="btn btn-outline-dark btn-sm" onclick="saveSOAP()"><i class="fas fa-save"></i></button>
				                <button class="btn btn-outline-dark btn-sm" onclick="openCheckout()">Fees</button>
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
            	                		    <li class="nav-item" style="width: 19%;">
            	                		        <a class="nav-link active" href="#vitals" data-toggle="tab">
            	                		            Vitals
            	                		        </a>
            	                		    </li>
            	                		    &nbsp;
            	                		    <li class="nav-item" style="width: 19%;">
            	                		        <a class="nav-link" href="#drawing" data-toggle="tab">
            	                		            Drawing
            	                		        </a>
            	                		    </li>
            	                		    &nbsp;
            	                		    <li class="nav-item" style="width: 19%;">
            	                		        <a class="nav-link" href="#exam" data-toggle="tab">
            	                		            Exam
            	                		        </a>
            	                		    </li>
            	                		    @if(auth()->user()->role == "Admin" || (isset(auth()->user()->doctor) && auth()->user()->doctor->specialization == "OB-GYN"))
            	                		    &nbsp;
            	                		    <li class="nav-item" style="width: 19%;">
            	                		        <a class="nav-link" href="#obgyne" data-toggle="tab">
            	                		            OB-Gyne
            	                		        </a>
            	                		    </li>
            	                		    @endif
            	                		    @if(auth()->user()->role == "Admin" || (isset(auth()->user()->doctor) && auth()->user()->doctor->specialization == "Endocrinology"))
            	                		    &nbsp;
            	                		    <li class="nav-item" style="width: 19%;">
            	                		        <a class="nav-link" href="#bloodGlucose" data-toggle="tab">
            	                		            Blood Glucose
            	                		        </a>
            	                		    </li>
            	                		    @endif
            	                		    @if(auth()->user()->role == "Admin" || (isset(auth()->user()->doctor) && auth()->user()->doctor->specialization == "Ophthalmology"))
            	                		    &nbsp;
            	                		    <li class="nav-item" style="width: 19%;">
            	                		        <a class="nav-link" href="#refraction" data-toggle="tab">
            	                		            Refraction
            	                		        </a>
            	                		    </li>
            	                		    @endif
            	                		</ul>

            	    					<br>

            	    					{{-- CONTENT START --}}
            	    					<div class="tab-content p-0">

            	    					    <div class="chart tab-pane active" id="vitals" style="position: relative;">
            		    	                    <div class="card">
            		    	                        <div class="card-body">
            		    	                    	    <div class="row" style="padding-top: 0px;">
            		    	                    	    	<div class="col-md-12 text-right">
	            		    	                    	        <button class="btn btn-primary btn-sm" onclick="bmiChart()">BMI Chart</button>
	            		    	                    	        <button class="btn btn-primary btn-sm" onclick="computeECC()">ECC</button>
            		    	                    	    	</div>
            		    	                    	    </div>

            		    	                    	    <br>

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

            	    					    <div class="chart tab-pane" id="obgyne" style="position: relative;">
            		    	                    <div class="card">
            		    	                        <div class="card-body">

            				                    		<div class="row">
            				                    			<div class="col-md-6">
            													<label class="form-label" style="float: left;">LMP</label>
            													<input type="text" class="form-control" id="ob-lmp" placeholder="LMP">
            				                    			</div>
            				                    			<div class="col-md-6">
            													<label class="form-label" style="float: left;">EDC</label>
            													<input type="text" class="form-control" id="ob-edc" placeholder="EDC">
            				                    			</div>
            				                    		</div>

            				                    		<div class="row">
            				                    			<div class="col-md-6">
            													<button class="btn btn-primary">Calculate EDC</button>
            				                    			</div>
            				                    			<div class="col-md-6" style="margin-top: 15px;">
            				                    				<input type="radio" name="edc_source" value="LMP">
            				                    				<label for="edc_source">LMP</label>
            				                    				<input type="radio" name="edc_source" value="Ultrasound">
            				                    				<label for="edc_source">Ultrasound</label>
            				                    			</div>
            				                    		</div>

            				                    		<br>
            		    	                        	
            				                    		<div class="row">
            				                    			<div class="col-md-6">
            													<label class="form-label" style="float: left;">AOG</label>
            													<input type="text" class="form-control" id="ob-aog" placeholder="AOG">
            				                    			</div>
            				                    			<div class="col-md-6">
            													<label class="form-label" style="float: left;">FH</label>
            													<input type="text" class="form-control" id="ob-fh" placeholder="FH">
            				                    			</div>
            				                    		</div>
            		    	                        	
            				                    		<div class="row">
            				                    			<div class="col-md-6">
            													<label class="form-label" style="float: left;">FHT</label>
            													<input type="text" class="form-control" id="ob-fht" placeholder="FHT">
            				                    			</div>
            				                    			<div class="col-md-6">
            													<label class="form-label" style="float: left;">IE</label>
            													<input type="text" class="form-control" id="ob-ie" placeholder="IE">
            				                    			</div>
            				                    		</div>

            				                    		<div class="row">
            				                    			<div class="col-md-1">
            				                    				<label class="form-label" style="float: left;">Gravida</label>
            				                    				<input type="number" class="form-control" id="ob-gravida" min=0>
            				                    			</div>
            				                    			<div class="col-md-1">
            				                    				<label class="form-label" style="float: left;">Para</label>
            				                    				<input type="number" class="form-control" id="ob-para" min=0>
            				                    			</div>
            				                    			<div class="col-md-1">
            				                    				<label class="form-label" style="float: left;">Term</label>
            				                    				<input type="number" class="form-control" id="ob-term" min=0>
            				                    			</div>
            				                    			<div class="col-md-1">
            				                    				<label class="form-label" style="float: left;">Preterm</label>
            				                    				<input type="number" class="form-control" id="ob-preterm" min=0>
            				                    			</div>
            				                    			<div class="col-md-1">
            				                    				<label class="form-label" style="float: left;">Abortion</label>
            				                    				<input type="number" class="form-control" id="ob-abortion" min=0>
            				                    			</div>
            				                    			<div class="col-md-1">
            				                    				<label class="form-label" style="float: left;">Living</label>
            				                    				<input type="number" class="form-control" id="ob-living" min=0>
            				                    			</div>
            				                    			<div class="col-md-3">
        				                    					<label class="form-label" style="float: left;">Presentation</label>
        				                    					<input type="text" class="form-control" id="ob-presentation">
            				                    			</div>
            				                    			<div class="col-md-3">
        				                    					<label class="form-label" style="float: left;">Remarks</label>
        				                    					<input type="text" class="form-control" id="ob-remarks">
            				                    			</div>
            				                    		</div>

            				                    	</div>
            		    	                    </div>
            	    					    </div>

            	    					    <div class="chart tab-pane" id="bloodGlucose" style="position: relative;">
            		    	                    <div class="card">
            		    	                        <div class="card-body">
                      	
                        	                    		<div class="row">
                        	                    			<div class="col-md-4">
                        										<label class="form-label" style="float: left;">Datetime</label>
                        										<input type="text" class="form-control" id="ob-bg-datetime">
                        	                    			</div>
                        	                    			<div class="col-md-4">
                        	                    				<label class="form-label" style="float: left;">Value</label>
                        	                    				<div class="input-group">
                        	                    					<input type="text" class="form-control" id="ob-bg-value">
                        	                    					{{-- <strong class="input-group-text">/</strong> --}}
                        	                    					<input type="text" class="form-control input-group-text" id="ob-bg-unit" value="mg/dL" disabled>
                        	                    				</div>
                        	                    			</div>
            				                    			<div class="col-md-4">
            													<label class="form-label" style="float: left;">Remarks</label>
            													<input type="text" class="form-control" id="ob-bg-remarks">
            				                    			</div>
                        	                    		</div>

            				                    	</div>
            		    	                    </div>
            	    					    </div>

            	    					    <div class="chart tab-pane" id="refraction" style="position: relative; text-align: center;">
            		    	                    <div class="card">
            		    	                        <div class="card-body">

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-12" style="background-color: skyblue; text-align: left; font-weight: bold;">
            		    	                        			Visual Acuity
            		    	                        		</div>
            		    	                        	</div>
                      	
                        	                    		<div class="row">
                        	                    			<div class="col-md-1"></div>
                        	                    			<div class="col-md-1">SC</div>
                        	                    			<div class="col-md-1">OD</div>
                        	                    			<div class="col-md-2"></div>
                        	                    			<div class="col-md-4">Spectacles</div>
                        	                    			<div class="col-md-1"></div>
                        	                    			<div class="col-md-2">AXIS</div>
                        	                    		</div>

                        	                    		<div class="row">
                        	                    			<div class="col-md-1">
                        	                    				OD
                        	                    			</div>
                        	                    			<div class="col-md-1">
                        	                    				<input type="number" class="form-control" id="ob-r-va_sc_od">
                        	                    			</div>
                        	                    			<div class="col-md-1">
                        	                    				<input type="number" class="form-control" id="ob-r-va_ph_od">
                        	                    			</div>
                        	                    			<div class="col-md-1">
                        	                    				<input type="number" class="form-control" id="ob-r-va_cc_od">
                        	                    			</div>

                        	                    			<div class="col-md-1"></div>

                        	                    			<div class="col-md-4">
                        	                    				<div class="input-group">
		                    	                    				<input type="number" class="form-control" id="ob-r-va_spec_od">
		                    	                    				<strong class="input-group-text">=</strong>
		                    	                    				<input type="number" class="form-control" id="ob-r-va_spec_od_sp">
		                    	                    				<strong class="input-group-text">X</strong>
		                    	                    				<input type="number" class="form-control" id="ob-r-va_spec_od_cy">
                        	                    				</div>
                        	                    			</div>
                        	                    			<div class="col-md-1">
                        	                    			</div>
                        	                    			<div class="col-md-2">
                        	                    				<input type="number" class="form-control" id="ob-r-va_spec_od_ax">
                        	                    			</div>
                        	                    		</div>

                        	                    		<div class="row">
                        	                    			<div class="col-md-1">
                        	                    				OS
                        	                    			</div>
                        	                    			<div class="col-md-1">
                        	                    				<input type="number" class="form-control" id="ob-r-va_sc_os">
                        	                    			</div>
                        	                    			<div class="col-md-1">
                        	                    				<input type="number" class="form-control" id="ob-r-va_ph_os">
                        	                    			</div>
                        	                    			<div class="col-md-1">
                        	                    				<input type="number" class="form-control" id="ob-r-va_cc_os">
                        	                    			</div>

                        	                    			<div class="col-md-1"></div>

                        	                    			<div class="col-md-4">
                        	                    				<div class="input-group">
		                    	                    				<input type="number" class="form-control" id="ob-r-va_spec_os">
		                    	                    				<strong class="input-group-text">=</strong>
		                    	                    				<input type="number" class="form-control" id="ob-r-va_spec_os_sp">
		                    	                    				<strong class="input-group-text">X</strong>
		                    	                    				<input type="number" class="form-control" id="ob-r-va_spec_os_cy">
                        	                    				</div>
                        	                    			</div>
                        	                    			<div class="col-md-1">
                        	                    			</div>
                        	                    			<div class="col-md-2">
                        	                    				<input type="number" class="form-control" id="ob-r-va_spec_os_ax">
                        	                    			</div>
                        	                    		</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-12" style="background-color: skyblue; text-align: left; font-weight: bold;">
            		    	                        			Auto Refract
            		    	                        		</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-12">Spectacles</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-1">OD</div>
            		    	                        		<div class="col-md-3">
                        	                    				<input type="number" class="form-control" id="ob-r-ar_spec_od">
            		    	                        		</div>
            		    	                        		<div class="col-md-1">=</div>
            		    	                        		<div class="col-md-3">
                        	                    				<input type="number" class="form-control" id="ob-r-ar_spec_od_sp">
            		    	                        		</div>
            		    	                        		<div class="col-md-1">X</div>
            		    	                        		<div class="col-md-3">
                        	                    				<input type="number" class="form-control" id="ob-r-ar_spec_od_cy">
            		    	                        		</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-1">OS</div>
            		    	                        		<div class="col-md-3">
                        	                    				<input type="number" class="form-control" id="ob-r-ar_spec_os">
            		    	                        		</div>
            		    	                        		<div class="col-md-1">=</div>
            		    	                        		<div class="col-md-3">
                        	                    				<input type="number" class="form-control" id="ob-r-ar_spec_os_sp">
            		    	                        		</div>
            		    	                        		<div class="col-md-1">X</div>
            		    	                        		<div class="col-md-3">
                        	                    				<input type="number" class="form-control" id="ob-r-ar_spec_os_cy">
            		    	                        		</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-12" style="background-color: skyblue; text-align: left; font-weight: bold;">
            		    	                        			New Refract
            		    	                        		</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-6">Spectacles</div>
            		    	                        		<div class="col-md-2">VA</div>
            		    	                        		<div class="col-md-2">PD</div>
            		    	                        		<div class="col-md-2">SH</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-1">OD</div>
            		    	                        		<div class="col-md-5">
            		    	                        			<div class="input-group">
            		    	                        				<input type="number" class="form-control" id="ob-r-nr_spec_od">
            		    	                        				<strong class="input-group-text">=</strong>
            		    	                        				<input type="number" class="form-control" id="ob-r-nr_spec_od_sp">
            		    	                        				<strong class="input-group-text">X</strong>
            		    	                        				<input type="number" class="form-control" id="ob-r-nr_spec_od_cy">
            		    	                        			</div>
            		    	                        		</div>
            		    	                        		<div class="col-md-2">
            		    	                        			<input type="number" class="form-control" id="ob-r-nr_spec_od_va">
            		    	                        		</div>
            		    	                        		<div class="col-md-2">
            		    	                        			<input type="number" class="form-control" id="ob-r-nr_spec_od_pd">
            		    	                        		</div>
            		    	                        		<div class="col-md-2">
            		    	                        			<input type="number" class="form-control" id="ob-r-nr_spec_od_sh">
            		    	                        		</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-1">OS</div>
            		    	                        		<div class="col-md-5">
            		    	                        			<div class="input-group">
            		    	                        				<input type="number" class="form-control" id="ob-r-nr_spec_os">
            		    	                        				<strong class="input-group-text">=</strong>
            		    	                        				<input type="number" class="form-control" id="ob-r-nr_spec_os_sp">
            		    	                        				<strong class="input-group-text">X</strong>
            		    	                        				<input type="number" class="form-control" id="ob-r-nr_spec_os_cy">
            		    	                        			</div>
            		    	                        		</div>
            		    	                        		<div class="col-md-2">
            		    	                        			<input type="number" class="form-control" id="ob-r-nr_spec_os_va">
            		    	                        		</div>
            		    	                        		<div class="col-md-2">
            		    	                        			<input type="number" class="form-control" id="ob-r-nr_spec_os_pd">
            		    	                        		</div>
            		    	                        		<div class="col-md-2">
            		    	                        			<input type="number" class="form-control" id="ob-r-nr_spec_os_sh">
            		    	                        		</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-1"></div>
            		    	                        		<div class="col-md-5 d-flex justify-content-center align-items-center">
            		    	                        			<input type="number" style="width: 33%;" class="form-control" id="ob-r-nr_spec_od_ax">
            		    	                        		</div>
            		    	                        		<div class="col-md-2"></div>
            		    	                        		<div class="col-md-2">
            		    	                        			<input type="number" class="form-control" id="ob-r-nr_spec_os_ax">
            		    	                        		</div>
            		    	                        		<div class="col-md-2"></div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-2">Type of Lens:</div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-nr_type_of_lens">
            		    	                        		</div>
            		    	                        		<div class="col-md-2">Type of Frame:</div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-nr_type_of_frame">
            		    	                        		</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-12" style="background-color: skyblue; text-align: left; font-weight: bold;">
            		    	                        			Eyelid Evaluation
            		    	                        		</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-2"></div>
            		    	                        		<div class="col-md-4">OD</div>
            		    	                        		<div class="col-md-2"></div>
            		    	                        		<div class="col-md-4">OS</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-2" style="text-align: left;">Straight</div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-ee_od_straight">
            		    	                        		</div>
            		    	                        		<div class="col-md-2"></div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-ee_os_straight">
            		    	                        		</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-2" style="text-align: left;">Up</div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-ee_od_up">
            		    	                        		</div>
            		    	                        		<div class="col-md-2"></div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-ee_os_up">
            		    	                        		</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-2" style="text-align: left;">Down</div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-ee_od_down">
            		    	                        		</div>
            		    	                        		<div class="col-md-2"></div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-ee_os_down">
            		    	                        		</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-2" style="text-align: left;">MRD</div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-ee_od_mrd">
            		    	                        		</div>
            		    	                        		<div class="col-md-2"></div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-ee_os_mrd">
            		    	                        		</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-2" style="text-align: left;">Lev Fxn</div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-ee_od_lev_fxn">
            		    	                        		</div>
            		    	                        		<div class="col-md-2"></div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-ee_os_lev_fxn">
            		    	                        		</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-2" style="text-align: left;">Lid Crease</div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-ee_od_lid_crease">
            		    	                        		</div>
            		    	                        		<div class="col-md-2"></div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-ee_os_lid_crease">
            		    	                        		</div>
            		    	                        	</div>

            		    	                        	<div class="row">
            		    	                        		<div class="col-md-2" style="text-align: left;">Lid Lag</div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-ee_od_lid_lag">
            		    	                        		</div>
            		    	                        		<div class="col-md-2"></div>
            		    	                        		<div class="col-md-4">
            		    	                        			<input type="number" class="form-control" id="ob-r-ee_os_lid_lag">
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
            									
            									<textarea class="form-control" rows="4" disabled id="previousDiagnosis"></textarea>
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
    <div class="modal fade" id="bs-icd" tabindex="-1" data-bs-backdrop="true" data-bs-keyboard="true">
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

    <div class="modal fade" id="bs-checkout" tabindex="-1" data-bs-focus="false" aria-labelledby="chargesModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
          <div class="modal-header border-0">
            <h5 class="modal-title" id="chargesModalLabel"> </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body pt-0">

            <!-- Top info -->
            <div class="mb-3">
              <div class="text-muted small">
              	Patient ID
              	<div class="fw-semibold" id="m_patient_id">-</div>
              </div>

              <div class="text-muted small mt-2">
              	Name
              	<div class="fw-semibold" id="m_patient_name">-</div>
              </div>
            </div>

            <!-- Charges + buttons row -->
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4 class="mb-0">Charges</h4>
              <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm" onclick="addService()">Add Services</button>
                &nbsp;
                <button class="btn btn-primary btn-sm" onclick="otherService()">Other Services</button>
                &nbsp;
              </div>
            </div>

            <!-- Charges list / search box -->
            <div class="mb-3">
            	<table id="list-of-services" class="table text-left table-sm small">
            		<tbody>
            			<tr>
            				<td class="text-center" colspan="3">No Charges</td>
            			</tr>
            		</tbody>
            	</table>
            </div>

            <!-- Payment card -->
            <div class="card shadow-sm border-0">
              <div class="card-header bg-white border-0 pt-3 pb-0">
                <h5 class="fw-semibold mb-2" style="color:#1f54a5;">Payment</h5>
                <!-- tabs -->
                <ul class="nav nav-tabs border-0" id="payTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cash-tab" data-bs-toggle="tab" data-bs-target="#cash" type="button" role="tab">Cash</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="card-tab" data-bs-toggle="tab" data-bs-target="#card" type="button" role="tab">Credit/Debit Card</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="hmo-tab" data-bs-toggle="tab" data-bs-target="#hmo" type="button" role="tab">HMO</button>
                  </li>
                </ul>
              </div>
              <div class="card-body bg-light" style="background:#f3f6fc;">
                <div class="tab-content" id="payTabContent">
                  <div class="tab-pane fade show" id="cash" role="tabpanel" aria-labelledby="cash-tab">
                    <h4>Cash Checkout</h4>
                    <label for="">Cash Amount</label>
                    <input type="number" class="form-control" id="cash-amount">
                  </div>
                  <div class="tab-pane fade" id="card" role="tabpanel" aria-labelledby="card-tab">
                    <div class="row">
                        <h4>Credit/Debit Card Checkout</h4>
                        <div class="mb-3 col-12">
                            <label for="card-name" class="form-label">Card Name</label>
                            <input type="text" class="form-control" id="card-name" name="card-name" required="">
                        </div>
                        <div class="mb-3 col-12">
                            <label for="card-number" class="form-label">Card Number</label>
                            <input type="text" class="form-control" id="card-number" name="card-number" required="">
                        </div>
                        <div class="mb-3 col-6 text-nowrap">
                            <label for="card-expiry" class="form-label">Card Number Expiration</label>
                            <input type="text" class="form-control" id="card-expiry" name="card-expiry" required="">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="card-code" class="form-label">Approval Code</label>
                            <input type="text" class="form-control" id="card-code" name="card-code" required="">
                        </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="hmo" role="tabpanel" aria-labelledby="hmo-tab">
                    <div class="row">
                        <h4>HMO Checkout</h4>
                        <div class="mb-3 col-12">
                            <label for="hmo-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="hmo-name" name="hmo-name" required="">
                        </div>
                        <div class="mb-3 col-12">
                            <label for="hmo-id" class="form-label">HMO Member ID</label>
                            <input type="text" class="form-control" id="hmo-id" name="hmo-id" required="">
                        </div>
                        <div class="mb-3 col-3">
                            <label for="hmo-code" class="form-label">Approval Code</label>
                            <input type="text" class="form-control" id="hmo-code" name="hmo-code" required="">
                        </div>
                    </div>
                  </div>
                </div>

                <!-- payment summary -->
                <div class="row mt-4">
                  <div class="col-md-4 offset-md-8">
                    <div class="d-flex justify-content-between">
                      	<span class="text-primary fw-semibold">Payment Method</span>
                    	<span id="selected-payment-method" class="text-dark">-</span>
                    </div>
                    <div class="d-flex justify-content-between">
                      <span class="text-primary fw-semibold">Subtotal</span>
                      <span id="checkout-subtotal">₱0.00</span>
                    </div>
                    <div class="d-flex justify-content-between">
                      <span class="text-primary fw-semibold">VAT(%12)</span>
                      <span id="checkout-vat">₱0.00</span>
                    </div>
                    <div class="d-none justify-content-between">
                      <span class="text-primary fw-semibold">Cash</span>
                      <span id="checkout-cash-amount">₱0.00</span>
                    </div>
                    <div class="d-none justify-content-between">
                      <span class="text-primary fw-semibold">Change</span>
                      <span id="checkout-change">₱0.00</span>
                    </div>
                  </div>
                </div>

                <!-- footer pay bar -->
                <div class="d-flex align-items-center justify-content-between mt-4 rounded-3 px-4 py-2" style="background:#11b55a;">
                  <div class="fw-bold text-white fs-5">₱0.00</div>
                  <button class="btn btn-link text-white text-decoration-none fw-semibold" id="bs-checkout-submit">
                    Checkout <i class="fas fa-arrow-right ms-1"></i>
                  </button>
                </div>
              </div>
            </div>

          </div> <!-- /modal-body -->

          <div class="modal-footer border-0">
            <!-- optional footer buttons -->
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

		#refraction .row{
			margin-top: 10px;
			margin-bottom: 10px;
		}

		.zoom-hover {
		    transition: transform .2s ease-in-out;
		    display: inline-block; /* IMPORTANT: allow transform */
		    cursor: pointer;
		}
		.zoom-hover:hover {
		    transform: scale(1.2);
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
	<script src="{{ asset('js/numeral.min.js') }}"></script>

	<script>
		var subjective = [], objective = [], assessment = [], plan = [];
		var stream = null;

		var search = null;
		var page = 0;

		var uid = {{ $userid }};
		var pDetails = null;
		{{-- uid = 3; //for testing --}}

		const { Calendar } = window.VanillaCalendarPro;
		var eventDates = [];
		var prescriptions = []
		{{-- var prescriptions = [
			{
				generic_name: "test 1",
				brand_name: "bname",
				qty: 4,
				form: "Capsule",
				instruction: "3x a day",
			},
			{
				generic_name: "test 2",
				brand_name: "bname 2",
				qty: 7,
				form: "pack",
				instruction: "8x a day",
			},
		]; --}}

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

			$('#callPreviousDiagnosis').on('click', e => {
				$('#diagnosis').val(pDetails.latest_soap ? pDetails.latest_soap.a_diagnosis : null);
			});

			$('#callDiagnosis').on('click', e => {
				modalOne = new bootstrap.Modal(document.getElementById('bs-diagnosis'), {
					backdrop: 'true',
					keyboard: true
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
					backdrop: 'true',
					keyboard: true
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
					backdrop: 'true',
					keyboard: true
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

			$('#ob-bg-datetime').flatpickr({
				altInput: true,
				altFormat: "M j, Y H:i",
				dateFormat: "Y-m-d H:i",
				maxDate: moment().format("YYYY-MM-DD"),
  				enableTime: true,
  				time_24hr: true,
				defaultDate: new Date()
			});

			$('#ob-lmp').flatpickr({
				altInput: true,
				altFormat: "M j, Y",
				dateFormat: "Y-m-d",
				maxDate: moment().format("YYYY-MM-DD")
			});

			$('#ob-edc').flatpickr({
				altInput: true,
				altFormat: "M j, Y",
				dateFormat: "Y-m-d"
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
						load: ["user", 'latestSoap']
					},
					success: patient => {
						patient = JSON.parse(patient)[0];
						pDetails = patient;
						
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
						$('#previousDiagnosis').val(pDetails.latest_soap ? pDetails.latest_soap.a_diagnosis : null);
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
						dateMax: moment().format("YYYY-MM-DD"),
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
						onClickDate(self) {
							const date = self.context.selectedDates[0];
							if(date){
								let text = $(`[data-vc-date="${date}"] .vc-date__btn`).text();

								if (text.includes("●")) {
									Swal.fire({
										icon: 'question',
										title: "Load SOAP details for this date?",
										confirmButtonText: "Yes",
										showCancelButton: true,
										cancelButtonText: "Cancel",
										cancelButtonColor: errorColor,
									}).then(result => {
										if(result.value){
											loadSoap(date);
										}
									})
								}
							}
						},
					});

		  			calendar.init();
				}
			})
		}

		function loadSoap(date){
			$.ajax({
				url: "{{ route('soap.get') }}",
				data: {
					select: "*",
					where: ['user_id', uid],
					where2: ['created_at', 'like', date + "%"],
					load: ['refraction', 'obgyne', 'blood_glucose']
				},
				success: soapData => {
					soapData = JSON.parse(soapData)[0];

					$('#type_of_visit').val(soapData.s_type_of_visit).trigger('change');
					$('#chief_complaint').val(soapData.s_chief_complaint).trigger('change');
					$('#history_of_present_illness').val(soapData.s_history_of_present_illness).trigger('change');
					$('#bp_systolic').val(soapData.o_systolic);
					$('#bp_diastolic').val(soapData.o_diastolic);
					$('#pulse_rate').val(soapData.o_pulse);
					$('#pulse_type').val(soapData.o_pulse_type);
					$('#temperature').val(soapData.o_temperature);
					$('#temp_unit').val(soapData.o_temperature_unit);
					$('#temp_location').val(soapData.o_temperature_location);
					$('#respiration_rate').val(soapData.o_respiration_rate);
					$('#respiration_type').val(soapData.o_respiration_type);
					$('#weight').val(soapData.o_weight);
					$('#weight_unit').val(soapData.o_weight_unit);
					$('#height').val(soapData.o_height);
					$('#height_unit').val(soapData.o_height_unit);
					$('#o2_sat').val(soapData.o_o2_sat);
					$('#physical_examination').val(soapData.o_physical_examination);
					$('#diagnosis').val(soapData.a_diagnosis);
					$('#diagnosis_care_plan').val(soapData.p_diagnosis_care_plan);
					$('#therapeutic_care_plan').val(soapData.p_therapeutic_care_plan);
					$('#doctors_note').val(soapData.p_doctors_note);

					$('#ob-r-va_sc_od').val(soapData.refraction.va_sc_od);
					$('#ob-r-va_sc_os').val(soapData.refraction.va_sc_os);
					$('#ob-r-va_ph_od').val(soapData.refraction.va_ph_od);
					$('#ob-r-va_ph_os').val(soapData.refraction.va_ph_os);
					$('#ob-r-va_cc_od').val(soapData.refraction.va_cc_od);
					$('#ob-r-va_cc_os').val(soapData.refraction.va_cc_os);
					$('#ob-r-va_spec_od').val(soapData.refraction.va_spec_od);
					$('#ob-r-va_spec_od_sp').val(soapData.refraction.va_spec_od_sp);
					$('#ob-r-va_spec_od_cy').val(soapData.refraction.va_spec_od_cy);
					$('#ob-r-va_spec_od_ax').val(soapData.refraction.va_spec_od_ax);
					$('#ob-r-va_spec_os').val(soapData.refraction.va_spec_os);
					$('#ob-r-va_spec_os_sp').val(soapData.refraction.va_spec_os_sp);
					$('#ob-r-va_spec_os_cy').val(soapData.refraction.va_spec_os_cy);
					$('#ob-r-va_spec_os_ax').val(soapData.refraction.va_spec_os_ax);
					$('#ob-r-ar_spec_od').val(soapData.refraction.ar_spec_od);
					$('#ob-r-ar_spec_od_sp').val(soapData.refraction.ar_spec_od_sp);
					$('#ob-r-ar_spec_od_cy').val(soapData.refraction.ar_spec_od_cy);
					$('#ob-r-ar_spec_os').val(soapData.refraction.ar_spec_os);
					$('#ob-r-ar_spec_os_sp').val(soapData.refraction.ar_spec_os_sp);
					$('#ob-r-ar_spec_os_cy').val(soapData.refraction.ar_spec_os_cy);
					$('#ob-r-nr_spec_od').val(soapData.refraction.nr_spec_od);
					$('#ob-r-nr_spec_od_sp').val(soapData.refraction.nr_spec_od_sp);
					$('#ob-r-nr_spec_od_cy').val(soapData.refraction.nr_spec_od_cy);
					$('#ob-r-nr_spec_od_ax').val(soapData.refraction.nr_spec_od_ax);
					$('#ob-r-nr_spec_od_va').val(soapData.refraction.nr_spec_od_va);
					$('#ob-r-nr_spec_od_pd').val(soapData.refraction.nr_spec_od_pd);
					$('#ob-r-nr_spec_od_sh').val(soapData.refraction.nr_spec_od_sh);
					$('#ob-r-nr_spec_os').val(soapData.refraction.nr_spec_os);
					$('#ob-r-nr_spec_os_sp').val(soapData.refraction.nr_spec_os_sp);
					$('#ob-r-nr_spec_os_cy').val(soapData.refraction.nr_spec_os_cy);
					$('#ob-r-nr_spec_os_ax').val(soapData.refraction.nr_spec_os_ax);
					$('#ob-r-nr_spec_os_va').val(soapData.refraction.nr_spec_os_va);
					$('#ob-r-nr_spec_os_pd').val(soapData.refraction.nr_spec_os_pd);
					$('#ob-r-nr_spec_os_sh').val(soapData.refraction.nr_spec_os_sh);
					$('#ob-r-nr_type_of_lens').val(soapData.refraction.nr_type_of_lens);
					$('#ob-r-nr_type_of_frame').val(soapData.refraction.nr_type_of_frame);
					$('#ob-r-ee_od_straight').val(soapData.refraction.ee_od_straight);
					$('#ob-r-ee_od_up').val(soapData.refraction.ee_od_up);
					$('#ob-r-ee_od_down').val(soapData.refraction.ee_od_down);
					$('#ob-r-ee_od_mrd').val(soapData.refraction.ee_od_mrd);
					$('#ob-r-ee_od_lev_fxn').val(soapData.refraction.ee_od_lev_fxn);
					$('#ob-r-ee_od_lid_crease').val(soapData.refraction.ee_od_lid_crease);
					$('#ob-r-ee_od_lid_lag').val(soapData.refraction.ee_od_lid_lag);
					$('#ob-r-ee_os_straight').val(soapData.refraction.ee_os_straight);
					$('#ob-r-ee_os_up').val(soapData.refraction.ee_os_up);
					$('#ob-r-ee_os_down').val(soapData.refraction.ee_os_down);
					$('#ob-r-ee_os_mrd').val(soapData.refraction.ee_os_mrd);
					$('#ob-r-ee_os_lev_fxn').val(soapData.refraction.ee_os_lev_fxn);
					$('#ob-r-ee_os_lid_crease').val(soapData.refraction.ee_os_lid_crease);
					$('#ob-r-ee_os_lid_lag').val(soapData.refraction.ee_os_lid_lag);

					$(`[name="edc_source"][value="${soapData.obgyne.edc_source}"]`).click();
					{{-- $('#ob-lmp').val(soapData.obgyne.lmp); --}}
					$("#ob-lmp").flatpickr().setDate(soapData.obgyne.lmp);
					$("#ob-edc").flatpickr().setDate(soapData.obgyne.edc);

					$('#ob-aog').val(soapData.obgyne.aog);
					$('#ob-fh').val(soapData.obgyne.fh);
					$('#ob-fht').val(soapData.obgyne.fht);
					$('#ob-ie').val(soapData.obgyne.ie);
					$('#ob-gravida').val(soapData.obgyne.gravida);
					$('#ob-para').val(soapData.obgyne.para);
					$('#ob-term').val(soapData.obgyne.term);
					$('#ob-preterm').val(soapData.obgyne.preterm);
					$('#ob-abortion').val(soapData.obgyne.abortion);
					$('#ob-living').val(soapData.obgyne.living);
					$('#ob-presentation').val(soapData.obgyne.presentation);
					$('#ob-remarks').val(soapData.obgyne.remarks);

					$('#ob-bg-value').val(soapData.blood_glucose.value);
					$('#ob-bg-unit').val(soapData.blood_glucose.unit);
					$('#ob-bg-remarks').val(soapData.blood_glucose.remarks);
					$('#ob-bg-datetime').val(soapData.blood_glucose.datetime);

					$('#type_of_visit').attr('disabled', 'disabled');
					$('#chief_complaint').attr('disabled', 'disabled');
					$('#history_of_present_illness').attr('disabled', 'disabled');
					$('#bp_systolic').attr('disabled', 'disabled');
					$('#bp_diastolic').attr('disabled', 'disabled');
					$('#pulse_rate').attr('disabled', 'disabled');
					$('#pulse_type').attr('disabled', 'disabled');
					$('#temperature').attr('disabled', 'disabled');
					$('#temp_unit').attr('disabled', 'disabled');
					$('#temp_location').attr('disabled', 'disabled');
					$('#respiration_rate').attr('disabled', 'disabled');
					$('#respiration_type').attr('disabled', 'disabled');
					$('#weight').attr('disabled', 'disabled');
					$('#weight_unit').attr('disabled', 'disabled');
					$('#height').attr('disabled', 'disabled');
					$('#height_unit').attr('disabled', 'disabled');
					$('#o2_sat').attr('disabled', 'disabled');
					$('#physical_examination').attr('disabled', 'disabled');
					$('#diagnosis').attr('disabled', 'disabled');
					$('#diagnosis_care_plan').attr('disabled', 'disabled');
					$('#therapeutic_care_plan').attr('disabled', 'disabled');
					$('#doctors_note').attr('disabled', 'disabled');
					$('#p_files').attr('disabled', 'disabled');

					let ctx = canvas.getContext('2d');

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
					base_image.src = soapData.o_drawing;

					$('canvas').addClass('disabled');
					$('canvas.disabled').css('pointer-events', 'none');
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

								        <div>
									        <button class="btn btn-sm btn-success" href="{{ route('soap.print') }}?id=${soap.id}" target="_blank">
									            <i class='fas fa-print'></i>
									        </button>
									        <button class="btn btn-sm btn-info caret-soap" data-bs-toggle="collapse" data-bs-target="#soapDetails${soap.id}" aria-expanded="true">
									            <i class='fas fa-caret-up'></i>
									        </button>
								        </div>
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

		function prescriptionChart(){
			if(uid){
				$.ajax({
					url: "{{ route('prescription.get') }}",
					data: {
						select: "*",
						where: ['user_id', uid],
						group: ['batch']
					}, 
					success: result => {
						result = JSON.parse(result);

						let string = `
							<div id="prescriptions">
						`;

						if(Object.keys(result).length){
							Object.keys(result).forEach(batch => {
								string += `
										<div style="background-color: #d5f4e6; text-align: left; font-weight: bold;">${moment(result[batch][0].created_at).format('MMM DD, YYYY hh:MM:SS A')} - #${batch}</div>
											<div style="margin-left: 20px; text-align: left; margin-bottom: 10px;">
										<br>
									`;

								result[batch].forEach(prescription => {
									string += `
										<u><b>${prescription.generic_name}</b> ${prescription.form} (${prescription.brand_name}) #${prescription.qty}</u>
										<br>
									`;
								});

								string += `
									</div>
									<br>
								`;
							});	
						}
						else{
							string += `<h3>No record of prescriptions</h3>`;
						}

						string += `
							</div>
						`;

						$('#prescriptions').html(string);

						Swal.fire({
							title: "Prescriptions",
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

		function bmiChart(){
			let bmi = "No Data";
			let weight = null;
			let height = null;

			if(pDetails != undefined && pDetails.latest_soap != undefined){
				weight = pDetails.latest_soap.o_weight;
				height = pDetails.latest_soap.o_height;

				if(height && weight){
					bmi = (weight / ((height / 100) ** 2)).toFixed(2);

					let category = null;

					if (bmi < 18.5) {
						category = "Underweight";
					} else if (bmi < 25) {
						category = "Normal weight";
					} else if (bmi < 30) {
						category = "Overweight";
					} else {
						category = "Obesity";
					}

					bmi = bmi + ` (${category})`;
				}
				else{
					bmi = "Invalid Data";
				}
			}

			Swal.fire({
				title: "Body Mass Index(BMI)",
				html: `
					<div class="row" style="text-align: center; color: red;">
						<div class="col-md-6">
							Height: ${height ?? "-"} cm
						</div>
						<div class="col-md-6">
							Weight: ${weight ?? "-"} kg
						</div>
					</div>

					<div class="row" style="margin-top: 5px;">
						<div class="col-md-12" style="font-weight: bold; text-align: center;">
							Standard Measurement
						</div>
					</div>

					<div class="row" style="margin-top: 10px;">
						<div class="col-md-12" style="text-align: left;">
							BMI Categories:<br>
							Underweight = < 18.5<br>
							Normal weight = 18.5-24.9<br>
							Overweight = 25-29.9<br>
							Obesity = BMI of 30 or greater<br>
						</div>
					</div>

					<div class="row" style="margin-top: 10px;">
						<div class="col-md-12" style="font-weight: bold; text-align: center;">
							BMI = ${bmi}
						</div>
					</div>
				`
			})
		}

		function computeECC(){
			let result = null;
		    let total_serum = null;
		    let age = null;

			Swal.fire({
				title: "Estimated Creatinine Clearance",
				html: `
					<div class="row">
						<div class="col-md-4 text-left">
							Age:
						</div>
						<div class="col-md-8">
							<input type="text" class="form-control" disabled value="${age ?? "No Data"}">
						</div>
					</div>

					<br>

					<div class="row">
						<div class="col-md-4 text-left">
							Serum Crea:
						</div>
						<div class="col-md-8">
							<input type="number" class="form-control" id="serum">
						</div>
					</div>

					<br>

					<div class="row">
						<div class="col-md-4 text-left">
							Result:
						</div>
						<div class="col-md-8">
							<input type="text" class="form-control" id="serum_result" disabled>
						</div>
					</div>
				`,
				confirmButtonText: "Compute",
				showCancelButton: true,
				cancelButtonColor: errorColor,
				preConfirm: () => {
					if(pDetails != undefined && pDetails.latest_soap != undefined){
				    	age = moment().diff(moment(pDetails.user.birthday, "YYYY-MM-DD"), 'years');
						let serum = $('#serum').val();
						let weight = pDetails.latest_soap.o_weight;
						let weight_unit = pDetails.latest_soap.o_weight_unit;

						if(!serum){
							Swal.showValidationMessage('No crea input');
							return false;
						}

					    if (weight_unit == 'Lbs') {
					        weight = weight * 0.453592;
					    }

					    result = 140 - age;
					    result *= weight;
					    total_serum = 72 * serum;
					    result = result / total_serum;

					    if (pDetails.user.gender == 'Female')
					        result *= 0.85;
					    	result = result.toFixed(2);

					    if(result){
						    if (result <= 15)
						        result = result + ' mL/min Stage 5(Close to or at kidney failure)';
						    else if (result >= 15 && result <= 29)
						        result = result + ' mL/min Stage 4(Advanced kidney disease)';
						    else if (result >= 30 && result <= 44)
						        result = result + ' mL/min Stage 3b(Moderate kidney disease)';
						    else if (result >= 45 && result <= 59)
						        result = result + ' mL/minStage 3a(Mild kidney disease)';
						    else if (result >= 60 && result <= 89)
						        result = result + ' mL/min Stage 2';
						    else if (result >= 90)
						        result = result + ' mL/min Stage 1(Normal kidney function)';
					    }
					    else{
					    	if(!age){
								Swal.showValidationMessage('No age data ⚠️');
								return false;
					    	}
					    }
					}
					else{
						Swal.showValidationMessage('No selected patient');
						result = "No Data";
					}

					$('#serum_result').val(result);

					return false;
				}
			})
		}

		function saveSOAP(){
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

			soapO.refractions = {
				va_sc_od: $('#ob-r-va_sc_od').val(),
				va_sc_os: $('#ob-r-va_sc_os').val(),
				va_ph_od: $('#ob-r-va_ph_od').val(),
				va_ph_os: $('#ob-r-va_ph_os').val(),
				va_cc_od: $('#ob-r-va_cc_od').val(),
				va_cc_os: $('#ob-r-va_cc_os').val(),
				va_spec_od: $('#ob-r-va_spec_od').val(),
				va_spec_od_sp: $('#ob-r-va_spec_od_sp').val(),
				va_spec_od_cy: $('#ob-r-va_spec_od_cy').val(),
				va_spec_od_ax: $('#ob-r-va_spec_od_ax').val(),
				va_spec_os: $('#ob-r-va_spec_os').val(),
				va_spec_os_sp: $('#ob-r-va_spec_os_sp').val(),
				va_spec_os_cy: $('#ob-r-va_spec_os_cy').val(),
				va_spec_os_ax: $('#ob-r-va_spec_os_ax').val(),
				ar_spec_od: $('#ob-r-ar_spec_od').val(),
				ar_spec_od_sp: $('#ob-r-ar_spec_od_sp').val(),
				ar_spec_od_cy: $('#ob-r-ar_spec_od_cy').val(),
				ar_spec_os: $('#ob-r-ar_spec_os').val(),
				ar_spec_os_sp: $('#ob-r-ar_spec_os_sp').val(),
				ar_spec_os_cy: $('#ob-r-ar_spec_os_cy').val(),
				nr_spec_od: $('#ob-r-nr_spec_od').val(),
				nr_spec_od_sp: $('#ob-r-nr_spec_od_sp').val(),
				nr_spec_od_cy: $('#ob-r-nr_spec_od_cy').val(),
				nr_spec_od_ax: $('#ob-r-nr_spec_od_ax').val(),
				nr_spec_od_va: $('#ob-r-nr_spec_od_va').val(),
				nr_spec_od_pd: $('#ob-r-nr_spec_od_pd').val(),
				nr_spec_od_sh: $('#ob-r-nr_spec_od_sh').val(),
				nr_spec_os: $('#ob-r-nr_spec_os').val(),
				nr_spec_os_sp: $('#ob-r-nr_spec_os_sp').val(),
				nr_spec_os_cy: $('#ob-r-nr_spec_os_cy').val(),
				nr_spec_os_ax: $('#ob-r-nr_spec_os_ax').val(),
				nr_spec_os_va: $('#ob-r-nr_spec_os_va').val(),
				nr_spec_os_pd: $('#ob-r-nr_spec_os_pd').val(),
				nr_spec_os_sh: $('#ob-r-nr_spec_os_sh').val(),
				nr_type_of_lens: $('#ob-r-nr_type_of_lens').val(),
				nr_type_of_frame: $('#ob-r-nr_type_of_frame').val(),
				ee_od_straight: $('#ob-r-ee_od_straight').val(),
				ee_od_up: $('#ob-r-ee_od_up').val(),
				ee_od_down: $('#ob-r-ee_od_down').val(),
				ee_od_mrd: $('#ob-r-ee_od_mrd').val(),
				ee_od_lev_fxn: $('#ob-r-ee_od_lev_fxn').val(),
				ee_od_lid_crease: $('#ob-r-ee_od_lid_crease').val(),
				ee_od_lid_lag: $('#ob-r-ee_od_lid_lag').val(),
				ee_os_straight: $('#ob-r-ee_os_straight').val(),
				ee_os_up: $('#ob-r-ee_os_up').val(),
				ee_os_down: $('#ob-r-ee_os_down').val(),
				ee_os_mrd: $('#ob-r-ee_os_mrd').val(),
				ee_os_lev_fxn: $('#ob-r-ee_os_lev_fxn').val(),
				ee_os_lid_crease: $('#ob-r-ee_os_lid_crease').val(),
				ee_os_lid_lag: $('#ob-r-ee_os_lid_lag').val(),
			};

			soapO.obgyne = {
				lmp: $('#ob-lmp').val(),
				edc: $('#ob-edc').val(),
				edc_source: $('[name="edc_source"]:checked').val(),
				aog: $('#ob-aog').val(),
				fh: $('#ob-fh').val(),
				fht: $('#ob-fht').val(),
				ie: $('#ob-ie').val(),
				gravida: $('#ob-gravida').val(),
				para: $('#ob-para').val(),
				term: $('#ob-term').val(),
				preterm: $('#ob-preterm').val(),
				abortion: $('#ob-abortion').val(),
				living: $('#ob-living').val(),
				presentation: $('#ob-presentation').val(),
				remarks: $('#ob-remarks').val()
			};

			soapO.glucose = {
				value: $('#ob-bg-value').val(),
				unit: $('#ob-bg-unit').val(),
				remarks: $('#ob-bg-remarks').val(),
				datetime: $('#ob-bg-datetime').val(),
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
	        })
		}

		function openCheckout(){
			modalFour = new bootstrap.Modal(document.getElementById('bs-checkout'), {
				backdrop: 'true',
				keyboard: true
			});
			modalFour.show();

			if(pDetails != undefined){
				$('#m_patient_id').text(pDetails.patient_id);
				$('#m_patient_name').text(`${pDetails.user.lname}, ${pDetails.user.fname} ${pDetails.user.mname}`);
			}
		}

		$('#cash-tab').on('click', () => {
			$('#checkout-cash-amount, #checkout-change').parent().removeClass('d-none');
			$('#checkout-cash-amount, #checkout-change').parent().addClass('d-flex');
			$('#selected-payment-method').text('Cash');
		});

		$('#card-tab').on('click', () => {
			$('#checkout-cash-amount, #checkout-change').parent().addClass('d-none');
			$('#checkout-cash-amount, #checkout-change').parent().removeClass('d-flex');
			$('#selected-payment-method').text('Card');
		});

		$('#hmo-tab').on('click', () => {
			$('#checkout-cash-amount, #checkout-change').parent().addClass('d-none');
			$('#checkout-cash-amount, #checkout-change').parent().removeClass('d-flex');
			$('#selected-payment-method').text('HMO');
		});

		$('#cash-amount').on('keyup', e => {
			$('#checkout-cash-amount').text(`₱${numeral(e.target.value).format('0,0.00')}`);
			$('#checkout-change').text(`₱${numeral(e.target.value - stringToNumeral($('#checkout-subtotal').text()) - stringToNumeral($('#checkout-vat').text())).format('0,0.00')}`);
			console.log(e.target.value, stringToNumeral($('#checkout-subtotal').text()), stringToNumeral($('#checkout-vat').text()))
		});

		function addService(){
			Swal.fire({
				title: "List of services",
				html: `
					<table class="table text-left">
						<tbody>
							<tr>
								<td>Medical Certificate</td>
								<td>₱100.00</td>
								<td><input type="checkbox" data-amount="100" data-type="Medical Certificate"></td>
							</tr>
							<tr>
								<td>Tele Consult</td>
								<td>₱800.00</td>
								<td><input type="checkbox" data-amount="800" data-type="Tele Consult"></td>
							</tr>
							<tr>
								<td>Online Rx</td>
								<td>₱100.00</td>
								<td><input type="checkbox" data-amount="100" data-type="Online Rx"></td>
							</tr>
							<tr>
								<td>Medicine</td>
								<td>₱100.00</td>
								<td><input type="checkbox" data-amount="100" data-type="Medicine"></td>
							</tr>
							<tr>
								<td>Consultation</td>
								<td>₱900.00</td>
								<td><input type="checkbox" data-amount="900" data-type="Consultation"></td>
							</tr>
							<tr>
								<td>Discount</td>
								<td>₱-100.00</td>
								<td><input type="checkbox" data-amount="-100" data-type="Discount"></td>
							</tr>
						</tbody>
					</table>
				`,
				confirmButtonText: "Add Services",
				showCancelButton: true,
				cancelButtonColor: errorColor
			}).then(result => {
				if(result.value){
					let servicesString = "";

					$('[type="checkbox"]:checked').each((a,service) => {

						let rn = Math.random().toString(36).substring(2, 8);

						servicesString += `
							<tr data-type="${service.dataset.type}${rn}">
								<td>${service.dataset.type}</td>
								<td class="service-amount" data-amount="${service.dataset.amount}">₱${numeral(service.dataset.amount).format('0,0.00')}</td>
								<td class="text-right">
									<a class="btn btn-warning btn-xs" data-toggle="tooltip" title="Edit" onclick="editService('${service.dataset.type}', ${service.dataset.amount}, '${rn}')">
										<i class="fas fa-pencil fa-sm"></i>
									</a>
									<a class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="deleteService(this)">
										<i class="fas fa-trash fa-sm"></i>
									</a>
								</td>
							</tr>
						`;
					})

					$('#list-of-services .text-center').parent().remove();
					$('#list-of-services tbody').append(servicesString);
					
					computeTotal();
				}
			})
		}

		function otherService(){
			Swal.fire({
				title: "Other Services",
				html: `
					<div class="row">
						<div class="mb-3 col-12 text-left">
						    <label for="other-service-name" class="form-label">Service Name</label>
						    <input type="text" class="form-control" id="other-service-name" name="other-service-name">
						</div>
						<div class="mb-3 col-6 text-left">
						    <label for="other-service-fee" class="form-label">Fee</label>
						    <input type="number" class="form-control" id="other-service-fee" name="other-service-fee">
						</div>
					</div>
				`,
				confirmButtonText: "Add Service",
				showCancelButton: true,
				cancelButtonColor: errorColor,
				preConfirm: () => {
					let osName = $('#other-service-name').val();
					let osFee = $('#other-service-fee').val();

					if(osName == "" || osFee == ""){
						Swal.showValidationMessage('Fill all fields');
						return false;
					}
					else{
						$('#list-of-services .text-center').remove();

						let rn = Math.random().toString(36).substring(2, 8);
						$('#list-of-services tbody').append(`
							<tr data-type="${osName}${rn}">
								<td>${osName}</td>
								<td class="service-amount" data-amount="${osFee}">₱${numeral(osFee).format('0,0.00')}</td>
								<td class="text-right">
									<a class="btn btn-warning btn-xs" data-toggle="tooltip" title="Edit" onclick="editService('${osName}', ${osFee}, '${rn}')">
										<i class="fas fa-pencil fa-sm"></i>
									</a>
									<a class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="deleteService(this)">
										<i class="fas fa-trash fa-sm"></i>
									</a>
								</td>
							</tr>
						`);

						computeTotal();
					}
				}
			}).then(result => {
				ss("Successfully added service");
			})
		}

		function editService(type, fee, rn){
			Swal.fire({
				title: "Edit Service",
				html: `
					<div class="row">
						<div class="mb-3 col-12 text-left">
						    <label for="other-service-name" class="form-label">Service Name</label>
						    <input type="text" class="form-control" id="other-service-name" name="other-service-name" value="${type}" disabled>
						</div>
						<div class="mb-3 col-6 text-left">
						    <label for="other-service-fee" class="form-label">Fee</label>
						    <input type="number" class="form-control" id="other-service-fee" name="other-service-fee" value="${fee}">
						</div>
					</div>
				`,
				confirmButtonText: "Update Service",
				showCancelButton: true,
				cancelButtonColor: errorColor,
				preConfirm: () => {
					let osName = $('#other-service-name').val();
					let osFee = $('#other-service-fee').val();

					if(osName == "" || osFee == ""){
						Swal.showValidationMessage('Fill all fields');
						return false;
					}
					else{
						$('#list-of-services .text-center').parent().remove();

						$(`tr[data-type="${osName}${rn}"]`).replaceWith(`
							<tr data-type="${osName}${rn}">
								<td>${osName}</td>
								<td class="service-amount" data-amount="${osFee}">₱${numeral(osFee).format('0,0.00')}</td>
								<td class="text-right">
									<a class="btn btn-warning btn-xs" data-toggle="tooltip" title="Edit" onclick="editService('${osName}', ${osFee}, '${rn}')">
										<i class="fas fa-pencil fa-sm"></i>
									</a>
									<a class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="deleteService(this)">
										<i class="fas fa-trash fa-sm"></i>
									</a>
								</td>
							</tr>
						`);

						computeTotal();
					}

				}
			}).then(result => {
				ss("Successfully updated service");
			})
		}

		function deleteService(elem){
			$(elem).parent().parent().remove();
		}

		function computeTotal(){
			let total = 0;
			$('.service-amount').each((a,amount) => {
				total += parseFloat(amount.dataset.amount);
			});

			$('#checkout-subtotal').text(`₱${numeral(total).format('0,0.00')}`);
			$('#checkout-vat').text(`₱${numeral(total * .12).format('0,0.00')}`);
			$('#cash-amount').trigger('keyup');
		}

		function stringToNumeral(amount) {
			return parseFloat(amount.replace(/[₱,]/g, '').trim());
		}

		function createPrescription(){
			if(pDetails){
				Swal.fire({
					title: 'Prescription',
					width: "70%",
					html: `
						<div class="row">
							<div class="col-md-2">
								<b>Patient ID</b>
							</div>
							<div class="col-md-10">
								${pDetails.patient_id}
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<b>Name</b>
							</div>
							<div class="col-md-10">
								${pDetails.user.lname}, ${pDetails.user.fname} ${pDetails.user.mname}
							</div>
						</div>

						<br>

						<div class="row">
							<div class="col-md-6">
								<h2>
									<b>Rx Medication</b>
								</h2>
							</div>
							<div class="col-md-6">
								<button class="btn btn-primary btn-sm" style="float: right;" onclick="addRX()">Add RX</button>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body" id="rxlist">
									</div>
								</div>
							</div>
						</div>
					`,
					didOpen: () => {
						$('#swal2-html-container .row').css("text-align", 'left');
						loadRXList();
					},
					showCloseButton: true,
					showCancelButton: true,
					cancelButtonColor: errorColor,
					confirmButtonText: "Print",
					showDenyButton: true,
					denyButtonColor: successColor,
					denyButtonText: "Sent to Portal",
				}).then(result => {
					if(result.isConfirmed){
						let json = encodeURIComponent(JSON.stringify(prescriptions));
						window.open("{{ route('soap.printPrescription') }}?data=" + json + "&uid=" + pDetails.user.id, "_blank");
					}
					else if(result.isDenied){
						let json = encodeURIComponent(JSON.stringify(prescriptions));
						window.open("{{ route('soap.sendPrescriptionToPortal') }}?data=" + json + "&uid=" + pDetails.user.id, "_blank");
					}
				})
			}
			else{
				se('No patient selected');
			}
		}

		function addRX(){
			Swal.fire({
				title: "Add Prescription",
				html: `
					<div class="text-align: left;">

						<div class="row">
							<div class="col-md-12">
								<label class="form-label" style="float: left;">Generic Name</label>
							    <input type="text" class="form-control" id="addRx_generic_name">
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<label class="form-label" style="float: left;">Brand Name</label>
							    <input type="text" class="form-control" id="addRx_brand_name">
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<label class="form-label" style="float: left;">Qty</label>
							    <input type="number" class="form-control" id="addRx_qty" min="0">
							</div>
							<div class="col-md-6">
								<label class="form-label" style="float: left;">Form</label>

								<select class="form-control" id="addRx_form">
									<option>Select One</option>
									<option value="Tablet">Tablet</option>
									<option value="Capsule">Capsule</option>
									<option value="Pill">Pill</option>
									<option value="Syrup">Syrup</option>
									<option value="Suspension">Suspension</option>
									<option value="Patch">Patch</option>
									<option value="Vial">Vial</option>
									<option value="Nebule">Nebule</option>
									<option value="Suppository">Suppository</option>
									<option value="Cream">Cream</option>
									<option value="Gel">Gel</option>
									<option value="Liniment">Liniment</option>
									<option value="Ointment">Ointment</option>
									<option value="Drops">Drops</option>
								</select>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="col-md-12">
								<label class="form-label" style="float: left;">Special Instruction</label>
								<textarea class="form-control" id="addRx_instruction" rows="4"></textarea>
							</div>
						</div>
					</div>
				`,
				showCancelButton: true,
				cancelButtonColor: errorColor
			}).then(result => {
				if(result.value){
					prescriptions.push({
						generic_name: $('#addRx_generic_name').val(),
						brand_name: $('#addRx_brand_name').val(),
						qty: $('#addRx_qty').val(),
						form: $('#addRx_form').val(),
						instruction: $('#addRx_instruction').val(),
					});
				}

				createPrescription();
			})
		}

		function editRX(index){
			let temp = prescriptions[index];

			Swal.fire({
				title: "Add Prescription",
				html: `
					<div class="text-align: left;">

						<div class="row">
							<div class="col-md-12">
								<label class="form-label" style="float: left;">Generic Name</label>
							    <input type="text" class="form-control" id="addRx_generic_name" value="${temp.generic_name}" disabled>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<label class="form-label" style="float: left;">Brand Name</label>
							    <input type="text" class="form-control" id="addRx_brand_name" value="${temp.brand_name}" disabled>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<label class="form-label" style="float: left;">Qty</label>
							    <input type="number" class="form-control" id="addRx_qty" min="0" value="${temp.qty}">
							</div>
							<div class="col-md-6">
								<label class="form-label" style="float: left;">Form</label>

								<select class="form-control" id="addRx_form">
									<option>Select One</option>
									<option value="Tablet">Tablet</option>
									<option value="Capsule">Capsule</option>
									<option value="Pill">Pill</option>
									<option value="Syrup">Syrup</option>
									<option value="Suspension">Suspension</option>
									<option value="Patch">Patch</option>
									<option value="Vial">Vial</option>
									<option value="Nebule">Nebule</option>
									<option value="Suppository">Suppository</option>
									<option value="Cream">Cream</option>
									<option value="Gel">Gel</option>
									<option value="Liniment">Liniment</option>
									<option value="Ointment">Ointment</option>
									<option value="Drops">Drops</option>
								</select>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="col-md-12">
								<label class="form-label" style="float: left;">Special Instruction</label>
								<textarea class="form-control" id="addRx_instruction" rows="4" value="${temp.instruction}">${temp.instruction}</textarea>
							</div>
						</div>
					</div>
				`,
				showCancelButton: true,
				didOpen: () => {
					$('#addRx_form').val(temp.form).trigger('change');
				},
				cancelButtonColor: errorColor
			}).then(result => {
				if(result.value){
					prescriptions[index] = {
						generic_name: $('#addRx_generic_name').val(),
						brand_name: $('#addRx_brand_name').val(),
						qty: $('#addRx_qty').val(),
						form: $('#addRx_form').val(),
						instruction: $('#addRx_instruction').val(),
					};
				}

				createPrescription();
			})
		}

		function deleteRX(index){
			prescriptions.splice(index,1);
			createPrescription();
		}

		function loadRXList(){
			let rxString = "";

			if(prescriptions.length){
				prescriptions.forEach((prescription, index) => {
					rxString += `
						<div class="row align-items-center" data-index="${index}" style="border-top: 1px solid #abaab4; padding-top: 10px; padding-bottom: 10px;">
							<div class="col-md-5">
								<h5 style="margin-bottom: 0px;"><b>${prescription.generic_name} / ${prescription.brand_name}</b></h6>
								<span style="font-size: 14px;">
									${prescription.instruction}
								</span>
							</div>
							<div class="col-md-2" style="text-align: center;">
								${prescription.qty} ${prescription.form}
							</div>
							<div class="col-md-5" style="text-align: right;">
								<a class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit" onclick="editRX(${index})">
									<i class="fas fa-pencil"></i>
								</a>
								<a class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete" onclick="deleteRX(${index})">
									<i class="fas fa-trash"></i>
								</a>
							</div>
						</div>
					`;
				});

				rxString += "<hr>"
			}
			else{
				rxString = `
					<div class="col-md-12">No Record</div>
				`;
			}

			$('#rxlist').html(rxString);
		}
	</script>
@endpush