@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <h2>{{str_replace(['.index','.','-'],' ', Str::ucfirst(request()->route()->getName()))}} </h2>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Department::class)
                <a
                    href="{{ route('departments.create') }}"
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
                                @lang('crud.departments.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.departments.inputs.code')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $department)
                        <tr>
                            <td>{{ $department->name ?? '-' }}</td>
                            <td>{{ $department->code ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $department)
                                    <a
                                        href="{{ route('departments.edit', $department) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-outline-primary btn-sm"
                                        >
                                            <i class="icon fas fa-edit"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $department)
                                    <a
                                        href="{{ route('departments.show', $department) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-outline-success btn-sm"
                                        >
                                            <i class="icon fa fa-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $department)
                                    <form
                                        action="{{ route('departments.destroy', $department) }}"
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
                            <td colspan="3">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">{!! $departments->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
