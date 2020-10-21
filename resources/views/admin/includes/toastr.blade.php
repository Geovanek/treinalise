<script type="text/javascript">

    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
    
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
    
            case 'error':
                toastr.error("{{ Session::get('message') }}", 'Erro', {
                    progressBar: true,
                    timeOut: 10000,
                    showMethod: "slideDown",
                    hideMethod: "fadeOut",
                });
                break;
        }
    @endif
</script>