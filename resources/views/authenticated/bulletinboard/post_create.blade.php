@extends('layouts.sidebar')

@section('content')
<div class="post_create_container d-flex">
  <div class="post_create_area border w-50 m-5 p-5">
    <div class="">
      <p class="mb-0">カテゴリー</p>
      <select class="w-100" form="postCreate" name="post_category_id">
       @foreach($main_categories as $main_category)
        <optgroup label="{{ $main_category->main_category }}" style="font-weight: lighter; color: gray;">
          @foreach($sub_categories as $sub_category)
           @if($sub_category->main_category_id == $main_category->id)
            <option value="{{ $sub_category->id }}" style="color: black;">{{ $sub_category->sub_category }}</option>
           @endif
          @endforeach
        </optgroup>
       @endforeach
     </select>
    </div>
    <div class="mt-3">
      @if($errors->first('post_title'))
      <span class="error_message" style ="font-size: 12px; color: red;">{{ $errors->first('post_title') }}</span>
      @endif
      <p class="mb-0">タイトル</p>
      <input type="text" class="w-100" form="postCreate" name="post_title" value="{{ old('post_title') }}">
    </div>
    <div class="mt-3">
      @if($errors->first('post_body'))
      <span class="error_message" style ="font-size: 12px; color: red;">{{ $errors->first('post_body') }}</span>
      @endif
      <p class="mb-0">投稿内容</p>
      <textarea class="w-100" form="postCreate" name="post_body">{{ old('post_body') }}</textarea>
    </div>
    <div class="mt-3 text-right">
      <input type="submit" class="btn btn-primary" value="投稿" form="postCreate">
    </div>
    <form action="{{ route('post.create') }}" method="post" id="postCreate">{{ csrf_field() }}</form>
  </div>
  @can('admin')
  <div class="w-25 ml-auto mr-auto">
    @if (Auth::user()->role < '4')
<div class="category_area mt-5 p-5">
  <div>
    <p class="m-0">メインカテゴリー</p>
    <form id="mainCategoryRequest" method="POST" action="{{ route('main.category.create') }}">{{ csrf_field() }}
      @csrf
      <input type="text" class="w-100" name="main_category_name">
      <input type="submit" value="追加" class="w-100 btn btn-primary p-0">
    </form>
   </div>
       @if ($errors->has('main_category_name'))
       <div style ="font-size: 12px; color: red;">{{ $errors->first('main_category_name') }}</div>
      @endif
   <!-- サブカテゴリー追加 -->
   <div>
    @if ($errors->has('sub_category_name'))
      <div style ="font-size: 12px; color: red;">{{ $errors->first('sub_category_name') }}</div>
    @endif
    <p class="m-0">サブカテゴリー</p>
    <form id="subCategoryRequest" method="POST" action="{{ route('sub.category.create') }}">{{ csrf_field() }}
      @csrf
      <select class="w-100" name="main_category_id">
        <option value="none">-----</option>
        @foreach($main_categories as $main_category)
        <option label="{{ $main_category->main_category }}" value="{{ $main_category->id }}"></option>
        @endforeach
      </select>
      <input type="text" class="w-100" name="sub_category_name">
      <input type="submit" value="追加" class="w-100 btn btn-primary p-0">
    </form>
   </div>
   </div>
    @endif
  </div>
  @endcan
</div>
@endsection
