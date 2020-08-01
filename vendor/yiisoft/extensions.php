<?php

$vendorDir = dirname(__DIR__);

return array (
  'mdmsoft/yii2-upload-file' => 
  array (
    'name' => 'mdmsoft/yii2-upload-file',
    'version' => '2.0.0.0',
    'alias' => 
    array (
      '@mdm/upload' => $vendorDir . '/mdmsoft/yii2-upload-file',
    ),
    'bootstrap' => 'mdm\\upload\\Bootstrap',
  ),
);
