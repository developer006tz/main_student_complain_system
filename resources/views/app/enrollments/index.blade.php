@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <h2>{{str_replace(['.index','.','-'],' ', Str::ucfirst(request()->route()->getName()))}} </h2>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Enrollment::class)
                <a
                    href="{{ route('enrollments.create') }}"
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
                <table class="table table-bordered table-striped dataTable dtr-inline" role="grid" id="myTable">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.enrollments.inputs.student_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.enrollments.inputs.course_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.enrollments.inputs.semester_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.enrollments.inputs.academic_year_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enrollments as $enrollment)
                        <tr>
                            <td>
                                {{ optional($enrollment->student)->date_of_birth
                                ?? '-' }}
                            </td>
                            <td>
                                {{ optional($enrollment->course)->name ?? '-' }}
                            </td>
                            <td>
                                {{ optional($enrollment->semester)->name ?? '-'
                                }}
                            </td>
                            <td>
                                {{ optional($enrollment->academicYear)->name ??
                                '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $enrollment)
                                    <a
                                        href="{{ route('enrollments.edit', $enrollment) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $enrollment)
                                    <a
                                        href="{{ route('enrollments.show', $enrollment) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $enrollment)
                                    <form
                                        action="{{ route('enrollments.destroy', $enrollment) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-block btn-outline-danger btn-sm"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">{!! $enrollments->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
