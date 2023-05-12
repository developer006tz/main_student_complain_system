<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\NtaLevel;
use Illuminate\View\View;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProgramStoreRequest;
use App\Http\Requests\ProgramUpdateRequest;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Program::class);

        $search = $request->get('search', '');

        $programs = Program::search($search)
            ->latest()
            ->paginate(500)
            ->withQueryString();

        return view('app.programs.index', compact('programs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Program::class);

        $ntaLevels = NtaLevel::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');

        return view('app.programs.create', compact('ntaLevels', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProgramStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Program::class);

        $validated = $request->validated();

        $program = Program::create($validated);

        return redirect()
            ->route('programs.index', $program)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Program $program): View
    {
        $this->authorize('view', $program);

        return view('app.programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Program $program): View
    {
        $this->authorize('update', $program);

        $ntaLevels = NtaLevel::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');

        return view(
            'app.programs.edit',
            compact('program', 'ntaLevels', 'departments')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ProgramUpdateRequest $request,
        Program $program
    ): RedirectResponse {
        $this->authorize('update', $program);

        $validated = $request->validated();

        $program->update($validated);

        return redirect()
            ->route('programs.index', $program)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Program $program
    ): RedirectResponse {
        $this->authorize('delete', $program);

        $program->delete();

        return redirect()
            ->route('programs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
