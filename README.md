# A fork of (Adam Wathan's Laravel Frontend Preset)

A Laravel frontend preset that scaffolds out new applications just the way I like 'em 👌🏻

How is it different than Adam's Presets:
- It doesn't include postcss-nesting, instead uses sass. 

## Installation

This package isn't on Packagist (yet), so to get started, add it as a repository to your `composer.json` file:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/ruman63/laravel-tailwind-preset"
    }
]
```

Next, run this command to add the preset to your project:

```
composer require ruman63/laravel-tailwind-preset --dev
```

Finally, apply the scaffolding by running:

```
php artisan preset tailwind
```
