<!-- <div class="padding"> -->
  <h2>Question has been sent 📧</h2>
  <p>Thanks you, We will get in contact with you as soon as we can!</p>
  <p>Please check that your details below are correct.</p>
  <h3>Contact detail summary:</h3>
  <ul>
    <li>Name: <?= $firstName ?> <?= $lastName ?></li>
    <li>Email: <?= $email ?></li>
    <?php if (!empty($phone)) : ?>
      <li>Phone number: <?= $phone ?></li>
    <?php endif; ?>
  </ul>
<!-- <div> -->