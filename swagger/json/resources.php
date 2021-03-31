<?php

$params     = require_once('params.php');
$profile    = require_once('profile.php');
$category   = require_once('category.php');
$notification   = require_once('notification.php');
$setting    = require_once('setting.php');
$contact    = require_once('contact.php');
$content    = require_once('content.php');
$advertisement   = require_once('advertisement.php');
$product    = require_once('product.php');
$message    = require_once('message.php');

$paths       = array_merge($profile['paths'],$category['paths'],$notification['paths'],$setting['paths'],$contact['paths'],$content['paths'],$advertisement['paths'],$product['paths'],$message['paths']);
$definitions = array_merge($profile['definitions'],$category['definitions'],$notification['definitions'],$setting['definitions'],$contact['definitions'],$content['definitions'],$advertisement['definitions'],$product['definitions'],$message['definitions']);

echo json_encode([
    'tags' => [
       
        [
            'name' => 'profile',
            'description' => 'User profile operations.',
        ],
        [
            'name' => 'category',
            'description' => 'Operation Category.',
        ],
        [
            'name' => 'notification',
            'description' => 'Notification.',
        ],
        [
            'name' => 'setting',
            'description' => 'Common operation.',
        ],
        [
            'name' => 'contact',
            'description' => 'contact operation.',
        ],
        [
            'name' => 'content',
            'description' => 'content operation.',
        ],
        [
            'name' => 'advertisement',
            'description' => 'advertisement operation.',
        ], 
        [
            'name' => 'product',
            'description' => 'product operation.',
        ],
        [
            'name' => 'message',
            'description' => 'message operation.',
        ],
        // [
        //     'name' => 'chat',
        //     'description' => 'Operation about chat.',
        // ],
		// [
        //     'name' => 'transaction',
        //     'description' => 'Operation about transaction.',
        // ]
    ],
    "swagger"     => "2.0",
    "info" => [
        "version" => "2.0.0",
        "title"   => "MJLOB API"
    ],
    "host"     => $params['host'],
    "basePath" => $params['basePath'],
    "schemes"  => [
        "http",
        "https"
    ],
    'paths'       => $paths,
    'definitions' => $definitions
]);
