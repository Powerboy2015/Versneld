<h1>Hoi <?php echo $user->userName; ?></h1>
<p>You can verify your account using the link below</p>
<a href='<?php echo URLROOT . '/home/verifyUser/' . $user->wachtwoord; ?>'>Verify your account!</a>

<p>Sincerely,</p>
<p>windschool Windkracht 12</p>