import fontawesome from '@fortawesome/fontawesome';
import solid from '@fortawesome/fontawesome-free-solid';
import regular from '@fortawesome/fontawesome-free-regular';
import brands from '@fortawesome/fontawesome-free-brands';

export default {
  init() {
    // JavaScript to be fired on all pages

    // Open external links in new tabs
    $('a').each(function() {
      var a = new RegExp('/' + window.location.host + '/');
      if(!a.test(this.href)) {
        $(this).attr("target","_blank").addClass('link__external');
      }
    });

    // Add indicator that menu item has children
    $('.menu-item-has-children > a').each(function() {
      $(this).append(' <i class="fa fa-angle-down"></i>');
    });

    $('main a:not(.btn, .nomagic)').each(function() {
      $(this).wrapInner('<span></span>').addClass('link--magic');
    });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
    fontawesome.library.add(solid,regular,brands);
  },
};
