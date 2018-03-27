<article @php(post_class('row'))>
  @if( has_post_thumbnail() )
    <div class="col-4 col-sm-3 col-lg-2 entry-image">
      <a href="{{ get_permalink() }}" class="featured-image">
        {{ the_post_thumbnail('thumbnail') }}
      </a>
    </div>
  @endif

  <div class="col">
    <h2 class="entry-title">
      <a href="{{ get_permalink() }}">{{ get_the_title() }}</a>
    </h2>
    <div class="entry-published">
      <time class="updated" datetime="{{ get_post_time('c', true) }}">
        {{ get_the_date('F j, Y') }}
      </time>
    </div>
    @include('partials.entry-categories')
    <div class="entry-summary">
      @php(the_excerpt())
      <a class="read-more-button btn btn-sm btn-primary" href="{{ get_permalink() }}"><i class="fa fa-angle-right"></i> Read More</a>
    </div>
  </section>
</article>
