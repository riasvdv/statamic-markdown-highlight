![Icon](https://github.com/riasvdv/statamic-markdown-highlight/raw/master/icon.png)

[![Latest Version](https://img.shields.io/github/release/riasvdv/statamic-markdown-highlight.svg?style=flat-square)](https://github.com/riasvdv/statamic-markdown-highlight/releases)

# Markdown Highlight

> Markdown Syntax Highlighting for Statamic 3.

This Addon provides pre-rendered syntax highlighting based on Shiki, so no need for any extra JavaScript to get some color in your code samples!

![Screenshot](./docs/img/markdown-highlight-screenshot.png)

## Installation

Require it using Composer.

```
composer require rias/statamic-markdown-highlight
```

In your project, you should have the JavaScript package `shiki` installed. You can install it via npm

```bash
npm install shiki
```

or Yarn

```bash
yarn add shiki
```

## Using Markdown Highlight

## Fieldtype

Add the fieldtype to your fieldset.

```yaml
sections:
  main:
    display: Main
    fields:
      -
        handle: code
        field:
          type: markdown_highlight
          display: Code
```

For other options, this fieldtype extends the default [Statamic Markdown](https://statamic.dev/fieldtypes/markdown) fieldtype.

## Highlighting lines and other functionalities

Under the hood this package uses `spatie/commonmark-shiki-highlighter`, you can [read those docs](https://github.com/spatie/commonmark-shiki-highlighter/edit/main/README.md) to see what else is possible.

## Change default shiki theme

You need to publish the config file. 

```bash
php artisan vendor:publish --tag=statamic-markdown-highlight-config --force
```

Go to config/statamic/markdown-highlight.php.

```php
'theme' => 'github-light', // change this 
```
Check supported themes [shiki themes](https://github.com/shikijs/shiki/blob/main/docs/themes.md#all-themes 'shiki themes').

---
Brought to you by [Rias](https://rias.be)
