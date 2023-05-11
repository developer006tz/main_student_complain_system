@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('academic-years.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.academic_years.create_title')
            </h4>

            <x-form
                method="POST"
                action="{{ route('academic-years.store') }}"
                class="mt-4"
            >
                @include('app.academic_years.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('academic-years.index') }}"
                        class="btn btn-outline-primary"
                    >
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.create')
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
