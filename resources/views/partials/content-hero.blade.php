<article @php(post_class())>
  @if( has_post_thumbnail() )
    <a href="{{ get_permalink() }}" class="featured-image">
      {{ the_post_thumbnail('og-image') }}
    </a>
  @endif

  @include('partials.entry-categories')

  <h2 class="entry-title">
    <a href="{{ get_permalink() }}">
      {{ the_title() }}
    </a>
  </h2>

  <section class="entry-meta">
    <time class="updated" datetime="{{ get_post_time('c', true) }}"><i class="fa fa-clock-o"></i> {{ get_the_date() }}</time>
  </section>

  <section class="entry-summary">
    @php(the_excerpt())
    <a class="read-more-button btn btn-sm btn-primary" href="{{ get_permalink() }}"><i class="fa fa-angle-right"></i> Read More</a>
  </section>
</article>
