<div class="modal fade" id="details-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Store Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-row g-3" id="details">
                <input type="hidden" name="id" />
                <div class="modal-body">
                    <div class="col-12 pb-2">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" autocomplete="off" readonly>
                    </div>
                    <div class="col-12 pb-2">
                        <label class="form-label">Location</label>
                        <input type="text" class="form-control" name="location" autocomplete="off" readonly>
                    </div>
                    <div class="row">
                        <div class="col-6 pb-2">
                            <label class="form-label">Latitude</label>
                            <input type="text" class="form-control" name="latitude" autocomplete="off" readonly>
                        </div>
                        <div class="col-6 pb-2">
                            <label class="form-label">Longitude</label>
                            <input type="text" class="form-control" name="longitude" autocomplete="off" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
