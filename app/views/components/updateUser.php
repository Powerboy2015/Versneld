<div class="darken">
    <section id="updateUser">
        <h1>Update data of <?php echo $data['userName'] ?></h1>
        <span id="button-close">X</span>
        <form action="/user/profile" method="POST" id="changeForm">
            <?php echo $data['rows'] ?>
            <span id="msg"></span>
            <button type="submit">Change Data</button>
        </form>
    </section>
</div>