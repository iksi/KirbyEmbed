<?php

namespace Iksi;

class Embed {

    public function fetch($params)
    {
        $url = $this->get_url($params);

        if ($url === FALSE)
        {
            return json_encode(
                array('error' => 'something wrong with that url')
            );
        }

        $handle = curl_init($url);

        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($handle, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        $response = curl_exec($handle);
        
        if (curl_errno($handle))
        {
            return json_encode(
                array('error' => curl_error($handle))
            );
        }

        curl_close($handle);

        return $this->filter_response($response, $params);
    }

    protected function filter_response($response, $params)
    {
        $data = json_decode($response, TRUE);

        // Remove the url
        unset($params['url']);

        switch (strtolower($data['provider_name']))
        {
            case 'soundcloud':
                $keys = array('autoplay' => 'auto_play');
            break;
        }

        $params = isset($keys)
            ? array_combine(array_merge($params, $keys), $params)
            : $params;

        // Get iframe src attribute
        preg_match('/src="([^"]+)"/', $data['html'], $match);

        $query = parse_url($match[1], PHP_URL_QUERY);

        // Replace iframe src attribute
        $data['html'] = preg_replace(
            '/src="([^"]+)"/', 
            'src="' . $match[1] . (empty($query) ? '?' : '&') . http_build_query($params) . '"',
            $data['html']
        );

        return json_encode($data);
    }

    protected function get_url($params)
    {
        if ( ! isset($params['url']) || ! filter_var($params['url'], FILTER_VALIDATE_URL))
        {
            return FALSE;
        }

        $host = parse_url($params['url'], PHP_URL_HOST);

        if (preg_match('/youtube\.com$/', $host))
        {
            return 'https://www.youtube.com/oembed?url=' . $params['url'];
        }
        
        if (preg_match('/mixcloud\.com$/', $host))
        {
            return 'https://www.mixcloud.com/oembed/?url=' . $params['url'];
        }
        
        if (preg_match('/soundcloud\.com$/', $host))
        {
            return 'https://soundcloud.com/oembed.json?url=' . $params['url'];
        }

        if (preg_match('/vimeo\.com$/', $host))
        {
            return 'https://vimeo.com/api/oembed.json?url=' . $params['url'];
        }

        return FALSE;
    }

}
