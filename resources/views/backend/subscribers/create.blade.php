  <!-- SMALL MODAL -->
  <div id="addSubscriber" class="modal">
      <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title">Add Subscriber </h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form id='subscriberForm'>
                @csrf
                  <div class="modal-body">
                    <div class='row'>
                        <div class="col-12" id='errors'>

                        </div>
                    </div>
                      <div class="row">
                          <div class="col-12">
                              <label>Email</label>
                              <input class='form-control' name='email' id='email'>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                            <label>Status</label>
                            <select class='form-control' id='status' name='status'>
                                <option value='active'>Active</option>
                                <option value='pending'>Pending</option>
                                <option value='inactive'>inactive</option>
                            </select>
                        </div>
                    </div>

                  </div>
                  <div class="modal-footer justify-content-center">
                      <button type="button" class="btn btn-indigo" id='subscriberAdd'>Add</button>
                      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                  </div>
              </form>
          </div>
      </div><!-- modal-dialog -->
  </div><!-- modal -->
