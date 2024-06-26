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

                <div class="mt-3 mb-3">
                    <div class="row mt-3">
                        <div class="col-2">
                          <span>Name: </span>
                        </div>
                        
                        <div class="col-10">
                          <input type="text" id="name" class="update-text">
                        </div>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-2">
                      <span>Author:</span>
                    </div>
                    
                    <div class="col-10">
                      <input type="text" id="author" class="update-text">
                    </div>
                </div>
    
                <div class="row mt-3">
                    <div class="col-2">
                      <span>Cover</span>
                    </div>
    
                    <div class="col-10">
                      <input type="text" id="cover" class="update-text">
                    </div>
                </div>

                <div class="row mt-3">
                  <div class="col-2">
                    <span>Stocks</span>
                  </div>
  
                  <div class="col-10">
                    <input type="text" id="stock" class="update-text">
                  </div>
              </div>
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="store">Save</button>
              <button type="button" class="btn btn-secondary" id="close-modal">Close</button>
            </div>
        </div>
    </div>
</div>