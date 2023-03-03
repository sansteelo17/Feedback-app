<?php include 'inc/header.php'; ?>

<?php
$name = $email = $body = '';
$nameErr = $emailErr = $bodyErr = '';

if (isset($_POST['submit'])) {
  if (empty($_POST['name'])) {
    $nameErr = 'Name is required';
  } else {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
  } else {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  }

  if (empty($_POST['body'])) {
    $bodyErr = 'Feedback is required';
  } else {
    $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  if (empty($nameErr) && empty($emailErr) && empty($bodyErr)) {

    //add to database
    $sql = "INSERT INTO feedback(name, email, body) VALUES ('$name', '$email', '$body')";

    if (mysqli_query($connection, $sql)) {
      // success
      header('Location: feedback.php');
    } else {
      echo 'Error' . mysqli_error($connection);
    }
  };
}
?>

<img src="/php-crash/feedback/img/logo.png" class="w-25 mb-3" alt="" />
<h2>Feedback</h2>
<p class="lead text-center">Leave your feedback</p>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-4 w-75" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null; ?> id=" name" name="name"
            placeholder="Enter your name" />

        <?php if ($nameErr) : ?>
        <div class="invalid-feedback">
            <?php echo $nameErr; ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null; ?>" id="email" name="email"
            placeholder="Enter your email" />

        <?php if ($emailErr) : ?>
        <div class="invalid-feedback">
            <?php echo $emailErr; ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Feedback</label>
        <textarea class="form-control <?php echo $bodyErr ? 'is-invalid' : null; ?>" id="body" name="body"
            placeholder="Enter your feedback"></textarea>
    </div>
    <div class="mb-3">
        <input type="submit" name="submit" value="Send" class="btn btn-dark w-100" />
        <?php if ($bodyErr) : ?>
        <div class="invalid-feedback">
            <?php echo $bodyErr; ?>
        </div>
        <?php endif; ?>
    </div>
</form>

<?php include 'inc/footer.php'; ?>