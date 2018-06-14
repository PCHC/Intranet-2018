<nav>
  <ul class="post-nav">
    <?php previous_post_link(
      '<li class="post-nav--link post-nav--link__prev"><i class="fas fa-angle-double-left"></i><span>%link</span></li>',
      '%title'
    ) ?>
    <?php next_post_link(
      '<li class="post-nav--link post-nav--link__next"><i class="fas fa-angle-double-right"></i><span>%link</span></li>',
      '%title'
    ) ?>
  </ul>
</nav>
