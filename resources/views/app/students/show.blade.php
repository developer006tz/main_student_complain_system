@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('students.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.students.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.user_id')</h5>
                    <span>{{ optional($student->user)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.department_id')</h5>
                    <span
                        >{{ optional($student->department)->name ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.program_id')</h5>
                    <span>{{ optional($student->program)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.country_id')</h5>
                    <span>{{ optional($student->country)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.gender')</h5>
                    <span>{{ $student->gender ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.date_of_birth')</h5>
                    <span>{{ $student->date_of_birth ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.admission_id')</h5>
                    <span>{{ $student->admission_id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.maritial_status')</h5>
                    <span>{{ $student->maritial_status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.photo')</h5>
                    <x-partials.thumbnail
                        src="{{ $student->photo ? asset('uploads/student/'.$student->photo) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.status')</h5>
                    <span>{{ $student->status ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('students.index') }}" class="btn btn-outline-primary">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Student::class)
                <a href="{{ route('students.create') }}" class="btn btn-outline-primary">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
