<?php

test('values can be flashed to session', function () {
    $message = 'Hello World';

    $flash = new \Leaf\Flash();
    $flash->set($message);

    expect($flash->display())->toBe($message);
});

test('flashed values can be used once', function () {
    $message = 'Hello World, this is me';

    $flash = new \Leaf\Flash();
    $flash->set($message);

    expect($flash->display())->toBe($message);
    expect($flash->display())->toBe(null);
});

test('multiple values can be flashed to session', function () {
    $message = 'Hello World';
    $message2 = 'Hello World 2';

    $flash = new \Leaf\Flash();
    $flash->set($message);
    $flash->set($message2, 'message2');

    expect($flash->display())->toBe($message);
    expect($flash->display('message2'))->toBe($message2);
});

