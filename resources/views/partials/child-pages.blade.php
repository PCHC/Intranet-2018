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
    $postID = $post->ID;

    if( !$pageChildren ) {
      $postID = wp_get_post_parent_id( $post->ID );

      if( $postID !== 0 ) {
        $pageChildrenArgs = array(
          'child_of' => $postID,
          'depth' => 1,
          'title_li' => null,
          'echo' => false,
        );
        $pageChildren = wp_list_pages($pageChildrenArgs);
      }
    }
  ?>
  @if( $pageChildren )
    <aside class="page-children">
      <ul class="page-children--nav page-children--nav__parent">
        {!! wp_list_pages("title_li=&include=".$postID."&echo=0&depth=3") !!}
      </ul>
      <ul class="page-children--nav page-children--nav__children">
        {!! $pageChildren !!}
      </ul>
    </aside>
  @endif
@endif
