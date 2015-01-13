<?php

field::$methods['embed'] = function($url) {
    return embed::html($url);
};