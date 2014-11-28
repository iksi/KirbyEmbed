<?php

c::set('routes', array(
    array(
        'pattern' => 'embed',
        'action'  => function() {
            return response::json(
                Iksi\Embed::embed(get('url'))
            );
        }
    )
));