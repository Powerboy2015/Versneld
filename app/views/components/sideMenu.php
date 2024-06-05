        <div class="aside-open"></div>
        <aside>
            <ul>
                <li><a href="/user/profile">profile</a></li>
                <li><a href="/user/Reservations">Reservations</a></li>
                <?php if ($data['userType'] == 1) : ?>
                    <li><a href="/user/makeReservation">create reservation</a></li>
                <?php elseif ($data['userType'] == 3) : ?>
                    <li><a href="/user/adminPanel">Users</a></li>
                <?php endif; ?>
            </ul>
        </aside>