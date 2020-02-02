@foreach (['default', 'primary', 'secondary', 'secondary', 'success', 'info', 'warning', 'danger', ''] as $msg)
@if(Session::has('alert-' . $msg))
<div class="error_container alert alert-{{ $msg }}" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <em>{{ Session::get('alert-' . $msg) }}</em>
    {{ Session::forget('alert-' . $msg) }}

</div>
@endif
@endforeach
