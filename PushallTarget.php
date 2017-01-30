<?php
/**
 * Created by PhpStorm.
 * User: fgorsky
 * Date: 30.01.17
 * Time: 10:47
 */

namespace fgh151\logger;

use platx\pushall\PushAll;
use yii\log\Target;
use yii;

class PushallTarget extends Target
{
    public function export()
    {
        (new PushAll(Yii::$app->params['PushallFeedId'], Yii::$app->params['PushallKey']))->send(array(
            'type' => PushAll::TYPE_BROADCAST,
            'title' => Yii::$app->name.' '.date('d.m.Y H:i:s'),
            'text' => implode("\n", array_map([$this, 'formatMessage'], $this->messages))
        ));
    }
}