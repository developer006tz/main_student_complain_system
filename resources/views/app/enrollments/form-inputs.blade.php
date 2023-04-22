@php $editing = isset($enrollment) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="student_id" label="Student" required>
            @php $selected = old('student_id', ($editing ? $enrollment->student_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Student</option>
            @foreach($students as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="course_id" label="Course" required>
            @php $selected = old('course_id', ($editing ? $enrollment->course_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Course</option>
            @foreach($courses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="semester_id" label="Semester" required>
            @php $selected = old('semester_id', ($editing ? $enrollment->semester_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Semester</option>
            @foreach($semesters as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="academic_year_id" label="Academic Year" required>
            @php $selected = old('academic_year_id', ($editing ? $enrollment->academic_year_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Academic Year</option>
            @foreach($academicYears as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
