define(function (require, exports, module) {

  let Validator = require('bootstrap.validator')
  let Notify = require('common/bootstrap-notify')
  require('common/validator-rules').inject(Validator)

  exports.run = function () {
    let $form = $('#navigation-form')
    let $modal = $form.parents('.modal')
    let $table = $('#navigation-table')

    let validator = new Validator({
      element: $form,
      autoSubmit: false,
      onFormValidated: function (error, results, $form) {
        if (error) {
          return
        }
        $('#navigation-save-btn').button('submiting').addClass('disabled')
        $.ajax({
          url: $form.attr('action'),
          data: $form.serialize(),
          type: $('input[name="_method"]').val(),
          dataType: 'json',
          success: function (response) {
            $modal.modal('hide')
            if (response.status) {
              Notify.success(response.msg)
            } else {
              Notify.danger(response.msg)
            }
            window.location.reload()
          },
          error: function (response) {
            Notify.danger('操作失败！')
          }
        })
        // $.post($form.attr('action'), $form.serialize(), function (response) {
        //   $modal.modal('hide')
        //   if (response.status) {
        //     Notify.success(response.msg)
        //   } else {
        //     Notify.danger(response.msg)
        //   }
        //   window.location.reload()
        // })
      }
    })

    validator.addItem({
      element: '[name="name"]',
      required: true
    })

    validator.addItem({
      element: '[name="href"]',
      required: true
    })
  }

})
