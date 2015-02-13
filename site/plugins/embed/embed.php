<?php

/**
 * Embed plugin for Kirby
 *
 * @author     Iksi <info@iksi.cc>
 * @copyright  (c) 2014-2015 Iksi
 * @license    MIT
 * @version    1.4
 */

use Iksi\oEmbed;

if (class_exists('Iksi\oEmbed') === false) {
    require __DIR__ . DS . 'vendor' . DS . 'oEmbed' . DS . 'oEmbed.php';
}

/**
 * oembed helper method
 */
function oembed($url)
{
    $oembed = new oEmbed;

    return $oembed->fetch($url);
}

/**
 * Embed helper method
 */
function embed($url, $alt = false, $poster = false)
{
    return kirbytag(array(
        'embed'  => $url,
        'alt'    => $alt,
        'poster' => $poster
    ));
}

/**
 * Custom field method (revise)
 */
field::$methods['embed'] = function($url, $alt, $poster) {
    // run the kirbytag
    return kirbytag(array(
        'embed'  => $url,
        'alt'    => $alt,
        'poster' => $poster
    ));
};

/**
 * Custom kirbytag
 */
kirbytext::$tags['embed'] = array(
    'attr' => array(
        'alt',
        'poster'
    ),
    'html' => function($tag) {
        $data = array(
            'url'    => $tag->attr('embed'),
            'class'  => c::get('embed.class', 'embed'),
            'poster' => ( ! $poster = $tag->file($tag->attr('poster')))
                ? $tag->attr('poster')
                : $poster->url(),
            'alt'    => ( ! $tag->attr('alt'))
                ? preg_replace('/^https?:\/\//i', '', $tag->attr('embed'))
                : $tag->attr('alt')
        );

        return tpl::load(__DIR__ . DS . 'template.php', $data);
    }
);