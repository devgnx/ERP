@if (session('messages.status'))
  @if (session('messages.status.success'))
    <div class="ls-alert-success">{{-- <strong>Sucesso!</strong> --}}{{ session('messages.status.success') }}!</div>
  @endif

  @if (session('messages.status.info'))
    <div class="ls-alert-info">{{-- <strong>Atenção:</strong> --}}{{ session('messages.status.info') }}</div>
  @endif

  @if (session('messages.status.warning'))
    <div class="ls-alert-warning">{{-- <strong>Cuidado:</strong> --}}{{ session('messages.status.warning') }}</div>
  @endif

  @if (session('messages.status.danger'))
    <div class="ls-alert-danger">{{-- <strong>Vish!</strong> --}}{{ session('messages.status.danger') }}</div>
  @endif
@endif