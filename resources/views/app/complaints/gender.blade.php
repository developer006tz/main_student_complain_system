@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex my-4">
        <h2 class="mr-auto">Submit Gender Complaint</h2>
        <div class="btn-group" role="group">
            <a href="{{ route('complaints.create') }}" class="btn btn-primary">
                back
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
                action="{{ route('gender-complaints.store') }}"
                class="mt-4"
                
            >
            @csrf

             <x-inputs.group class="col-sm-12 mb-4">
        <x-inputs.text
            name="title"
            label="Subject (Title)"
            :value="old('title')"
            placeholder="Input your subject here"
            required
        ></x-inputs.text>
    </x-inputs.group>

          <x-inputs.group class="col-sm-12 mb-4">
        <x-inputs.textarea
            name="description"
            label="Subject (Title)"
            :value="old('description')"
            placeholder="Input your Description here"
            required
        ></x-inputs.textarea>
    </x-inputs.group>

  
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
                        submit to gender desk
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
