<?php

error_reporting(0);
class Killbot {
    protected $server = 'https://killbot.pw';
    protected $active;
    protected $apikey;
    protected $bot;

    function __construct($config = array()) {
        $this->active = $config['active'];
        $this->apikey = $config['apikey'];
        $this->bot = $config['bot_redirect'];
    }

    function get_client_ip() {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
        
        if(filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        
        return $ip;
    }
    
    function httpGet($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return $response;
    }

    function check() {
        $ip         = $this->get_client_ip();
        $respons    = $this->httpGet($this->server . "/api/v2/blocker?ip=".$ip."&apikey=".$this->apikey."&ua=".urlencode($_SERVER['HTTP_USER_AGENT'])."&url=".urldecode($_SERVER['REQUEST_URI']));
        $json       = json_decode($respons,true);
        if($json['data']['block_access'] == true){
            return true;
        } else {
            return false;
        }
    }

    function run() {
        if($this->active == true) {
            if($this->check() == true){
                die(header("location: " . $this->bot));
            }
        }
    }
}