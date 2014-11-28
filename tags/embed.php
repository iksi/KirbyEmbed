<?php

kirbytext::$tags['embed'] = array(
    'attr' => array(
        'autoplay',
        'class'
    ),
    'html' => function($tag) {

        return '<div class="' . $tag->attr('class', kirby()->option('kirbytext.embed.class', 'embed')) . '" data-type="embed" data-autoplay="' . $tag->attr('autoplay', 'false') . '">'
             . '<a href="' . $tag->attr('embed') . '">'
             . parse_url($tag->attr('embed'), PHP_URL_HOST) . parse_url($tag->attr('embed'), PHP_URL_PATH)
             . '</a>'
             . '</div>';

    }
);