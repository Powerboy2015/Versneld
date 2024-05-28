<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/Profile.css">
    <title>My profile</title>
</head>

<body>
    <header>
        <!-- main head menu -->
        <?php require_once APPROOT . '/views/components/header.php'; ?>
    </header>
    <main>
        <!-- sideMenu of the user account -->
        <?php require_once APPROOT . '/views/components/sideMenu.php'; ?>
        <div class="container">
            <section class="page profile">
                <div class="inner">
                    <article class="card" id="userInfo">
                        <h3>Profile info</h3>
                        <table class="userTable">
                            <?php echo $data['userTable'] ?>
                        </table>

                        <a href="/user/change">Change information</a>
                    </article>
                </div>
            </section>
        </div>
    </main>
    <script src="/public/js/profileNav.js"></script>
</body>

</html>