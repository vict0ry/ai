<?php

namespace App\Http\Controllers;

use App\Services\Ai\SunoAIService;
use Illuminate\Http\Request;

class SunoAiController extends Controller
{
    protected $sunoAIService;

    public function __construct()
    {
        $this->sunoAIService = new SunoAIService();
    }

    public function generate(Request $request)
    {
        $params = $request->all(); // Gather input data
        $result = $this->sunoAIService->testConnection();
        return response()->json($result);  // Ensure $result is encodable to JSON.
    }
}
