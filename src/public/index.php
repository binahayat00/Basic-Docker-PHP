<?php

require __DIR__ . '/../vendor/autoload.php';

$fields = [
    // new \App\Field('baseField'),
    new \App\Text('textField'),
    // new \App\Boolean('booleanField'),
    new \App\Checkbox('checkboxField'),
    new \App\Radio('radioField'),
];

foreach($fields as $field){
    echo $field->render() . '<br />';
}