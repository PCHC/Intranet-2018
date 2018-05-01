<article @php(post_class())>
  <header>
    <h1 class="post--title">Employee Recognition for {{ get_the_title() }}</h1>
    <div class="post--meta">
      @include('partials.recognition-taxonomies')
      <time class="post--published" datetime="{{ get_post_time('c', true) }}">
          {{ get_the_date('F Y') }}</time>
    </div>
    @if( has_post_thumbnail() )
      <div class="post--image">
        {{ the_post_thumbnail('medium') }}
      </div>
    @endif
  </header>
  <div class="post--content">
    @php(the_content())
  </div>
  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>
</article>
