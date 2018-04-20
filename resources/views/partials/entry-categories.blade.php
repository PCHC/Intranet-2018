<div class="post--categories">
  @foreach( get_the_category() as $category )
    <a href="{{ get_category_link( $category->term_id ) }}"><i class="fas fa-folder-open"></i> {{ $category->name }}</a>
  @endforeach
</div>
