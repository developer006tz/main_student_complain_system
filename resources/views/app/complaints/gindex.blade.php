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
                    href="{{ route('gender-complaints.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> submit new
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
                                Complain Title
                            </th>
                            <th class="text-left">
                                Complaint Description
                            </th>
                            <th class="text-left">
                               student Name
                            </th>
                            <th class="text-left">
                               Student Reg number
                            </th>
                            <th class="text-left">
                                Date submited
                            </th>
                            <th class="text-left">
                                status
                            </th>
                            <th class="text-center">
                                Resolve
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $complaint)
                        <tr>
                            <td>
                                {{ $complaint->title ??
                                '-' }}
                            </td>
                            <td>
                                {{ Str::limit(strip_tags($complaint->description),100) ?? '-' }}
                            </td>
                            <td>
                                {{ $complaint->user->name ?? '-'
                                }}
                            </td>
                            <td>
                                {{ $complaint->student->admission_id ?? '-' }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($complaint->date)->format('d/m/Y') ?? '-' }}
                            </td>
                            <td style="width: 134px;">
                                    @if(Auth::user()->hasRole('student'))
                                    {!! $complaint->status == '0' ? '<span class="badge badge-info">new</span>' : ($complaint->status == '1' ? '<span class="badge badge-warning">pending</span>' : ($complaint->status == '2' ? '<span class="badge badge-success">resolved</span>' :($complaint->status == '4' ? '<span class="badge badge-danger">rejected</span>' : '<span class="badge badge-secondary">transfered</span>') )) !!}                            @else

                                    {!! $complaint->status == '0' ? '<span class="badge badge-info">new</span>' : ($complaint->status == '1' ? '<span class="badge badge-warning">pending</span>' : ($complaint->status == '2' ? '<span class="badge badge-success">resolved</span>' :($complaint->status == '4' ? '<span class="badge badge-danger">rejected</span>' : '<span class="badge badge-secondary">transfered</span>') )) !!}                            @endif
                            </td>

                            <td class="text-center" style="width: 134px;">
                                @if(Auth::user()->hasRole('gender-desk'))
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                
                                    <a
                                        href="{{ route('complaints.resolve', $complaint) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-success btn-sm mx-3"
                                        >
                                            resolve
                                        </button>
                                    </a>
                                    
                                    
                                    <a href="{{ route('complaints.reject', $complaint) }}"  >
                                        <button type="button" class="btn btn-danger btn-sm" >
                                            reject
                                        </button>
                                    </a>
                                    
                                     
                                </div>
                                @endif
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
