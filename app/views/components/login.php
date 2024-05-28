<div id="loginContainer">
        <div class="loginMenu appear">
                <h3>Log in</h3>
                <form action="/user/profile" method="post" id="loginForm">
                        <label for="username">Gebruikersnaam</label>
                        <input type="text" name="username" autocomplete="off" />

                        <label for="password">Wachtwoord</label>
                        <input type="password" name="password" id="password" autocomplete="off">

                        <button type="submit" class="submitBut">Log In</button>
                        <a class="switchMenu">Register now</a>
                </form>
                <a class="LoginMenuClose">X</a>

        </div>

        <div class="registerMenu">
                <h3>Register</h3>
                <form action="/home/index" id="registerForm" method="post">
                        <label for="email">email</label>
                        <input type="text" name="email" required>

                        <label for="username">Gebruikersnaam</label>
                        <input type="text" name="username" required>

                        <label for="password">wachtwoord</label>
                        <input type="password" name="password" required>

                        <label for="repeat-pass">herhaal wachtwoord</label>
                        <input type="password" name="repeat-pass" required>

                        <button type="submit" class="submitBut">Log In</button>
                        <a class="switchMenu"">Already have an account?</a>
                </form>
                <a class=" LoginMenuClose">X</a>
        </div>
</div>
<script src="/js/Closelogin.js"></script>