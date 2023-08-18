$(function () {
  $('.cancel-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var delete_date = $(this).attr('delete_date');  //日付の情報を取得
    var delete_part = $(this).attr('delete_part');    //何部かの情報を取得
    $('.delete_reserve_date').text('予約日:' + delete_date);
    $('.delete_reserve_part').text('時間:リモ' + delete_part + '部');
    $('.cancel-modal-hidden-date').val(delete_date);
    $('.cancel-modal-hidden-part').val(delete_part);
    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});
