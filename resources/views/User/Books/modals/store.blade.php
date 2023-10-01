<div class="modal fade" tabindex="-1" role="dialog" id="store-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Store Book Details</h5>
            </div>
          
              <div div class="modal-body">
                  
                <div class="p-3 mb-2 bg-danger text-white hidden" id="error-message">
                    <span></span>
                </div>
                  <form action="{{ route('user.requestbook.requestABook') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="mt-3 mb-3">
                        <div class="row mt-3">
                            <div class="col-2">
                              <span>Name: </span>
                            </div>
                            <div class="col-10">
                              <input type="text" id="name" class="update-text" name="book_name">
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 mb-3">
                        <div class="row mt-3">
                            <div class="col-2">
                              <span>Author: </span>
                            </div>
                            <div class="col-10">
                              <input type="text" id="author" class="update-text" name="book_author">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-2">
                        <span>Book Cover</span>
                      </div>
      
                      <div class="col-10">
                        <input type="file" name="book_cover">
                      </div>
                    </div>

                    <div class="p-3">
                      <button type="submit" class="btn btn-success mb-3" id="store">Save</button>
                      <button type="button" class="btn btn-secondary mb-3" id="close-modal">Close</button>
                    </div>
                  </form>
              </div>
              
            </div>
          
        </div>
    </div>
</div>