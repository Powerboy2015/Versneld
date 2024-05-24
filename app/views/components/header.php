 <nav>
                <div class="logo">
                    <img src="/img/logo.png" alt="" id="logo" />
                    <p>Windkracht 12</p>
                </div>
                <ul>
                    <li><a href="/home/index">Home</a></li>
                    <li>Pakketten</li>
                    <?php if(isset($_SESSION['username'])): ?> 
                        <li><a href="/user/profile">my profile</a></li>    
                        <li><a href="/home/clear">Log out</a></li>
                    <?php else: ?> 
                            <li><a id="login">Log in</a></li>
                    <?php endif;?>
                </ul>
            </nav>
            <script src="/js/navbar.js"></script>