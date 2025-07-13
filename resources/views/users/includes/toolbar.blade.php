<h3 class="float-right">
    @if(auth()->user()->role == "Admin")
        <a class="btn btn-success btn-sm" data-toggle="tooltip" title="Add User" onclick="create()">
            <i class="fas fa-plus"></i>
        </a>
    @endif
</h3>