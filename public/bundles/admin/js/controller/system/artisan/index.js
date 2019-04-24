define(function (require, exports, module) {

  exports.run = function () {

    $('.artisan-command').click(function () {
      $(this).find('.artisan-form').slideDown()
      $(this).find('input[type="text"]').focus()
    })

    $('.close-output').click(function () {
      $('#artisan-output pre').slideUp()
    })
  }
})
