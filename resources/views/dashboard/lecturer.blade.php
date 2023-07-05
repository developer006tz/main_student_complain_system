{{-- lecturer dashboard in student complaint system --}}
 @empty($user->lecture)
                    <div class="row justify-content-center">
                        <div class="col-11 text-center p-0 mt-3 mb-2">
                            <div class="card px-0 pt-4 pb-0 mt-3 mb-3 text-success">
                                <h2 id="heading">Welcome {{Auth::user()->getRoleNames()[0]}} {{Auth::user()->name}}</h2>
                                <p>Congratulation's, You are 1 step  to Finish your Registration</p>

                                <form id="msform">
                                    <!-- progressbar -->
                                    <ul id="progressbar">
                                        <li class="active" id="account"><strong>Register</strong></li>
                                        <li class="active" id="personal"><strong>Choose Role</strong></li>
                                        <li id="payment"><strong>Fill {{Auth::user()->getRoleNames()[0]}} Info's</strong></li>
                                        <li id="confirm"><strong>Finish</strong></li>
                                    </ul>
                                    <br>
                                    <!-- fieldsets -->
                                    <fieldset class="d-flex justify-content-center">
                                        <a href="{{url('lectures/create')}}"  name="next" class="next action-button">Next</a>
                                    </fieldset>
                                    
                                
                                </form>
                            </div>
                        </div>
                    </div>

                @push('scripts')
              <script src="{{asset('custom_js/wizard.js')}}"></script>
            @endpush
                    @endempty
                    {{-- //WHEN LECTURE REGISTRATION IS COMPLETE  --}}
                    @isset($user->lecture)
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
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{$complaints->count() ?? '-'}}<sup style="font-size: 20px"></sup></h3>

                                <p>Total complaints received</p>
                            </div>
                            
                            <div class="icon">
                                <i class="fa-sharp fa fa-folder-open"></i>
                            </div>
                            
                            <a href="#" class="small-box-footer">view<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$complaints->where('status','2')->count()}}</h3>

                                <p>Resolved</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <a href="#" class="small-box-footer">view <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$complaints->where('status','3')->count()}}</h3>
                                <p>Transfered</p>
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
                {{-- <div class="row d-flex justify-content-end my-2">
                    <a href="{{url("complaints/create")}}" class="btn btn-primary">create new complaint</a>
                </div> --}}
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
                            Solution
                            </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                            date submitted
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
                    @forelse($complaints as $complaint)

                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">{{ optional($complaint->complainType)->name ??
                                '-' }}</td>
                    <td>{!! Str::limit(strip_tags($complaint->description),100) ?? '-' !!}</td>
                    <td>{!! Str::limit(strip_tags($complaint->solution),100) ?? '-' !!}</td>
                    <td>{{ \Carbon\Carbon::parse($complaint->date)->format('d/m/Y') ?? '-' }}</td>
                    <td>
    {!! $complaint->status == '0' ? '<span class="badge badge-warning">new</span>' : ($complaint->status == '1' ? '<span class="badge badge-info">pending</span>' : ($complaint->status == '2' ? '<span class="badge badge-success">resolved</span>' : '<span class="badge badge-secondary">transfered</span>')) !!}
</td>
<td>
                    <a href="{{ route('complaints.show', $complaint) }}">view</a>
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
                    @endisset
                
                
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