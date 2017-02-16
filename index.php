<?php
require_once __DIR__ . '/vendor/autoload.php';

$klein = new \Klein\Klein();
$options = [];
$uam = new \UAM\Chillispot($options);

$klein->respond('GET', '/prelogin', array($uam, 'prelogin'));

$klein->respond('GET', '/logoff', array($uam, 'logoff'));

$klein->respond('GET', '/logout',array($uam, 'logoff'));

$klein->respond('GET', '/login', array($uam, 'login'));
$klein->respond('POST', '/login', array($uam, 'login'));
$klein->respond('GET', '/logon', array($uam, 'login'));

$klein->respond('POST', '/cgi-bin/login', array($uam, 'login'));

$klein->respond('404', function ($request) {
    /**
     * @var $request \Klein\Request
     */
    $page = $request->uri();
    echo "Oops, it looks like $page doesn't exist..\n";
});

$klein->dispatch();
