<?php

namespace zizou86\Unifonic;


interface AppContract
{

    public function send($recipient, $message);
    public function sendBulk(array $recipient, $message);

}