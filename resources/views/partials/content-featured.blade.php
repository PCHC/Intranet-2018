<article @php(post_class())>
  <div class="featured--wrap">
    <div class="featured--background" style="background-image: url({!! Single::getFeaturedImageURL() !!});"></div>
    <a class="featured--all-over-link" href="{{ get_permalink() }}" title="Click to learn more"></a>
    <div class="featured--overlay featured-overlay--{{ rand(1, 156)}}">
      <div class="featured--content">
        <time class="updated" datetime="{{ get_post_time('c', true) }}"><i class="fa fa-clock-o"></i> {{ get_the_date() }}</time>
        <h2 class="entry-title">{{ get_the_title() }}</h2>
        <div class="featured--summary">
          @php(the_excerpt())
        </div>
      </div>
    </div>
    <div class="featured--categories">
      @foreach( get_the_category() as $category )
        <a class="badge badge-primary" href="{{ get_category_link( $category->term_id ) }}"><i class="fa fa-folder-open-o"></i> {{ $category->name }}</a>
      @endforeach
    </div>
  </div>
</article>
