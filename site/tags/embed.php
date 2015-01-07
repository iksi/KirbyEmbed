<?php

kirbytext::$tags['embed'] = array(
    'attr' => array(
        'autoplay'
    ),
    'html' => function($tag) {
        return embed($tag->attr('embed'), $tag->attr('autoplay'));
    }
);
