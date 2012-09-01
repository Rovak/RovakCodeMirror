CodeMirror View Helper
======================

CodeMirror intergration module for Zend Framework 2

By [Roy van Kaathoven](https://github.com/Rovak)

## Introduction

This module adds a view helper that enables you to easily add a codemirror
editor to your website. It will add the required javascript files including any
dependent mode files and adds a init function which will load the editor.

## Requirements

- [CodeMirror](https://github.com/marijnh/CodeMirror)

## Installation

Configure the `lib_path` inside [module.config.php](https://github.com/Rovak/RovakCodeMirror/blob/master/config/module.config.php)
to point to the root of the CodeMirror library

## Usage

The headScript, headLink and inlineScript view helpers are required to be outputted
in your view

```php
<?php $this->codemirror($code, 'php'); ?>
```

## Supported modes

- PHP
- HTML
- CSS
- XML
- Javascript

You can add more modes by adding them to the [module.config.php](https://github.com/Rovak/RovakCodeMirror/blob/master/config/module.config.php) file.
Please submit a PR if you do so!

## TODO

- [Editor configuration](https://github.com/Rovak/RovakCodeMirror/blob/master/src/RovakCodeMirror/Options/CodeMirror.php)