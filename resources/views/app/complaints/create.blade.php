@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex my-4">
        <h2 class="mr-auto">Create Complaint &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  (OR)</h2>
        <div class="btn-group" role="group">
            <a href="{{ route('gender-complaints.create') }}" class="btn btn-primary">
                CREATE GENDER BASED COMPLAINT
            </a>
        </div>

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
