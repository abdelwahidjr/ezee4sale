<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;


class OnSignalNotifierController extends Controller
{
    private $client;
    private $app_id;
    private $player_id;
    private $languages;
    private $BASE_URL;
    private $data;
    private $segment;
    private $header;
    private $body;

    /**
     * PushNotificationController constructor.
     */
    public function __construct()
    {
        $this->BASE_URL = 'https://onesignal.com/api/v1/notifications';
        $this->client = new Client(['base_uri' => $this->BASE_URL]);
        $this->player_id = array();
        $this->languages = array();
        $this->body = array();
        $this->app_id = env('ONESIGNAL_APP_ID');
        $this->header = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . env('ONESIGNAL_REST_API_KEY')
        ];

    }


    public function addPlayerIDS($players)
    {
        if (is_array($players)) {
            $this->player_id = array_merge($this->player_id, $players);
        } else
            array_push($this->player_id, $players);
        return $this;
    }

    public function addMessage($lang_key, $message)
    {

        $this->languages[$lang_key] = $message;
        return $this;
    }

    public function addData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function addSegment($segment)
    {
        if (!isset($this->segment))
            $this->segment = array();
        if (is_array($segment)) {
            $this->segment = array_merge($this->segment, $this->segment);
        } else
            array_push($this->segment, $segment);
        return $this;
    }


    public function send()
    {
        $this->parseBody();
        $promise = $this->client->request('POST', '', $this->body);

    }

    private function parseBody()
    {
        $temp = array();
        $temp['app_id'] = $this->app_id;
        if (isset($this->segment))
            $temp['included_segments'] = $this->segment;
        else
            if (isset($this->player_id))
                $temp['include_player_ids'] = $this->player_id;

        if (isset($this->languages))
            $temp["contents"] = $this->languages;

        if (isset($this->data))
            $temp["data"] = $this->data;

        $this->body = [
            'headers' => $this->header,
            'body' => json_encode($temp)
        ];
    }

}
