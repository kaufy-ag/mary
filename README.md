<p align="center"><img width="200" src="https://github.com/kaufy-ag/mary-ui.com/blob/main/public/mary.png?raw=true"></p>

<p align="center">
    <a href="https://packagist.org/packages/kaufy-ag/mary">
        <img src="https://img.shields.io/packagist/dt/kaufy-ag/mary?cacheSeconds=60">
    </a>
    <a href="https://packagist.org/packages/kaufy-ag/mary">
        <img src="https://img.shields.io/packagist/v/kaufy-ag/mary?label=stable&color=blue&cacheSeconds=60">
    </a>
    <a href="https://packagist.org/packages/kaufy-ag/mary">
        <img src="https://poser.pugx.org/kaufy-ag/mary/license.svg">
    </a>
</p>

## Introduction

MaryUI is a set of gorgeous Laravel Blade UI Components made for Livewire 3 and styled around daisyUI + Tailwind.

## Official Documentation

You can read the official documentation on the [maryUI website](https://mary-ui.com).

## Sponsor

Let's keep pushing it, [sponsor me](https://github.com/sponsors/kaufy-ag) ❤️

## Discord 

Come to say hello on [maryUI Discord](https://discord.gg/c2Dv8T2X2s)


## Follow me

[@kaufy-ag](https://twitter.com/kaufy-ag)

## Contributing

Clone the repository into some folder **inside your app**.

```bash
git clone git@github.com:kaufy-ag/mary.git
```

Change `composer.json` from **your app**

<!-- @formatter:off -->
```json
"minimum-stability": "dev", // <- change to "dev"

// Add this
"repositories": {
    "kaufy-ag/mary": {
        "type": "path",
        "url": "/path/to/mary", // <- change the path
        "options": {
          "symlink": true
        }
    }
}
```
<!-- @formatter:on -->


Require the package again for local symlink.

```bash
composer require kaufy-ag/mary
```

Start dev

```bash
yarn dev
```

## License

<a name="license"></a>

MaryUI is open-sourced software licensed under the [MIT license](/license.md).
