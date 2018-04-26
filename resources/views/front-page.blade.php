@extends('layouts.app')

@section('announcements')

  <div class="announcements">
    <div class="container-fluid">
      <div class="section-title section-title__red row no-gutters">
        <h4 class="section-title--content col">
          <a href="{!! App::categorySlugLink('news') !!}">Latest News</a>
        </h4>
        <div class="section-title--more col-2 text-right">
          <a href="{!! App::categorySlugLink('news') !!}">More News <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
      <div class="row">
        <div class="col-8 announcements--primary">
          <?php
            $announcements_query = array(
              'category_name' => 'news',
              'showposts' => 1,
              'offset' => 0,
            );

            query_posts( $announcements_query );
          ?>
          @if( have_posts() )
            <div class="announcements--hero">
              @while( have_posts() ) @php( the_post() )
                @include('partials.content-hero')
              @endwhile()
            </div>
          @endif

          <?php
            $announcements_query['offset'] += $announcements_query['showposts'];

            $announcements_query['showposts'] = 2;
            query_posts( $announcements_query );
          ?>
          @if( have_posts() )
            <div class="announcements--secondary row">
              @while( have_posts() ) @php( the_post() )
                @include('partials.content-'.get_post_type())
              @endwhile()
            </div>
          @endif
        </div>

        <?php
        $announcements_query['offset'] += $announcements_query['showposts'];

        $announcements_query['showposts'] = 6;
        query_posts( $announcements_query );
        ?>
        @if( have_posts() )
          <div class="col-4 announcements--more postcolumn">
              @while( have_posts() ) @php( the_post() )
                @include('partials.content-'.get_post_type())
              @endwhile()
          </div>
        @endif

      </div>{{-- /.row --}}
    </div>{{-- /.container --}}
  </div>{{-- /.announcements --}}
  @php( wp_reset_query() )
@endsection

@section('content')
  <div class="row">
    <div class="col section--leadership postcolumn">
      <div class="section-title section-title__red row no-gutters">
        <h4 class="section-title--content col">
          <a href="{!! App::categorySlugLink('leadership') !!}">Leadership Reports</a>
        </h4>
        <div class="section-title--more col-2 text-right">
          <a href="{!! App::categorySlugLink('leadership') !!}">More <i class="fa fa-angle-right"></i></a>
        </div>
      </div>

      <?php
        query_posts( array(
          'category_name' => 'leadership',
          'showposts' => 10,
        ) );
      ?>
      @if( have_posts() )
        @while( have_posts() ) @php(the_post())
          @include('partials.content-'.get_post_type())
        @endwhile
      @endif

      @php( wp_reset_query() )
    </div>

    <div class="col section--around postcolumn">
      <div class="section-title section-title__red row no-gutters">
        <h4 class="section-title--content col">
          <a href="{!! App::categorySlugLink('around-the-org') !!}">Around the Organization</a>
        </h4>
        <div class="section-title--more col-2 text-right">
          <a href="{!! App::categorySlugLink('around-the-org') !!}">More <i class="fa fa-angle-right"></i></a>
        </div>
      </div>

      <?php
        query_posts( array(
          'category_name' => 'around-the-org',
          'showposts' => 10,
        ) );
      ?>
      @if( have_posts() )
        @while( have_posts() ) @php(the_post())
          @include('partials.content-'.get_post_type())
        @endwhile
      @endif

      @php( wp_reset_query() )
    </div>
  </div>
@endsection
