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
                <table class="table table-bordered table-striped dataTable dtr-inline" role="grid"  id="myTableFixedColumn">
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
                                {{ optional($complaint->student)->user->name
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
                            <td>{!! Str::limit(strip_tags($complaint->description),100) ?? '-' !!}</td>
                            <td>{!! Str::limit(strip_tags($complaint->solution),100) ?? '-' !!}</td>
                            <td>{{ \Carbon\Carbon::parse($complaint->date)->format('d/m/Y') ?? '-' }}</td>
                            <td style="width: 134px;">
   @if(Auth::user()->hasRole('student'))
{!! $complaint->status == '0' ? '<span class="badge badge-info">new</span>' : ($complaint->status == '1' ? '<span class="badge badge-warning">pending</span>' : ($complaint->status == '2' ? '<span class="badge badge-success">resolved</span>' :($complaint->status == '4' ? '<span class="badge badge-danger">rejected</span>' : '<span class="badge badge-secondary">transfered</span>') )) !!}                            @else

{!! $complaint->status == '0' ? '<span class="badge badge-info">new</span>' : ($complaint->status == '1' ? '<span class="badge badge-warning">pending</span>' : ($complaint->status == '2' ? '<span class="badge badge-success">resolved</span>' :($complaint->status == '4' ? '<span class="badge badge-danger">rejected</span>' : '<span class="badge badge-secondary">transfered</span>') )) !!}                            @endif

                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $complaint)
                                    {{-- //check if the user is student or and if compaint status is 0 to enable edit else to disable button  --}}
                                    @if(Auth::user()->hasRole('student'))
                                    {!! $complaint->status == '0' ? '<a href="'.route('complaints.edit', $complaint).'" ><button type="button" class="btn btn-outline-primary btn-sm"><i class="icon fas fa-edit"></i></button></a>' : '<button type="button" class="btn btn-outline-primary btn-sm" disabled><i class="icon fas fa-edit"></i></button>' !!}
                                    @else
                                    <a
                                        href="{{ route('complaints.edit', $complaint) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-outline-primary btn-sm"
                                        >
                                            <i class="icon fas fa-edit"></i>
                                        </button>
                                    </a>
                                    @endif
                                    @endcan @can('view', $complaint)
                                    <a
                                        href="{{ route('complaints.show', $complaint) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-outline-success btn-sm"
                                        >
                                            <i class="icon fa fa-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $complaint)
                                    {{-- //check if the user is student or and if compaint status is 0 to enable delete else to disable button --}}

                                    @if(Auth::user()->hasRole('student'))
                                    @if($complaint->status == '0')
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
                                            <i class="icon fa fa-trash"></i>
                                        </button>
                                    </form>
                                    @else
                                    <button
                                        type="button"
                                        class="btn btn-block btn-outline-danger btn-sm"
                                        disabled
                                    > <i class="icon fa fa-trash"></i>
                                    </button>
                                    @endif

                                    @else


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
                                            <i class="icon fa fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
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
