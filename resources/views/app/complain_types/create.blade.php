@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('complain-types.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.complain_types.create_title')
            </h4>

            <x-form
                method="POST"
                action="{{ route('complain-types.store') }}"
                class="mt-4"
            >
                @include('app.complain_types.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('complain-types.index') }}"
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
