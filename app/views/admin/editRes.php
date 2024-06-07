<?php require_once APPROOT . '/views/partial/admin_header.php'; ?>
<main>
    <!-- no usermenu on the side because of the fact you're changing sensitive data -->
    <section class="formCard">
        <form action="/admin/updateRes/<?php echo $data['resId']; ?>" method="post">
            <?php echo $data['resData']; ?>
            <button type="submit">Change reservation</button>
        </form>
    </section>
</main>
</body>

</html>