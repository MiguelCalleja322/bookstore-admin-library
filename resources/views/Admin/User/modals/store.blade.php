<div class="modal fade" tabindex="-1" role="dialog" id="store-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Store Book Details</h5>
            </div>
          
            <div class="modal-body">
                  
                <div class="p-3 mb-2 bg-danger text-white hidden" id="error-message">
                    <span></span>
                </div>
                
                <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}

                    <div class="mt-3 mb-3">
                      <div class="row mt-3">
                          <div class="col-2">
                            <span>Name:</span>
                          </div>
                          
                          <div class="col-10">
                            <input type="text" name="name" class="update-text">
                          </div>
                      </div>
                    </div>

                    <div class="mt-3 mb-3">
                      <div class="row mt-3">
                          <div class="col-2">
                            <span>Username:</span>
                          </div>
                          
                          <div class="col-10">
                            <input type="text" name="username" class="update-text">
                          </div>
                      </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-2">
                          <span>Email:</span>
                        </div>
                        
                        <div class="col-10">
                          <input type="email" name="email" class="update-text">
                        </div>
                    </div>
        
                    <div class="row mt-3">
                        <div class="col-2">
                          <span>Password</span>
                        </div>
        
                        <div class="col-10">
                          <input type="password" name="password" class="update-text">
                        </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-2">
                        <span>Profile Picture</span>
                      </div>
      
                      <div class="col-10">
                        <input type="file" name="profile_pic">
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success" id="store">Save</button>
                      <button type="button" class="btn btn-secondary" id="close-modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>