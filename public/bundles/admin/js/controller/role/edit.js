define(function (require, exports, module) {

  var Validator = require('bootstrap.validator')
  var Notify = require('common/bootstrap-notify')
  require('common/validator-rules').inject(Validator)

  var Tree = require('bbs.tree')

  exports.run = function () {
    let $form = $('#role-add-form')
    let tree = new Tree({
      element: $('#tree')
    })

    $('#role-add-btn').on('click', function (event) {
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

        $.post($form.attr('action'), $form.serialize(), function (response) {
          console.log(response)
          return
          let string = $form.attr('action')

          if (string.indexOf('edit') >= 0) {
            Notify.success(Translator.trans('admin.role.update_success_hint'))
          } else {
            Notify.success(Translator.trans('admin.role.add_success_hint'))
          }
          window.location.reload()
        })
      }
    })

    validator.addItem({
      element: '#name',
      required: true,
      rule: 'byte_minlength{min:2} byte_maxlength{max:20} chinese_alphanumeric remote'
    })

    validator.addItem({
      element: '#test',
      required: true,
      rule: 'minlength{min:2} maxlength{max:20} alphanumeric remote'
    })
  }
})
