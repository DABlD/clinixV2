@extends('layouts.app')
@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">

        	{{-- PACKAGES --}}
            <section class="col-lg-4 connectedSortable soap-categories">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <img src="{{ asset('images/icons/px.png') }}" width="30px">
                            Px
                        </h3>
                    </div>

                    <div class="card-body table-responsive">
                    	<div class="row">
                    		<div class="col-md-9">
                    			Medical History
                    		</div>
                    		<div class="col-md-3">
                    			<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" onclick="viewPackage('Medical Examination Report')">
                    				<i class="fas fa-search fa-xs"></i>
                    			</a>
                    		</div>
                    	</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <img src="{{ asset('images/icons/subjective.png') }}" width="30px">
                            Subjective
                        </h3>
                    </div>

                    <div class="card-body table-responsive">
                    	<div class="row">
                    		<div class="col-md-9">
                    			History of Present Illness
                    		</div>
                    		<div class="col-md-3">
                    			<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" onclick="">
                    				<i class="fas fa-search fa-xs"></i>
                    			</a>
                    		</div>
                    	</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <img src="{{ asset('images/icons/objective.png') }}" width="30px">
                            Objective
                        </h3>
                    </div>

                    <div class="card-body table-responsive">
                    	<div class="row">
                    		<div class="col-md-9">
                    			Vitals
                    		</div>
                    		<div class="col-md-3">
                    			<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" onclick="">
                    				<i class="fas fa-search fa-xs"></i>
                    			</a>
                    		</div>
                    	</div>
                    	<div class="row">
                    		<div class="col-md-9">
                    			Physical Examination
                    		</div>
                    		<div class="col-md-3">
                    			<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" onclick="">
                    				<i class="fas fa-search fa-xs"></i>
                    			</a>
                    		</div>
                    	</div>
                    	<div class="row">
                    		<div class="col-md-9">
                    			Drawing Template
                    		</div>
                    		<div class="col-md-3">
                    			<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" onclick="">
                    				<i class="fas fa-search fa-xs"></i>
                    			</a>
                    		</div>
                    	</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <img src="{{ asset('images/icons/assessment.png') }}" width="30px">
                            Assessment
                        </h3>
                    </div>

                    <div class="card-body table-responsive">
                    	<div class="row">
                    		<div class="col-md-9">
                    			RVU
                    		</div>
                    		<div class="col-md-3">
                    			<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" onclick="showRVU()">
                    				<i class="fas fa-search fa-xs"></i>
                    			</a>
                    		</div>
                    	</div>
                    	<div class="row">
                    		<div class="col-md-9">
                    			ICD
                    		</div>
                    		<div class="col-md-3">
                    			<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" onclick="showICD()">
                    				<i class="fas fa-search fa-xs"></i>
                    			</a>
                    		</div>
                    	</div>
                    	<div class="row">
                    		<div class="col-md-9">
                    			Diagnosis
                    		</div>
                    		<div class="col-md-3">
                    			<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" onclick="showDiagnosis()">
                    				<i class="fas fa-search fa-xs"></i>
                    			</a>
                    		</div>
                    	</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <img src="{{ asset('images/icons/plan.png') }}" width="30px">
                            Plan
                        </h3>
                    </div>

                    <div class="card-body table-responsive">
                    	<div class="row">
                    		<div class="col-md-9">
                    			Frequent Rx
                    		</div>
                    		<div class="col-md-3">
                    			<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" onclick="">
                    				<i class="fas fa-search fa-xs"></i>
                    			</a>
                    		</div>
                    	</div>
                    	<div class="row">
                    		<div class="col-md-9">
                    			Laboratory
                    		</div>
                    		<div class="col-md-3">
                    			<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" onclick="">
                    				<i class="fas fa-search fa-xs"></i>
                    			</a>
                    		</div>
                    	</div>
                    	<div class="row">
                    		<div class="col-md-9">
                    			Imaging
                    		</div>
                    		<div class="col-md-3">
                    			<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" onclick="">
                    				<i class="fas fa-search fa-xs"></i>
                    			</a>
                    		</div>
                    	</div>
                    	<div class="row">
                    		<div class="col-md-9">
                    			Rx Format
                    		</div>
                    		<div class="col-md-3">
                    			<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" onclick="">
                    				<i class="fas fa-search fa-xs"></i>
                    			</a>
                    		</div>
                    	</div>
                    	<div class="row">
                    		<div class="col-md-9">
                    			Services
                    		</div>
                    		<div class="col-md-3">
                    			<a class="btn btn-success btn-sm" data-toggle="tooltip" title="View" onclick="">
                    				<i class="fas fa-search fa-xs"></i>
                    			</a>
                    		</div>
                    	</div>
                    </div>
                </div>
            </section>

            {{-- QUESTIONS --}}
            <section class="col-lg-8 connectedSortable" id="medicalHistory">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="margin-top: 10px;">
                            <i class="fas fa-table mr-1"></i>
                            Medical History
                        </h3>
                        
                        <h3 class="float-right" style="margin-bottom: 0px;">
                            <a class="btn btn-success btn-sm" data-toggle="tooltip" id="addCategory" title="Add Category" onclick="addCategory()">
                                <i class="fas fa-plus fa-xs"></i>
                            </a>
                        </h3>
                    </div>

                    <div class="card-body table-responsive" id="questions">
                    	No Selected Package
                    </div>
                </div>
            </section>

            {{-- RVU --}}
            <section class="col-lg-8 connectedSortable" id="rvu">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="margin-top: 10px;">
                            <i class="fas fa-table mr-1"></i>
                            RVU
                        </h3>
                        
                        <h3 class="float-right" style="margin-bottom: 0px;">
                            <a class="btn btn-success btn-sm" data-toggle="tooltip" title="Add RVU" onclick="addRVU()">
                                <i class="fas fa-plus fa-xs"></i>
                            </a>
                        </h3>
                    </div>

                    <div class="card-body table-responsive">
                    	<table class="table table-hover">
                    		<tbody></tbody>
                    	</table>
                    </div>
                </div>
            </section>

            {{-- ICD --}}
            <section class="col-lg-8 connectedSortable" id="icd">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="margin-top: 10px;">
                            <i class="fas fa-table mr-1"></i>
                            ICD
                        </h3>
                        
                        <h3 class="float-right" style="margin-bottom: 0px;">
                            <a class="btn btn-success btn-sm" data-toggle="tooltip" title="Add ICD" onclick="addICD()">
                                <i class="fas fa-plus fa-xs"></i>
                            </a>
                        </h3>
                    </div>

                    <div class="card-body table-responsive">
                    	<table class="table table-hover">
                    		<tbody></tbody>
                    	</table>
                    </div>
                </div>
            </section>

            {{-- DIAGNOSIS --}}
            <section class="col-lg-8 connectedSortable" id="diagnosis">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="margin-top: 10px;">
                            <i class="fas fa-table mr-1"></i>
                            Diagnosis
                        </h3>
                        
                        <h3 class="float-right" style="margin-bottom: 0px;">
                            <a class="btn btn-success btn-sm" data-toggle="tooltip" title="Add Diagnosis" onclick="addDiagnosis()">
                                <i class="fas fa-plus fa-xs"></i>
                            </a>
                        </h3>
                    </div>

                    <div class="card-body table-responsive">
                    	<table class="table table-hover">
                    		<tbody></tbody>
                    	</table>
                    </div>
                </div>
            </section>

        </div>
    </div>

