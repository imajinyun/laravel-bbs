define(function (require, exports, module) {

  const WebUploader = require('bbs.webuploader')
  const Notify = require('common/bootstrap-notify')
  const Uploader = require('upload')

  exports.run = function () {
    let $form = $('#site-info-form')
    let uploader = new WebUploader({
      element: '#site-logo-upload'
    })

    uploader.on('uploadSuccess', function (file, response) {
      let url = $('#site-logo-upload').data('gotoUrl')
    })

    $('#site-info-btn').on('click', function () {
      $.ajax({
        url: $form.attr('action'),
        data: $form.serializeArray(),
        type: 'PUT',
        cache: false,
        dataType: 'json',
        success: function (response) {
          Notify.success(response.msg)
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(errorThrown)
        }
      })
    })
  }
})
