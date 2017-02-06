<?php
/**
 * Created by PhpStorm.
 * User: fgorsky
 * Date: 06.02.17
 * Time: 8:29
 */

namespace fgh151\pushall;

use platx\pushall\exceptions\InvalidIdException;
use platx\pushall\exceptions\InvalidKeyException;
use platx\pushall\exceptions\RequiredParameterException;
use platx\pushall\PushAll;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

class PushallBehavior extends AttributeBehavior
{
    /**
     * @var string Attribute contains title
     */
    public $titleAttribute;

    /**
     * @var string Attribute contains message
     */
    public $messageAttribute;

    /**
     * @var string Attribute contains url to view page
     */
    public $url;

    /**
     * @var integer feed id. Default from params
     */
    public $feedId;

    /**
     * @var string feed key. Default from params
     */
    public $feedKey;

    /**
     * @var string Chanel type
     */
    public $chanelType = PushAll::TYPE_BROADCAST;

    /**
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'pushallSend',

        ];
    }


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (!$this->feedId || !$this->feedKey) {
            $this->feedId = Yii::$app->params['PushallFeedId'];
            $this->feedKey = Yii::$app->params['PushallKey'];
        }
    }

    /**
     * @throws RequiredParameterException
     * @throws InvalidIdException
     * @throws InvalidKeyException
     */
    public function pushallSend()
    {
        $messageText = $this->messageAttribute;
        $message = $this->url !== '' ? $this->url . "\n" : '';
        $message .= $this->owner->$messageText;
        $titleAttribute = $this->titleAttribute;
        (new PushAll($this->feedId, $this->feedKey))->send(array(
            'type' => $this->chanelType,
            'title' => $this->owner->$titleAttribute,
            'text' => $message
        ));

    }
}