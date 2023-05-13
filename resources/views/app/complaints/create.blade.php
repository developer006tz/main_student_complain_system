@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text">
        <h2 class="mb-2">@lang('crud.complaints.create_title')</h2>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('complaints.index') }}" class="mr-4"
                    ><i class="icon fa fa-arrow-left"></i
                ></a>
            </h4>

            <x-form
                method="POST"
                action="{{ route('complaints.store') }}"
                class="mt-4"
            >
                @include('app.complaints.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('complaints.index') }}"
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
