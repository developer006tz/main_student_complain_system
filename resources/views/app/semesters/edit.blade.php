@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('semesters.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.semesters.edit_title')
            </h4>

            <x-form
                method="PUT"
                action="{{ route('semesters.update', $semester) }}"
                class="mt-4"
            >
                @include('app.semesters.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('semesters.index') }}"
                        class="btn btn-outline-primary"
                    >
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a
                        href="{{ route('semesters.create') }}"
                        class="btn btn-outline-primary"
                    >
                        <i class="icon ion-md-add text-primary"></i>
                        @lang('crud.common.create')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
