<script type="text/javascript">
    Cufon.now();
</script>
<script>
    let error = '{{ session('error') }}';
    let success_message = '{{ session('success') }}';
    if (error) {
        errorMessage(error);
        error = "";
    }
    if (success_message) {
        successMessage(success_message);
        success = "";
    }

    function successMessage(success_message) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: success_message
        });
    }

    function errorMessage(error_message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error_message
        });
    }
</script>
