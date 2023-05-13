@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <h2>{{str_replace(['.index','.','-'],' ', Str::ucfirst(request()->route()->getName()))}} </h2>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Student::class)
                <a
                    href="{{ route('students.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap4" id="button-wrapper">
                <table class="table table-bordered table-striped dataTable dtr-inline" role="grid"  id="myTable">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.students.inputs.user_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.students.inputs.department_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.students.inputs.program_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.students.inputs.country_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.students.inputs.gender')
                            </th>
                            <th class="text-left">
                                @lang('crud.students.inputs.date_of_birth')
                            </th>
                            <th class="text-left">
                                @lang('crud.students.inputs.admission_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.students.inputs.maritial_status')
                            </th>
                            <th class="text-left">
                                @lang('crud.students.inputs.photo')
                            </th>
                            <th class="text-left">
                                @lang('crud.students.inputs.status')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr>
                            <td>{{ optional($student->user)->name ?? '-' }}</td>
                            <td>
                                {{ optional($student->department)->name ?? '-'
                                }}
                            </td>
                            <td>
                                {{ optional($student->program)->name ?? '-' }}
                            </td>
                            <td>
                                {{ optional($student->country)->name ?? '-' }}
                            </td>
                            <td>{{ $student->gender ?? '-' }}</td>
                            <td>{{ $student->date_of_birth ?? '-' }}</td>
                            <td>{{ $student->admission_id ?? '-' }}</td>
                            <td>{{ $student->maritial_status ?? '-' }}</td>
                            <td>
                                <x-partials.thumbnail
                                    src="{{ $student->photo ? asset('uploads/student/'.$student->photo) : '' }}"
                                />
                            </td>
                            <td>{{ $student->status ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $student)
                                    <a
                                        href="{{ route('students.edit', $student) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-outline-primary btn-sm"
                                        >
                                            <i class="icon fas fa-edit"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $student)
                                    <a
                                        href="{{ route('students.show', $student) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-outline-success btn-sm"
                                        >
                                            <i class="icon fa fa-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $student)
                                    <form
                                        action="{{ route('students.destroy', $student) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-block btn-outline-danger btn-sm"
                                        >
                                            <i class="icon fa fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="11">{!! $students->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
