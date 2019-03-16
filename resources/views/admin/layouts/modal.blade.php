<div class="modal-dialog ">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h4 class="modal-title">@yield('title')</h4>
    </div>
    <div class="modal-body">@yield('content', 'Default Content')</div>
    <div class="modal-footer">@yield('footer')</div>
  </div>
</div>

@yield('script')
<script>
window.seajsBoot && window.seajsBoot()
$('[data-toggle=\'popover\']').popover()
</script>
