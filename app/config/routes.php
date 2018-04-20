<?php

// Маршруты
return [

    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'edit' => [
        'controller' => 'main',
        'action' => 'edit',
    ],

    'dialog' => [
        'controller' => 'main',
        'action' => 'dialog',
    ],

    'dialog/[0-9]+' => [
        'controller' => 'main',
        'action' => 'chat',
    ],

    'subscriptions/[0-9]+' => [
        'controller' => 'main',
        'action' => 'subscriptions',
    ],

    'subscribers/[0-9]+' => [
        'controller' => 'main',
        'action' => 'subscribers',
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

    'all' => [
        'controller' => 'main',
        'action' => 'all',
    ],



];