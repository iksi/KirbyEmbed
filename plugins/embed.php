<?php

/**
 * Embed plugin
 *
 * @author Iksi <info@iksi.cc>
 * @version 1.1.0
 */

function embed($url, $autoplay = NULL, $class)
{
    $data = array(
        'url'      => $url,
        'class'    => $class,
        'label'    => preg_replace('/^https?:\/\//i', '', $url),
        'autoplay' => $autoplay
    );

    return tpl::load(__DIR__ . DS . 'template.php', $data);
}

function oembed($url, $autoplay = NULL)
{
    if ( ! class_exists('Iksi\oEmbed'))
    {
        require_once(__DIR__ . DS . 'vendors' . DS . 'Iksi' . DS . 'oEmbed.php');
    }

    $oembed = new Iksi\oEmbed();
    return $oembed->request($url, $autoplay);
}
