@extends('layouts.app')

@section('announcements')

  <div class="announcements">
    <div class="container-fluid container--announcements">
      <div class="row">
        <div class="col-9">
      <div class="section-title section-title__red row no-gutters">
        <h4 class="section-title--content col">
          <a href="{!! App::categorySlugLink('news') !!}">Latest News</a>
        </h4>
        <div class="section-title--more col-2 text-right">
          <a href="{!! App::categorySlugLink('news') !!}page/2/">More News <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
      <div class="row">
        <div class="announcements--primary">
          <?php
            $sticky = get_option( 'sticky_posts' );
            $announcements_query = array(
              'category_name' => 'news',
              'showposts' => 1,
              'offset' => 0,
              'ignore_sticky_posts' => 1,
              'post__in' => $sticky,
            );

            query_posts( $announcements_query );
          ?>
          @if( have_posts() )
            <div class="announcements--hero">
              @while( have_posts() ) @php( the_post() )
                @if( has_post_thumbnail() )
                  @php( $heroHasImage = true )
                @endif
                @include('partials.content-hero')
              @endwhile()
            </div>
          @endif

          <?php
            // Querying the rest of the posts, don't include first sticky post if one exists.
            $announcements_query['post__in'] = null;
            if( $sticky ) {
              $announcements_query['post__not_in'] = array($sticky[0]);
              $announcements_query['offset'] = -1;
            }
          ?>

          @if( !$heroHasImage )

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

          @endif
        </div>

        <?php
        $announcements_query['offset'] += $announcements_query['showposts'];

        $announcements_query['showposts'] = 7;
        // $announcements_query['showposts'] += $heroHasImage ? 2 : 0;
        query_posts( $announcements_query );
        ?>
        @if( have_posts() )
          <div class="announcements--more postcolumn {{ $heroHasImage ? 'announcements--more__features' : '' }}">
              @while( have_posts() ) @php( the_post() )
                @include('partials.content-'.get_post_type())
              @endwhile()
              <a class="btn btn-primary btn-block" href="{!! App::categorySlugLink('news') !!}page/2/"><i class="fas fa-newspaper"></i> See More</a>
          </div>
        @endif

      </div>{{-- /.row --}}
    </div>{{-- /.col-9 --}}
    <aside class="sidebar--wrap col-3">
      @include('partials.sidebar')
    </aside>
  </div>
    </div>{{-- /.container --}}
  </div>{{-- /.announcements --}}
  @php( wp_reset_query() )
@endsection

@section('content')
  <div class="row">
    <div class="homepage-section homepage-section--leadership postcolumn">
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
          'showposts' => 5,
        ) );
      ?>
      @if( have_posts() )
        @while( have_posts() ) @php(the_post())
          @include('partials.content-'.get_post_type())
        @endwhile
      @endif

      @php( wp_reset_query() )
    </div>

    <div class="homepage-section homepage-section--around postcolumn">
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
          'showposts' => 5,
        ) );
      ?>
      @if( have_posts() )
        @while( have_posts() ) @php(the_post())
          @include('partials.content-'.get_post_type())
        @endwhile
      @endif

      @php( wp_reset_query() )
    </div>

    <div class="homepage-section homepage-section--providers postcolumn">
      <div class="section-title section-title__red row no-gutters">
        <h4 class="section-title--content col">
          <a href="{!! App::categorySlugLink('new-providers') !!}">New Providers</a>
        </h4>
        <div class="section-title--more col-2 text-right">
          <a href="{!! App::categorySlugLink('new-providers') !!}">More <i class="fa fa-angle-right"></i></a>
        </div>
      </div>

      <?php
        query_posts( array(
          'category_name' => 'new-providers',
          'showposts' => 5,
        ) );
      ?>
      @if( have_posts() )
        @while( have_posts() ) @php(the_post())
          @include('partials.content-'.get_post_type())
        @endwhile
      @endif

      @php( wp_reset_query() )
    </div>

    <div class="homepage-section homepage-section--in-the-news postcolumn">
      <div class="section-title section-title__red row no-gutters">
        <h4 class="section-title--content col">
          <a href="{!! App::categorySlugLink('in-the-news') !!}">PCHC in the News</a>
        </h4>
        <div class="section-title--more col-2 text-right">
          <a href="{!! App::categorySlugLink('in-the-news') !!}">More <i class="fa fa-angle-right"></i></a>
        </div>
      </div>

      <?php
        query_posts( array(
          'category_name' => 'in-the-news',
          'showposts' => 5,
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
