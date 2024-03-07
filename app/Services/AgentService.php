<?php

namespace App\Services;

use App\Models\Agent;
use App\Repositories\AgentRepository;

class AgentService
{
    public function __construct(
      private readonly AgentRepository $agentRepository
    )
    {
    }

    public function findById($id): ?Agent
    {
        return $this->agentRepository->findById($id);
    }
}
