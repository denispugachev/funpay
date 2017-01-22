<?php
$testMessage = 'Пароль: 6689
Спишется 1,51р.
Перевод на счет 410011612585609';

vprintf('Wallet: %s, code: %s, sum: %s' . PHP_EOL, parseSmsMessage($testMessage));

/**
 * Parses SMS message text and returns data as array.
 *
 * If there is several wallets in the message it will try to recognize 'на счет xxxx' or return last occurence.
 *
 * Parses code by 'пароль' or 4 digit string occurence.
 *
 * Parses sum by finance format (xx.xx) or 'спишется' occurence or 'xxр.' occurence.
 *
 * @param string $text
 * @return array
 */
function parseSmsMessage($text)
{
    $wallet = null;
    $code = null;
    $sum = null;

    if (preg_match_all('/\d{15}/', $text, $match1)) {
        if (count($match1) == 1) {
            $wallet = $match1[0][0];
        } else {
            if (preg_match('/на счет\:?\s*(\d{15})/ui', $text, $match2)) {
                $wallet = $match2[1];
            } else {
                $match = array_pop($match1);
                $wallet = $match[0];
            }
        }
    }

    if (
        preg_match('/пароль\:?\s*([^\s\n]+)/ui', $text, $match) ||
        preg_match('/[^\d](\d{4})[^\d]/', $text, $match)
    ) {
        $code = $match[1];
    }

    if (
        preg_match('/(\d+(\.|,)\d{1,2})/', $text, $match) ||
        preg_match('/спишется\:?\s*(\d+)/', $text, $match) ||
        preg_match('/(\d+)\s*р\./', $text, $match)
    ) {
        $sum = $match[1];
    }

    return [
        'wallet' => $wallet,
        'code' => $code,
        'sum' => $sum,
    ];
}