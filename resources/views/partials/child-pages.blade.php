@if( is_page() )
  <?php
    the_post();

    // Get current page
    $pgSelfArgs = array(
      'include' => $post->ID,
      'depth' => 1,
      'title_li' => null,
      'echo' => false,
    );
    $pgSelfOutput = wp_list_pages($pgSelfArgs);

    // Get siblings of current page
    $pgSiblings = get_pages('child_of='.$post->ID);
    $pgSiblingsArgs = array(
      'child_of' => $post->post_parent,
      'depth' => 1,
      'title_li' => null,
      'echo' => false,
    );
    $pgSiblingsOutput = wp_list_pages($pgSiblingsArgs);

    // Get children of current page
    $pgChildrenArgs = array(
      'child_of' => $post->ID,
      'depth' => 1,
      'title_li' => null,
      'echo' => false,
    );
    $pgChildrenOutput = wp_list_pages($pgChildrenArgs);

    // Get parent page if there is one
    if($post->post_parent) {
      $pgParent = get_pages('include='.$post->post_parent);
      $pgParent = $pgParent[0];

      $pgParentArgs = array(
        'include' => $post->post_parent,
        'depth' => 1,
        'title_li' => null,
        'echo' => false,
        'link_before' => '<span class="page-children--nav__icon"><i class="fas fa-angle-left"></i></span><span>',
        'link-after' => '</span>'
      );
      $pgParentOutput = wp_list_pages($pgParentArgs);

      // Get grandparent page if there is one
      if($pgParent->post_parent) {
        $pgGrandparent = get_pages('include='.$pgParent->post_parent);
        $pgGrandparent = $pgGrandparent[0];
        $pgGrandparentArgs = array(
          'include' => $pgGrandparent->ID,
          'depth' => 1,
          'title_li' => null,
          'echo' => false,
          'link_before' => '<span class="page-children--nav__icon"><i class="fas fa-angle-double-left"></i></span><span>',
          'link-after' => '</span>'
        );
        $pgGrandparentOutput = wp_list_pages($pgGrandparentArgs);
      }
    }
  ?>
  @if( $pgParentOutput || $pgChildrenOutput )
    <aside class="page-children">
      @if( $pgGrandparentOutput && !$pgChildrenOutput )
        <ul class="page-children--nav page-children--nav__grandparent">
          {!! $pgGrandparentOutput !!}
        </ul>
      @endif

      @if( $pgParentOutput )
        <ul class="page-children--nav page-children--nav__parent">
          {!! $pgParentOutput !!}
        </ul>
      @endif

      @if( ($pgSelfOutput && $pgChildrenOutput ) )
        <ul class="page-children--nav page-children--nav__self">
          {!! $pgSelfOutput !!}
        </ul>
      @endif

      @if( $pgSiblingsOutput && !$pgChildrenOutput )
        <ul class="page-children--nav page-children--nav__siblings">
          {!! $pgSiblingsOutput !!}
        </ul>
      @endif

      @if( $pgChildrenOutput )
        <ul class="page-children--nav page-children--nav__children">
          {!! $pgChildrenOutput !!}
        </ul>
      @endif
    </aside>
  @endif
@endif
