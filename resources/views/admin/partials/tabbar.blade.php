<div class="page-header clearfix">
  <h1 class="pull-left">@section('title') @parent @show</h1>
  <div class="pull-right">@yield('action')</div>
</div>

@if (isset($sidebar))
  <ul class="nav nav-tabs mbm">
    @foreach($navbars[$sidebar]['children'] as $navbar)
      @php($uris = menu_filter($navbar['children'], 'uri'))
      @php($isUriExists = in_array(request()->url(), $uris, true))
      @if ($isUriExists)
        @foreach($navbar['children'] as $item)
          @if (! empty($item['uri']) && $item['is_show'])
            @php($isNavbarActived = route($item['uri']) === request()->url())
            <li class="{{ $isNavbarActived ? 'active' : '' }}">
              <a href="{{ route($item['uri']) }}" title="{{ $item['name'] }}">{{ $item['name'] }}</a>
            </li>
          @endif
        @endforeach
      @endif
    @endforeach
  </ul>
@endif
