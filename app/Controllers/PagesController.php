<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use GuzzleHttp\Client;
use Nick\Framework\Database\QueryBuilder;
use Nick\Framework\Request;
use Nick\Framework\Session;

class PagesController
{
    public function home()
    {
        $usersWithCars = UserRepository::getAllUsersWithCars();

        $authenticatedUser = Session::get('authenticatedUser');

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
            compact('allCars', 'availableCars', 'errors', 'name', 'age', 'readonly', 'authenticatedUser'));
    }

    public function newCar()
    {
        return view('newCar');
    }

    public function github()
    {
        $client = new Client([
            'base_uri' => 'https://api.github.com'
        ]);
        $response = $client->request('GET', 'users');

        $body = (string)$response->getBody();

        $usersArray =  \GuzzleHttp\json_decode($body, true);

        foreach ($usersArray as $user){
            $avatarUrls[] = $user['avatar_url'];
        }

        return view('github', compact('avatarUrls'));
    }
}
