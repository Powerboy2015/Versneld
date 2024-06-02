<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/reserve.css">
    <title>Document</title>
</head>

<body>
    <header>
        <?php require_once APPROOT . '/views/components/header.php'; ?>
    </header>
    <main>
        <?php require_once APPROOT . '/views/components/sideMenu.php'; ?>
        <div class="container">

            <section id="Reservation">
                <h1>Reserve lesson</h1>
                <form action="/user/reservations" method="post" id="reserveForm">
                    <label for="startdate">Start date</label>
                    <input type="datetime-local" name="startdate" required>

                    <label for="enddate">End date</label>
                    <input type="datetime-local" name="enddate" required>

                    <label for="pakketType">Packet Type</label>
                    <select name="pakketType" required>
                        <option value="1">Privéles 2,5 uur</option>
                        <option value="2">Losse Duo Kiteles 3,5 uur</option>
                        <option value="3">Kitesurf Duo lespakket 3 lessen 10,5 uur</option>
                        <option value="4">Kitesurf Duo lespakket 5 lessen 17,5 uur</option>
                    </select>

                    <label for="location">Location</label>
                    <select name="location" required>
                        <option value="Zandvoort">Zandvoort</option>
                        <option value="Muiderberg">Muiderberg</option>
                        <option value="Wijk aan Zee">Wijk aan Zee</option>
                        <option value="Ijmuiden">Ijmuiden</option>
                        <option value="Scheveningen">Scheveningen</option>
                        <option value="Hoek van holland">Hoek van holland</option>
                    </select>

                    <label for="amountPeople">Amount of people</label>
                    <input type="number" name="amountPeople" min="1" max="4" required>

                    <button type="submit">Reserveer</button>
                </form>
            </section>
        </div>
    </main>
</body>
<script src="/public/js/reserve.js"></script>

</html>