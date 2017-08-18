<?php

namespace Zizou86\Unifonic;


class App implements AppContract
{

    /**
     * @var string
     */
    public $messagesUrl;

    /**
     * @var string
     */
    public $accountUrl;

    /**
     * @var string
     */
    public $appsid;


    /**
     * App constructor.
     *
     * @param string $appsid
     * @param array $urls
     */
    public function __construct(string $appsid, array $urls = null) {
        $urls = $urls ?: config('unifonic.urls');
        $this->messagesUrl  = array_get($urls, 'messages');
        $this->accountUrl  = array_get($urls, 'account');
        $this->appsid = $appsid;
    }


    /**
     * Used to get the message status.
     *
     * @param integer $messageId
     * @return array
     */
    public function getMessageIDStatus(int $messageId)
    {
        return $this->messages('GetMessageIDStatus',[
            'MessageID' => $messageId
        ]);
    }


    /**
     * Used to send a message for only one recipient.
     *
     * @param string $recipient
     * @param string $message
     * @return array
     */
    public function send($recipient, $message)
    {
        return $this->messages('Send',[
            'Recipient' => $recipient,
            'Body'      => $message
        ]);
    }


    /**
     * Used to check the balance of an account.
     *
     * @return array
     */
    public function getBalance()
    {
        return $this->account('GetBalance');
    }


    /**
     * Used to to send bulk messages for multi recipiencts seperated by commas.
     *
     * @param array $recipient
     * @param string $message
     * @return array
     */
    public function sendBulk(array $recipient, $message)
    {
        $recipients = implode(',',$recipient);
        return $this->messages('SendBulk',[
            'Recipient' => $recipients,
            'Body'      => $message
        ]);
    }


    /**
     * Execute a message API request
     *
     * @param $segment
     * @param array $parameters
     * @return array
     */
    public function messages($segment, array $parameters = [])
    {
        $baseUrl = $this->messagesUrl;
        return $this->request($baseUrl,$segment,$parameters);
    }


    /**
     * Execute an account API request
     *
     * @param $segment
     * @param array $parameters
     * @return array
     */
    public function account($segment, array $parameters = [])
    {
        $baseUrl = $this->accountUrl;
        return $this->request($baseUrl,$segment,$parameters);
    }


    /**
     * Executes an API request (messages),
     * using appsid
     *
     * @param $baseUrl
     * @param $segment
     * @param array $parameters
     * @return array
     */
    public function request($baseUrl, $segment, $parameters)
    {
        $parameters = array_merge(array_filter($parameters), [
            'AppSid' => $this->appsid
        ]);
        $post_fields = http_build_query($parameters);
        $uri = $baseUrl . $segment;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/x-www-form-urlencoded"
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

}