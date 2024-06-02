<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/reservation.css">
    <title>My Reservations</title>
</head>

<body>
    <header>
        <?php require_once APPROOT . '/views/components/header.php'; ?>
    </header>
    <main>
        <?php require_once APPROOT . '/views/components/sideMenu.php'; ?>
        <div class="container">
            <section id="reservations">
                <div class="inner">
                    <h1>Latest resverations for <?php echo $_SESSION['username']; ?></h1>
                    <div class="reservationTable">
                        <!-- table with all the reservations. -->
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
<script src="/public/js/reservation.js"></script>

</html>