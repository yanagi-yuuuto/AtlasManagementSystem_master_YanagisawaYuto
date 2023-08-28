@extends('layouts.sidebar')

@section('content')
<div class="border shadow" style="width:90%; border-radius:5px; background:#FFF; margin:25px 80px; height:115vh;">
  <div class="m-auto" style="border-radius:5px; width:85%;">
    <p class="text-center mt-3 mb-3">{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>
</div>
@endsection
