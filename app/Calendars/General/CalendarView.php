<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';

      $days = $week->getDays();
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = $this->carbon->copy()->format("Y-m-d");

        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<td class="calendar-td" style="background-color:#eee;>';
        }else{
          $html[] = '<td class="calendar-td '.$day->getClassName().'">';
        }
        $html[] = $day->render();

        if(in_array($day->everyDay(), $day->authReserveDay())){  //予約している場合
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reserveParts = "リモ1部";
          }else if($reservePart == 2){
            $reserveParts = "リモ2部";
          }else if($reservePart == 3){
            $reserveParts = "リモ3部";
          }
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){  //過去
            if($reservePart == 1){
              $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">1部参加</p>';
            }else if($reservePart == 2){
              $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">2部参加</p>';
            }else if($reservePart == 3){
              $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">3部参加</p>';
            }
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{  //未来
            $html[] = '<span class="btn btn-danger p-0 w-75 cancel-modal-open" delete_date="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'" delete_part="'. $reservePart .'" style="font-size:12px" value="">'. $reserveParts .'</span>';
            $html[] = '<input type="hidden" name="getPart[]" value="'. $reserveParts .'" form="reserveParts">';
          }
        }else{  //予約していていない場合
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){  //過去
           $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">受付終了</p>';
           $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{ //未来
           $html[] = $day->selectPart($day->everyDay());
          }
        }
        $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';

    $html[] = '<div class="modal js-modal">';
    $html[] = '<div class="modal__bg js-modal-close"></div>';
    $html[] = '<div class="modal__content">';
    $html[] = '<div class="w-100">';
    $html[] = '<div class="modal-inner-title w-75 m-auto">';
    $html[] = '<p class="delete_reserve_date"></p>';
    $html[] = '<p class="delete_reserve_part"></p>';
    $html[] = '<p>上記の予約をキャンセルしてよろしいですか？</p>';
    $html[] = '</div>';
    $html[] = '<div class="w-75 m-auto edit-modal-btn d-flex">';
    $html[] = '<a class="js-modal-close btn btn-primary d-inline-block" href="" style="font-size:0.7rem">閉じる</a>';
    $html[] = '<input type="hidden" class="cancel-modal-hidden-date" name="delete_date" value="" form="deleteParts">';
    $html[] = '<input type="hidden" class="cancel-modal-hidden-part" name="delete_part" value="" form="deleteParts">';
    $html[] = '<input type="submit" class="btn btn-danger d-block" value="キャンセル" form="deleteParts" style="font-size:0.7rem">';
    $html[] = '</div>';
    $html[] = '</div>';
    $html[] = '</div>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
