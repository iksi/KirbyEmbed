<?php

// Set the class for embeds
c::set('embed.class', 'embed');

// Route for oembed request
c::set('routes', array(
    array(
        'pattern' => 'oembed',
        'action'  => function() {
            return response::json(
                oembed(get('url'))
            );
        }
    )
));
