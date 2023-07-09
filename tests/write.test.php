<?php

test('values can be added to session', function () {
    $name = 'John Doe';

    $session = new \Leaf\Http\Session();
    $session->set('name', $name);

    expect($_SESSION['name'] ?? null)->toBe($name);
});

test('multiple values can be set at once', function () {
    $name = 'John Doe 2';
    $age = 20;

    $session = new \Leaf\Http\Session();
    $session->set([
        'name' => $name,
        'age' => $age,
    ]);

    expect($_SESSION['name'] ?? null)->toBe($name);
    expect($_SESSION['age'] ?? null)->toBe($age);
});

test('values can be set using dot notation', function () {
    $name = 'John Doe 3';
    $age = 30;

    $session = new \Leaf\Http\Session();
    $session->set('user.name', $name);
    $session->set('user.age', $age);

    expect($_SESSION['user']['name'] ?? null)->toBe($name);
    expect($_SESSION['user']['age'] ?? null)->toBe($age);
});
