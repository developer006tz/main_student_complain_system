<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AcademicYearStoreRequest;
use App\Http\Requests\AcademicYearUpdateRequest;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', AcademicYear::class);

        $search = $request->get('search', '');

        $academicYears = AcademicYear::search($search)
            ->latest()
            ->paginate(500)
            ->withQueryString();

        return view(
            'app.academic_years.index',
            compact('academicYears', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', AcademicYear::class);

        return view('app.academic_years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AcademicYearStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', AcademicYear::class);

        $validated = $request->validated();

        $academicYear = AcademicYear::create($validated);

        return redirect()
            ->route('academic-years.index', $academicYear)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, AcademicYear $academicYear): View
    {
        $this->authorize('view', $academicYear);

        return view('app.academic_years.show', compact('academicYear'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, AcademicYear $academicYear): View
    {
        $this->authorize('update', $academicYear);

        return view('app.academic_years.edit', compact('academicYear'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AcademicYearUpdateRequest $request,
        AcademicYear $academicYear
    ): RedirectResponse {
        $this->authorize('update', $academicYear);

        $validated = $request->validated();

        $academicYear->update($validated);

        return redirect()
            ->route('academic-years.index', $academicYear)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        AcademicYear $academicYear
    ): RedirectResponse {
        $this->authorize('delete', $academicYear);

        $academicYear->delete();

        return redirect()
            ->route('academic-years.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
