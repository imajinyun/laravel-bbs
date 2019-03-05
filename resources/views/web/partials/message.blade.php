<div class="row justify-content-center">
  <div class="col-md-12">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(session()->has($msg))
        <div class="flash-message">
          <p class="alert alert-{{ $msg }}">
            @if ($msg === 'danger')❌
            @elseif ($msg === 'warning')⚠️
            @elseif ($msg === 'success')🙏
            @else🦋
            @endif
            {{ session()->get($msg) }}
          </p>
        </div>
      @endif
    @endforeach
  </div>
</div>
