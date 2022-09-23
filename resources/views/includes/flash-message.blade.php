@if ($message = Session::get('primary'))
    <div class="alert alert-primary bg-primary text-light border-0 alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('secondary'))
    <div class="alert alert-secondary bg-secondary text-light border-0 alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('success'))
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            console.log('success');
            sweetAlart('success', '{{ $message }}');
        });
    </script>
@endif

@if ($message = Session::get('error'))
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            console.log('error');
            sweetAlart('error', '{{ $message }}');
        });
    </script>
@endif

@if ($message = Session::get('warning'))
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            console.log('warning');
            sweetAlart('warning', '{{ $message }}');
        });
    </script>
@endif

@if ($message = Session::get('info'))
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            console.log('info');
            sweetAlart('info', '{{ $message }}');
        });
    </script>
@endif

@if ($message = Session::get('light'))
    <div class="alert alert-light bg-light border-0 alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('dark'))
    <div class="alert alert-dark bg-dark text-light border-0 alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
    function sweetAlart(alert, message) {
        return Swal.fire({
            icon: `${alert}`,
            title: `${message}`,
            showConfirmButton: true,
            timer: 3000
        });
    }
</script>
