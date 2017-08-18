<?php

namespace Zizou86\Unifonic;


interface AppContract
{

    public function send($recipient, $message);
    public function sendBulk(array $recipient, $message);
    public function getMessageIDStatus(int $messageId);
    public function getBalance();

}