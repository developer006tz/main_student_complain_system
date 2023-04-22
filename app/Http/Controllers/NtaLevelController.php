<?php

namespace App\Http\Controllers;

use App\Models\NtaLevel;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\NtaLevelStoreRequest;
use App\Http\Requests\NtaLevelUpdateRequest;

class NtaLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', NtaLevel::class);

        $search = $request->get('search', '');

        $ntaLevels = NtaLevel::search($search)
            ->latest()
            ->paginate(500)
            ->withQueryString();

        return view('app.nta_levels.index', compact('ntaLevels', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', NtaLevel::class);

        return view('app.nta_levels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NtaLevelStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', NtaLevel::class);

        $validated = $request->validated();

        $ntaLevel = NtaLevel::create($validated);

        return redirect()
            ->route('nta-levels.edit', $ntaLevel)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, NtaLevel $ntaLevel): View
    {
        $this->authorize('view', $ntaLevel);

        return view('app.nta_levels.show', compact('ntaLevel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, NtaLevel $ntaLevel): View
    {
        $this->authorize('update', $ntaLevel);

        return view('app.nta_levels.edit', compact('ntaLevel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        NtaLevelUpdateRequest $request,
        NtaLevel $ntaLevel
    ): RedirectResponse {
        $this->authorize('update', $ntaLevel);

        $validated = $request->validated();

        $ntaLevel->update($validated);

        return redirect()
            ->route('nta-levels.edit', $ntaLevel)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        NtaLevel $ntaLevel
    ): RedirectResponse {
        $this->authorize('delete', $ntaLevel);

        $ntaLevel->delete();

        return redirect()
            ->route('nta-levels.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
