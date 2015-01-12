<?php

kirbytext::$tags['embed'] = array(
    'html' => function($tag) {
        return embed($tag->attr('embed'));
    }
);
