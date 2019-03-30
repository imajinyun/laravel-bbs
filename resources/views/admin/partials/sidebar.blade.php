<div class="list-group left-navbar">
  @if (isset($sidebar))
    @foreach($navbars[$sidebar]['children'] as $navbar)
      @php($isNavbarActived = ! empty($navbar['uri']) && route($navbar['uri']) === request()->getUri())
      @php($isParentActived = false)
      @foreach($navbar['children'] as $item)
        @if (!empty($item['uri']) && route($item['uri']) === request()->getUri())
          @php($isParentActived = true)
          @break
        @endif
      @endforeach
      <a href="{{ ! empty($navbar['uri']) && $navbar['uri'] ? route($navbar['uri']) : '#' }}"
         class="list-group-item {{ $isNavbarActived || $isParentActived ? 'active' : '' }}"
         title="{{ $navbar['name'] }}">
        {{ $navbar['name'] }}
      </a>
    @endforeach
  @endif
</div>
