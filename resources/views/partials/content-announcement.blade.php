<article @php(post_class())>
  <a href="{{ get_permalink() }}" class="featured-image">
    <img src="{!! Single::getFeaturedImageURL() !!}" alt="{{ get_the_title() }}">
  </a>
  <h2 class="entry-title"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
  <section class="meta">
    <time class="updated" datetime="{{ get_post_time('c', true) }}"><i class="fa fa-clock-o"></i> {{ get_the_date() }}</time>
    <div class="categories">
      @foreach( get_the_category() as $category )
        <a class="badge badge-light" href="{{ get_category_link( $category->term_id ) }}"><i class="fa fa-folder-open-o"></i> {{ $category->name }}</a>
      @endforeach
    </div>
  </section>
  <div class="entry-summary">
    @php(the_excerpt())
    <a class="read-more-button btn btn-sm btn-primary" href="{{ get_permalink() }}"><i class="fa fa-angle-right"></i> Read More</a>
  </div>
</article>
