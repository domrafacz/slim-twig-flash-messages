# Slim twig flash messages

This Twig extension lets you use Slim-Flash package functions inside Twig templates

## Install

```
composer require domrafacz/slim-twig-flash-messages
```
## Requirements

* PHP >= 7.4.0
* slim/flash >= 0.4.0
* Slim 3.x or Slim 4.x
* Twig 2.x or Twig 3.x

## Usage

Below example should be adjusted to specific Slim framework installation

```php
$twig->addExtension(new Slim\Twig\FlashMessages(
    $container['flash']
));
```

## Authors

* **Dominik Rafacz**

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details