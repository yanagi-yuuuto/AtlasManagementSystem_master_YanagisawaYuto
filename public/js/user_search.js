$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
  });

  $('.main_categories').click(function () {
    var targetID = $(this).data('target');
    $('#category-button-' + targetID).slideToggle();
  });
});

$(function () {
  $('.arrow_btn').click(function () {
    $(".arrow").toggleClass("upper");
  });

  $('.category_arrow_btn').click(function () {
    var targetID = $(this).data('target');
    $(".arrow_" + targetID).toggleClass("upper");
  });
});
