<!-- 
Button trigger modal
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
  Add Mahasiswa 
</button>
 -->

<?php

$major_options = [
    "Computer Science",
    "Mathematics",
    "Physics",
    "Chemistry",
    "Biology",
    "Engineering",
    "Accounting",
    "Law",
    "Psychology",
    "Sociology"
];


$default_values = [
  'name' => '',
  'nim' => '',
  'major' => '',
  'age' => '',
  'email' => ''
];

if(isset($payload['mhs'])){
  $mhs = $payload['mhs'];

  $default_values['name']   = $mhs->name;
  $default_values['nim']    = $mhs->nim;
  $default_values['age']    = $mhs->age;
  $default_values['major']  = $mhs->major;
  $default_values['email']  = $mhs->email;
};


?>

<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="add-mhs" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="add-mhs">New Mahasiswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= $payload['form-handler'] ?>" id="mahasiswa-form">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input value="<?= $default_values['name']?>" name="name" autocomplete="off" type="text" class="form-control" id="name" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="nim" class="form-label">Nim</label>
            <input value="<?= $default_values['nim']?>" name="nim" autocomplete="off" type="text" class="form-control" id="nim">
          </div>
          <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input value="<?= $default_values['age']?>"  name="age" autocomplete="off" type="number" min="1" max="120" class="form-control" id="age">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input value="<?= $default_values['email']?>" name="email" autocomplete="off" type="email" class="form-control" id="email">
          </div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="major-options">Major</label>
            <select name="major" class="form-select" id="major-options">
              <?php if($default_values['major'] === ''): ?>
                <option id="default-options" value="" selected>...</option>    
              <?php endif; ?>
              <?php foreach($major_options as $mj): ?>
                <?php if($mj === $default_values['major']): ?>
                  <option value="<?= $mj?>" selected><?= $mj ?></option>
                <?php else: ?>
                  <option value="<?= $mj?>"><?= $mj ?></option>
                <?php endif; ?>
              <?php endforeach ; ?>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="submit-btn" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

<script defer>
  const submitBtn = document.getElementById('submit-btn');
  const form = document.getElementById('mahasiswa-form');
  submitBtn.addEventListener('click',() => {
    form.submit();
  });
</script>

