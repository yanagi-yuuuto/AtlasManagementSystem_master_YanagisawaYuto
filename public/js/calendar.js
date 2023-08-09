$(function () {
  $('.cancel-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    // var  = $(this).attr('');  日付の情報を取得
    // var post_body = $(this).attr('post_body');    何部かの情報を取得
    // $('.modal-inner-date').text(); 上で取得した日付の情報を表示
    // $('.modal-inner-parts').text(post_body); 上で取得した何部かの情報を表示
    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});
