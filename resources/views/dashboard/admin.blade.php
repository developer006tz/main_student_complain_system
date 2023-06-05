<div class="row">
    @if($role=='super-admin')
    @php
    $complaints = App\Models\Complaint::count ();
    $users = App\Models\User::count ();
    $resolved = App\Models\Complaint::where('status', '4')->count ();
    $pending = App\Models\Complaint::where('status', '0')->count ();
    $failed = App\Models\Complaint::where('status', '3')->count ();
    @endphp
    @endif
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3> {{$pending}} </h3>

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
                                <h3> {{$resolved}}<sup style="font-size: 20px"></sup></h3>

                                <p>Resolved Complaints</p>
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
                                <h3> {{$users}}</h3>

                                <p>Users</p>
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
                                <h3> {{$failed}}</h3>

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