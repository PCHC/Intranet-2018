<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
    @php(do_action('get_header'))
    @include('partials.header')
    <div class="document-wrap" role="document">
      @yield('featured')
      <div class="container container--main">
        <div class="content row">
          <main class="main col">
            @yield('content')
          </main>
          @if (App\display_sidebar())
            <aside class="sidebar col-md-4 col-lg-3">
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
