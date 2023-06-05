<div class="row">
        <div class="col-md-3">
          <a href="{{route('messages.create')}}" class="btn btn-primary btn-block mb-3">Compose</a>

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
                    <i class="fas fa-inbox"></i> new
                    <span class="badge bg-primary float-right">{{count($messages)}}</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('messages.index')}}" class="nav-link">
                     <i class="fas fa-inbox"></i> Inbox
                     <span class="badge bg-secondary float-right">{{count($messages)}}</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('sent_messages.show')}}" class="nav-link">
                     <i class="fas fa-inbox"></i> Sent
                     <span class="badge bg-secondary float-right">{{count($sentMessages)}}</span>
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"> @if(request()->routeIs('sent_messages.show')) {{__('Sent messages')}} @else {{__('Inbox')}} @endif   </h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="Search Mail">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-reply"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-share"></i>
                  </button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-sync-alt"></i>
                </button>
                <div class="float-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm">
                      <i class="fas fa-chevron-left"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-sm">
                      <i class="fas fa-chevron-right"></i>
                    </button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                 <tbody>
  @empty($showSentMessages)
    @forelse($messages as $message)
      <tr>
        <td>
          <div class="icheck-primary">
            <input type="checkbox" value="" id="check1">
            <label for="check1"></label>
          </div>
        </td>
        <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>
        <td class="mailbox-name"><a href="{{ url("messages/$message->id") }}">{{ optional($message->user)->name ?? '-' }}</a></td>
        <td class="mailbox-subject"><b>{{ $message->phone ?? '-' }}</b> - {{ $message->body ?? '-' }}</td>
        <td class="mailbox-attachment"></td>
        <td class="mailbox-date">{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</td>
      </tr>
    @empty
      <tr>
        <td colspan="6">
          @lang('crud.common.no_items_found')
        </td>
      </tr>
    @endforelse
  @else
    @isset($showSentMessages)
      @forelse($showSentMessages as $message)
        <tr>
          <td>
            <div class="icheck-primary">
              <input type="checkbox" value="" id="check1">
              <label for="check1"></label>
            </div>
          </td>
          <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>
          <td class="mailbox-name"><a href="{{ url("messages/$message->id") }}">{{ optional($message->user)->name ?? '-' }}</a></td>
          <td class="mailbox-subject"><b>{{ $message->phone ?? '-' }}</b> - {{ $message->body ?? '-' }}</td>
          <td class="mailbox-attachment"></td>
          <td class="mailbox-date">{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="6">
            @lang('crud.common.no_items_found')
          </td>
        </tr>
      @endforelse
    @endisset
  @endempty
</tbody>

                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                  <i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-reply"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-share"></i>
                  </button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-sync-alt"></i>
                </button>
                <div class="float-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm">
                      <i class="fas fa-chevron-left"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-sm">
                      <i class="fas fa-chevron-right"></i>
                    </button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
         @push('scripts')
    <script>
  $(function () {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })

    //Handle starring for font awesome
    $('.mailbox-star').click(function (e) {
      e.preventDefault()
      //detect type
      var $this = $(this).find('a > i')
      var fa    = $this.hasClass('fa')

      //Switch states
      if (fa) {
        $this.toggleClass('fa-star')
        $this.toggleClass('fa-star-o')
      }
    })
  })
</script>
    @endpush
        <!-- /.col -->
      </div>