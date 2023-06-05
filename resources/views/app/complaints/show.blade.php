@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text">
        <h2 class="mb-2">@lang('crud.complaints.show_title')</h2>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('complaints.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
            </h4>

            {{-- table --}}
            <table class="table table-sm">
                  <thead>
                    <tr>
                        <th scope="col">Date Submitted</th>
                        <th scope="col">Status</th>
                         @can('update', $complaint)
                  @if(Auth::user()->hasAnyRole(['super-admin', 'lecturer', 'gender-desk']))
                        <th scope="col">Accept complaint</th>
                    @endif
                    @endcan
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>{{\Carbon\Carbon::parse($complaint->date)->format('Y-m-d') ?? '-' }}</td>
                        <td>
                            @if(Auth::user()->hasRole('student'))
                            {!! $complaint->status == '0' ? '<button class="btn btn-warning">pending</button>' : ($complaint->status == '1' ? '<button class="btn btn-primary">received</button>' : ($complaint->status ?? '-')) !!}
                            @else

                        {!! $complaint->status == '0' ? '<button class="btn btn-warning">pending</button>' : ($complaint->status == '1' ? '<button class="btn btn-info">in review</button>' : ($complaint->status ?? '-')) !!}
                            @endif
                        </td>
                         @can('update', $complaint)
                  @if(Auth::user()->hasAnyRole(['super-admin', 'lecturer', 'gender-desk']))
                        <td>
                            @if($complaint->status == '0')
                            <form method="POST" action="{{ route('complaint_status.update', $complaint) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <input type="hidden" name="status" value="1">
                                <button type="submit" class="btn btn-success">Accept</button>
                            </form>
                            @else
                            <button class="btn btn-success" disabled>Already Accepted</button>
                            @endif
                        </td>
                    @endif
                    @endcan
                    </tr>
                    
                  </tbody>
                </table>
            <table class="table table-bordered">
                  <thead>
                    <tr @style(['background:#003cff5e']) >
                      <th>Complain type</th>
                      <th>Student</th>
                      <th >Department</th>
                      <th >Program</th>
                        <th >Course</th>
                        <th >Lecturer</th>
                        <th >Semester</th>
                        <th >Academic year</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>{{ optional($complaint->complainType)->name ?? '-' }}</td>
                        <td>{{ optional($complaint->student)->user->name ?? '-' }}</td>
                        <td>{{ optional($complaint->department)->name ?? '-' }}</td>
                        <td>{{ optional($complaint->program)->name ?? '-' }}</td>
                        <td>{{ optional($complaint->course)->name ?? '-' }}</td>
                        <td>{{ optional($complaint->lecture)->user->name ?? '-' }}</td>
                        <td>{{ optional($complaint->semester)->name ?? '-' }}</td>
                        <td>{{ optional($complaint->academicYear)->name ?? '-' }}</td>
                    </tr>
                    
                  </tbody>
                </table>

                
            {{-- table end --}}

            <div class="mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3>@lang('crud.complaints.inputs.description')</h3>
                    </div>
                    <div class="card-body" @style(['background:#106ed821'])>
                        {!! $complaint->description ?? '-' !!}
                    </div>
                </div>
            </div>
            <div class="mt-4">
                 <div class="card">
                    <div class="card-header">
                        <h3>@lang('crud.complaints.inputs.solution')</h3>
                    </div>
                    <div class="card-body" @style(['background:#106ed821'])>
                        {!! $complaint->solution ?? '-' !!}
                    </div>
                </div>
                
            </div>

            <div class="mt-4">
                <div class="button-wrapper d-flex justify-content-between">
                    <div class="button left">
                    <a href="{{ route('complaints.index') }}" class="btn btn-outline-primary">
                                        <i class="icon ion-md-return-left"></i>
                                        @lang('crud.common.back')
                                    </a>
                    </div>
                    <div class="button right">
                        @can('create', App\Models\Complaint::class)
                <a
                    href="{{ route('complaints.create') }}"
                    class="btn btn-outline-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan

                @can('update', $complaint)
                  @if(Auth::user()->hasAnyRole(['super-admin', 'lecturer', 'gender-desk']))
                <a
                    href="{{ route('complaints.edit', $complaint) }}"
                    class="btn btn-success" 
                >


                    <i class="icon ion-md-create"></i> resolve
                </a>
                <a
                    href="{{ route('complaints.edit', $complaint) }}"
                    class="btn btn-danger" 
                >


                    <i class="icon ion-md-create"></i>reject
                </a>
                @endif
                @endcan

                    </div>
                </div>
                

                
            </div>
        </div>
    </div>
</div>
@endsection
