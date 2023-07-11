@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('users.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.users.edit_title')
            </h4>

            <x-form
                method="PUT"
                action="{{ route('users.update', $user) }}"
                class="mt-4"
            >
                @include('app.users.form-inputs')

                <div class="mt-4">
                    @if($user->hasAnyRole(['super-admin', 'admin', 'editor']))
                    <a href="{{ route('users.index') }}" class="btn btn-outline-primary">
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>
                    
                    <a href="{{ route('users.create') }}" class="btn btn-outline-primary">
                        <i class="icon ion-md-add text-primary"></i>
                        @lang('crud.common.create')
                    </a>
                    @endif

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
