<article @php(post_class())>
  <header>
    <h1 class="entry-title">{{ get_the_title() }}</h1>
    <div class="row entry-meta">
      <div class="col">
        <time class="updated" datetime="{{ get_post_time('c', true) }}">
          Posted {{ get_the_date('F j, Y \a\t g:i a') }}</time>
        <span class="byline author vcard">
          by <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">{{ get_the_author() }}</a>
        </span>
      </div>
      <div class="col text-right">
        @include('partials.entry-categories')
      </div>
    </div>
    {{ the_post_thumbnail('large') }}
  </header>
  <div class="entry-content">
    @php(the_content())
  </div>
  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>
</article>
