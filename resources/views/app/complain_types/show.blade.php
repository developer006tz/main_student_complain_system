@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('complain-types.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.complain_types.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.complain_types.inputs.name')</h5>
                    <span>{{ $complainType->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.complain_types.inputs.description')</h5>
                    <span>{{ $complainType->description ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('complain-types.index') }}"
                    class="btn btn-outline-primary"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\ComplainType::class)
                <a
                    href="{{ route('complain-types.create') }}"
                    class="btn btn-outline-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
