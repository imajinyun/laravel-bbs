define(function (require, exports, module) {

  require('z_tree')
  require('z_tree_css')
  require('z_tree_exhide')

  var Widget = require('widget')
  var Tree = Widget.extend({

    attrs: {
      zTree: null
    },

    setup: function () {
      var self = this
      var element = self.element
      var defaultSetting = {
        check: {
          enable: true,
          chkboxType: { 'Y': 'ps', 'N': 'ps' }
        },
        data: {
          simpleData: {
            enable: true,
            idKey: 'id',
            pIdKey: 'parent_id'
          }
        }
      }

      var setting = $.extend(self.get(), defaultSetting)
      var zNodes = element.find('textarea').text()

      this.set('zTree', $.fn.zTree.init($(element), setting, JSON.parse(zNodes)))
    },

    getCheckedNodes: function () {
      var tree = this.get('zTree')

      return tree.getCheckedNodes(true)
    }
  })

  module.exports = Tree
})
