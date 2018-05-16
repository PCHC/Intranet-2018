@if( is_page() )
  <?php
    the_post();

    $pageChildrenArgs = array(
      'child_of' => $post->ID,
      'depth' => 1,
      'title_li' => null,
      'echo' => false,
    );
    $pageChildren = wp_list_pages($pageChildrenArgs);
  ?>
  @if( $pageChildren )
    <aside class="page-children">
      <ul class="page-children--nav">
        {!! wp_list_pages("title_li=&include=".$post->ID."&echo=0&depth=3") !!}
        {!! $pageChildren !!}
      </ul>
    </aside>
  @endif
@endif
