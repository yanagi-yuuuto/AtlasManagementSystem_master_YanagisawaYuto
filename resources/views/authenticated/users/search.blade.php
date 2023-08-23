@extends('layouts.sidebar')

@section('content')
<div class="search_content w-100 d-flex mt-3">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="one_person">
      <div>
        <span>ID : </span><span class="profile-data">{{ $user->id }}</span>
      </div>
      <div><span>名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span class="profile-data">{{ $user->over_name }}</span>
          <span class="profile-data">{{ $user->under_name }}</span>
        </a>
      </div>
      <div>
        <span>カナ : </span>
        <span class="profile-data">{{ $user->over_name_kana }}</span>
        <span class="profile-data">{{ $user->under_name_kana }}</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span>性別 : </span><span class="profile-data">男</span>
        @else
        <span>性別 : </span><span class="profile-data">女</span>
        @endif
      </div>
      <div>
        <span>生年月日 : </span><span class="profile-data">{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span>権限 : </span><span class="profile-data">教師(国語)</span>
        @elseif($user->role == 2)
        <span>権限 : </span><span class="profile-data">教師(数学)</span>
        @elseif($user->role == 3)
        <span>権限 : </span><span class="profile-data">講師(英語)</span>
        @else
        <span>権限 : </span><span class="profile-data">生徒</span>
        @endif
      </div>
      <div>
        @if($user->role == 4)
        <span>
          選択科目 :@foreach($user->subjects as $subject)
          <span class="profile-data">{{ $subject->subject }}</span>
          @endforeach
        </span>
        @endif
      </div>
    </div>
    @endforeach
  </div>
  <div class="search_area w-25 mt-1" style="color: #648199; font-size:0.8rem">
    <div class="">
      <p>検索</p>
      <div>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest" style="">
      </div>
      <div class="mt-1" style="flex-direction: column; display: flex; width:160px">
        <span>カテゴリ</span>
        <select form="userSearchRequest" name="category" class="pulldown">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div class="mt-1" style="flex-direction: column; display: flex; width:160px">
        <span>並び替え</span>
        <select name="updown" form="userSearchRequest" class="pulldown">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>
      <div class="">
        <p class="m-0 search_conditions mt-3" style="border-bottom: 1px solid black; width:350px;"><span>検索条件の追加</span></p>
        <div class="search_conditions_inner" style="background-color: #ecf1f6;">
          <div class="mt-3">
            <span>性別</span>
            <div class="mt-1" style="display:flex;">
            <span style="color: black;">男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span style="margin-left: 10px; color: black;">女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
            </div>
          </div>
          <div class="mt-3" style="flex-direction: column; display: flex; width:180px">
            <span>権限</span>
            <select name="role" form="userSearchRequest" class="engineer pulldown mt-1">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <div class="selected_engineer mt-3">
            <span>選択科目</span>
            <div class="mt-1" style="display: flex;">
            <p style="color: black;">国語<input type="checkbox" name="subject" value="28" form="userSearchRequest"></p>
            <p style="margin-left: 10px; color: black;">数学<input type="checkbox" name="subject" value="29" form="userSearchRequest"></p>
            <p style="margin-left: 10px; color: black;">英語<input type="checkbox" name="subject" value="30" form="userSearchRequest"></p>
            </div>
          </div>
        </div>
      </div>
      <div>
        <input type="submit" name="search_btn" value="検索" form="userSearchRequest" class="btn btn-info btn-large mt-3" style="width:350px;">
      </div>
      <div>
        <input type="reset" value="リセット" form="userSearchRequest" class="btn btn-info btn-large mt-3" style="width:350px; background-color: #ecf1f6; border: none; color: #138496; margin-bottom:10px;">
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
@endsection
