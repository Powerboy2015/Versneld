<div class="darken">
    <section id="updateType">
        <h2>UserType for <?php echo $data['username'] ?></h2>
        <span id="button-close">X</span>
        <form action="/api/updateUserType/<?php echo $data['username'] ?>" method="post" id="userForm">
            <select name="userType" id="userType">
                <option value="4">blocked</option>
                <option value="3">Admin</option>
                <option value="2">instructor</option>
                <option value="1" default>user</option>
            </select>
            <button type="submit">submit</button>
        </form>
    </section>
</div>