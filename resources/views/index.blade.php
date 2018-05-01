@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif

  @if (have_posts())
    <div class="posts--wrap">
      @while (have_posts()) @php(the_post())
        @include('partials.content-'.get_post_type())
      @endwhile
    </div>
  @endif

  {!! get_the_posts_navigation() !!}
@endsection
