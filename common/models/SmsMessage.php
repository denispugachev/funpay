<?php

namespace common\models;

use yii\base\Model;

/**
 * SmsMessage model.
 *
 * @property string $wallet
 * @property string $code
 * @property string $sum
 */
class SmsMessage extends Model
{
    /**
     * @var string Message text
     */
    public $text;

    /**
     * @var string Wallet number
     */
    private $wallet = null;

    /**
     * @var string Confirmation code
     */
    private $code = null;

    /**
     * @var string Sum amount
     */
    private $sum = null;

    /** @inheritdoc */
    public function rules()
    {
        return [
            ['text', 'required'],
            ['text', 'string']
        ];
    }

    /** @inheritdoc */
    public function attributes()
    {
        return [
            'wallet',
            'code',
            'sum'
        ];
    }

    /**
     * Parses SMS message text and returns wallet value or false if can't.
     *
     * If there is several wallets in the message it will try to recognize 'на счет xxxx' or return last occurence.
     *
     * @return array|false
     */
    public function getWallet()
    {
        return $this->getAttributeOrSetFromResult('wallet', function () {
            if (preg_match_all('/\d{15}/', $this->text, $match1)) {
                if (count($match1) == 1) {
                    return $match1[0][0];
                } else {
                    if (preg_match('/на счет\:?\s*(\d{15})/ui', $this->text, $match2)) {
                        return $match2[1];
                    } else {
                        $match = array_pop($match1);
                        return $match[0];
                    }
                }
            }

            return false;
        });
    }

    /**
     * Parses SMS message text and returns wallet value or false if can't.
     *
     * Parses code by 'пароль' or 4 digit string occurence.
     *
     * @return array|false
     */
    public function getCode()
    {
        return $this->getAttributeOrSetFromResult('code', function () {
            if (
                preg_match('/пароль\:?\s*([^\s\n]+)/ui', $this->text, $match) ||
                preg_match('/[^\d](\d{4})[^\d]/', $this->text, $match)
            ) {
                return $match[1];
            }

            return false;
        });
    }

    /**
     * Parses SMS message text and returns sum value or false if can't.
     *
     * Parses sum by finance format (xx.xx) or 'спишется' occurence or 'xxр.' occurence.
     *
     * @return array|false
     */
    public function getSum()
    {
        return $this->getAttributeOrSetFromResult('sum', function () {
            if (
                preg_match('/(\d+(\.|,)\d{1,2})/', $this->text, $match) ||
                preg_match('/спишется\:?\s*(\d+)/', $this->text, $match) ||
                preg_match('/(\d+)\s*р\./', $this->text, $match)
            ) {
                return $match[1];
            }

            return false;
        });
    }

    /**
     * Checks if attribute is set and returns its value. If it's not - sets it from callback result and returns value.
     *
     * @param string $attribute
     * @param callable $callable
     * @return mixed
     */
    protected function getAttributeOrSetFromResult($attribute, callable $callable)
    {
        return $this->$attribute === null ?
            $this->$attribute = call_user_func($callable) :
            $this->$attribute;
    }
}