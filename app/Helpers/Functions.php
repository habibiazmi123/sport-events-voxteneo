<?php

use App\Models\LogActivity;

if (!function_exists('currentUser')) {
    function currentUser()
    {
        return session('currentUser');
    }
}

if (!function_exists('success_activity')) {
    function success_activity($response = null)
    {
        LogActivity::create([
            "user_id" => currentUser()["id"] ?? 0,
            "status" => "SUCCESS",
            "ip_address" => request()->ip(),
            "user_agent" => request()->header('user-agent'),
            "url" => request()->url(),
            "response" => is_array($response) ? json_encode($response) : $response,
        ]);
    }
}

if (!function_exists('error_activity')) {
    function error_activity($response = null)
    {
        LogActivity::create([
            "user_id" => currentUser()["id"] ?? 0,
            "status" => "ERROR",
            "ip_address" => request()->ip(),
            "user_agent" => request()->header('user-agent'),
            "url" => request()->url(),
            "response" => is_array($response) ? json_encode($response) : $response,
        ]);
    }
}
