<?php

namespace App\Services\Ai;

use App\Helpers\Classes\Helper;
use Illuminate\Support\Facades\Http;
class SunoAIService
{
    protected $baseUri;
    protected $apiToken;

    public function __construct()
    {
//         $this->baseUri = 'https://studio-api.suno.ai/api/';
//         $this->apiToken = 'eyJhbGciOiJSUzI1NiIsImNhdCI6ImNsX0I3ZDRQRDExMUFBQSIsImtpZCI6Imluc18yT1o2eU1EZzhscWRKRWloMXJvemY4T3ptZG4iLCJ0eXAiOiJKV1QifQ.eyJhdWQiOiJzdW5vLWFwaSIsImF6cCI6Imh0dHBzOi8vc3Vuby5jb20iLCJleHAiOjE3MjQ1MTg4MTEsImh0dHBzOi8vc3Vuby5haS9jbGFpbXMvY2xlcmtfaWQiOiJ1c2VyXzJlNlMyYnZ1VEE2RzFtemxGREcwM05iQWd3QSIsImh0dHBzOi8vc3Vuby5haS9jbGFpbXMvZW1haWwiOiJtYWlsQHZpY3RvcmVsaW90LmNvbSIsImh0dHBzOi8vc3Vuby5haS9jbGFpbXMvcGhvbmUiOm51bGwsImlhdCI6MTcyNDUxODc1MSwiaXNzIjoiaHR0cHM6Ly9jbGVyay5zdW5vLmNvbSIsImp0aSI6ImUwMTA0NmIwYzk2YmUxOGFjNWNmIiwibmJmIjoxNzI0NTE4NzQxLCJzaWQiOiJzZXNzXzJrUXhpNXFTQ3FRanZqWWxyYWNaUjk1Q2dtTCIsInN1YiI6InVzZXJfMmU2UzJidnVUQTZHMW16bEZERzAzTmJBZ3dBIn0.r0-XxrwGBZ5CleNLJLiQ7KjyyXZkCkrv8WivFzdKIIZA71Yj34BWZu9C7oFek55VgdJ-EzuiD8Mmxz13GKMFz1djWISuiRGFAIXwESDY5o2_im0n3AmvTWtR04TStetrKKByqmAyAUxXAVq_mAI3VUgO9RT79M9_LVTa4CZy1t-633z2vhTRPFhFxOOAIYZUXWeISGbVen4ClgKoScwNXnVMFTOR59RfMshOJTIZrlidWWVAsgLv0Hc9vywAFi76YM1y1263Gp1Vmo_-aUR7aXWNLzNIFSjJy7ik0jMXrCuHIvAbkrkhizdP0dh7b95vM_x3pK8Yh_z8dybhT1j7TQ';
    }

    public function testConnection()
    {
        return ['status' => 'SunoAIService is working'];
    }

    public function generateMusic($params)
    {
        $url = $this->baseUri . 'generate/v2/';
        $response = $this->makePostRequest($url, $params);

        return json_decode($response, true);
    }

    private function makePostRequest($url, $params)
    {
        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->apiToken,
            'Content-Type: application/json',
            'Accept: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Optional: For SSL issues

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return json_encode(['error' => curl_error($ch)]);
        }

        curl_close($ch);

        return $response;
    }
}
