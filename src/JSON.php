<?php

namespace Dimaskao\Serializer;

class JSON extends AbstractSerializer implements SerializerInterface {
    final public function serialize($object, $elemetn_list = []) {

        //Getting all fields
        $public_value = $this->get_data($object, $elemetn_list);

        //Returning result
        return json_encode($public_value);
    }
}