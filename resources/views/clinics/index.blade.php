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

                        @include('clinics.includes.toolbar')
                    </div>

                    <div class="card-body table-responsive">
                    	<table id="table" class="table table-hover" style="width: 100%;">
                    		<thead>
                    			<tr>
                    				<th>ID</th>
                    				<th>Name</th>
                    				<th>Location</th>
                    				<th>Region</th>
                    				<th>Contact</th>
                    				<th>PF</th>
                    				<th>Registered on</th>
                    				<th>Status</th>
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
	<link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/datatables.bundle.min.css') }}">
	{{-- <link rel="stylesheet" href="{{ asset('css/datatables.bootstrap4.min.css') }}"> --}}
	{{-- <link rel="stylesheet" href="{{ asset('css/datatables-jquery.min.css') }}"> --}}
@endpush

@push('scripts')
	<script src="{{ asset('js/datatables.min.js') }}"></script>
	<script src="{{ asset('js/datatables.bundle.min.js') }}"></script>
	{{-- <script src="{{ asset('js/datatables.bootstrap4.min.js') }}"></script> --}}
	{{-- <script src="{{ asset('js/datatables-jquery.min.js') }}"></script> --}}

	<script>
		$(document).ready(()=> {
			var table = $('#table').DataTable({
				ajax: {
					url: "{{ route('datatable.clinic') }}",
                	dataType: "json",
                	dataSrc: "",
					data: {
						select: "*"
					}
				},
				columns: [
					{data: 'id'},
					{data: 'name'},
					{data: 'location'},
					{data: 'region'},
					{data: 'contact'},
					{data: 'pf'},
					{data: 'created_at'},
					{data: 'status'},
					{data: 'actions'},
				],
        		pageLength: 25,
	            columnDefs: [
	                {
	                    targets: 6,
	                    render: created_at => {
	                        return toDate(created_at);
	                    },
	                },
	                {
	                    targets: 7,
	                    render: status => {
	                        if(status){
	                        	return `<span class="text-bold text-success">Active</span>`;
	                        }
	                        else{
	                        	return `<span class="text-bold text-danger">Inactive</span>`;
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

		function updateStatus(id, status){
			let change = status ? "activate" : "deactivate";
			sc("Confirmation", `Are you sure you want to ${change} clinic?`, result => {
				if(result.value){
					swal.showLoading();
					update({
						url: "{{ route('clinic.update') }}",
						data: {id: id, status: status},
						message: "Success"
					}, () => {
						reload();
					})
				}
			});
		}
	</script>
@endpush