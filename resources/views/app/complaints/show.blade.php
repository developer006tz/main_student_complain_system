@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text h2">
                Student Complaint
            </h2>
        </div>
    </div>
    <div class="row">
          <div class="col-md-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              <span class="text-info" >Careful Examine student complaint and resolve it or transfer to top level management.</span>
               <table class="table table-borderless table-sm mt-3">
                  <thead>
                    <tr>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>Date Requested: <span class="badge badge-info"> {{\Carbon\Carbon::parse($complaint->date)->format('m/d/Y') ?? '-' }}</span></td>
                        <td>
                            Resolve status:  
                        {!! $complaint->status == '0' ? '<span class="badge badge-info">new</span>' : ($complaint->status == '1' ? '<span class="badge badge-warning">pending</span>' : ($complaint->status == '2' ? '<span class="badge badge-success">resolved</span>' :($complaint->status == '4' ? '<span class="badge badge-danger">rejected</span>' : '<span class="badge badge-secondary">transfered</span>') )) !!}
                            
                        </td>
                         @can('update', $complaint)
                  @if(Auth::user()->hasAnyRole(['super-admin', 'lecturer', 'gender-desk']))
                  {{dd('yes')}}
                        <td>
                            @if($complaint->status == '0')
                            <form method="POST" action="{{ route('complaint_status.update', $complaint) }}"  class="form-horizontal">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <input type="hidden" name="status" value="1">
                                <button type="submit" class="btn btn-warning">Accept</button>
                            </form>
                            @else
                            <button class="btn btn-success" disabled>Already Accepted</button>
                            @endif
                        </td>
                    @else
                    {{dd('no')}}
                    @endif
                    @endcan
                    </tr>
                    
                  </tbody>
                </table>
            </div>
          </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3 col-md-12" id="printable_div">
              <!-- title row -->
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <h4 class="text-center">
                    <img src="{{asset('logo.png')}}" width="120" alt="">
                  </h4>
                </div>
              </div>
              <div class="row">
                <div class="col-12  d-flex flex-column align-items-center justify-content-between">
                  <h4 class="text h4 text-bold">
                    NATIONAL INSTITUTE OF TRANSPORT (NIT)
                  </h4>
                  <h4 class="text text-bold h4">
                    DEPARTMENT OF {{ optional($complaint->department)->name  ?? '-' }}
                  </h4>
                  <p class="h4" class="text text-bold h4">
                    STUDENT COMPLAINT FORM
                  </p>
                </div>
              </div>
              <div class="row invoice-info d-flex flex-row justify-content-between my-4">
                <style>
                    .clear-student-list{
                        list-style: none;
                    }
                    #printable_div{
                        font-family: Georgia, 'Times New Roman', Times, serif;
                    }
                </style>
                <div class="col-sm-8">
                  <ul class="clear-form-student-info">
                    <li class="mb-1 clear-student-list" ><strong class="p-2">Student Name: </strong> <span>{{ optional($complaint->student)->user->name ?? '-' }}</span></li>
                    <li class="mb-1 clear-student-list" ><strong class="p-2">Reg Number: </strong><span>{{ $complaint->student->admission_id ?? '-' }}</span></li>
                    <li class="mb-1 clear-student-list" ><strong class="p-2">Student Programme: </strong> <span>{{ optional($complaint->student)->program->name ?? '-' }}</span> </li>
                    <li class="mb-1 clear-student-list" ><strong class="p-2">Level: </strong> <span>{{ optional($complaint->student)->program->ntaLevel->name ?? '-' }}</span> </li>
                  </ul>
                </div>
                <div class="col-sm-4">
                  <img src="{{ $complaint->student->user->image ? url(\Storage::url($complaint->student->user->image)) : asset('default.png') }}" width="132" height="132" style="margin-left: 120px; margin-top:-20px;" alt="{{$complaint->student->user->name}}">
                </div>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-sm-11">
                    <p class="h5 mb-3">COMPLAINT DETAILS</p>
                </div>
              </div>
              
              <div class="row d-flex justify-content-center">
                <div class="col-md-11 table-responsive">
                  <table class="table  table-bordered">
                    <thead>
                    <tr>
                      <th>LECTURE NAME</th>
                      <th>{{ optional($complaint->lecture)->user->name ?? '-' }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Complaint type</td>
                        <td>{{ optional($complaint->complainType)->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>COMPLAINED DEPARTMENT</td>
                           <td>{{ optional($complaint->department)->name ?? '-' }}</td> 
                        </tr>
                        <tr>
                            <td>COMPLAINED COURSE</td>
                          <td>{{ optional($complaint->course)->name ?? '-' }}</td>  
                        </tr>
                        <tr>
                            <td>SEMESTER</td>
                           <td>{{ optional($complaint->semester)->name ?? '-' }}</td> 
                        </tr>
                        <tr>
                            <td>ACADEMIC YEAR</td>
                            <td>{{ optional($complaint->academicYear)->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>DATE REQUESTED</td>
                            <td>{{\Carbon\Carbon::parse($complaint->date)->format('d/m/Y') ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td >COMPLAINT DESCRIPTION</td>
                            <td @style(['background:#4b4b4b21','border-bottom:2px solid white'])><div class="mt-4">
                                            {!! $complaint->description ?? '-' !!}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td >SUGGESTED SOLUTION</td>
                            <td @style(['background:#4b4b4b21'])>
                                <div class="mt-4" >
                                        {!! $complaint->solution ?? '-' !!}
                                
                            </div>
                            </td>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="row d-flex justify-content-center">
                <div class="col-6">
                  <p>
                    <strong>Resolve Status: </strong>
                    @if($complaint->status == 2)
                    <span class="badge badge-success">resolved</span>
                    <span class="">Remark: <u class="badge badge-info">{{$complaint->resolves->first()->remark ?? '-'}}</u> </span>
                    @elseif($complaint->status == 4)
                    <span class="badge badge-danger">Rejected</span>
                    <span class="">Reason: <u class="badge badge-info">{{$complaint->resolves->first()->remark ?? '-'}}</u> </span>
                    @endif
                  </p>
                </div>
                <div class="col-5">
                    @if(auth()->user()->hasRole('lecturer') && !auth()->user()->hasRole('department-head') && $complaint->status == 1 && $complaint->status != 3)
                    <form action="{{ route('complaint_status.resolve', $complaint) }}" class="no_print" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="complaint_id" value="{{$complaint->id}}" >
                    <input type="hidden" name="lecture_id" value="{{$complaint->lecture->id}}" >
                    <input type="hidden" name="user_id" value="{{$complaint->lecture->user->id}}" >
                  <div class="row">
                    <div class="col-sm-6">
                       <div class="form-group">
                    <label>Resolve</label>
                        <select name="resolve_status" class="form-control" style="width: 100%;">
                            <option value="2">Resolve</option>
                            <option value="3">Transfer</option>
                            <option value="4">Reject</option>
                    </select>
                    </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Remark</label>
                        <textarea name="remark" class="form-control" rows="3" placeholder="Enter Remark">
                           
                        </textarea>
                      </div>
                    </div>
                    <div class="no_print col-sm-6 d-flex justify-content-end align-items-end">
                      <div class="form-group">
                        <button type="submit" class="btn btn-danger" >submit</button>
                      </div>
                    </div>
                  </div>
                
                </form>
                @endif
                @include('app.complaints.department-head-clear')

                </div>
              </div>
              <div class="row no-print">
                <div class="col-12">
                  <button type="button" class="no_print btn btn-primary float-left" id="print_button" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Download Pdf
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
        </div>
</div>
@push('scripts')
 <script>
   $(document).ready(function() {
      $('#print_button').click(function() {
        var printContents = $('#printable_div').clone();
        printContents.find('.no_print').remove();

        var originalContents = $('body').html();

        $('body').empty().append(printContents);
        window.print();
        $('body').html(originalContents);
      });
    });
  </script>
  @endpush
@endsection

