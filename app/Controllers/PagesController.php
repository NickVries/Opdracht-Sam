<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Services\GithubService;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Nick\Framework\App;
use Nick\Framework\Database\QueryBuilder;
use Nick\Framework\Request;
use Nick\Framework\Session;

class PagesController
{
    public function home()
    {
        $authenticatedUser = null;
        $usersWithCars = UserRepository::getAllUsersWithCars();

        if (App::get('loginService')->checkLogin()) {
            $authenticatedUser = App::get('loginService')->getUser();
        }

        return view('index', compact('usersWithCars', 'authenticatedUser'));
    }

    public function about()
    {
        $companyName = 'Nickdude';

        return view('about', compact('companyName'));
    }

    public function contact()
    {
        $contactDetails = [
            'phone' => '+316 12 345 678',
            'mail'  => 'blabla@example.com',
        ];

        return view('contact', compact('contactDetails'));

    }

    public function userCreated()
    {
        $user = $_GET['name'];

        return view('user-created', compact('user'));
    }

    public function secret()
    {
        return view('secret');
    }

    public function page404()
    {
        $baseUrl = Request::baseUrl();

        return view('404', compact('baseUrl'));
    }

    public function newUser()
    {
        $authenticatedUser = Session::get('authenticatedUser');

        $allCars = QueryBuilder::query()->from('cars')->get();

        if ($authenticatedUser) {
            $usersWithCars = UserRepository::getAllUsersWithCars();

            $usersCars = $usersWithCars[$authenticatedUser->id]->garage;

            $availableCars = array_udiff($allCars, $usersCars,
                function ($a, $b) {
                    return $a->id - $b->id;
                });
        }

        $errors = Session::getFlash('errors');
        $age = $authenticatedUser->age ?? '';
        $name = $authenticatedUser->name ?? '';
        $readonly = (bool)($authenticatedUser ?? false);

        return view('newUser',
            compact('allCars', 'availableCars', 'errors', 'name', 'age',
                'readonly', 'authenticatedUser'));
    }

    public function newCar()
    {
        return view('newCar');
    }

    public function github()
    {
        $client = new Client([
            'base_uri' => 'https://api.github.com',
        ]);
        $response = $client->request('GET', 'users');

        $body = (string)$response->getBody();

        $usersArray = \GuzzleHttp\json_decode($body, true);

        foreach ($usersArray as $user) {
            $avatarUrls[] = $user['avatar_url'];
        }
        $avatarUrls = array_rand(array_flip($avatarUrls), 10);

        $avatarUrls = [];
        for ($i = 0; $i < 10; $i++) {
            $avatarUrls[] = sprintf(
                'https://avatars0.githubusercontent.com/u/%s?v=4',
                rand(100, 1000000)
            );
        }

        $users = [];
        foreach ($avatarUrls as $avatarUrl) {

            $watsonClient = new Client([
                'base_uri' => 'https://watson-api-explorer.mybluemix.net',
            ]);

            $watsonResponse = $watsonClient->request('POST',
                'visual-recognition/api/v3/classify?version=2016-05-20', [
                    'multipart' => [
                        [
                            'name'     => 'parameters',
                            'contents' => \GuzzleHttp\json_encode(['url' => $avatarUrl]),
                        ],
                    ],
                ]);

            $watsonBody = (string)$watsonResponse->getBody();

            $watsonBodyphp = \GuzzleHttp\json_decode($watsonBody);

            $classifiers = $watsonBodyphp->images[0]->classifiers[0]->classes;

            usort($classifiers, function ($a, $b) {
                return ($b->score - $a->score) * 1000;
            });

            $top3Classifiers = array_slice($classifiers, 0, 30);
            $users[] = [
                'avatar'      => $avatarUrl,
                'classifiers' => $top3Classifiers,
            ];
        }

        return view('github', compact('users'));
    }

    public function callback()
    {
        $client = new Client([
            'base_uri' => 'https://github.com',
        ]);

        $response = $client->request('POST', 'login/oauth/access_token', [
            RequestOptions::FORM_PARAMS => [
                'client_id'     => 'd77abb39c2b95aa9efb7',
                'client_secret' => 'cdd81aee1063c06f9583fcbc64218ea6e72a6db1',
                'code'          => $_GET['code'],
            ],
            RequestOptions::HEADERS     => [
                'Accept' => 'application/json',
            ],
        ]);

        $body = (string)$response->getBody();

        $phpBody = \GuzzleHttp\json_decode($body, true);

        $accessToken = $phpBody['access_token'];

        Session::store('accessToken', $accessToken);

        redirect('');
    }

    public function editBio()
    {
        $bio = App::get('loginService')->getUser()->bio;

        return view('editBio', compact('bio'));
    }

}
