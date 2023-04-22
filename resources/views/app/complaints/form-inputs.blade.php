@php $editing = isset($complaint) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="complain_type_id" label="Complain Type" required>
            @php $selected = old('complain_type_id', ($editing ? $complaint->complain_type_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Complain Type</option>
            @foreach($complainTypes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="student_id" label="Student" required>
            @php $selected = old('student_id', ($editing ? $complaint->student_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Student</option>
            @foreach($students as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="department_id" label="Department">
            @php $selected = old('department_id', ($editing ? $complaint->department_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Department</option>
            @foreach($departments as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="program_id" label="Program">
            @php $selected = old('program_id', ($editing ? $complaint->program_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Program</option>
            @foreach($programs as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="course_id" label="Course">
            @php $selected = old('course_id', ($editing ? $complaint->course_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Course</option>
            @foreach($courses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="lecture_id" label="Lecture">
            @php $selected = old('lecture_id', ($editing ? $complaint->lecture_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Lecture</option>
            @foreach($lectures as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="semester_id" label="Semester">
            @php $selected = old('semester_id', ($editing ? $complaint->semester_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Semester</option>
            @foreach($semesters as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="academic_year_id" label="Academic Year">
            @php $selected = old('academic_year_id', ($editing ? $complaint->academic_year_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Academic Year</option>
            @foreach($academicYears as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $complaint->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="solution"
            label="Solution"
            maxlength="255"
            required
            >{{ old('solution', ($editing ? $complaint->solution : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($complaint->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $complaint->status : '0')) @endphp
            <option value="0" {{ $selected == '0' ? 'selected' : '' }} >0</option>
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >1</option>
            <option value="2" {{ $selected == '2' ? 'selected' : '' }} >2</option>
            <option value="3" {{ $selected == '3' ? 'selected' : '' }} >3</option>
            <option value="4" {{ $selected == '4' ? 'selected' : '' }} >4</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
