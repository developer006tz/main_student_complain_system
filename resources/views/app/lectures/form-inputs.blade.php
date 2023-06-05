@php $editing = isset($lecture) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        @if(Auth::user()->hasRole('lecturer'))
        <x-inputs.hidden name="user_id" :value="Auth::user()->id"></x-inputs.hidden>
        @else
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $lecture->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
        @endif
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="department_id" class="select2" label="Department" required>
            @php $selected = old('department_id', ($editing ? $lecture->department_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Department</option>
            @foreach($departments as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <div
            x-data="imageViewer('{{ $editing && $lecture->image ? \Storage::url($lecture->image) : '' }}')"
        >
            <x-inputs.partials.label
                name="image"
                label="Image"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="image"
                    id="image"
                    @change="fileChosen"
                />
            </div>

            @error('image') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>
@if(Auth::user()->hasRole('super-admin'))
<x-inputs.group class="col-sm-12">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $lecture->status : '1')) @endphp
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >1</option>
            <option value="0" {{ $selected == '0' ? 'selected' : '' }} >0</option>
        </x-inputs.select>
    </x-inputs.group>
        
        @else
    <x-inputs.hidden name="status" :value="1"></x-inputs.hidden>
    @endif
</div>
