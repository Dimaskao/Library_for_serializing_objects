<?php

namespace Dimaskao\Serializer;

require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\Yaml\Yaml;

class _YAML_ extends AbstractSerializer implements SerializerInterface {
    final public function serialize($object, $elemetn_list = []) {

        //Getting all fields
        $public_value = $this->get_data($object, $elemetn_list);

        //Returning result
        return Yaml::dump($public_value);
    }
}