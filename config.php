<?php

c::set('kirbytext.embed.class', 'embed');

c::set('routes', array(
    array(
        'pattern' => 'embed',
        'action'  => function() {
            $embed = new Iksi\Embed();
            return response::json(
                $embed->fetch(get());
            );
        }
    )
));
