<?php
return array(

    'admin/edit/([0-9]+)' => 'admin/edit/$1',
    'admin/page-([0-9]+)' => 'admin/index/$1',
    'admin' => 'admin/index',

    'view/([0-9]+)' => 'site/view/$1',
    'page-([0-9]+)' => 'site/index/$1',

    'login' => 'site/login',
    'logout' => 'site/logout',
    'add' => 'site/add',


    '' => 'site/index',
);