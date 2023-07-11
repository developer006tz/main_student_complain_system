<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\DepartmentHead;
use Spatie\Permission\Models\Role;
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

        //users with role of lecturer and does not habe a department-head role
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'lecturer');
        })->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'department-head');
        })->pluck('name', 'id');
        

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

        $department = Department::find($validated['department_id']);
        $user = User::find($validated['user_id']);
        //check in department if there is a $user->lecture with role of department-head
        $lecturer = $department->departmentHead()->where('user_id','!=',$user->id)->join('users','users.id','=','department_heads.user_id')->first();
        if ($lecturer) {
            return to_route('department-heads.create')
                ->withError(__('Department Head already Exists in "' . strtolower($department->name) . '" !'));
        } else {
            $user->assignRole(Role::findByName('department-head'));
            $departmentHead = DepartmentHead::create($validated);
        }

        

        return redirect()
            ->route('department-heads.index', $departmentHead)
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
            ->route('department-heads.index', $departmentHead)
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

        $user = User::find($departmentHead->user_id);
        $user->removeRole(Role::findByName('department-head'));

        $departmentHead->delete();

        return redirect()
            ->route('department-heads.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
