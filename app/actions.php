<?php

namespace App;

/**
* Custom actions
*/
add_action( 'send_email_digest', function () {
  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'date_query' => array(
      array(
        'after' => '1 week ago'
      ),
    ),
  );

  $to = 'cviolette@pchc.com';
  $subject = 'Latest PCHC Employee News - ' . date('F j, Y');
  $body = "<p>Here's what you may have missed this week:</p>";
  $headers = array(
    'Content-Type: text/html; charset=UTF-8'
  );

  $digestQuery = new \WP_Query( $args );

  if( $digestQuery->have_posts() ) {

    $body .= '<table width="600" cellspacing="0" cellpadding="0" border="0" style="boder-collapse: collapse; width: 600px;">';

    while( $digestQuery->have_posts() ) {
      $digestQuery->the_post();

      $body .= '<tr>';

        if( has_post_thumbnail() ) {
          $body .= '<td>';
            $body .= '<a href="'.get_the_permalink().'?utm_source=latest-news&utm_medium=email&utm_content=thumbnail">';
              $body .= '<img src="'.get_site_url().'/'.get_the_post_thumbnail_url(get_the_ID(), 'thumbnail').'" style="margin-right: 12px;" alt="'.get_the_title().'"/>';
            $body .= '</a>';
          $body .= '</td>';
        }

        $body .= has_post_thumbnail() ? '<td>' : '<td colspan="2">';

          $body .= '<h2 style="font-size: 24px; font-weight: bold; margin-top:0;"><a href="'.get_the_permalink().'?utm_source=latest-news&utm_medium=email&utm_content=title">'.get_the_title().'</a></h2>';
          $body .= "<p style=\"margin-bottom: 18px;\"><em>" . get_the_date('F j, Y') . " &mdash; </em>" . get_the_excerpt() . "</p>";
        $body .= '</td>';
      $body .= '</tr>';
    }

    $body .= '</table>';

    $body .= '<p><strong>Stay up to date by visiting the <a href="' . get_home_url() . '?utm_source=latest-news&utm_medium=email&utm_content=bottomlink">PCHC Employee Intranet</a>.</strong></p>';
    wp_mail($to, $subject, $body, $headers);
  }

  wp_reset_postdata();
} );
