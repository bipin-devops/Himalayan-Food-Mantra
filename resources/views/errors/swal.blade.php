@if($errors->any())

    @php
      $message = "";
      $class = "";
    @endphp
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if($errors->has('alert-' . $msg))
            @php
             $message .= $errors->first('alert-' .$msg) ."</br>";
             $class = $msg == "danger" ? "error" : $msg;
            @endphp
        @endif
    @endforeach

    <script>
        Swal.fire({
            icon: "{{ $class }}",
            html: "{!! $message !!}",
        })
    </script>

@endif
