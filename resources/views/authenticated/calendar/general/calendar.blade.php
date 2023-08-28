@extends('layouts.sidebar')

@section('content')
<div class="pt-3" style="height:125vh;">
  <div class="border m-auto pt-3 pb-3 mb-3 shadow" style="width:90%; border-radius:5px; background:#FFF;">
    <div class="m-auto" style="border-radius:5px; width:85%;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right m-auto" style="width:85%;">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>
@endsection
