@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <h2>{{str_replace(['.index','.','-'],' ', Str::ucfirst(request()->route()->getName()))}} </h2>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Complaint::class)
                <a
                    href="{{ route('complaints.create') }}"
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
            <div  class="dataTables_wrapper dt-bootstrap4" id="button-wrapper">
                <table class="table table-bordered table-striped dataTable dtr-inline" role="grid"  id="myTable">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.complaints.inputs.complain_type_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.complaints.inputs.student_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.complaints.inputs.department_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.complaints.inputs.program_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.complaints.inputs.course_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.complaints.inputs.lecture_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.complaints.inputs.semester_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.complaints.inputs.academic_year_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.complaints.inputs.description')
                            </th>
                            <th class="text-left">
                                @lang('crud.complaints.inputs.solution')
                            </th>
                            <th class="text-left">
                                @lang('crud.complaints.inputs.date')
                            </th>
                            <th class="text-left">
                                @lang('crud.complaints.inputs.status')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $complaint)
                        <tr>
                            <td>
                                {{ optional($complaint->complainType)->name ??
                                '-' }}
                            </td>
                            <td>
                                {{ optional($complaint->student)->date_of_birth
                                ?? '-' }}
                            </td>
                            <td>
                                {{ optional($complaint->department)->name ?? '-'
                                }}
                            </td>
                            <td>
                                {{ optional($complaint->program)->name ?? '-' }}
                            </td>
                            <td>
                                {{ optional($complaint->course)->name ?? '-' }}
                            </td>
                            <td>
                                {{ optional($complaint->lecture)->user->name ?? '-'
                                }}
                            </td>
                            <td>
                                {{ optional($complaint->semester)->name ?? '-'
                                }}
                            </td>
                            <td>
                                {{ optional($complaint->academicYear)->name ??
                                '-' }}
                            </td>
                            <td>{{ $complaint->description ?? '-' }}</td>
                            <td>{{ $complaint->solution ?? '-' }}</td>
                            <td>{{ $complaint->date ?? '-' }}</td>
                            <td>
    {!! $complaint->status == '0' ? '<button class="btn btn-warning">pending</button>' : ($complaint->status == '1' ? '<button class="btn btn-success">success</button>' : ($complaint->status ?? '-')) !!}
</td>

                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $complaint)
                                    <a
                                        href="{{ route('complaints.edit', $complaint) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-outline-primary btn-sm"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $complaint)
                                    <a
                                        href="{{ route('complaints.show', $complaint) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-outline-success btn-sm"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $complaint)
                                    <form
                                        action="{{ route('complaints.destroy', $complaint) }}"
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
                            <td colspan="13">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="13">{!! $complaints->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
