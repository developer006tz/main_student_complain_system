@php $editing = isset($program) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="code"
            label="Code"
            :value="old('code', ($editing ? $program->code : ''))"
            maxlength="255"
            placeholder="Code"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $program->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="capacity"
            label="Capacity"
            :value="old('capacity', ($editing ? $program->capacity : ''))"
            max="255"
            placeholder="Capacity"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="nta_level_id" label="Nta Level" required>
            @php $selected = old('nta_level_id', ($editing ? $program->nta_level_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Nta Level</option>
            @foreach($ntaLevels as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="department_id" label="Department" required>
            @php $selected = old('department_id', ($editing ? $program->department_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Department</option>
            @foreach($departments as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
