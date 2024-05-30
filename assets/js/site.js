(function ($) {
  'use strict';

  /**
   * Site javascripts
   * ===
   */

  // Wrap video embeds in Flexible Container
  $('iframe[src*="youtube.com"]:not(.not-responsive), iframe[src*="vimeo.com"]:not(.not-responsive)')
    .attr( 'frameborder', 0 )
    .wrap('<div class="flexible-container"></div>');

  // Resize Maps
  $('iframe[src*="google.com/map"]:not(.not-responsive)')
    .attr( 'frameborder', 0 )
    .wrap('<div class="flexible-container"></div>');

})(jQuery);
