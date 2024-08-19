

<!-- Modal Create Point -->
<div class="modal fade" id="createpointModal" tabindex="-1" aria-labelledby="createpointModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createpointModalLabel"><i class="bi bi-geo-alt-fill"></i> Create Point</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('create-point') }}" method="Post">
          <?= csrf_field(); ?>
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Fill in the name" required>
          </div>
          <div class="mb-3">
            <label for="geometry-point" class="form-label">Geometry WKT</label>
            <textarea class="form-control" id="geometry-point" name="geometry-point" rows="3" ></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill"></i> Close</button>
        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Create Polyline -->
<div class="modal fade" id="createpolylineModal" tabindex="-1" aria-labelledby="createpolylineModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createpolylineModalLabel"><i class="bi bi-slash-lg"></i> Create Polyline</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('create-polyline') }}" method="Post">
          <?= csrf_field(); ?>
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Fill in the name" required>
          </div>
          <div class="mb-3">
            <label for="geometry-polyline" class="form-label">Geometry WKT</label>
            <textarea class="form-control" id="geometry-polyline" name="geometry-polyline" rows="3" ></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill"></i> Close</button>
        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Create Polygon -->
<div class="modal fade" id="createpolygonModal" tabindex="-1" aria-labelledby="createpolygonModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createpolygonModalLabel"><i class="bi bi-pentagon-fill"></i> Create Polygon</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('create-polygon') }}" method="Post">
          <?= csrf_field(); ?>
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Fill in the name" required>
          </div>
          <div class="mb-3">
            <label for="geometry-polygon" class="form-label">Geometry WKT</label>
            <textarea class="form-control" id="geometry-polygon" name="geometry-polygon" rows="3" ></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill"></i> Close</button>
        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Point -->
<div class="modal fade" id="editpointModal" tabindex="-1" aria-labelledby="editpointModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editpointModalLabel"><i class="bi bi-geo-alt-fill"></i> Edit Point</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="Post" id="form-update-point">
          <?= csrf_field(); ?>
          <input type="hidden" name="_method" value="PUT">
          <div class="mb-3">
            <label for="name-edit-point" class="form-label">Name</label>
            <input type="text" class="form-control" id="name-edit-point" name="name-edit-point" placeholder="Fill in the name" required>
          </div>
          <div class="mb-3">
            <label for="geometry-edit-point" class="form-label">Geometry WKT</label>
            <textarea class="form-control" id="geometry-edit-point" name="geometry-edit-point" rows="3" ></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill"></i> Close</button>
        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Polyline -->
<div class="modal fade" id="editpolylineModal" tabindex="-1" aria-labelledby="editpolylineModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editpolylineModalLabel"><i class="bi bi-geo-alt-fill"></i> Edit Polyline</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="Post" id="form-update-polyline">
          <?= csrf_field(); ?>
          <input type="hidden" name="_method" value="PUT">
          <div class="mb-3">
            <label for="name-edit-polyline" class="form-label">Name</label>
            <input type="text" class="form-control" id="name-edit-polyline" name="name-edit-polyline" placeholder="Fill in the name" required>
          </div>
          <div class="mb-3">
            <label for="geometry-edit-polyline" class="form-label">Geometry WKT</label>
            <textarea class="form-control" id="geometry-edit-polyline" name="geometry-edit-polyline" rows="3" ></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill"></i> Close</button>
        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Polygon -->
<div class="modal fade" id="editpolygonModal" tabindex="-1" aria-labelledby="editpolygonModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editpolygonModalLabel"><i class="bi bi-geo-alt-fill"></i> Edit Polygon</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="Post" id="form-update-polygon">
          <?= csrf_field(); ?>
          <input type="hidden" name="_method" value="PUT">
          <div class="mb-3">
            <label for="name-edit-polygon" class="form-label">Name</label>
            <input type="text" class="form-control" id="name-edit-polygon" name="name-edit-polygon" placeholder="Fill in the name" required>
          </div>
          <div class="mb-3">
            <label for="geometry-edit-polygon" class="form-label">Geometry WKT</label>
            <textarea class="form-control" id="geometry-edit-polygon" name="geometry-edit-polygon" rows="3" ></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill"></i> Close</button>
        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> Save</button>
        </form>
      </div>
    </div>
  </div>
</div>