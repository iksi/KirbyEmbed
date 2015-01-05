<?php

c::set('kirbytext.embed.class', 'embed');

c::set('routes', array(
    array(
        'pattern' => 'embed',
        'action'  => function() {
            extract(a::get($_GET, array('url', 'autoplay')));
            return response::json(
                oembed($url, $autoplay)
            );
        }
    )
));
