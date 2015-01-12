<?php

c::set('embed.class', 'embed');

c::set('routes', array(
    array(
        'pattern' => 'embed',
        'action' => function() {
            $url = get('url');
            return response::json(
                oembed($url)
            );
        }
    )
));
