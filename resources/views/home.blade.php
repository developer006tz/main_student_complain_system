@extends('layouts.app')

@section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) SUPER ADMIN-->
                @if($role=='super-admin')
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>150</h3>

                                <p>New Complaints</p>
                            </div>
                            <div class="icon">
                                <i class="icon ion-md-archive"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>

                                <p>Completed Complaints</p>
                            </div>
                            <div class="icon">
                                <i class="icon ion-md-checkmark-circle"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>

                                <p>All Users</p>
                            </div>
                            <div class="icon">
                                <i class="icon ion-md-people"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Failed Complaints</p>
                            </div>
                            <div class="icon">
                                <i class=" icon ion-md-alert"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                @endif

                @if($role=='user')
                    <div class="row">
                        <div class="col-lg-5 col-6">
                        <!-- small box -->
                        <div class="small-box bg-grey">
                            <div class="inner">
                                <h3>WELCOME</h3>

                                <b>{{Auth::user()->name}}</b>
                            </div>
                            <div class="icon">
                                <i class=" icon ion-person-outline"></i>
                            </div>
                            <div class="p-3 my-3">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>Profile complete 40%</h3>

                                <p>Please complete profile to proceed</p>
                            </div>
                            <div class="icon">
                                <i class=" icon ion-ios-create"></i>
                            </div>
                            <a href="{{url("users/$user->id/edit")}}" class="small-box-footer">complete profile <i class="icon ion-md-arrow-forward text-bold text-white"></i></a>
                        </div>
                    </div>
                      
                        <!-- ./col -->
                    </div>
                @endif
                @if($role=='student')

                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>100%</h3>

                                <p>Profile</p>
                            </div>
                            <div class="icon">
                                <i class="icon ion-md-archive"></i>
                            </div>
                            <a href="#" class="small-box-footer">view your profile<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>3<sup style="font-size: 20px"></sup></h3>

                                <p>Total complaints</p>
                            </div>
                            <div class="icon">
                                <i class="icon ion-md-checkmark-circle"></i>
                            </div>
                            <a href="#" class="small-box-footer">view<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>0</h3>

                                <p>Resolved</p>
                            </div>
                            <div class="icon">
                                <i class="icon ion-md-people"></i>
                            </div>
                            <a href="#" class="small-box-footer">view <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>3</h3>

                                <p>Failed</p>
                            </div>
                            <div class="icon">
                                <i class="icon ion-md-people"></i>
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
                  <tr role="row"><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Complain type</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Description</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Solution</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">date submitted</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Status</th></tr>
                  </thead>
                  <tbody>
                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                    <td>Firefox 1.0</td>
                    <td>Win 98+ / OSX.2+</td>
                    <td>1.7</td>
                    <td>A</td>
                  </tr><tr class="even">
                    <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                    <td>Firefox 1.5</td>
                    <td>Win 98+ / OSX.2+</td>
                    <td>1.8</td>
                    <td>A</td>
                  </tr><tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                    <td>Firefox 2.0</td>
                    <td>Win 98+ / OSX.2+</td>
                    <td>1.8</td>
                    <td>A</td>
                  </tr><tr class="even">
                    <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                    <td>Firefox 3.0</td>
                    <td>Win 2k+ / OSX.3+</td>
                    <td>1.9</td>
                    <td>A</td>
                  </tr><tr class="odd">
                    <td class="sorting_1 dtr-control">Gecko</td>
                    <td>Camino 1.0</td>
                    <td>OSX.2+</td>
                    <td>1.8</td>
                    <td>A</td>
                  </tr><tr class="even">
                    <td class="sorting_1 dtr-control">Gecko</td>
                    <td>Camino 1.5</td>
                    <td>OSX.3+</td>
                    <td>1.8</td>
                    <td>A</td>
                  </tr></tbody>
                  <tfoot>
                  <tr><th rowspan="1" colspan="1">Complain type</th><th rowspan="1" colspan="1">Description</th><th rowspan="1" colspan="1">Solution</th><th rowspan="1" colspan="1">Date</th><th rowspan="1" colspan="1">Status</th></tr>
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
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                    $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    });
                });
                </script>
            @endpush

                @endif

                <!-- /.row -->
                <!-- Main row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

@endsection
