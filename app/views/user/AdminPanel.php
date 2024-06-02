<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/adminpanel.css">
    <title>Document</title>
</head>

<body>
    <header>
        <?php require_once APPROOT . '/views/components/header.php'; ?>
    </header>
    <main>
        <?php require_once APPROOT . '/views/components/sideMenu.php'; ?>

        <div class="container">
            <section id="users">
                <!-- Dip in panel of users. -->
                <table id="userTable">
                    <thead>
                        <tr>
                            <td>UserId</td>
                            <td>username</td>
                            <td>email</td>
                            <td>Tel</td>
                            <td>Adres</td>
                            <td>userType</td>
                            <td>isVerified</td>
                            <td>User actions</td>
                            <td>Delete</td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </section>
        </div>
    </main>
    <script src="/public/js/adminPanel.js"></script>
</body>

</html>