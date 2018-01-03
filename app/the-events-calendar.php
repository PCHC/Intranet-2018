<?php
Namespace App;
/**
 * The Events Calendar drop-in functionality for Sage 9
 * Version: 1.0
 * Author: Michael W. Delaney
 */
/**
 * Set Sage-friendly The Events Calendar template
 */
if(class_exists('Tribe__Settings_Manager')) {

  // Set the The Events Calendar default template to our Sage-friendly template.
  \Tribe__Settings_Manager::set_option( 'tribeEventsTemplate', 'views/template-events.blade.php' );

}

/**
* Menu highlighting for The Events Calendar pages
*/
add_filter( 'nav_menu_css_class', function ($classes = array(), $menu_item = false){
    // Check if the current queried page is an event, or the events archive, and whether the current item in the filter is '/events/'
    if((is_singular('tribe_events') || is_post_type_archive('tribe_events')) && $menu_item->url == '/events/') {
        $classes[] ='current-page-ancestor';
    }

    // The filter also wants to highlight the "Posts" archive. Stop it from doing that.
    if((is_singular('tribe_events') || is_post_type_archive('tribe_events')) && $menu_item->url == get_post_type_archive_link( 'post' )) {
        if(($key = array_search('current_page_parent', $classes)) !== false) {
            unset($classes[$key]);
        }

    }
    // Return the correct classes for this menu item.
    return $classes;

}, 10, 2 );

/**
* Changes the text labels for Google Calendar and iCal buttons on a single event page
*/
remove_action( 'tribe_events_single_event_after_the_content', array( tribe( 'tec.iCal' ), 'single_event_links' ) );

add_action( 'tribe_events_single_event_after_the_content', __NAMESPACE__ . '\\customized_tribe_single_event_links' );

function customized_tribe_single_event_links()	{

	if ( is_single() && post_password_required() ) {
		return;
	}

  $link_classes = 'btn btn-sm btn-secondary';
  $text  = '<i class="fa fa-calendar-plus-o"></i> Export Event';
	$title = esc_html__( 'Use this to share calendar data with Google Calendar, Apple iCal and other compatible apps', 'the-events-calendar' );

  printf(
			'<a class="%1$s" title="%2$s" href="%3$s">%4$s</a>',
      $link_classes,
			$title,
			esc_url( tribe_get_single_ical_link() ),
			$text
		);
}

/**
* Changes the text labels for Google Calendar and iCal buttons on an event list page
*/
remove_action( 'tribe_events_after_footer', array( tribe( 'tec.iCal' ), 'maybe_add_link' ) );

add_action( 'tribe_events_after_footer', __NAMESPACE__ . '\\customized_tribe_list_event_links' );

function customized_tribe_list_event_links()	{

	if ( is_single() && post_password_required() ) {
		return;
	}

  $link_classes = 'btn btn-sm btn-secondary pull-right';
  $text  = '<i class="fa fa-calendar-plus-o"></i> Export Events';
	$title = esc_html__( 'Use this to share calendar data with Google Calendar, Apple iCal and other compatible apps', 'the-events-calendar' );

  printf(
			'<a class="%1$s" title="%2$s" href="%3$s">%4$s</a>',
      $link_classes,
			$title,
			esc_url( tribe_get_ical_link() ),
			$text
		);
}
