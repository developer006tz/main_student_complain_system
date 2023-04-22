@php $editing = isset($course) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="code"
            label="Code"
            :value="old('code', ($editing ? $course->code : ''))"
            maxlength="255"
            placeholder="Code"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $course->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="credit"
            label="Credit"
            :value="old('credit', ($editing ? $course->credit : ''))"
            max="255"
            step="0.01"
            placeholder="Credit"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="elective" label="Elective">
            @php $selected = old('elective', ($editing ? $course->elective : '1')) @endphp
            <option value="0" {{ $selected == '0' ? 'selected' : '' }} >0</option>
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >1</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="semester_id" label="Semester">
            @php $selected = old('semester_id', ($editing ? $course->semester_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Semester</option>
            @foreach($semesters as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="department_id" label="Department" required>
            @php $selected = old('department_id', ($editing ? $course->department_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Department</option>
            @foreach($departments as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="nta_level_id" label="Nta Level" required>
            @php $selected = old('nta_level_id', ($editing ? $course->nta_level_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Nta Level</option>
            @foreach($ntaLevels as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="program_id" label="Program" required>
            @php $selected = old('program_id', ($editing ? $course->program_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Program</option>
            @foreach($programs as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
