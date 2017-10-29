<?php

/* GET QUERY

ident[0]=ident1&value[0]=some value 1&version[0]=1
&ident[1]=ident2&value[1]=some value 1&version[1]=2
&ident[2]=ident3&value[2]=some value 1&version[2]=3
&ident[3]=ident4&value[3]=some value 1&version[3]=4
&ident[4]=ident5&value[4]=some value 1&version[4]=5

*/

require_once './core/autoload.php';

$object = new controller\ Controller( $_GET );

echo '<pre>';
print_r($object->index());
echo '</pre>';