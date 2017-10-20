<header class="banner">
  <div class="header-top">
    <div class="container header-top--container">
      <div class="header-top--row row justify-content-between align-items-center">
        <div class="col-auto">
          <a class="brand" href="{{ home_url('/') }}" title="{{ get_bloginfo('name', 'display') }}">
            <img src="@asset('images/pchcnow-logo_nobacker@2x.png')" alt="{{ get_bloginfo('name', 'display') }} Logo">
          </a>
        </div>
        <div class="col-auto">
          <nav class="nav-primary">
            @if (has_nav_menu('primary_navigation'))
              {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
            @endif
          </nav>
        </div>
      </div><!-- end .header-top--row -->
    </div><!-- end .header-top--container -->
  </div><!-- end .header-top -->
  <div class="header-bottom">
    <div class="container header-bottom--container">
      <div class="header-bottom--row row no-gutters justify-content-end">
        <div class="col-auto">
          <nav class="nav-secondary">
            @if (has_nav_menu('secondary_navigation'))
              {!! wp_nav_menu(['theme_location' => 'secondary_navigation', 'menu_class' => 'nav']) !!}
            @endif
          </nav>
        </div>
      </div><!-- end .header-bottom--row -->
    </div><!-- end .header-bottom--container -->
  </div><!-- end .header-bottom -->
</header>
