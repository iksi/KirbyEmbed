<?php

/**
 * Embed plugin
 *
 * @author Iksi <info@iksi.cc>
 * @version 1.1.0
 */

function embed($url)
{
    $data = array(
        'url'   => $url,
        'class' => c::get('embed.class', 'embed'),
        'label' => preg_replace('/^https?:\/\//i', '', $url)
    );

    return tpl::load(__DIR__ . DS . 'template.php', $data);
}

function oembed($url)
{
    if ( ! class_exists('Iksi\oEmbed')) {
        require_once(__DIR__ . DS . 'vendors' . DS . 'oEmbed' . DS . 'oEmbed.php');
    }

    $oembed = new Iksi\oEmbed();

    return $oembed->get($url);
}
