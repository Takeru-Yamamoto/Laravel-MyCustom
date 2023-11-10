@if (session()->has('success_message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa-solid fa-check"></i> Success</h5>
        {!! enl2br(session('success_message')) !!}
    </div>
@endif
@if (session()->has('danger_message'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa-solid fa-xmark"></i> Failure</h5>
        {!! enl2br(session('danger_message')) !!}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa-solid fa-xmark"></i> Errors</h5>
        {!! enl2br(implode(PHP_EOL, $errors->all())) !!}
    </div>
@endif
