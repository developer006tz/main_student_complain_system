@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('semesters.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.semesters.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.semesters.inputs.name')</h5>
                    <span>{{ $semester->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.semesters.inputs.start_date')</h5>
                    <span>{{ $semester->start_date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.semesters.inputs.end_date')</h5>
                    <span>{{ $semester->end_date ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('semesters.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Semester::class)
                <a href="{{ route('semesters.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
