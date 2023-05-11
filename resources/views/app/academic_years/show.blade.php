@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('academic-years.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.academic_years.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.academic_years.inputs.name')</h5>
                    <span>{{ $academicYear->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.academic_years.inputs.start_date')</h5>
                    <span>{{ $academicYear->start_date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.academic_years.inputs.end_date')</h5>
                    <span>{{ $academicYear->end_date ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('academic-years.index') }}"
                    class="btn btn-outline-primary"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\AcademicYear::class)
                <a
                    href="{{ route('academic-years.create') }}"
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
