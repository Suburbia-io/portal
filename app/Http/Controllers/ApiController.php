<?php

namespace App\Http\Controllers;

use App\Models\AccessLogEntry;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends BaseController
{
    private ?string $apiKey = null;

    public function __construct()
    {
        $this->apiKey = env('API_KEY');
    }

    public function userDatasetsApi(Request $request) {
        $apiKeyHeader = $request->bearerToken();

        if (empty($this->apiKey) || $apiKeyHeader !== $this->apiKey) {
            abort(401);
        }

        $s3Key = $request->get('key');
        /** @var User $user */
        $user = User::where('s3_key', '=', $s3Key)->first();

        if (empty($user)) {
            return [];
        }

        return $user->datasets()->pluck('name');
    }

    public function userAccessLogApi(Request $request) {
        $apiKeyHeader = $request->bearerToken();
        if (empty($this->apiKey) || $apiKeyHeader !== $this->apiKey) {
            abort(401);
        }

        $s3Key = $request->get('key');
        /** @var User $user */
        $user = User::where('s3_key', '=', $s3Key)->first();

        if (empty($user)) {
            return response()->json([
                'data' => true,
            ]);
        }

        $payload = $request->get('file');

        AccessLogEntry::create([
            'user_id' => $user->id,
            'type' => 's3_download',
            'payload' => trim($payload),
        ]);

        return response()->json([
            'data' => true,
        ]);
    }

}
