<div class="modal fade" tabindex="-1" role="dialog" id="update-modal">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update User Details</h5>
          </div>
        
          <div class="modal-body">
            <form action="{{ route('admin.user.update') }}" method="POST" enctype="multipart/form-data">

              {{ csrf_field() }}

              <input type="text" class="hidden" id="id" name="id">

              <div class="mt-3 mb-3">
                  <div class="row mt-3">
                      <div class="col-2">
                        <span>Name: </span>
                      </div>
                      
                      <div class="col-10">
                        <input type="text" id="name" class="update-text" name="name">
                      </div>
                  </div>
              </div>
              
              <div class="row mt-3">
                  <div class="col-2">
                    <span>Username:</span>
                  </div>
                  
                  <div class="col-10">
                    <input type="text" id="username" class="update-text" name="username">
                  </div>
              </div>
  
              <div class="row mt-3">
                  <div class="col-2">
                    <span>Email:</span>
                  </div>
  
                  <div class="col-10">
                    <input type="text" id="email" class="update-text" name="email">
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
                <button type="submit" class="btn btn-primary" id="update">Update</button>
                <button type="button" class="btn btn-secondary" id="close-modal">Close</button>
              </div>

            </form>
          </div>
          
         
      </div>
  </div>
</div>