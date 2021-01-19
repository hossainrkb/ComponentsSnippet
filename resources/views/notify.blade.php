
    <!-- iziToast -->
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
    <script src="{{ asset('js/iziToast.min.js') }}"></script>

    @if(session()->has('notify'))
      @foreach(session('notify') as $msg)
        <script type="text/javascript">  iziToast.{{ $msg[0] }}({message:"{{ $msg[1] }}", position: "topRight"}); </script>
        @endforeach
    @endif
    {{-- // @dd($errors->any()) --}}

    @if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
            iziToast.success({
                message: '{{ $error }}',
            position: "topRight"
            });
        @endforeach
    </script>

    @endif
    <script>

        function notify(status,message) {
            iziToast[status]({
                message: message,
                position: "topRight"
            });
        }
    </script>

