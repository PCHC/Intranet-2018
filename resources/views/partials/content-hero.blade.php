<article @php(post_class())>
  @if( has_post_thumbnail() )
    <a href="{{ get_permalink() }}" class="featured-image">
      {{ the_post_thumbnail('og-image') }}
    </a>
  @endif

  @include('partials.entry-categories')

  <h2 class="post--title">
    <a href="{{ get_permalink() }}">
      {{ the_title() }}
    </a>
  </h2>
  <div class="post--meta">
    <time class="post--published" datetime="{{ get_post_time('c', true) }}">
      {{ get_the_date() }}
    </time>
  </div>
  <section class="post--summary">
    @php(the_excerpt())
    <a class="read-more-button btn btn-sm btn-primary post--readmore" href="{{ get_permalink() }}"><i class="fa fa-angle-right"></i> Read More</a>
  </section>
</article>
