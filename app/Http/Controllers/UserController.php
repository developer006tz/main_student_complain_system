<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', User::class);

        $search = $request->get('search', '');

        $users = User::search($search)
            ->latest()
            ->paginate(500)
            ->withQueryString();

        return view('app.users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', User::class);

        $roles = Role::get();

        return view('app.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        $user->syncRoles($request->roles);

        return redirect()
            ->route('users.edit', $user)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user): View
    {
        $this->authorize('view', $user);

        return view('app.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edits(Request $request, User $user): View
    {
        $this->authorize('update', $user);

        $roles = Role::get();

        return view('app.users.edit', compact('user', 'roles'));//
    }

    public function edit(Request $request, User $user): View
    {
        $this->authorize('update', $user);

        $excludedRoles = ['super-admin', 'department-head', 'gender-desk','user'];

        if (auth()->user()->hasRole('super-admin')) {
            $roles = Role::get();
        } else {
            $roles = Role::whereNotIn('name', $excludedRoles)->get();
        }

        return view('app.users.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(
        UserUpdateRequest $request,
        User $user
    ): RedirectResponse {
        $this->authorize('update', $user);

        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);
        
        // return roles name by $request roles id

        $roles = Role::findOrFail($request->roles);

        $role_names = $roles->pluck('name')->toArray();
        //check if $request roles contain department-head
        if (in_array('department-head', $role_names)) {
            //ckeck if the user has also role lecturer and check if there are lecture in the same department with the department-head role , if found return error message if not assign the department-head role
            if (in_array('lecturer', $role_names)) {
                $lecturer = User::where('users.id', '!=', $user->id)
                    ->whereHas('roles', function ($q) {
                        $q->where('name', 'department-head');
                    })
                    ->join('lectures', 'users.id', '=', 'lectures.user_id')
                    ->where('lectures.department_id', $user->lecture->department_id)
                    ->first();

                if ($lecturer) {
                    return redirect()
                        ->route('users.edit', $user)
                        ->withError(__('Department Head already Exists in "'. strtolower($user->lecture->department->name).'" Department !'));
                } else {
                    $user->syncRoles($request->roles);
                }
            } else {
                $user->syncRoles($request->roles);
            }
           
        } else {
            $user->syncRoles($request->roles);
        }

        $user->syncRoles($request->roles);
        
        if (auth()->user()->hasRole('super-admin')){
          return redirect()
            ->route('users.show', $user)
            ->withSuccess(__($user->name.' Updated Successfull'));  
        } else{
            return redirect()
            ->route('home')
            ->withSuccess(__($user->name . ' Updated Successfull'));
            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()
            ->route('users.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
