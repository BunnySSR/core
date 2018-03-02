<?php
namespace Util\Json;

class Parser
{
    static public function parse($content = '', $default = [], $options = 0)
    {
        $json = json_decode($content, true, 512, $options);
        $json = is_array($json) ? $json : $default;

        return $json;
    }
}
