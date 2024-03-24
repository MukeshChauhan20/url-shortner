
<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="create-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Url</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('url.store') }}" method="post" id="frmShortner">
            <div class="modal-body">
                <div class="alert alert-danger" role="alert" style="display:none">
                    A simple danger alert—check it out!
                  </div>
                <label for="url" class="form-label">Enter URL:</label>
                <input type="text" class="form-control" name="url" id="url" required>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="status" id="status" value="">
                    <label class="form-check-label" for="status">
                      Status
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary create-url">Create</button>
            </div>
        </form>
      </div>
    </div>
  </div>