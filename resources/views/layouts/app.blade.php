<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PR6NC2R"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @include('partials.alert')
    @php(do_action('get_header'))
    @include('partials.header')
    <div class="document-wrap" role="document">
      @yield('announcements')
      <div class="container-fluid container--main">
        <div class="content row">
          <main class="main col">
            @include('partials.breadcrumbs')
            @yield('content')
          </main>
          @include('partials.child-pages')
          @if (App\display_sidebar() && !is_front_page() && !is_page('directory') )
            <aside class="sidebar--wrap col-md-4 col-lg-3">
              @include('partials.sidebar')
            </aside>
          @endif
        </div>
      </div>
    </div>
    @php(do_action('get_footer'))
    @include('partials.footer')
    @php(wp_footer())
  </body>
</html>
