<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lecture;
use Illuminate\View\View;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\LectureStoreRequest;
use App\Http\Requests\LectureUpdateRequest;
use Illuminate\Support\Facades\Auth;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Lecture::class);

        $search = $request->get('search', '');

        $lectures = Lecture::search($search)
            ->latest()
            ->paginate(500)
            ->withQueryString();

        return view('app.lectures.index', compact('lectures', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
       $this->authorize('create', Lecture::class);
            $users = User::pluck('name', 'id');
            $departments = Department::pluck('name', 'id');

            return view('app.lectures.create', compact('users', 'departments'));
       

        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LectureStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Lecture::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $extension = $file->getClientOriginalExtension();

            $filename = time() . rand(4, 999) . '.' . $extension;

            $file->move('uploads/lecturer/', $filename);
        } else {
            $filename = 'default.png';
        }
        $image = ['image' => $filename];

        $lecture = Lecture::create(array_merge($validated, $image));

        if (auth()->user()->hasRole('super-admin')) {
            return redirect()
            ->route('lectures.show', $lecture)
            ->withSuccess(__('crud.common.created'));
        } else {
            return redirect()
            ->route('home')
            ->withSuccess(__('crud.common.created'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Lecture $lecture): View
    {
        $this->authorize('view', $lecture);

        return view('app.lectures.show', compact('lecture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Lecture $lecture): View
    {
        $this->authorize('update', $lecture);

        $users = User::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');

        return view(
            'app.lectures.edit',
            compact('lecture', 'users', 'departments')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        LectureUpdateRequest $request,
        Lecture $lecture
    ): RedirectResponse {
        $this->authorize('update', $lecture);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($lecture->image) {
                Storage::delete($lecture->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $lecture->update($validated);

        return redirect()
            ->route('lectures.index', $lecture)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Lecture $lecture
    ): RedirectResponse {
        $this->authorize('delete', $lecture);

        if ($lecture->image) {
            Storage::delete($lecture->image);
        }

        $lecture->delete();

        return redirect()
            ->route('lectures.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
