var __URL_PROTOCOL = 'https:' === document.location.protocol ? 'https' : 'http'

seajs.config({
  alias: {
    'jquery': 'jquery/1.11.2/jquery',
    '$': 'jquery/1.11.2/jquery',
    '$-debug': 'jquery/1.11.2/jquery',
    'jquery.jcrop': 'jquery-plugin/jcrop/0.9.12/jcrop',
    'jquery.jcrop-css': 'jquery-plugin/jcrop/0.9.12/jcrop.css',
    'bootstrap': 'gallery2/bootstrap/3.1.1/bootstrap',
    'upload': 'arale/upload/1.1.0/upload',
    'bootstrap.validator': 'common/validator',
    'bootstrap.daterangepicker': 'common/bootstrap-daterangepicker',
    'class': 'arale/class/1.1.0/class',
    'base': 'arale/base/1.1.1/base',
    'widget': 'arale/widget/1.1.1/widget',
    'position': 'arale/position/1.0.1/position',
    'overlay': 'arale/overlay/1.1.4/overlay',
    'mask': 'arale/overlay/1.1.4/mask',
    'sticky': 'arale/sticky/1.3.1/sticky',
    'cookie': 'arale/cookie/1.0.2/cookie',
    'messenger': 'arale/messenger/2.0.1/messenger',
    'templatable': 'arale/templatable/0.9.1/templatable',
    'placeholder': 'arale/placeholder/1.1.0/placeholder',
    'messenger': 'arale/messenger/2.0.1/messenger',
    'templatable': 'arale/templatable/0.9.1/templatable',
    'placeholder': 'arale/placeholder/1.1.0/placeholder',
    'ckeditor': 'ckeditor/4.6.7/ckeditor',
    'es-ckeditor': 'common/es-ckeditor',
    'webuploader': 'gallery2/webuploader/0.1.2/webuploader',
    'webuploader2': 'webuploader/0.1.5/webuploader',
    'bbs.webuploader': 'bbs/webuploader/1.0.3/web-uploader.js',
    'bbs.imagecrop': 'bbs/imagecrop/1.0.2/image-crop.js',
    'z_tree': 'jquery-plugin/z_tree/js/jquery.ztree.all-3.5.min',
    'z_tree_css': 'jquery-plugin/z_tree/css/zTreeStyle/zTreeStyle.css',
    'bbs.tree': 'bbs/tree/1.0.0/tree.js',
    'z_tree': 'jquery-plugin/zTree/3.5.21/js/jquery.ztree.all.min',
    'z_tree_exhide': 'jquery-plugin/zTree/3.5.21/js/jquery.ztree.exhide.js',
    'z_tree_css': 'jquery-plugin/zTree/3.5.21/css/zTreeStyle/zTreeStyle.css'
  },

  // 预加载项
  preload: [this.JSON ? '' : 'json'],

  base: '/backend/libs',

  // 路径配置
  paths: app.jsPaths,

  // 变量配置
  vars: {
    'locale': app.lang
  },

  charset: 'utf-8',

  debug: app.debug,

  base: app.basePath + '/backend/libs',

  plugins: ['text']
})

var __SEAJS_FILE_VERSION = '?v' + app.version

seajs.on('fetch', function (data) {
  if (! data.uri) {
    return
  }

  if (data.uri.indexOf(app.mainScript) > 0) {
    return
  }

  if (/\:\/\/.*?\/backend\/libs\/[^(common)]/.test(data.uri)) {
    return
  }

  data.requestUri = data.uri + __SEAJS_FILE_VERSION
})

seajs.on('define', function (data) {
  if (data.uri.lastIndexOf(__SEAJS_FILE_VERSION) > 0) {
    data.uri = data.uri.replace(__SEAJS_FILE_VERSION, '')
  }
})

seajs.on('require', function (data) {
  if ((data.id === '$' || data.id === 'jquery' || data.id === '$-debug') && (typeof window.jQuery !== 'undefined' || typeof window.$ !== 'undefined')) {
    data.exec = function () {
      return window.$
    }
  }
})
