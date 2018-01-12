@extends('layouts.app')

@section('announcements')

  @php( query_posts( array(
    'category_name' => 'announcements',
    'showposts' => 10,
  ) ) )

  @if (have_posts())
    @php( $c = 1 )
    <div class="announcements">
      <div class="container">
        <div class="row">
          <div class="col-md-10 announcements-current">
            @while (have_posts()) @php(the_post())
              @if( $c == 4 )
                <div class="announcements-current--secondary">
              @endif
              @include('partials.content-announcement-'.get_post_type())
              @php( $c++ )
            @endwhile
            </div>
          </div>
          <div class="col-md-2 announcements-past"></div>
        </div>
      </div>
    </div>
  @endif
@endsection

@section('content')
@endsection
