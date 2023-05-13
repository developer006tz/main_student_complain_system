@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('complaints.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.complaints.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.complaints.inputs.complain_type_id')</h5>
                    <span
                        >{{ optional($complaint->complainType)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.complaints.inputs.student_id')</h5>
                    <span
                        >{{ optional($complaint->student)->date_of_birth ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.complaints.inputs.department_id')</h5>
                    <span
                        >{{ optional($complaint->department)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.complaints.inputs.program_id')</h5>
                    <span
                        >{{ optional($complaint->program)->name ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.complaints.inputs.course_id')</h5>
                    <span>{{ optional($complaint->course)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.complaints.inputs.lecture_id')</h5>
                    <span
                        >{{ optional($complaint->lecture)->image ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.complaints.inputs.semester_id')</h5>
                    <span
                        >{{ optional($complaint->semester)->name ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.complaints.inputs.academic_year_id')</h5>
                    <span
                        >{{ optional($complaint->academicYear)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.complaints.inputs.description')</h5>
                    <span>{!! $complaint->description ?? '-' !!}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.complaints.inputs.solution')</h5>
                    <span>{{ $complaint->solution ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.complaints.inputs.date')</h5>
                    <span>{{ $complaint->date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.complaints.inputs.status')</h5>
                    <span>{{ $complaint->status ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('complaints.index') }}" class="btn btn-outline-primary">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Complaint::class)
                <a
                    href="{{ route('complaints.create') }}"
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
