<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordUserRequest;
use App\Http\Requests\FormUserRequest;
use App\Http\Requests\ListRequest;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    const MODULE = 'users';
    const PATH = "/users";

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->callAPI("GET", self::PATH . "/$id");

        $results = $response->json();
        if ($response->status() !== 200) {
            error_activity($results);
            return redirect()->back()->withErrors($results['errors'] ?? []);
        }

        return view(self::MODULE . ".view", ["results" => $results]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response = $this->callAPI("GET", self::PATH . "/$id");

        $results = $response->json();
        if ($response->status() !== 200) {
            error_activity($results);
            return redirect()->back()->withErrors($results['errors'] ?? []);
        }

        return view(self::MODULE . ".edit", ["results" => $results]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormUserRequest $request, string $id)
    {
        $input = $request->validated();
        $response = $this->callAPI("PUT", self::PATH . "/$id", $input);

        $results = $response->json();
        if ($response->status() !== 204) {
            error_activity($results);
            return redirect()->back()->withErrors($results['errors'] ?? []);
        }

        if ($id == currentUser()["id"]) {
            return redirect()->route('users.show', $id);
        }

        return redirect()->back()->withSuccess("Successfully update user");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->callAPI("DELETE", self::PATH . "/$id");

        $results = $response->json();
        if ($response->status() !== 204) {
            error_activity($results);
            return redirect()->back()->withErrors($results['errors'] ?? []);
        }

        return redirect()->back()->withSuccess("Successfully delete user");
    }

    public function showChangePassword(string $id)
    {
        return view(self::MODULE . ".change-password", ["id" => $id]);
    }

    /**
     * Update update password.
     */
    public function updateChangePassword(ChangePasswordUserRequest $request, string $id)
    {
        $input = $request->validated();
        $response = $this->callAPI("PUT", self::PATH . "/$id/password", $input);

        $results = $response->json();
        if ($response->status() !== 204) {
            error_activity($results);
            return redirect()->back()->withErrors($results['errors'] ?? []);
        }

        return redirect()->back()->withSuccess("Successfully update user password");
    }
}
