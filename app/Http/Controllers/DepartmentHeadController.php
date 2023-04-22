<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\DepartmentHead;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DepartmentHeadStoreRequest;
use App\Http\Requests\DepartmentHeadUpdateRequest;

class DepartmentHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', DepartmentHead::class);

        $search = $request->get('search', '');

        $departmentHeads = DepartmentHead::search($search)
            ->latest()
            ->paginate(500)
            ->withQueryString();

        return view(
            'app.department_heads.index',
            compact('departmentHeads', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', DepartmentHead::class);

        $users = User::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');

        return view(
            'app.department_heads.create',
            compact('users', 'departments')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentHeadStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', DepartmentHead::class);

        $validated = $request->validated();

        $departmentHead = DepartmentHead::create($validated);

        return redirect()
            ->route('department-heads.edit', $departmentHead)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, DepartmentHead $departmentHead): View
    {
        $this->authorize('view', $departmentHead);

        return view('app.department_heads.show', compact('departmentHead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, DepartmentHead $departmentHead): View
    {
        $this->authorize('update', $departmentHead);

        $users = User::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');

        return view(
            'app.department_heads.edit',
            compact('departmentHead', 'users', 'departments')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DepartmentHeadUpdateRequest $request,
        DepartmentHead $departmentHead
    ): RedirectResponse {
        $this->authorize('update', $departmentHead);

        $validated = $request->validated();

        $departmentHead->update($validated);

        return redirect()
            ->route('department-heads.edit', $departmentHead)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        DepartmentHead $departmentHead
    ): RedirectResponse {
        $this->authorize('delete', $departmentHead);

        $departmentHead->delete();

        return redirect()
            ->route('department-heads.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
