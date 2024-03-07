<?php

namespace App\Http\Controllers\Order\V1;

use Illuminate\Http\Request;
use App\Services\AgentService;
use App\Http\Controllers\Controller;
use App\Services\DelayReportService;

class AssignDelayController extends Controller
{
    public function __construct(
        private readonly DelayReportService $delayReport,
        private readonly AgentService $agentService,
    ) {
    }

    public function __invoke(Request $request)
    {
        $agent = $this->agentService->findById($request->input('agent_id'));

        if (is_null($agent)) {
            return apiResponse()
                ->withMessage("Agent with the ID of {$request->input('agent_id')} not found")
                ->notFound();
        }

        $ok = $this->delayReport->assignTheAgentToTheOldestDelayReport(
            $request->input('agent_id'), // Just to skip the authentication system....
        );

        return apiResponse()->ok([
            'ok' => $ok
        ]);
    }
}
