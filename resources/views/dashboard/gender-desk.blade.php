
                    {{-- //WHEN LECTURE REGISTRATION IS COMPLETE  --}}
                    @if(Auth::user()->hasRole('gender-desk'))
                    <div class="row mb-3">
                        <div class="col-sm-12 d-flex justify-content-end">
                            Welcome <span class="badge badge-success ml-2" > {{Auth::user()->name}} </span> <span class="badge badge-primary ml-2">
                                @forelse ($user->roles as $role)
                                {{ $role->name }},
                                @empty - @endforelse
                            </span>
                        </div>
                    </div>
                    
                        <div class="row">

                            @php 

                            $genderComplaints = \App\Models\GenderComplaints::all();

                            $resolved = $genderComplaints->where('status',2);
                            $rejected = $genderComplaints->where('status',4);

                            @endphp

                             
                        <div class="col-lg-4 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{$resolved->count() ?? '-'}}<sup style="font-size: 20px"></sup></h3>

                                <p>All Resolved Complaint</p>
                            </div>
                            
                            <div class="icon">
                                <i class="fa-sharp fa fa-folder-open"></i>
                            </div>
                            
                            <a href="#" class="small-box-footer">view<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{$genderComplaints->count() ?? '-'}}<sup style="font-size: 20px"></sup></h3>

                                <p>Total Gender Complaints</p>
                            </div>
                            
                            <div class="icon">
                                <i class="fa-sharp fa fa-folder-open"></i>
                            </div>
                            
                            <a href="#" class="small-box-footer">view<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$rejected->count()}}</h3>
                                <p>Rejected</p>
                            </div>
                            <div class="icon">
                               <i class="fas fa-file-excel"></i>
                            </div>
                            <a href="#" class="small-box-footer">view<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Previous complaints</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="student_complaints_summary" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                  <thead>
                  <tr role="row">
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                        Complain type
                    </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                            Description
                            </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                            Student Reg Number
                            </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                            Date submited
                            </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                            Status
                            </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                        view
                        </th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($genderComplaints as $complaint)

                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">{{$complaint->title ??
                                '-' }}</td>
                    <td>{!! Str::limit(strip_tags($complaint->description),100) ?? '-' !!}</td>
                    <td>{!! Str::limit(strip_tags($complaint->user->name),100) ?? '-' !!}</td>
                    <td>{{ \Carbon\Carbon::parse($complaint->created_at)->format('d/m/Y') ?? '-' }}</td>
                    <td>
                    {!! $complaint->status == '0' ? '<span class="badge badge-info">new</span>' : ($complaint->status == '1' ? '<span class="badge badge-warning">pending</span>' : ($complaint->status == '2' ? '<span class="badge badge-success">resolved</span>' :($complaint->status == '4' ? '<span class="badge badge-danger">rejected</span>' : '<span class="badge badge-secondary">transfered</span>') )) !!}</td>
                    <td>
                    <a href="{{ route('gender-complaints.list') }}">view</a>
                  </td>
                  
                </tr>
                  
                   @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                </tbody>
                  <tfoot>
                  </tfoot>
                </table></div></div></div>
              </div>
              <!-- /.card-body -->
            </div>
                    </div>
                </div>
                
                
                @push('scripts')
                <script>
                $(function () {
                    $("#student_complaints_summary").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["colvis"]
                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                });
                </script>
            @endpush

            @endif