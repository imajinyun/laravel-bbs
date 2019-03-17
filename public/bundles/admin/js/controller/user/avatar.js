define(function (require, exports, module) {
  let WebUploader = require('bbs.webuploader')
  let Notify = require('common/bootstrap-notify')

  exports.run = function () {
    let uploader = new WebUploader({
      element: '#upload-avatar-btn'
    })

    uploader.on('uploadSuccess', function (file, response) {
      let url = $('#upload-avatar-btn').data('gotoUrl')

      $('#modal').load(url)
      Notify.success(Translator.trans('admin.user.upload_avatar_success_hint'), 1)
    })
  }
})
