<?php
namespace Util\Api;

use Util\Json\Parser as JsonParser;
use Shudrum\Component\ArrayFinder\ArrayFinder;
use Requests;

class Getter
{
    public function load($config = [])
    {
        if(empty($config))
            return [];

        $post = new ArrayFinder($_POST);

        if(is_string($config)) {
            $content = Requests::get($config)->body;
            $content = JsonParser::parse($content);

            $result      = [];
            $result['_'] = $content;

            return $result;
        } elseif(is_array($config)) {
            $result = [];

            foreach($config as $name => $options) {
                // $name is mapping name, $options is api request options
                if(!empty($options['url'])) {
                    if(!empty($options['get']) && is_array($options['get'])) {
                        // This passes GET params received to GET params
                        $get        = new ArrayFinder($_GET);
                        $get_params = new ArrayFinder([]);

                        foreach($options['get'] as $origin => $target) {
                            // $origin is received GET key, $target is GET key to send
                            $get_params[$target] = $get->get($origin);
                        }

                        $get_params = $get_params->get();
                    }

                    if(!empty($options['post']) && is_array($options['post'])) {
                        // This passes POST params received to POST params
                        $post        = new ArrayFinder($_POST);
                        $post_params = new ArrayFinder([]);

                        foreach($options['post'] as $origin => $target) {
                            // $origin is received POST key, $target is POST key to send
                            $post_params[$target] = $post->get($target);
                        }

                        $post_params = $post_params->post();
                    }

                    // Prebuild url and data for current api
                    $url = $options['url'] . (empty($get_params) ? '' : ('?' . http_build_query($get_params)));

                    // Detect request Data
                    if(empty($post_params)) {
                        $content = Requests::get($url)->body;
                    } else {
                        $content = Requests::post($url, [], $post_params)->body;
                    }

                    $content       = JsonParser::parse($content);
                    $result[$name] = $content;
                }
            }

            return $result;
        } else {
            return [];
        }
    }
}
