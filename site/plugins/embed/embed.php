<?php

/**
 * Embed plugin for Kirby
 *
 * @author     Iksi <info@iksi.cc>
 * @copyright  (c) 2014-2015 Iksi
 * @license    MIT
 * @version    1.3
 */

use Iksi\oEmbed;

if (class_exists('Iksi\oEmbed') === false) {
    require __DIR__ . DS . 'vendor' . DS . 'oEmbed' . DS . 'oEmbed.php';
}

/**
 * Class
 */
class Embed extends oEmbed
{
    public function html()
    {
        $data = array(
            'url' => $this->url,
            'class' => c::get('embed.class', 'embed'),
            'placeholder' => preg_replace('/^https?:\/\//i', '', $this->url)
        );

        return tpl::load(__DIR__ . DS . 'template.php', $data);
    }
}

/**
 * Helper method
 */
function embed()
{
    return new Embed;
}

/**
 * Custom field method
 */
field::$methods['embed'] = function($url) {
    return embed()->url($url)->html();
};

/**
 * Custom kirbytag
 */
kirbytext::$tags['embed'] = array(
    'html' => function($tag) {
        return embed()->url($tag->attr('embed'))->html();
    }
);
