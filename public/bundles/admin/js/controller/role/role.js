define(function (require, exports, module) {

  var Validator = require('bootstrap.validator')
  var Notify = require('common/bootstrap-notify')
  require('common/validator-rules').inject(Validator)

  var Tree = require('bbs.tree')

  exports.run = function () {
    let $form = $('#role-form')
    let tree = new Tree({
      element: $('#tree')
    })

    $('#role-btn').on('click', function (event) {
      let checkedNodes = tree.getCheckedNodes()
      let checkedNodesArray = []
      for (let i = 0; i < checkedNodes.length; i++) {
        checkedNodesArray.push(checkedNodes[i].id)
      }
      $('#menus').val(JSON.stringify(checkedNodesArray))
    })

    let validator = new Validator({
      element: $form,
      autoSubmit: false,
      onFormValidated: function (error, results, $form) {
        if (error) {
          return
        }

        $.ajax({
          url: $form.attr('action'),
          data: $form.serialize(),
          type: $('input[name="_method"]').val(),
          dataType: 'json',
          success: function (response) {
            Notify.success(response.msg)
            window.location.reload()
          },
          error: function (jqXHR, textStatus, errorThrown) {
            Notify.danger('操作失败！')
          }
        })

        // $.post($form.attr('action'), $form.serialize(), function (response) {
        //   if ($form.attr('action').indexOf('edit') >= 0) {
        //     Notify.success(response.msg)
        //   } else {
        //     Notify.success(response.msg)
        //   }
        //   // window.location.reload()
        // })
      }
    })

    validator.addItem({
      element: '#name',
      required: true,
      rule: 'byte_minlength{min:2} byte_maxlength{max:20} chinese_alphanumeric remote'
    })

    validator.addItem({
      element: '#slug',
      required: true,
      rule: 'minlength{min:2} maxlength{max:20} alphanumeric remote'
    })
  }
})
