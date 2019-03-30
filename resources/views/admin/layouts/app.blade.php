<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge, chrome=1">
  <meta name="renderer" content="webkit">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', config('app.name')) - Laravel</title>
  <meta name="description" content="@yield('description', 'Laravel Artisan')"/>
  <link rel="stylesheet" href="{{ asset('backend/libs/gallery2/bootstrap/3.1.1/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/css/admin.css') }}">
  @yield('styles')
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="phl">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('admin.dashboard') }}">LaravelBBS-管理后台</a>
    </div>
    <div class="navbar-collapse collapse">
      @yield('sidebar')
      @include('admin.partials.navbar', ['navbars' => $navbars])
    </div>
  </div>
</div>

<div class="container">
  @if (request()->routeIs('admin.dashboard'))
    @yield('content', 'Dashboard Content')
  @else
    <div class="row">
      <div class="col-md-2">@include('admin.partials.sidebar')</div>
      <div class="col-md-10">
        @include('admin.partials.tabbar')
        @yield('content', 'Default Content')
      </div>
    </div>
  @endif
</div>

@if (app()->isLocal())
  @include('sudosu::user-selector')
@endif

<script>
var app = {}
app.debug = '{{ config('app.debug') }}'
app.version = '{{ config('app.version') }}'
app.httpHost = '{{ config('app.url') }}'
app.basePath = ''
app.theme = 'jianmo'
app.jsPaths = {
  'common': 'common',
  'theme': '\/themes\/jianmo\/js',
  'adminbundle': '\/bundles\/admin\/js'
}

window.CKEDITOR_BASEPATH = app.basePath + '/backend/libs/ckeditor/4.6.7/'
window.CLOUD_FILE_SERVER = ''

app.config = {
  'api': { 'weibo': { 'key': '' }, 'qq': { 'key': '' }, 'douban': { 'key': '' }, 'renren': { 'key': '' } },
  'loading_img_path': '\/backend\/img\/default\/loading.gif?version=' + app.version
}
app.arguments = {}
app.controller = 'default/index'
app.scripts = null
app.uploadUrl = '{{ route('admin.files.upload') }}'
app.imgCropUrl = '{{ route('admin.files.crop') }}'
app.lessonCopyEnabled = '0'
app.mainScript = '/bundles/admin/js/admin-app.js?version=' + app.version
app.lang = 'zh_CN'
</script>
<script src="{{ asset('bundles/translations/translator.min.js') }}"></script>
<script src="{{ asset('bundles/translations/zh_CN.js') }}"></script>
<script src="{{ asset('backend/libs/seajs/seajs/2.2.1/sea.js') }}"></script>
<script src="{{ asset('backend/libs/seajs/seajs-style/1.0.2/seajs-style.js') }}"></script>
<script src="{{ asset('backend/libs/seajs/seajs-text/1.1.1/seajs-text.min.js') }}"></script>
<script src="{{ asset('backend/libs/seajs-global-config.js') }}"></script>
<script>seajs.use(app.mainScript)</script>
<div class="modal" id="modal"></div>
<div class="modal" id="attachment-modal"></div>
<div class="fixed-bar">
  <a href="#" target='_blank' class="icon-question-text feedback">
    <i class="es-icon es-icon-help"></i>
    <span>产品<br/>反馈</span>
  </a>
</div>
@yield('scripts')
</body>
</html>
