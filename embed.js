var Embed = (function () {
    'use strict';

    function embed(embedElement) {
        var query = '',
            dataset = dataSet(embedElement),
            key;

        // Build querystring
        for (key in dataset) {
            if (dataset.hasOwnProperty(key)) {
                query += (query.length === 0 ? '?' : '&') + key + '=' + encodeURIComponent(dataset[key]);
            }
        }

        // Make the request
        getJSON('embed' + query, function (response) {
            // Make sure to only get the iframe
            var iframe = domExtract(response.html, 'iframe'),
                provider = response.provider_name.toLowerCase();

            // Add a modifier to the class based on provider
            embedElement.className = embedElement.className.replace(
                /\bjs-embed\b/,
                embedElement.className.split(' ')[0] + '--' + provider
            );

            // Video, add paddingTop based on the ratio
            if (provider === 'youtube' || provider === 'vimeo') {
                embedElement.style.paddingTop = (100 * response.height / response.width) + '%';
            }

            embedElement.innerHTML = '';

            embedElement.appendChild(iframe);
        });

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

Embed.init();