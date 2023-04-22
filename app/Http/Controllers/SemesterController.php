<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SemesterStoreRequest;
use App\Http\Requests\SemesterUpdateRequest;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Semester::class);

        $search = $request->get('search', '');

        $semesters = Semester::search($search)
            ->latest()
            ->paginate(500)
            ->withQueryString();

        return view('app.semesters.index', compact('semesters', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Semester::class);

        return view('app.semesters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SemesterStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Semester::class);

        $validated = $request->validated();

        $semester = Semester::create($validated);

        return redirect()
            ->route('semesters.edit', $semester)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Semester $semester): View
    {
        $this->authorize('view', $semester);

        return view('app.semesters.show', compact('semester'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Semester $semester): View
    {
        $this->authorize('update', $semester);

        return view('app.semesters.edit', compact('semester'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SemesterUpdateRequest $request,
        Semester $semester
    ): RedirectResponse {
        $this->authorize('update', $semester);

        $validated = $request->validated();

        $semester->update($validated);

        return redirect()
            ->route('semesters.edit', $semester)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Semester $semester
    ): RedirectResponse {
        $this->authorize('delete', $semester);

        $semester->delete();

        return redirect()
            ->route('semesters.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
