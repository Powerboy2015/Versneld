<h1>Hoi <?php echo $user->userName; ?></h1>
<p>je kan je account verifieren met de link hieronder</p>
<a href='<?php echo URLROOT . '/home/verifyUser/' . $user->wachtwoord; ?>'>Verify your account!</a>

<p>Met vriendelijke groet,</p>
<p>windschool Windkracht 12</p>