</section>

@endsection

@push('styles')
	{{-- <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}"> --}}
	<link rel="stylesheet" href="{{ asset('css/datatables.bundle.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

	<style>
		.card-body table td, .card-body table th, #questions{
			text-align: center;
		}

		.qtd td, .qtd th{
			text-align: left !important;
		}

		.qtd th:nth-child(1){
			width: 50%;
		}

		.qtd th:nth-child(2){
			width: 25%;
		}

		.qtd th:nth-child(3){
			width: 25%;
		}

		.soap-categories .row{
			margin-bottom: 5px;
		}

		.card-header{
			background-color: #96c1db;
		}

		.card-title{
			margin-top: 0px;
		}

		.table-responsive{
			padding-top: 8px;
			padding-bottom: 2px;
		}

		.col-lg-8.connectedSortable table{
			border-bottom: 1px solid #dee2e6;
		}
	</style>
@endpush

@push('scripts')
	<script src="{{ asset('js/datatables.min.js') }}"></script>
	<script src="{{ asset('js/datatables.bundle.min.js') }}"></script>
	<script src="{{ asset('js/flatpickr.min.js') }}"></script>
	<script src="{{ asset('js/numeral.min.js') }}"></script>
	<script src="{{ asset('js/select2.min.js') }}"></script>
	<script src="{{ asset('js/table-dnd.js') }}"></script>

	<script>
		$(document).ready(()=> {
			viewPackage('Medical Examination Report');
		});

		// QUESTION FUNCTIONS
		function viewPackage(fPackageName){
			fPackageName = name;
			$('#addCategory').show();

			$.ajax({
				url: "{{ route('question.get') }}",
				data: {
					select: '*',
					group: ['category_id']
				},
				success: result => {
					result = JSON.parse(result);
					let keys = Object.keys(result);
					let categories = result[keys[keys.length-1]];

					let string = "";

					if(result[""] != undefined){
						for (let [k, v] of Object.entries(result[""])) {
						    string += `
						    	<div class="row">
						    		<div class="col-md-12" style="text-align: left;">
							    		<b style="font-size: 1.5rem;">${v.name}</b>

							    		&nbsp;
							    		<tr>
								    		<td>
								    			<a class="btn btn-success btn-sm" data-toggle="tooltip" title="Add Inclusion" onclick="getQuestionData(${v.id})">
								    				<i class="fas fa-plus"></i>
								    			</a>
								    			<a class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Category" onclick="deleteCategory(${v.id})">
								    				<i class="fas fa-trash"></i>
								    			</a>
								    		</td>
							    		</tr>
						    		</div>
						    	</div>

						    	<table class="table table-hover qtd" style="width: 100%; margin-top: 5px;">
						    		<thead>
						    			<tr>
						    				<th>Name</th>
						    				<th class="tType">Type</th>
						    				<th class="tCode">Code</th>
						    				<th>Actions</th>
						    			</tr>
						    		</thead>
						    		<tbody>
						    `;

						    let temp = result[v.id];

						    if(temp){
							    for(let i = 0; i < temp.length; i++){
							    	string += `
							    		<tr id="${temp[i].id}">
							    			<td>${temp[i].name}</td>
							    			<td class="tType">${temp[i].type}</td>
							    			<td class="tCode">${temp[i].code}</td>
							    			<td>
							    				<a class="btn btn-info btn-sm" data-toggle="tooltip" title="Edit Inclusion" onclick="editQuestion(${temp[i].id}, '${temp[i].name}', '${temp[i].type}', '${temp[i].code}')">
							    					<i class="fas fa-pencil"></i>
							    				</a>
							    				<a class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Inclusion" onclick="deleteQuestion(${temp[i].id})">
							    					<i class="fas fa-trash"></i>
							    				</a>
							    			</td>
							    		</tr>
							    	`;
							    }
						    }
						    else{
						    	string += `
						    		<tr>
						    			<td colspan="3" style="text-align: center !important;">No Inclusions Added</td>
						    		</tr>
						    	`;
						    }


						    string += "</tbody></table><br>";
						}
					}
					else{
						string = `
							No Categories Added.
						`;
					}

					$('#questions').slideUp(500);
					
					setTimeout(() => {
						$('#questions').html(
							`
								<h1 style="color: #0a73ad; text-align: left;"><b>
						    		${fPackageName}
						    	</b></h1>
						    	${string}
							`
						);

						$('.tCode').hide();
						$('#questions').slideDown();

						$('.qtd').tableDnD({
							onDrop: e => {
								let ids = [];
								
								$(e).find('tr').each((i,row) => {
									if(row.id != ""){
										ids.push(row.id);
									}
								});

								$.ajax({
									url: "{{ route('question.reorderRows') }}",
									type: "POST",
									data: {
										ids: ids,
										_token: $('meta[name="csrf-token"]').attr('content')
									},
									success: result => {
										if(result){
											ss("Successfully reordered inclusion");
										}
									}
								})
							}
						});
					}, 500);
				}
			})
		}

		function addCategory(){
			Swal.fire({
				title: 'Enter Category Name',
				html: `
					${input('name', 'Name', null, 4, 8)}
				`,
				showCancelButton: true,
				cancelButtonColor: errorColor,
				preConfirm: () => {
				    swal.showLoading();
				    return new Promise(resolve => {
				    	let bool = true;

			            if($('.swal2-container input:placeholder-shown').length){
			                Swal.showValidationMessage('Fill all fields');
			            }

			            bool ? setTimeout(() => {resolve()}, 500) : "";
				    });
				},
			}).then(result => {
				if(result.value){
					addQuestion({
						name: $('[name="name"]').val(),
						type: 'Category',
					});
				}
			});
		}

		function getQuestionData(cid){
			Swal.fire({
				title: 'Enter Inclusion',
				html: `
					${input('name', 'Name', null, 3, 9)}
					${input('code', 'Code', null, 3, 9)}
					<div class="row iRow">
					    <div class="col-md-3 iLabel">
					        Type
					    </div>
					    <div class="col-md-9 iInput">
					        <select name="type" class="form-control">
					        	<option value="">Select Type</option>
					        	<option value="Dichotomous">Dichotomous</option>
					        	<option value="Text">Text</option>
					        </select>
					    </div>
					</div>
				`,
				showCancelButton: true,
				cancelButtonColor: errorColor,
				didOpen: () => {
					$('[name="code"]').parent().parent().hide();
				},
				preConfirm: () => {
				    swal.showLoading();
				    return new Promise(resolve => {
				    	let bool = true;

			            if($('[name="name"]').val() == ""){
			                Swal.showValidationMessage('Fill all fields');
			            }

			            bool ? setTimeout(() => {resolve()}, 500) : "";
				    });
				},
			}).then(result => {
				if(result.value){
					addQuestion({
						category_id: cid,
						name: $('[name="name"]').val(),
						code: $('[name="code"]').val(),
						type: $('[name="type"]').val()
					});
				}
			});
		}

		function addQuestion(data){
			$.ajax({
				url: "{{ route('question.store') }}",
				type: "POST",
				data: {
					...data, 
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				success: () => {
					ss("Success");
					viewPackage(1, "Medical Examination Report");
				}
			})
		}

		function editQuestion(id, name, type, code){
			Swal.fire({
				title: 'Enter Details',
				html: `
					${input('name', 'Name', name, 3, 9)}
					${input('code', 'Code', code, 3, 9)}
					<div class="row iRow">
					    <div class="col-md-3 iLabel">
					        Type
					    </div>
					    <div class="col-md-9 iInput">
					        <select name="type" class="form-control">
					        	<option value="">Select Type</option>
					        	<option value="Dichotomous">Dichotomous</option>
					        	<option value="Text">Text</option>
					        	<option class="d-none" value="Inclusion"></option>
					        </select>
					    </div>
					</div>
				`,
				showCancelButton: true,
				cancelButtonColor: errorColor,
				didOpen: () => {
					$("[name='type']").val(type).trigger('change');
					$('[name="code"]').parent().parent().hide();
				},
				preConfirm: () => {
				    swal.showLoading();
				    return new Promise(resolve => {
				    	let bool = true;

			            if($('.swal2-container input:placeholder-shown').length || $('[name="type"]').val() == ""){
			                Swal.showValidationMessage('Fill all fields');
			            }

			            bool ? setTimeout(() => {resolve()}, 500) : "";
				    });
				},
			}).then(result => {
				if(result.value){
					swal.showLoading();
					update({
						url: "{{ route('question.update') }}",
						data: {
							id: id,
							name: $('[name="name"]').val(),
							type: $('[name="type"]').val(),
							code: $('[name="code"]').val(),
						},
						message: "Success"
					}, () => {
						viewPackage("Medical Examination Report");
					})
				}
			});
		}

		function deleteQuestion(id){
			sc("Confirmation", "Are you sure you want to delete this question?", result => {
				if(result.value){
					swal.showLoading();
					update({
						url: "{{ route('question.delete') }}",
						data: {id: id},
						message: "Success"
					}, () => {
						viewPackage("Medical Examination Report");
					})
				}
			});
		}

		function deleteCategory(qid){
			sc("Confirmation", "Are you sure you want to delete this category? This will delete all included questions.", result => {
				if(result.value){
					swal.showLoading();
					update({
						url: "{{ route('question.delete') }}",
						data: {id: qid, category: true},
						message: "Success"
					}, () => {
						viewPackage("Medical Examination Report");
					})
				}
			});
		}

		function hideTemplates(){
			$('.col-lg-8.connectedSortable').slideUp();
		}

		function showRVU(){
			hideTemplates();

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
									<td>${temp.block}</td>
									<td>${temp.description}</td>
								</tr>
							`;
						});
					}
					else{
						string = `
							<tr>
								<td>No Entries</td>
							</tr>
						`;
					}

					$('#rvu .card-body tbody').html(string);
					$('#rvu').slideDown();
				}
			})
		}

		function showICD(){
			hideTemplates();

			$.ajax({
				url: "{{ route('template.getICD') }}",
				success: result => {
					result = JSON.parse(result);

					let string = "";

					if(result.length){
						result.forEach(temp => {
							string += `
								<tr>
									<td>${temp.name}</td>
									<td>${temp.code}</td>
								</tr>
							`;
						});
					}
					else{
						string = `
							<tr>
								<td>No Entries</td>
							</tr>
						`;
					}

					$('#icd .card-body tbody').html(string);
					$('#icd').slideDown();
				}
			})
		}

		function showDiagnosis(){
			hideTemplates();

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
								</tr>
							`;
						});
					}
					else{
						string = `
							<tr>
								<td>No Entries</td>
							</tr>
						`;
					}

					$('#diagnosis .card-body tbody').html(string);
					$('#diagnosis').slideDown();
				}
			})
		}

		function addRVU(){
			Swal.fire({
				title: 'Enter RVU Details',
				html: `
					${input('code', 'Code', null, 4, 8)}
					${input('block', 'Block', null, 4, 8)}
					
					<div class="row iRow">
					    <div class="col-md-4 iLabel">
					        Description
					    </div>
					    <div class="col-md-9 iInput">
					        <textarea name="description" rows="3" placeholder="Enter description"></textarea>
					    </div>
					</div>
				`,
				showCancelButton: true,
				cancelButtonColor: errorColor,
				preConfirm: () => {
				    swal.showLoading();
				    return new Promise(resolve => {
				    	let bool = true;

			            if($('.swal2-container input:placeholder-shown').length){
			                Swal.showValidationMessage('Fill all fields');
			            }

			            bool ? setTimeout(() => {resolve()}, 500) : "";
				    });
				},
			}).then(result => {
				if(result.value){
					addQuestion({
						name: $('[name="name"]').val(),
						type: 'Category',
					});
				}
			});
		}
	</script>
@endpush