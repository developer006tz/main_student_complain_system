<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\ComplainType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ComplainTypeStoreRequest;
use App\Http\Requests\ComplainTypeUpdateRequest;

class ComplainTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ComplainType::class);

        $search = $request->get('search', '');

        $complainTypes = ComplainType::search($search)
            ->latest()
            ->paginate(500)
            ->withQueryString();

        return view(
            'app.complain_types.index',
            compact('complainTypes', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ComplainType::class);

        return view('app.complain_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComplainTypeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ComplainType::class);

        $validated = $request->validated();

        $complainType = ComplainType::create($validated);

        return redirect()
            ->route('complain-types.index', $complainType)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ComplainType $complainType): View
    {
        $this->authorize('view', $complainType);

        return view('app.complain_types.show', compact('complainType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ComplainType $complainType): View
    {
        $this->authorize('update', $complainType);

        return view('app.complain_types.edit', compact('complainType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ComplainTypeUpdateRequest $request,
        ComplainType $complainType
    ): RedirectResponse {
        $this->authorize('update', $complainType);

        $validated = $request->validated();

        $complainType->update($validated);

        return redirect()
            ->route('complain-types.index', $complainType)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ComplainType $complainType
    ): RedirectResponse {
        $this->authorize('delete', $complainType);

        $complainType->delete();

        return redirect()
            ->route('complain-types.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
