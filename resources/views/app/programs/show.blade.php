@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('programs.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.programs.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.programs.inputs.code')</h5>
                    <span>{{ $program->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.programs.inputs.name')</h5>
                    <span>{{ $program->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.programs.inputs.capacity')</h5>
                    <span>{{ $program->capacity ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.programs.inputs.nta_level_id')</h5>
                    <span>{{ optional($program->ntaLevel)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.programs.inputs.department_id')</h5>
                    <span
                        >{{ optional($program->department)->name ?? '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('programs.index') }}" class="btn btn-outline-primary">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Program::class)
                <a href="{{ route('programs.create') }}" class="btn btn-outline-primary">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
