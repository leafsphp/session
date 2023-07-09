<?php

test('values can be removed from session', function () {
    $name = 'John Doe Again';

    $session = new \Leaf\Http\Session();
    $session->set('name', $name);

    expect($session->get('name'))->toBe($name);

    $session->unset('name');

    expect($session->get('name'))->toBe(null);
});

test('values can be removed from session using array', function () {
    $name = 'John Doe Again';

    $session = new \Leaf\Http\Session();
    $session->set('name', $name);

    expect($session->get('name'))->toBe($name);

    $session->unset(['name']);

    expect($session->get('name'))->toBe(null);
});

test('values can be removed from session using dot notation', function () {
    $name = 'John Doe Again';

    $session = new \Leaf\Http\Session();
    $session->set('user.name', $name);

    expect($session->get('user.name'))->toBe($name);

    $session->unset('user.name');

    echo json_encode($_SESSION);

    expect($session->get('user.name'))->toBe(null);
});
