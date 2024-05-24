<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/Proifle.css">
    <title>Document</title>
</head>
<body>
    <header>    
        <?php require_once APPROOT . '/views/components/header.php' ?>
    </header>
    <main>
        <div class="container phone-column">
            <aside id="profileNav">
                <ul>
                    <!-- TODO icon to open menu -->
                    <li class="phone-only" id="menuBut">Menu</li>
                    
                    <li class="pc-only phoneMenu" id="test">overview</li>
                    <li class="pc-only phoneMenu">reservations</li>
                    <li class="pc-only phoneMenu">settings</li>

                </ul>
            </aside>
            
            <section id="overview" class="slide">
            </section>
        </div>
    </main>
    <script src="/public/js/profileNav.js"></script>
</body>
</html>