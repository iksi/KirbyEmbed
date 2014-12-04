<?php

c::set('kirbytext.embed.class', 'embed');

c::set('routes', array(
    array(
        'pattern' => 'embed',
        'action'  => function() {
            return response::json(
                Iksi\Embed::embed(get())
            );
        }
    )
));