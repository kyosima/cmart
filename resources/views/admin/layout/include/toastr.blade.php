@if (session('success'))
    <script>
        toastr.success('{{ session('success') }}', {
            timeOut: 5000
        })
    </script>
@endif
@if (session('error'))
    <script>
        toastr.error('{{ session('error') }}', {
            timeOut: 5000
        })
    </script>
@endif
@if ($errors->any())
    @foreach($errors->all() as $val)
        <script>
            toastr.error('{{ $val }}', {
                timeOut: 5000
            })
        </script>
    @endforeach
@endif