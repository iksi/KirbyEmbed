<?php

c::set('embed.class', 'embed');

c::set('routes', array(
    array(
        'pattern' => 'embed',
        'action' => function() {
            return response::json(
                embed(get('url'))->fetch()
            );
        }
    )
));
