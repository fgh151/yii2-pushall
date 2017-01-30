Yii2 pushall.ru logger
======================
Yii2 pushall.ru logger

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist fgh151/yii2-pushall-logger "*"
```

or add

```
"fgh151/yii2-pushall-logger": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Add to params file:
```php
'PushallFeedId' => 'Your feed id',
'PushallKey' => 'Your feed key',
```

How to get feed id and key see [documentation](https://pushall.ru/blog/create)

Add to config file pushall log target. For example in ```/config/main.php```
```php
[
    'bootstrap' => ['log'],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'fgh151\logger\PushallTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
]
```