import fontawesome from '@fortawesome/fontawesome';
import solid from '@fortawesome/fontawesome-free-solid';
import regular from '@fortawesome/fontawesome-free-regular';

export default {
  init() {
    // JavaScript to be fired on all pages

    // Add indicator that menu item has children
    $('.menu-item-has-children > a').each(function() {
      $(this).append(' <i class="fa fa-angle-down"></i>');
    });

    $('main a:not(.btn)').each(function() {
      $(this).wrapInner('<span></span>').addClass('underline--magical');
    });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
    fontawesome.library.add(solid,regular);
  },
};
