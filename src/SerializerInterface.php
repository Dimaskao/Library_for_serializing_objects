<?php

namespace Dimaskao\Serializer;

interface SerializerInterface
{
    public function serialize($object, $element_list = []);
}