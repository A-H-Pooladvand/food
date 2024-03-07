<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository
{
    public function __construct(
        private readonly User $user
    ) {
        parent::__construct();
    }

    public function setModel(): Model
    {
        return $this->user;
    }
}
