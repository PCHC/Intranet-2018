<?php
namespace App;

trait SinglePartial
{
  public static function getFeaturedImageURL() {
    if( has_post_thumbnail() ) {
      return get_the_post_thumbnail_url(null, 'og-image');
    }

    return asset_path('images/news-placeholder_'.rand(1,8).'.jpg');
  }

  public static function getRandomStyle() {

  }
}
