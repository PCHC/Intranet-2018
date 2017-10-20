<?php
namespace App;

trait SinglePartial
{
  public static function getFeaturedImageURL() {
    if( has_post_thumbnail() ) {
      return get_the_post_thumbnail_url();
    }

    return asset_path('images/news-placeholder_'.rand(1,2).'.jpg');
  }

  public static function getRandomStyle() {
    
  }
}
