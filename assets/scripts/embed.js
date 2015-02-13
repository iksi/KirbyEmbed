var Embed = (function () {
    'use strict';

    function embed(embedElement) {
        var url = '/oembed?url=' + encodeURIComponent(
            embedElement.querySelector('a').getAttribute('href')
        );

        // Make the request
        getJSON(url, function (response) {

            if (response.error) {
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
            if (/^youtube|vimeo$/.test(provider)) {
                embedElement.style.paddingTop = (100 * response.height / response.width) + '%';
            }

            embedElement.replaceChild(iframe, embedElement.firstChild);
        });
    }

    function init() {
        // Loop through all the embeds
        [].forEach.call(document.querySelectorAll('.js-embed'), embed);
    }

    return {
        init: init
    };
}());

Embed.init();
