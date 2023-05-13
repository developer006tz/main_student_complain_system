<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MessageStoreRequest;
use App\Http\Requests\MessageUpdateRequest;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Message::class);

        $search = $request->get('search', '');

        
        
        //if the auth user is student show only message which is sent to his user profile
        if (auth()->user()->hasRole('super-admin')) {
            $messages = Message::search($search)
            ->latest()
            ->paginate(500)
            ->withQueryString();
            
        }else{
            $messages = Message::where('user_id', auth()->user()->id)->search($search)
                ->latest()
                ->paginate(500)
                ->withQueryString();
        }    

        return view('app.messages.index', compact('messages', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Message::class);

        $users = User::pluck('name', 'id');

        return view('app.messages.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Message::class);

        $validated = $request->validated();
        $sender_id = auth()->user()->id;

        $message = Message::create($validated + ['sender_id' => $sender_id]);

        return redirect()
            ->route('messages.index', $message)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Message $message): View
    {
        $this->authorize('view', $message);
        //if the auth user is student show only message which is sent to his user profile
        $uri = last(explode('/', $request->path()));
        if(auth()->user()->hasRole('super-admin')){
            return view('app.messages.show', compact('message'));
        }else {
            $message = Message::select('messages.id', 'messages.body','messages.phone','receiver.phone as receiver_phone','sender.phone as sender_phone', 'messages.created_at', 'receiver.name as receiver_name', 'sender.name as sender_name')
            ->where('user_id', auth()->user()->id)->where('messages.id', $uri)
                ->join('users as receiver', 'receiver.id', '=', 'messages.user_id')
                ->join('users as sender', 'sender.id', '=', 'messages.sender_id')->first();
            return view('app.messages.show', compact('message'));
        }


        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Message $message): View
    {
        $this->authorize('update', $message);

        $users = User::pluck('name', 'id');

        return view('app.messages.edit', compact('message', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        MessageUpdateRequest $request,
        Message $message
    ): RedirectResponse {
        $this->authorize('update', $message);

        $validated = $request->validated();
        $sender_id = auth()->user()->id;

        $message->update($validated + ['sender_id' => $sender_id]);

        return redirect()
            ->route('messages.index', $message)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Message $message
    ): RedirectResponse {
        $this->authorize('delete', $message);

        $message->delete();

        return redirect()
            ->route('messages.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
