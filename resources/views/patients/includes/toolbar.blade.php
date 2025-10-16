<div class="d-flex justify-content-end align-items-center gap-2">
  <!-- Add Patient button -->
  <a class="btn btn-success btn-sm" data-bs-toggle="tooltip" title="Add Patient" onclick="create()">
    <i class="fas fa-plus"></i>
  </a>

  &nbsp;
  &nbsp;

  <!-- Search input -->
  <input type="text" class="form-control form-control-sm w-auto" placeholder="Enter patient name" id="searchInput">

  <!-- Search button -->
  <button class="btn btn-primary btn-sm" onclick="proceedSearch()">
    <i class="fas fa-search"></i> Search
  </button>
</div>