<!-- Partial - Manager::partials.message !-->
@if(Session::has('msg'))
    <script type="text/javascript">
        @if(Session::get('success'))
           toastr.success('{{ Session::get('msg') }}');
        @else
            toastr.error('{{ Session::get('msg') }}');
        @endif
    </script>
@endif