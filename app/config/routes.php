<?php

// Маршруты
return [

    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'user/[0-9]+' => [
        'controller' => 'main',
        'action' => 'user',
    ],

    'register' => [
        'controller' => 'main',
        'action' => 'register',
    ],

    'logout' => [
      'controller' => 'main',
      'action' => 'logout',
    ],

    'user/all' => [
        'controller' => 'user',
        'action' => 'all',
    ],

    'user/chat' => [
        'controller' => 'user',
        'action' => 'chat',
    ],


];