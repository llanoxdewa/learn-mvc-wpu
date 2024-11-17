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
</div>

<div id="detail-container" class="container mt-5">

  <div class="card image">
    <img src='<?= $payload['images']['img_profile'] ?>' width="200" height="200"/>
  </div>
  <div class="card text">
    <p>name: <?= $payload['mhs']->name ?></p>
    <p>email: <?= $payload['mhs']->email ?></p>
    <p>major: <?= $payload['mhs']->major ?></p>
    <p>age: <?= $payload['mhs']->age ?></p>
    <div class="card buttons">
      <button data-bs-toggle="modal" data-bs-target="#modal-form" class="btn btn-primary">Update</button>
      <button class="btn btn-danger">Delete</button>
    </div>
  </div>
</div>


