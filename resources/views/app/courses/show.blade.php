@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('courses.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.courses.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.courses.inputs.code')</h5>
                    <span>{{ $course->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.courses.inputs.name')</h5>
                    <span>{{ $course->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.courses.inputs.credit')</h5>
                    <span>{{ $course->credit ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.courses.inputs.elective')</h5>
                    <span>{{ $course->elective ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.courses.inputs.semester_id')</h5>
                    <span>{{ optional($course->semester)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.courses.inputs.department_id')</h5>
                    <span
                        >{{ optional($course->department)->name ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.courses.inputs.nta_level_id')</h5>
                    <span>{{ optional($course->ntaLevel)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.courses.inputs.program_id')</h5>
                    <span>{{ optional($course->program)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('courses.index') }}" class="btn btn-outline-primary">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Course::class)
                <a href="{{ route('courses.create') }}" class="btn btn-outline-primary">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
