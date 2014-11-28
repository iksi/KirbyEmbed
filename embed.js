var Embeds = (function () {
    'use strict';
    function embed(embedElement) {
        var anchor = embedElement.querySelector('a');
        // Only proceed if an anchor tag is present
        if (anchor) {
            // Make the request
            getJSON('embed?url=' + encodeURIComponent(anchor.getAttribute('href')), function (response) {
                var iframe = domExtract(response.html, 'iframe'),
                    provider = response.provider_name.toLowerCase();
                embedElement.setAttribute('data-type', 'embed-' + provider);
                // Video
                if (provider === 'youtube' || provider === 'vimeo') {
                    embedElement.style.paddingTop = (100 * response.height / response.width) + '%';
                }
                // Finally append
                embedElement.appendChild(iframe);
            });
            embedElement.removeChild(anchor);
        }

    }
    function init() {
        // Loop through all the embeds
        [].forEach.call(document.querySelectorAll('[data-type="embed"]'), embed);
    }
    return {
        init: init
    };
}());

Embeds.init();