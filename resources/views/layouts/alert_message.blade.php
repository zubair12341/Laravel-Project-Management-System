<style>
    #alert-container {
    position: relative;
    top: 20px; /* adjust this value as needed to position the alert below your header */
}

#alert {
    position: absolute;
    width: 100%;
    z-index: 100;
}

</style>
{{-- Success message on submit --}}
<div id="alert-container">
@if (session('success'))
    <div id="alert" class="alert alert-success alert-dismissible fade in mb-1"  role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>
        <strong>Done!</strong> {{session('success')}}
    </div>
@endif
</div>
@if (session('error'))
    <div id="alert" class="alert alert-danger alert-dismissible fade in mb-1" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>
        <strong>Error!</strong> {{session('error')}}
    </div>
@endif

{{-- Updated message on update --}}
@if (session()->has('update'))
    <div id="alert" class="alert alert-success alert-dismissible fade in mb-1" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Done!</strong> {{session('update')}}
    </div>
@endif

{{-- Delete message on delete--}}
@if(session()->has('delete'))
    <div id="alert" class="alert alert-danger alert-dismissible fade in mb-1" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Done!</strong> {{session('delete')}}
    </div>
@endif

