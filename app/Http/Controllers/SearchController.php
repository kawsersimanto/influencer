<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;
use Modules\Service\Entities\Category;
use Modules\Service\Entities\Service;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with('category', 'influencer', 'platform')->where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable'])->orderBy('id', 'desc')->get();
        $categories = Category::where('status', 'active')->get();
        $platforms = Platform::all();

        return view("search")->with([
            'categories' => $categories,
            'services' => $services,
            "platforms" => $platforms
          ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
