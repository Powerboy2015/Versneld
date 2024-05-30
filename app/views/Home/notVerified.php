<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/notVerified.css">
    <title>Document</title>
</head>

<body>
    <header>
        <?php require_once APPROOT . '/views/components/header.php' ?>
    </header>
    <main>
        <section id="verify" class="panel active">
            <h1>Hoi <?php echo $_SESSION['username']; ?></h1>
            <p>To be able to use our service you have to have verified your email</p>
            <p>Haven't gotten an email?</p>
            <p>Press here to resend the email</p>
            <button id="resend">send Email</button>
        </section>

        <section id="emailSent" class="panel">
            <h1>Hoi <?php echo $_SESSION['username']; ?></h1>
            <p>We have send another email to verify your account</p>
            <p>Please check your inbox or spam folder</p>
        </section>
    </main>
</body>
<script src="/public/js/notVerified.js"></script>

</html>