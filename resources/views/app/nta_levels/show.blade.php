@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('nta-levels.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.nta_levels.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.nta_levels.inputs.name')</h5>
                    <span>{{ $ntaLevel->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.nta_levels.inputs.description')</h5>
                    <span>{{ $ntaLevel->description ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('nta-levels.index') }}" class="btn btn-outline-primary">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\NtaLevel::class)
                <a
                    href="{{ route('nta-levels.create') }}"
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
