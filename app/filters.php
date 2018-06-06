<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a class="readmore" href="' . get_permalink() . '">' . __('Continued', 'sage') . ' <i class="fa fa-angle-right"></i></a>';
});

/**
 * Control excerpt length
 * @return length in words
 */
 add_filter('excerpt_length', function() {
  return 55;
 });

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Tell WordPress how to find the compiled path of comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );
    return template_path(locate_template(["views/{$comments_template}", $comments_template]) ?: $comments_template);
});

/**
 * Tell WordPress when to show the sidebar
 */
add_filter('sage/display_sidebar', function ($display) {
  static $display;
  isset($display) || $display = in_array(true, [
    // The sidebar will be displayed if any of the following return true
    is_front_page(),
    is_single(),
    is_archive(),
    is_page(),
    is_search(),
  ]);
  return $display;
});

/**
 * Changing the title of archive pages
 */
add_filter('get_the_archive_title', function($title) {
  if ( is_category() ) {
    $title = single_cat_title( '', false );
  } elseif ( is_tag() ) {
    $title = single_tag_title( '', false );
  } elseif ( is_author() ) {
    $title = 'Posted by: <span class="vcard">' . get_the_author() . '</span>';
  } elseif ( is_post_type_archive() ) {
    $title = post_type_archive_title( '', false );
  } elseif ( is_tax() ) {
    $title = single_term_title( '', false );
  }

  return $title;
});

/**
 * Changing password reset email
 */
add_filter( 'retrieve_password_message', function( $message, $key, $user_login ) {
  $user_data = '';
  // If no value is posted, return false
  if( ! isset( $user_login )  ){
    return '';
  }
  // Fetch user information from user_login
  if ( strpos( $user_login, '@' ) ) {
    $user_data = get_user_by( 'email', trim( $user_login ) );
  } else {
    $login = trim($user_login);
    $user_data = get_user_by('login', $login);
  }
  if( ! $user_data  ){
    return '';
  }
  $user_login = $user_data->user_login;
  $user_email = $user_data->user_email;
  // Setting up message for retrieve password
  $message = "Looks like you want to reset your password!\n\n";
  $message .= "Please click on this link:\n";
  $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login');
  $message .= "\n\n";
  $message .= "If this was a mistake, just ignore this email and nothing will happen.\n\n";
  $message .= "Kind Regards,\nPCHC Intranet Team";
  // Return completed message for retrieve password
  return $message;
}, 10, 3);
