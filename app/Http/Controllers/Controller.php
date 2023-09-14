<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    const BASE_API_URL = 'https://api-sport-events.php9-01.test.voxteneo.com/api/v1';

    public function callAPI($method, $path, $data = [])
    {
        $url = self::BASE_API_URL . $path;
        $token = currentUser()['token'] ?? null;

        switch (strtoupper($method)) {
            case 'GET':
                $response = Http::withToken($token)->get($url);
                break;
            case 'POST':
                $response = Http::withToken($token)->post($url, $data);
                break;
            case 'PUT':
                $response = Http::withToken($token)->put($url, $data);
                break;
            case 'DELETE':
                $response = Http::withToken($token)->delete($url, $data);
                break;
            default:
                throw new Exception('Invalid HTTP method');
        }

        success_activity();

        return $response;
    }

    public static function paginator($path, $perPage, $totalRecords)
    {
        $dataCollection = new Collection(range(1, $totalRecords));
        $paginator = new Paginator($dataCollection, $perPage);
        $paginator->setPath($path);

        return $paginator;
    }
}
