Yii2 [pushall.ru](pushall.ru)
======================
Yii2 pushall.ru module

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist fgh151/yii2-pushall "*"
```

or add

```
"fgh151/yii2-pushall": "*"
```

to the require section of your `composer.json` file.

Add to params file:
```php
'PushallFeedId' => 111 //Your feed id. It mast be integer,
'PushallKey' => 'Your feed key',
```

Usage
-----

###Logs

How to get feed id and key see [documentation](https://pushall.ru/blog/create)

Add to config file pushall log target. For example in ```/config/main.php```
```php
[
    'bootstrap' => ['log'],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'fgh151\pushall\PushallTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
]
```

###Behavior

You can add behavior to model, that will send message after model save.
Example:
in model class add
```php
 /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'class' => fgh151\pushall\PushallBehavior::className(),
            //Attribute that contain title
            'titleAttribute' => 'title', 
            //Attribute that contain text message
            'messageAttribute' => 'intro', 
            //Optional. String that contain full url to view page
            'url' => Yii::$app->urlManager->createAbsoluteUrl(['controller/view', 'id' => $this->id]),
            //Optional. Contain custom feed id. If not set use from params
            'feedId' => 0000,
            //Optional. Contain custom feed key. If not set use from params
            'feedKey' => 'Your feed key',
            //Optional. Chanel type. Defaul broadcast.
            //Can be: broadcast, unicast, self
            'chanelType' => 'broadcast'
        ];
    }
```