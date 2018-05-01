<article @php(post_class())>
  <div class="post--wrap">
    @if( has_post_thumbnail() )
      <div class="post--image">
        <a href="{{ get_permalink() }}" class="featured-image">
          {{ the_post_thumbnail('thumbnail') }}
        </a>
      </div>
    @endif

    <div class="post--content">
      <h2 class="post--title">
        <a href="{{ get_permalink() }}">{{ get_the_title() }}</a>
      </h2>
      <div class="post--meta">
        <time class="post--published" datetime="{{ get_post_time('c', true) }}">
          {{ get_the_date('F j, Y') }}
        </time>
      </div>
      @include('partials.entry-categories')
      @include('partials.recognition-taxonomies')
      <div class="post--summary">
        @php(the_excerpt())
      </div>
    </div>
  </div>
</article>
