@extends('layouts.sidebar')
@section('content')
<div class="border shadow" style="width:90%; border-radius:5px; background:#FFF; margin:25px 80px;">
<p class="text-center mb-3 mt-3">{{ $calendar->getTitle() }}</p>
  <div class="m-auto" style="border-radius:5px; width:85%;">
    {!! $calendar->render() !!}
    <div class="m-auto text-right">
      <input type="submit" class="btn btn-primary mb-3" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div>
@endsection
