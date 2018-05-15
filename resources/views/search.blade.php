@extends('layouts.app')

@section('content')
  @include('partials.page-header')
  @include('partials.search-form')

  <div class="card border-info mt-3 mb-3">
    <div class="card-header">
      <strong>Looking for Forms &amp; Documents?</strong>
    </div>
    <div class="card-body">
      <p>Try the following search:</p>
      <div class="search">
        <form role="search" method="get" class="search--form" action="{{ home_url('/resources/forms-documents/') }}">
      		<input class="search--field" placeholder="Search Forms &amp; Documents &hellip;" aria-label="Search Forms &amp; Documents" value="{{ sanitize_text_field( get_search_query() ) }}" name="wpfb_s" type="search">
          <div class="search--input-group">
          	<button class="search--submit" value="Search" type="submit" aria-label="Submit">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <hr />

  @if (!have_posts())
    <div class="alert alert-warning">
      {{  __('Sorry, no results were found.', 'sage') }}
    </div>
  @endif

  @if (have_posts())
    <div class="posts--wrap">
      @while(have_posts()) @php(the_post())
        @include('partials.content')
        <hr />
      @endwhile
    </div>
  @endif

  {!! get_the_posts_navigation() !!}
@endsection
