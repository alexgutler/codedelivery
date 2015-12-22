<?php

namespace CodeDelivery\Http\Controllers\Api;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Http\Requests;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{
    private $userRepository;
    private $with = ['client'];

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authenticated()
    {
        $id = Authorizer::getResourceOwnerId();
        return $this->userRepository
            ->skipPresenter(false)
            ->with($this->with)
            ->find($id);
    }
}
