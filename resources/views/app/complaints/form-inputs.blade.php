@php $editing = isset($complaint) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="complain_type_id" class="select2" label="Complain Type" style="width: 100%;" required>
            @php $selected = old('complain_type_id', ($editing ? $complaint->complain_type_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Complain Type</option>
            @foreach($complainTypes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        @if(Auth::user()->hasRole('super-admin'))
        <x-inputs.select name="student_id" class="select2" label="Student" required>
            @php $selected = old('student_id', ($editing ? $complaint->student_id : '')) @endphp
            
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Student</option>
            
            @foreach($students as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
        @else
        <x-inputs.hidden name="student_id" :value="Auth::user()->student->id"></x-inputs.hidden>
        @endif
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="department_id" class="select2" label="Department">
            @php $selected = old('department_id', ($editing ? $complaint->department_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Department</option>
            @foreach($departments as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="program_id" class="select2" label="Program">
            @php $selected = old('program_id', ($editing ? $complaint->program_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Program</option>
            @foreach($programs as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group> 

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="course_id" class="select2" label="Course">
            @php $selected = old('course_id', ($editing ? $complaint->course_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Course</option>
            @foreach($courses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="lecture_id" class="select2" label="Lecture">
            @php $selected = old('lecture_id', ($editing ? $complaint->lecture_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Lecture</option>
            @foreach($lectures as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="semester_id" class="select2" label="Semester">
            @php $selected = old('semester_id', ($editing ? $complaint->semester_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Semester</option>
            @foreach($semesters as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="academic_year_id" class="select2" label="Academic Year">
            @php $selected = old('academic_year_id', ($editing ? $complaint->academic_year_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Academic Year</option>
            @foreach($academicYears as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    {{-- <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="65530"
            id="summernote"
            required
            >{{ old('description', ($editing ? $complaint->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group> --}}

     <div class="col-sm-12 my-2">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                <b>Describe your Complaints</b>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <textarea class="summernote" name="description">
               {{ old('description', ($editing ? $complaint->description : 'Write your complaints Here'))
            }}
              </textarea>
              @error('description')
                <p class="text-danger" role="alert">{{ $message }}</p>
            @enderror
            </div>
           
          </div>
        </div>

        <div class="col-sm-12 my-2">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                <b>Propose your Solution</b>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <textarea id="summernote" class="summernote" name="solution">
               {{ old('description', ($editing ? $complaint->solution : 'Write your Solution Here'))
            }}
              </textarea>
              @error('solution')
            <p class="text-danger" role="alert">{{ $message }}</p>
        @enderror
            </div>
           
          </div>
        </div>

    {{-- <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="solution"
            label="Solution"
            maxlength="65530"
            required
            >{{ old('solution', ($editing ? $complaint->solution : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group> --}}

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($complaint->date)->format('Y-m-d') : date('Y-m-d'))) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    
</div>
