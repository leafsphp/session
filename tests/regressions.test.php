<?php

use Leaf\Flash;
use Leaf\Http\Session;

test('flash messages are not escaped on display', function () {
    $message = '<b>Hi</b> & "quotes"';

    Flash::set($message);

    expect(Flash::display())->toBe($message);
});

test('multiple flashes set in a row are both returned unescaped', function () {
    $one = '<i>first</i> & one';
    $two = '<u>second</u> & two';

    Flash::set($one);
    Flash::set($two, 'second');

    expect(Flash::display())->toBe($one);
    expect(Flash::display('second'))->toBe($two);
});

test('flashed arrays are returned identical', function () {
    $formData = ['name' => 'Tom & Jerry', 'bio' => '<b>hello</b>'];

    Flash::set($formData, 'form');

    expect(Flash::display('form'))->toBe($formData);
});

test('append does not double-escape values containing ampersands', function () {
    Session::append('appendTest', 'fish & chips');
    Session::append('appendTest', ' & more');

    expect(Session::get('appendTest', null, false))->toBe('fish & chips & more');
    expect(substr_count(Session::get('appendTest', null, false), '&amp;'))->toBe(0);
});

test('get returns the default for missing keys', function () {
    expect(Session::get('missing', 'fallback'))->toBe('fallback');
});

test('get sanitizes on read by default and returns raw when disabled', function () {
    Session::set('html', '<b>bold</b>');

    expect(Session::get('html'))->toBe(htmlspecialchars('<b>bold</b>'));
    expect(Session::get('html', null, false))->toBe('<b>bold</b>');
});

test('regenerate returns a boolean', function () {
    expect(Session::regenerate())->toBeBool();
    expect(Session::regenerate(true))->toBeBool();
});

test('id returns the custom id passed to it', function () {
    $result = Session::id('custom-id-123');

    expect($result)->toBe('custom-id-123');
});

test('has returns true for falsy stored values and false for missing keys', function () {
    Session::set('zeroString', '0');
    Session::set('zeroInt', 0);
    Session::set('falseVal', false);

    expect(Session::has('zeroString'))->toBeTrue();
    expect(Session::has('zeroInt'))->toBeTrue();
    expect(Session::has('falseVal'))->toBeTrue();
    expect(Session::has('definitelyMissing'))->toBeFalse();
});
