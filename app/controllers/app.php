<?php

namespace App;

use Sober\Controller\Controller;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for <span class="search-query">%s</span>', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }

    public static function categorySlugLink($catSlug = '')
    {
      if ($catSlug === '') {
        return;
      }

      $catObj = get_category_by_slug($catSlug);
      $catId = $catObj->term_id;
      $catLink = get_category_link($catId);

      return esc_url($catLink);
    }
}
