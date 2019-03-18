define(function (require, exports, module) {
  var Widget = require('widget')
  require('jquery.jcrop-css')
  require('jquery.jcrop')

  var ImageCrop = Widget.extend({
    attrs: {
      group: 'default'
    },

    events: {},

    setup: function () {
      var self = this
      var $picture = this.element

      var scaledWidth = $picture.attr('width'),
        scaledHeight = $picture.attr('height'),
        naturalWidth = $picture.data('naturalWidth'),
        naturalHeight = $picture.data('naturalHeight'),
        cropedWidth = this.get('cropedWidth'),
        cropedHeight = this.get('cropedHeight'),
        ratio = cropedWidth / cropedHeight,
        selectWidth = (cropedWidth) * (naturalWidth / scaledWidth),
        selectHeight = (cropedHeight) * (naturalHeight / scaledHeight)

      /** $picture.css('height', scaledHeight); */
      var img = $.Jcrop($picture, {
        trueSize: [naturalWidth, naturalHeight],
        setSelect: [0, 0, selectWidth, selectHeight],
        aspectRatio: ratio,
        keySupport: false,
        allowSelect: false,
        onSelect: function (c) {
          self.trigger('select', c)
        }
      })
      self.set('img', img)
    },

    crop: function (postData) {
      let self = this
      let cropImgUrl = app.imgCropUrl
      if (!postData) {
        postData = {}
      }

      postData = $.extend(this.get('img').tellScaled(), postData, {
        width: this.element.width(),
        height: this.element.height(),
        group: self.get('group')
      })

      // 由于小数精度问题，jcrop 计算出的 x，y 初始坐标可能小于 0，比如 -2.842170943040401e-14, 应当修正此类非法数据
      postData.x = postData.x > 0 ? postData.x : 0
      postData.y = postData.y > 0 ? postData.y : 0
      $.post(cropImgUrl, postData, function (response) {
        self.trigger('afterCrop', response)
      })
    }
  })

  module.exports = ImageCrop
})
