<div class="modal fade" tabindex="-1" role="dialog" id="approved-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Approved Book Details</h5>
            </div>
          
            <div class="modal-body">
                  
                <div class="p-3 mb-2 bg-danger text-white hidden" id="error-message">
                    <span></span>
                </div>
                
                <form action="{{ route('admin.requestedbooks.approveOrDisapprove') }}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                    <input type="text" name="id" id="book_id" class="hidden">
                    <input type="text" name="status" id="status" class="hidden">
                    <div class="mt-3 mb-3">
                      <div class="row mt-3">
                          <div class="col-2">
                            <span>Stock:</span>
                          </div>
                          
                          <div class="col-10">
                            <input type="text" name="stocks" class="update-text">
                          </div>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-success" id="store">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>