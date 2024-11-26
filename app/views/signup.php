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

<div id="signup-form-container" class="container">
  <form method="post" action="<?= $payload['signup-handler']?>">
    <div class="mb-3">
      <label for="usernaem" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username" autocomplete="off">
    </div>
    <div class="mb-3 position-relative">
      <label for="password" class="form-label" autocomplete="off">Password</label>
      <input type="password" class="form-control float-right" id="password" name="password">
    </div>
    <div class="mb-3 position-relative">
      <label for="email" class="form-label" autocomplete="off">Email</label>
      <input type="email" class="form-control float-right" id="email" name="email">
    </div>
    <button type="submit" class="btn btn-primary">Signup</button>
  </form>
</div>




