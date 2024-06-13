<?php require_once APPROOT . '/views/partial/admin_header.php'; ?>
<main>
    <section class="formCard">
        <form method="POST" action="/admin/cancel/<?php echo $data['resId']; ?>">
            <select name="Reason" id="Reason">
                <option value="1">Te hoge windkracht</option>
                <option value="2">Anders</option>
            </select>
            <input type="text" name="Reasoning" id="Reasoning">
            <button type="submit">Cancel Reservation</button>
        </form>
    </section>
</main>
</body>
<script src="/public/js/cancelRes.js"></script>

</html>