define(function (require, exports, module) {

  let Validator = require('bootstrap.validator')
  require('common/validator-rules').inject(Validator)

  let Notify = require('common/bootstrap-notify')

  exports.run = function () {
    let $form = $('#password-reset-form')
    let validator = new Validator({
      element: '#password-reset-form',
      autoSubmit: false,
      onFormValidated: function (error, results, $form) {
        if (error) {
          return
        }
        $('#password-reset-btn').button('submiting').addClass('disabled')

        let $modal = $('#modal')
        $.ajax({
          url: $form.attr('action'),
          data: $form.serialize(),
          type: 'PATCH',
          contentType: 'application/x-www-form-urlencoded',
          dataType: 'json',
          success: (res) => {
            $modal.modal('hide')
            Notify.success(res.msg)
          },
          error: (res) => {
            Notify.danger(res.msg)
          }
        })
      }
    })

    validator.addItem({
      element: '[name="newPassword"]',
      required: true,
      rule: 'minlength{min:6} maxlength{max:20}'
    })

    validator.addItem({
      element: '[name="confirmPassword"]',
      required: true,
      rule: 'confirmation{target:#newPassword}'
    })
  }
})
