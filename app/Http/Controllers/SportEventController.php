<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormSportEventRequest;
use App\Http\Requests\ListRequest;

class SportEventController extends Controller
{
    const MODULE = 'sport-events';
    const PATH = "/sport-events";
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
        $response = $this->callAPI("GET", "/organizers?perPage=" . PHP_INT_MAX);

        $organizers = $response->json();
        if ($response->status() !== 200) {
            return redirect()->back()->withErrors($organizers['errors'] || []);
        }

        return view(self::MODULE . ".create", ["organizers" => $organizers["data"]]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormSportEventRequest $request)
    {
        $input = $request->validated();
        $response = $this->callAPI("POST", self::PATH, $input);

        $results = $response->json();
        if ($response->status() !== 200) {
            error_activity($results);
            return redirect()->back()->withErrors($results['errors'] ?? []);
        }

        return redirect()->back()->withSuccess("Successfully created sport event");
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
        $response = $this->callAPI("GET", "/organizers?perPage=" . PHP_INT_MAX);

        $organizers = $response->json();
        if ($response->status() !== 200) {
            return redirect()->back()->withErrors($organizers['errors'] || []);
        }

        $response = $this->callAPI("GET", self::PATH . "/$id");

        $results = $response->json();
        if ($response->status() !== 200) {
            error_activity($results);
            return redirect()->back()->withErrors($results['errors'] ?? []);
        }

        return view(self::MODULE . ".edit", ["organizers" => $organizers["data"], "results" => $results]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormSportEventRequest $request, string $id)
    {
        $input = $request->validated();
        $response = $this->callAPI("PUT", self::PATH . "/$id", $input);

        $results = $response->json();
        if ($response->status() !== 204) {
            error_activity($results);
            return redirect()->back()->withErrors($results['errors'] ?? []);
        }

        return redirect()->back()->withSuccess("Successfully update sport event");
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

        return redirect()->back()->withSuccess("Successfully delete sport event");
    }
}
