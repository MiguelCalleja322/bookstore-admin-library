<div class="modal fade" id="import-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.book.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="csv_file">
                    <button type="submit" class="btn btn-primary">Import CSV</button>
                </form>
            </div>
        </div>
    </div>
</div>