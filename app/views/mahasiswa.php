<!-- 
  page yang berisi data mahasiswa dan juga tempat untuk melakukan 
  mutasi data mahasiswa
-->

<?php
use App\Utils\FlashMessage;

$flash_messages = FlashMessage::show_message();

?>


<div class="container">
  
  <div id="flash-message-box" class="mt-4 container">
    <?php foreach($flash_messages as $flash_data): ?>
      <div class="alert alert-<?= $flash_data['type'] ?>" role="alert">
        <?= $flash_data['msg'] ?>
      </div>
    <?php endforeach; ?>
  </div>

  <div id="searchbar" class="input-group mb-3 mt-5">
  <form style="display: flex;flex-direction: row;" method="GET" action="/mahasiswa">
      <input name="q" type="text" class="form-control" placeholder="cari mahasiswa" aria-label="cari mahasiswa" aria-describedby="basic-addon2">
      <button class="input-group-text" id="basic-addon2">Search</button>
    </form>
  </div>

  <button id="add-btn" type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#add">
    Add Mahasiswa 
  </button>
  <ul id="list-mahasiswa" class="list-group">
    <?php foreach($payload['data-mahasiswa'] as $mhs) : ?>
      <li class="list-group-item" data-id='<?= $mhs->id ?>'>
        <p><?= $mhs->name ?></p>
        <button class='btn update btn-primary'data-bs-toggle="modal" data-bs-target="#modal-form">Update</button>
        <button class='btn delete btn-danger'>Delete</button>
      </li>
    <?php endforeach; ?>
  </ul>
</div>



