@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <h2>{{str_replace(['.index','.','-'],' ', Str::ucfirst(request()->route()->getName()))}} </h2>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Semester::class)
                <a
                    href="{{ route('semesters.create') }}"
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
                                @lang('crud.semesters.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.semesters.inputs.start_date')
                            </th>
                            <th class="text-left">
                                @lang('crud.semesters.inputs.end_date')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($semesters as $semester)
                        <tr>
                            <td>{{ $semester->name ?? '-' }}</td>
                            <td>{{ $semester->start_date ?? '-' }}</td>
                            <td>{{ $semester->end_date ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $semester)
                                    <a
                                        href="{{ route('semesters.edit', $semester) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-outline-primary btn-sm"
                                        >
                                            <i class="icon fas fa-edit"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $semester)
                                    <a
                                        href="{{ route('semesters.show', $semester) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-outline-success btn-sm"
                                        >
                                            <i class="icon fa fa-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $semester)
                                    <form
                                        action="{{ route('semesters.destroy', $semester) }}"
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
                            <td colspan="4">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">{!! $semesters->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
