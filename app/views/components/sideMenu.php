        <div class="aside-open"></div>
        <aside>
            <ul>
                <li><a href="/user/profile">profile</a></li>
                <?php if ($data['userType'] == 1) : ?>
                    <li><a href="/user/Reservations">Reservations</a></li>
                    <li><a href="/user/makeReservation">create reservation</a></li>
                <?php elseif ($data['userType'] == 3) : ?>
                    <li><a href="/admin/users">Users</a></li>
                <?php endif; ?>
                <?php if ($data['userType'] > 1) : ?>
                    <li><a href="/admin/reservations">reservation</a></li>
                <?php endif; ?>
            </ul>
        </aside>