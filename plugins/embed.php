<?php

namespace Iksi;

class Embed {

    public static function embed($url)
    {
        $url = self::url($url);

        if ($url && filter_var($url, FILTER_VALIDATE_URL))
        {
            $handle = curl_init($url);

            curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($handle, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

            $data = curl_exec($handle);

            curl_close($handle);

            return $data;
        }

        return json_encode(
            array('error' => 'not found')
        );
    }

    protected static function url($url)
    {
        $host = parse_url($url, PHP_URL_HOST);

        if (preg_match('/youtube\.com$/', $host))
        {
            return 'https://www.youtube.com/oembed?url=' . $url;
        }
        
        if (preg_match('/mixcloud\.com$/', $host))
        {
            return 'https://www.mixcloud.com/oembed/?url=' . $url;
        }
        
        if (preg_match('/soundcloud\.com$/', $host))
        {
            return 'https://soundcloud.com/oembed.json?url=' . $url;
        }

        if (preg_match('/vimeo\.com$/', $host))
        {
            return 'https://vimeo.com/api/oembed.json?url=' . $url;
        }

        return FALSE;
    }

}