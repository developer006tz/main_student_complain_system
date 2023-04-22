@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('lectures.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.lectures.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.lectures.inputs.user_id')</h5>
                    <span>{{ optional($lecture->user)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lectures.inputs.department_id')</h5>
                    <span
                        >{{ optional($lecture->department)->name ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lectures.inputs.image')</h5>
                    <x-partials.thumbnail
                        src="{{ $lecture->image ? \Storage::url($lecture->image) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lectures.inputs.status')</h5>
                    <span>{{ $lecture->status ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('lectures.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Lecture::class)
                <a href="{{ route('lectures.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
