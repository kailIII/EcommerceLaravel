(function ($) {
  $('.spinner .btn:first-of-type').on('click', function() {
    var inputObj = $('#cart-item-'+($(this).data('id')));
    inputObj.val( parseInt(inputObj.val(), 10) + 1);
    inputObj.trigger('change');
  });
  $('.spinner .btn:last-of-type').on('click', function() {
    var inputObj = $('#cart-item-'+($(this).data('id')));
  	if (parseInt(inputObj.val(), 10) > 1) {
      inputObj.val( parseInt(inputObj.val(), 10) - 1);
      inputObj.trigger('change');
    }
  });
})(jQuery);