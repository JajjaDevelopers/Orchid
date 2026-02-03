<div class="modal-content" id='content'>
    <div class="modal-header">
        <h6 class="modal-title">Edit Subscriber </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form id="subscriberFormUpdate" action="{{ route('admin.subscriber.update', ['id' => $subscriber->id]) }}">
        @csrf
        <div class="modal-body">
            <div class='row'>
                <div class="col-12" id='errors'>

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Email</label>
                    <input class='form-control' value="{{ $subscriber->email }}" name='email' id='email'>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Status</label>
                    <select class='form-control' id='status' name='status'>
                        <option value="active" @selected($subscriber->status == 'active')>Active</option>
                        <option value="pending" @selected($subscriber->status == 'pending')>Pending</option>
                        <option value="inactive" @selected($subscriber->status == 'inactive')>Inactive</option>
                        <option value="unsubscribed" @selected($subscriber->status == 'unsubscribed')>Unsubscribed</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-indigo" id='subscriberUpdate'>Update</button>
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>
