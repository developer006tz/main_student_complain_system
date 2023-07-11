
                    @if(auth()->user()->hasAnyRole(['department-head','super-admin']) && ($complaint->status == 1 || $complaint->status == 3))
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