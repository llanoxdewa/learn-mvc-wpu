<!-- 
Button trigger modal
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
  Add Mahasiswa 
</button>
 -->


<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="add-mhs" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="add-mhs">Update Mahasiswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= $payload['form-handler'] ?>" id="add-mahasiswa-form">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input name="name" autocomplete="off" type="text" class="form-control" id="name" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="nim" class="form-label">Nim</label>
            <input name="nim" autocomplete="off" type="text" class="form-control" id="nim">
          </div>
          <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input name="age" autocomplete="off" type="number" min="1" max="120" class="form-control" id="age">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" autocomplete="off" type="email" class="form-control" id="email">
          </div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="major-options">Major</label>
            <select name="major" class="form-select" id="major-options">
              <option value="" selected>...</option>
              <option value="Computer Science">Computer Science</option>
              <option value="Mathematics">Mathematics</option>
              <option value="Physics">Physics</option>
              <option value="Chemistry">Chemistry</option>
              <option value="Biology">Biology</option>
              <option value="Engineering">Engineering</option>
              <option value="Accounting">Accounting</option>
              <option value="Law">Law</option>
              <option value="Psychology">Psychology</option>
              <option value="Sociology">Sociology</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="add-submit-btn" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
