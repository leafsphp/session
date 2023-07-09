<!-- markdownlint-disable no-inline-html -->
<p align="center">
  <br><br>
  <img src="https://leafphp.dev/logo-circle.png" height="100"/>
  <h1 align="center">Leaf Session Module</h1>
  <br><br>
</p>

# Leaf PHP

[![Latest Stable Version](https://poser.pugx.org/leafs/session/v/stable)](https://packagist.org/packages/leafs/session)
[![Total Downloads](https://poser.pugx.org/leafs/session/downloads)](https://packagist.org/packages/leafs/session)
[![License](https://poser.pugx.org/leafs/session/license)](https://packagist.org/packages/leafs/session)

Leaf's core session functionality packaged as a serve-yourself module.

## Installation

You can easily install Leaf using the [Leaf CLI](https://cli.leafphp.dev):

```bash
leaf install session
```

Or with [Composer](https://getcomposer.org/).

```bash
composer require leafs/session
```

## Usage

```php
session()->set('name', 'Leaf PHP');
session()->get('name');
```

Check the full documentation [here](https://leafphp.dev/modules/session/).
