<?php
/**
 * User:  aziz
 * Email: aziz.trabelsi@gmail.com
 * Date:  8/17/2017 AD
 * Time:  07:12
 */

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
    public $appsid;


    /**
     * App constructor.
     *
     * @param string $appsid
     * @param array $urls
     */
    public function __construct(string $appsid, array $urls) {
        $this->messagesUrl  = array_get($urls, 'messages');
        $this->appsid    = $appsid;
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

        return $response;
    }

}