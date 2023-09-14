<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormOrganizerRequest;
use App\Http\Requests\ListRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class OrganizerController extends Controller
{
    const MODULE = 'organizers';
    const PATH = "/organizers";
    /**
     * Display a listing of the resource.
     */
    public function index(ListRequest $request)
    {
        $response = $this->callAPI("GET", self::PATH . "?page=" . $request->page . "&perPage=" . $request->perPage);

        $results = $response->json();
        if ($response->status() !== 200) {
            error_activity($results);
            return redirect()->back()->withErrors($results['errors'] ?? []);
        }

        $paginator = $this->paginator(self::PATH, $request->perPage, $results["meta"]["pagination"]["total"]);

        return view(self::MODULE . ".index", ["results" => $results["data"], "paginator" => $paginator]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::MODULE . ".create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormOrganizerRequest $request)
    {
        $input = $request->validated();
        $response = $this->callAPI("POST", self::PATH, $input);

        $results = $response->json();
        if ($response->status() !== 200) {
            error_activity($results);
            return redirect()->back()->withErrors($results['errors'] ?? []);
        }

        return redirect()->back()->withSuccess("Successfully created organization");
    }

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
    public function update(FormOrganizerRequest $request, string $id)
    {
        $input = $request->validated();
        $response = $this->callAPI("PUT", self::PATH . "/$id", $input);

        $results = $response->json();
        if ($response->status() !== 204) {
            error_activity($results);
            return redirect()->back()->withErrors($results['errors'] ?? []);
        }

        return redirect()->back()->withSuccess("Successfully update organization");
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

        return redirect()->back()->withSuccess("Successfully delete organization");
    }
}
