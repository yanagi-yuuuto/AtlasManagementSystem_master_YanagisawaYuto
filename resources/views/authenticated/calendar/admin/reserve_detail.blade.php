@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-75 m-auto h-75">
    <p><span>{{ date('Y年n月j日', strtotime($date)) }}</span><span class="ml-3">{{ $part }}部</span></p>
    <div class="reserve-box">
      <table class="w-100">
        <tr class="text-center w-100" style="background-color: #03aad2; color: white; font-size:0.8rem;">
          <th class="w-25">ID</th>
          <th class="">名前</th>
          <th class="">場所</th>
        </tr>
      @foreach($reservePersons as $reservePerson)
        @foreach($reservePerson->users as $user)
        <tr class="text-center" style="font-size:0.8rem;">
          <td class="w-25">{{ $user->id }}</td>
          <td class="">{{ $user->over_name }}{{ $user->under_name }}</td>
          <td class="">リモート</td>
        </tr>
       @endforeach
      @endforeach
      </table>
    </div>
  </div>
</div>
@endsection
