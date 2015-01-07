var Embed = (function () {
    'use strict';

    function embed(embedElement) {
        var html,
            query;

        // Build query
        query = '?url=' + encodeURIComponent(embedElement.querySelector('a').getAttribute('href'));

        // Add possible autoplay
        if (embedElement.getAttribute('data-autoplay').length > 0) {
            query += '&autoplay=' + embedElement.getAttribute('data-autoplay');
        }

        // Make the request
        getJSON('/embed' + query, function (response) {

            if (response.error) {
                embedElement.innerHTML = html;
                return;
            }

            // Make sure to only get the iframe
            var iframe,
                container = document.createElement('div'),
                provider = response.provider_name.toLowerCase();

            container.innerHTML = response.html;
            iframe = container.childNodes[0];

            // Add a modifier to the class based on provider
            embedElement.className = embedElement.className.replace(
                /\bjs-embed\b/,
                embedElement.className.split(' ')[0] + '--' + provider
            );

            // Video, add paddingTop based on the ratio
            if (provider === 'youtube' || provider === 'vimeo') {
                embedElement.style.paddingTop = (100 * response.height / response.width) + '%';
            }

            embedElement.replaceChild(iframe, embedElement.firstChild);
        });

        // Store html in case we need to place it back
        html = embedElement.innerHTML;

        embedElement.innerHTML = 'Loading';
    }

    function init() {
        // Loop through all the embeds
        [].forEach.call(document.querySelectorAll('.js-embed'), embed);
    }

    return {
        init: init
    };
}());
