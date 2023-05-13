@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text">
        <h2 class="mb-2">@lang('crud.messages.show_title')</h2>
    </div>
    @if(Auth::user()->hasRole('super-admin'))
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('messages.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.messages.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.messages.inputs.body')</h5>
                    <span>{{ $message->body ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.messages.inputs.user_id')</h5>
                    <span>{{ optional($message->user)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.messages.inputs.phone')</h5>
                    <span>{{ $message->phone ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.messages.inputs.send_status')</h5>
                    <span>{{ $message->send_status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.messages.inputs.type')</h5>
                    <span>{{ $message->type ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('messages.index') }}" class="btn btn-outline-primary">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Message::class)
                <a href="{{ route('messages.create') }}" class="btn btn-outline-primary">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
    @else
    @include('app.messages.student-read')
    @endif


</div>
@endsection
