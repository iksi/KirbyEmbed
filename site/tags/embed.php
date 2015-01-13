<?php

kirbytext::$tags['embed'] = array(
    'html' => function($tag) {
        return embed::html($tag->attr('embed'));
    }
);
