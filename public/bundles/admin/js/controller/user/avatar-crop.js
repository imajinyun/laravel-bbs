define(function (require, exports, module) {

  var Notify = require('common/bootstrap-notify')
  var ImageCrop = require('bbs.imagecrop')

  exports.run = function () {
    var imagecopy = $('#avatar-crop').clone()
    let $form = $('#avatar-crop-form')

    var imageCrop = new ImageCrop({
      element: '#avatar-crop',
      group: 'user',
      cropedWidth: 200,
      cropedHeight: 200
    })

    $('#modal #avatar-crop').on('load', function () {
      imageCrop.get('img').destroy()

      let dom = $('#modal .controls').get(0)
      $(dom).prepend(imagecopy)

      var newImageCrop = new ImageCrop({
        element: '#avatar-crop',
        group: 'user',
        cropedWidth: 200,
        cropedHeight: 200
      })

      newImageCrop.on('afterCrop', function (response) {
        let url = $('#upload-avatar-btn').data('url')
        $.post(url, {
          images: response
        }, function () {
          Notify.success('头像裁剪成功！', 1)
          $('#modal').load($('#upload-avatar-btn').data('gotoUrl'))
        })
      })

      $('#upload-avatar-btn').click(function (e) {
        e.stopPropagation()

        newImageCrop.crop({
          imgs: {
            large: [200, 200],
            medium: [120, 120],
            small: [48, 48]
          }
        })
      })
    })

    imageCrop.on('afterCrop', function (response) {
      let url = $('#upload-avatar-btn').data('url')
      $.post(url, {
        images: response
      }, function () {
        Notify.success('头像更新成功！', 1)
        $('#modal').load($('#upload-avatar-btn').data('gotoUrl'))
      })
    })

    $('#upload-avatar-btn').click(function (e) {
      e.stopPropagation()

      imageCrop.crop({
        imgs: {
          large: [200, 200],
          medium: [120, 120],
          small: [48, 48]
        }
      })
    })

    $('.go-back').click(function () {
      history.go(-1)
    })
  }
})
