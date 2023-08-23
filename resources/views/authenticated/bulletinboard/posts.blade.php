@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 m-auto d-flex">
  <div class="post_view w-75 mt-5">
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p style="font-size:0.75rem; color:gray;"><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p style="font-weight:bold; margin-bottom:5px;"><a href="{{ route('post.detail', ['id' => $post->id]) }}" style="color:#000;">{{ $post->post_title }}</a></p>
       @foreach($post->sub_categories as $sub_category)
       <div  class="category_btn btn-info" style="height:30px; width:fit-content; color:white; padding: 6px 10px; border-radius: 10px;">
        <span style="">{{ $sub_category->sub_category }}</span>
        </div>
       @endforeach
      <div class="post_bottom_area d-flex" style="justify-content: flex-end; color:gray;">
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment"></i><span class="" style="font-size: 1rem; margin-left: 7px;">{{ $post->postComments->count() }}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i>
             <span class="like_counts{{ $post->id }}" style="font-size: 1rem; margin-left: 7px;"> {{$like->likeCounts($post->id)}}</span>
            </p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i>
             <span class="like_counts{{ $post->id }}" style="font-size: 1rem; margin-left: 7px;"> {{$like->likeCounts($post->id)}}</span>
            </p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area w-25 mt-5">
    <div class="m-2">
      <div class="mb-3"><a href="{{ route('post.input') }}" class="btn btn-info btn-large" style="width:350px;" >投稿</a></div>
    <div class="input-group mb-3">
      <input type="text" id="txt-search" class="form-control input-group-prepend" placeholder="キーワードを入力" form="postSearchRequest" style="font-size: 0.8rem;"></input>
      <span class="input-group-btn input-group-append">
       <submit type="submit" id="btn-search" class="btn btn-primary" form="postSearchRequest"><i class="fas fa-search"></i> 検索</submit>
      </span>
    </div>
    <div class="mb-3">
      <input type="submit" name="like_posts" class="category_btn btn" value="いいねした投稿" form="postSearchRequest" style="font-size: 0.8rem;
    width: 50%; color: white; background-color: #e38eab;">
      <input type="submit" name="my_posts" class="category_btn btn" value="自分の投稿" form="postSearchRequest" style="font-size: 0.8rem;
    width: 48%; color: white; background-color: #ebbc5d;">
    </div>
    <p style="font-size:0.8rem;">カテゴリー検索</p>
      <ul>
        @foreach($categories as $category)
        <li class="main_categories" category_id="{{ $category->id }}" style="color:black;" data-target ="{{ $category->id }}" ><span>{{ $category->main_category }}</span></li>
        <div id="category-button-{{ $category->id }}" style="display:none;">
          @foreach($sub_categories as $sub_category)
           @if($sub_category->main_category_id == $category->id)
           <div class="subcategory-button" style="color:black;" >
            <input type="submit" name="category_word" class="" value="{{ $sub_category->sub_category }}" form="postSearchRequest"  style="  border: none; background-color: #ecf1f6; color:black;"></input>
            </div>
           @endif
          @endforeach
         </div>
        @endforeach
      </ul>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection
