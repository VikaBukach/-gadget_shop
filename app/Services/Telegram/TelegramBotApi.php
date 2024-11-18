<?php

namespace app\Services\Telegram;

use Illuminate\Support\Facades\Http;

class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';

    /**
     * Надсилає повідомлення до Telegram.
     *
     * @param string $token Токен бота
     * @param int|string $chatId ID або username чату
     * @param string $text Текст повідомлення
     */

    public static function sendMessage(string $token, $chatId, string $text):void
    {
        Http::get(
            self:: HOST . $token . '/sendMessage',
            [
                'chat_id' => $chatId,
                'text' => $text
            ]
        );

    }

}
