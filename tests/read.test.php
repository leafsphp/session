<?php

test('values can be read from session', function () {
    $name = 'JMitchell';

    $session = new \Leaf\Http\Session();
    $session->set('name', $name);

    expect($session->get('name'))->toBe($name);
});

test('values can be read from session using array', function () {
    $name = 'JMitchell';

    $session = new \Leaf\Http\Session();
    $session->set('name', $name);

    $data = $session->get(['name']);

    expect($data['name'])->toBe($name);
});

test('values can be read from session using dot notation', function () {
    $name = 'JMitchell';

    $session = new \Leaf\Http\Session();
    $session->set('user.name', $name);

    expect($session->get('user.name'))->toBe($name);
});
