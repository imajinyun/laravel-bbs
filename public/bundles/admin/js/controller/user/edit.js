define(function (require, exports, module) {

  var Validator = require('bootstrap.validator')
  require('common/validator-rules').inject(Validator)

  var Notify = require('common/bootstrap-notify')
  require('es-ckeditor')

  exports.run = function () {
    let editor = CKEDITOR.replace('about', {
      toolbar: 'Simple',
      filebrowserImageUploadUrl: $('#about').data('imageUploadUrl')
    })
    let $modal = $('#user-edit-form').parents('.modal')
    let validator = new Validator({
      element: '#user-edit-form',
      autoSubmit: false,
      failSilently: true,
      onFormValidated: function (error, results, $form) {
        if (error) {
          return false
        }
        $('#edit-user-btn').button('submiting').addClass('disabled')

        $.ajax({
          url: $form.attr('action'),
          data: $form.serialize(),
          type: 'PATCH',
          contentType: 'application/json',
          dataType: 'json',
          success: function (html) {
            $modal.modal('hide')
            Notify.success(Translator.trans('用户信息保存成功'))
            let $tr = $(html)
            $('#' + $tr.attr('id')).replaceWith($tr)
          },
          error: function (jqXHR, textStatus, errorThrown) {
            Notify.danger(Translator.trans('操作失败'))
          }
        })
      }
    })

    validator.on('formValidate', function (elemetn, event) {
      editor.updateElement()
    })

    validator.addItem({
      element: '[name="name"]',
      rule: 'chinese_alphanumeric byte_minlength{min:4} byte_maxlength{max:36}'
    })

    validator.addItem({
      element: '[name="qq"]',
      rule: 'qq'
    })

    validator.addItem({
      element: '[name="weibo"]',
      rule: 'url',
      errormessageUrl: Translator.trans('admin.user.valid_weibo_address_input.message')
    })

    validator.addItem({
      element: '[name="site"]',
      rule: 'url',
      errormessageUrl: Translator.trans('admin.user.valid_site_address_input.message')
    })

    validator.addItem({
      element: '[name="mobile"]',
      rule: 'phone'
    })

    validator.addItem({
      element: '[name="idcard"]',
      rule: 'idcard'
    })

    for (var i = 1; i <= 5; i++) {
      validator.addItem({
        element: '[name="intField' + i + '"]',
        rule: 'int'
      })

      validator.addItem({
        element: '[name="floatField' + i + '"]',
        rule: 'float'
      })

      validator.addItem({
        element: '[name="dateField' + i + '"]',
        rule: 'date'
      })
    }
  }
})
