<?php

/**
 * Маршруты
 */

return [

    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'like/[0-9]+' => [
        'controller' => 'main',
        'action' => 'like',
    ],

    'comment/[0-9]+' => [
        'controller' => 'main',
        'action' => 'comment',
    ],

    'restore' => [
        'controller' => 'main',
        'action' => 'restore',
    ],

    'contact' => [
        'controller' => 'main',
        'action' => 'contact',
    ],

    'feedback' => [
        'controller' => 'main',
        'action' => 'feedback',
    ],

    'about' => [
        'controller' => 'main',
        'action' => 'about',
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