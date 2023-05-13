<div class="row">
          <div class="col-md-3">
            <a href="{{url('messages')}}" class="btn btn-primary btn-block mb-3">Back to Inbox</a>

             <div class="card">
            <div class="card-header">
              <h3 class="card-title">Messages</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <a href="#" class="nav-link">
                    <i class="icon ion-ios-chatbubbles"></i> new
                    <span class="badge bg-primary float-right">1</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                     <i class="fas fa-inbox"></i> Inbox
                      <span class="badge bg-secondary float-right">12</span>
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Read Message</h3>

              <div class="card-tools">
                <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
                <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h6>From: {{ $message->sender_name ?? '-' }}
                  <span class="mailbox-read-time float-right">{{$message->created_at ?? '-'}}</span></h6>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message" style="background:#00dfff1f;">
                {!! $message->body ?? '-' !!}
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            
            <!-- /.card-footer -->
            <div class="card-footer">
              <div class="float-right">
                <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
                <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
              </div>
              <button type="button" class="btn btn-default bg-danger"><i class="far fa-trash-alt "></i> Delete</button>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>