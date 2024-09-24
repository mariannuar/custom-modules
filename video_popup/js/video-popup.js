(function ($, Drupal) {
  Drupal.behaviors.videoPopup = {
    attach: function (context, settings) {
      $('.video-link', context).once('videoPopup').click(function (e) {
        e.preventDefault();
        const videoUrl = $(this).attr('href');
        // Add logic for the popup
        window.open(videoUrl, '_blank', 'width=800,height=600');
      });
    }
  };
})(jQuery, Drupal);
