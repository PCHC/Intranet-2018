export default {
  init() {
    // JavaScript to be fired on all pages

    // Add indicator that menu item has children
    $('.menu-item-has-children > a').each(function() {
      $(this).append(' <i class="fa fa-angle-down"></i>');
    });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
