<?php

c::set('embed.class', 'embed');

c::set('routes', array(
    array(
        'pattern' => 'embed',
        'action'  => function() {
            extract(a::get($_GET, array('url')));
            return response::json(
                oembed($url)
            );
        }
    )
));
