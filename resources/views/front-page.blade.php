@extends('layouts.app')

@section('featured')
  @php($no_dup = array())
  @php(query_posts( array('showposts' => 3) ))
  @if (have_posts())
    <div class="featured">
      <div class="featured--container container">
        @while (have_posts()) @php(the_post())
          @include('partials.content-featured-'.get_post_type())
          @php($no_dup[] = get_the_ID())
        @endwhile
      </div>
    </div>
  @endif
@endsection

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif

  @php(query_posts(array('showposts' => 3, 'post__not_in' => $no_dup)))
  @if (have_posts())
    <div class="frontpage-posts frontpage-posts--secondary">
      @while (have_posts()) @php(the_post())
        @include('partials.content-'.get_post_type())
        @php($no_dup[] = get_the_ID())
      @endwhile
    </div>
  @endif

  @php(query_posts(array('showposts' => 6, 'post__not_in' => $no_dup)))
  @if (have_posts())
    <div class="frontpage-posts frontpage-posts--tertiary row">
      @while (have_posts()) @php(the_post())
        <div class="col-6">
          @include('partials.content-'.get_post_type())
          @php($no_dup[] = get_the_ID())
        </div>
      @endwhile
    </div>
  @endif

  {!! get_the_posts_navigation() !!}
@endsection
