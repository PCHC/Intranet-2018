<p class="entry-meta">
  <span class="byline author vcard">
    <i class="fa fa-user"></i> 
    <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">{{ get_the_author() }}</a>
  </span><br>
  <time class="updated" datetime="{{ get_post_time('c', true) }}">
    <i class="fa fa-clock-o"></i>
    {{ get_the_date('l, F j, Y \a\t g:i a') }}</time>
</p>
<div class="entry-categories">
  @foreach( get_the_category() as $category )
    <a class="badge badge-primary" href="{{ get_category_link( $category->term_id ) }}"><i class="fa fa-folder-open-o"></i> {{ $category->name }}</a>
  @endforeach
</div>
