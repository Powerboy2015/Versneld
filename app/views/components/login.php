<div id="loginContainer">
        <div class="loginMenu">
            <h3>Log in!</h3>
            <form action="/user/profile" method="post" id="loginForm">
                <label for="username">Gebruikersnaam</label>
                <input type="text" name="username" autocomplete="off" />
                
                <label for="password">Wachtwoord</label>
                <input type="password" name="password" id="password" autocomplete="off">

                <button type="submit" id="submitBut">Log In</button>
                <a>Register now!</a>
                </form>
                <a id="LoginMenuClose">X</a>
        </div>
</div>
<script src="/js/Closelogin.js"></script>