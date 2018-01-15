@extends('layouts.app')

@section('announcements')

  <div class="announcements">
    <div class="container">
      <div class="row">
        <div class="col-md-9 announcements-current">
          @php( query_posts( array(
            'category_name' => 'announcements',
            'showposts' => 10,
          ) ) )

          @if( have_posts() )
            @php( $c = 1 )
            @while( have_posts() ) @php( the_post() )
              @if( $c == 4 )
                <div class="announcements-current--secondary">
              @endif

              @include('partials.content-announcement-'.get_post_type())
              @php( $c++ )
            @endwhile
          </div>{{-- /.announcements-current--secondary --}}
          @endif

        </div>{{-- /.announcements-current --}}
        <div class="col-md-3 announcements-past">
          @php( query_posts( array(
            'category_name' => 'announcements',
            'showposts' => 10,
            'offset' => 10,
          ) ) )
          @if( have_posts() )
            @while( have_posts() ) @php( the_post() )
              @include('partials.content-announcement-'.get_post_type())
            @endwhile
          @endif
        </div>{{-- /.announcements-past --}}


      </div>{{-- /.row --}}
    </div>{{-- /.container --}}
  </div>{{-- /.announcements --}}
@endsection

@section('content')
@endsection
