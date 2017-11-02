<?php

namespace App\Services;

use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Nick\Framework\App;
use Nick\Framework\Session;

class GithubService
{
    public function getUser($accessToken)
    {
        $client = new Client([
            'base_uri' => 'https://api.github.com'
        ]);

        $response = $client->request('GET', "user", [
            RequestOptions::HEADERS => [
                'Authorization' => "token {$accessToken}",
            ],
        ]);

        $body = (string)$response->getBody();

        $userCredentials = \GuzzleHttp\json_decode($body, true);

        $user = new User();

        $user->name = $userCredentials['name'];
        $user->id = $userCredentials['id'];
        $user->bio = $userCredentials['bio'];

        return $user;
    }

    public function saveToUser($parameter, $data)
    {
        $accessToken = Session::get('accessToken');

        $array[$parameter] = $data;

        $client = new Client([
            'base_uri' => 'https://api.github.com'
        ]);

        $client->request('PATCH', 'user', [
            RequestOptions::JSON => $array,
            RequestOptions::HEADERS => [
                'Authorization' => "token " . $accessToken,
            ]
        ]);

        $user = App::get('loginService')->getUser();

        $user->$parameter = $data;

        App::get('loginService')->storeUser($user);

        redirect('edit-bio');
    }
}