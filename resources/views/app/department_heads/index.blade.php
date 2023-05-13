@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <h2>{{str_replace(['.index','.','-'],' ', Str::ucfirst(request()->route()->getName()))}} </h2>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\DepartmentHead::class)
                <a
                    href="{{ route('department-heads.create') }}"
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
                                @lang('crud.department_heads.inputs.user_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.department_heads.inputs.department_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departmentHeads as $departmentHead)
                        <tr>
                            <td>
                                {{ optional($departmentHead->user)->name ?? '-'
                                }}
                            </td>
                            <td>
                                {{ optional($departmentHead->department)->name
                                ?? '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $departmentHead)
                                    <a
                                        href="{{ route('department-heads.edit', $departmentHead) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-outline-primary btn-sm"
                                        >
                                            <i class="icon fas fa-edit"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $departmentHead)
                                    <a
                                        href="{{ route('department-heads.show', $departmentHead) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-outline-success btn-sm"
                                        >
                                            <i class="icon fa fa-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $departmentHead)
                                    <form
                                        action="{{ route('department-heads.destroy', $departmentHead) }}"
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
                            <td colspan="3">
                                {!! $departmentHeads->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
