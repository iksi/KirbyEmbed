<?php

kirbytext::$tags['embed'] = array(
    'attr' => array(
        'autoplay',
        'class'
    ),
    'html' => function($tag) {
        return embed(
            $tag->attr('embed'),
            $tag->attr('autoplay'),
            $tag->attr('class', kirby()->option('kirbytext.embed.class', 'embed'))
        );
    }
);
