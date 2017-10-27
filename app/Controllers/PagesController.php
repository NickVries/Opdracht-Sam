<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use Nick\Framework\Database\QueryBuilder;
use Nick\Framework\Request;

class PagesController
{
    public function home()
    {
        $usersWithCars = UserRepository::getAllUsersWithCars();
        return view('index', compact('usersWithCars'));
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
            'mail' => 'blabla@example.com'
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
        $allCars = QueryBuilder::query()->from('cars')->get();

        return view('newUser', compact('allCars'));
    }

    public function newCar()
    {
        return view('newCar');
    }
}
