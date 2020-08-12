<?php

namespace Serializer;

interface SerializerInterface
{
    public function serialize($object, $element_list = []);
}