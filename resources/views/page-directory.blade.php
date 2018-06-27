@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <article @php(post_class())>
      @include('partials.page-header')
    </article>
  @endwhile
  @debug
@endsection
