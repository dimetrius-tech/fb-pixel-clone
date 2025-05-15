<?php
namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Auth\Events\Registered;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
    }

    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    public function createUser(array $data)
    {
        $user = $this->userRepository->create($data);
        event(new Registered($user));
        return $user;
    }
}
