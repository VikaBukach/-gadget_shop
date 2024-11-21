<?php

namespace app\Services\Telegram;

use app\Services\Telegram\Exceptions\TelegramBotApiException;
use Illuminate\Support\Facades\Http;

final class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';

    /**
     * Надсилає повідомлення до Telegram.
     *
     * @param string $token Токен бота
     * @param int|string $chatId ID або username чату
     * @param string $text Текст повідомлення
     */

    public static function sendMessage(string $token, $chatId, string $text):bool
    {
        try{
            $response = Http::get(
                self:: HOST . $token . '/sendMessage',
                [
                    'chat_id' => $chatId,
                    'text' => $text
                ])->throw()->json();

            return $response['ok'] ?? false;
        }catch (\Throwable $e){
            report(new TelegramBotApiException($e->getMessage()));

            return false;
        }
    }

}
