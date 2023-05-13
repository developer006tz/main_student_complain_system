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