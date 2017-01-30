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
        $pushallClient = new PushAll(Yii::$app->params['PushallFeedId'], Yii::$app->params['PushallKey']);

        foreach ($this->messages as $message) {

            $result = $pushallClient->send(array(
                'type' => PushAll::TYPE_SELF,
                'title' => 'Message',
                'text' => $message
            ));
        }
    }
}