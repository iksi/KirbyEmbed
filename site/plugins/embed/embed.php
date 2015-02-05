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
    public function html($arguments = array())
    {
        $data = array(
            'url'   => $this->url,
            'class' => c::get('embed.class', 'embed'),
            'image' => isset($arguments['image'])
                ? $arguments['image']
                : false,
            'text'  => isset($arguments['text'])
                ? html($arguments['text'])
                : preg_replace('/^https?:\/\//i', '', $this->url)
        );

        return tpl::load(__DIR__ . DS . 'template.php', $data);
    }
}

/**
 * Helper method
 */
function embed()
{
    $embed = new Embed;
    return $embed->url($url);
}

/**
 * Custom field method
 */
field::$methods['embed'] = function($url) {
    return embed($url);
};

/**
 * Custom kirbytag
 */
kirbytext::$tags['embed'] = array(
    'attr' => array(
        'text',
        'image'
    ),
    'html' => function($tag) {
        $image = $tag->file($tag->attr('image'));

        return embed($tag->attr('embed'))->html(array_filter(array(
            'text'  => $tag->attr('text'),
            'image' => ( ! is_null($image))
                ? $image->url()
                : url($tag->attr('image'))
        )));
    }
);
