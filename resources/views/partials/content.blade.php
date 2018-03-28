<article @php(post_class())>
  <div class="row">
    @if( has_post_thumbnail() )
      <div class="col-4 col-sm-3 col-lg-2 post--image">
        <a href="{{ get_permalink() }}" class="featured-image">
          {{ the_post_thumbnail('thumbnail') }}
        </a>
      </div>
    @endif

    <div class="col post--content">
      <h2 class="post--title">
        <a href="{{ get_permalink() }}">{{ get_the_title() }}</a>
      </h2>
      <div class="post--meta">
        <time class="post--published" datetime="{{ get_post_time('c', true) }}">
          {{ get_the_date('F j, Y') }}
        </time>
      </div>
      @include('partials.entry-categories')
      <div class="post--summary">
        @php(the_excerpt())
        <a class="read-more-button btn btn-sm btn-primary post--readmore" href="{{ get_permalink() }}"><i class="fa fa-angle-right"></i> Read More</a>
      </div>
    </div>
  </div>
</article>
