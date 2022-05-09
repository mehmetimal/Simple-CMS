@if(\Illuminate\Support\Facades\Session::has('message'))
    <script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: '{{\Illuminate\Support\Facades\Session::get('message')}}',
        showConfirmButton: false,
        timer: 1500
    })
</script>



@endif
@if(\Illuminate\Support\Facades\Session::has('error'))
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: '{{\Illuminate\Support\Facades\Session::get('error')}}',
            showConfirmButton: true,

        })
    </script>

@endif
