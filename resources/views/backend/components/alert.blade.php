<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "positionClass": "toast-top-right",
    };
    @if(session('success'))
        toastr.success('{{ session('success') }}');
    @endif

    @if(session('error'))
        toastr.error('{{ session('error') }}');
    @endif

    @if(session('warning'))
        toastr.warning('{{ session('warning') }}');
    @endif

    @if(session('info'))
        toastr.info('{{ session('info') }}');
    @endif
</script>