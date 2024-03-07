<?php

namespace App\Repositories;

use App\Models\Agent;
use Illuminate\Database\Eloquent\Model;

/**
 * @method Agent|null findById($id)
 */
class AgentRepository extends Repository
{
    public function __construct(
      private readonly Agent $agent
    )
    {
        parent::__construct();
    }

    public function setModel(): Model
    {
        return $this->agent;
    }
}
