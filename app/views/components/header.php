 <nav>
     <!-- <div class="logo">
         <img src="/img/logo.png" alt="" id="logo" />
         <p>Windkracht 12</p>
     </div> -->
     <ul class="navigation">
         <li>
             <div class="logo">
                 <img src="/img/logo.png" alt="" id="logo" />
                 <p>Windkracht 12</p>
             </div>
         </li>
         <li id="hamburger">
             <div class="bar1"></div>
             <div class="bar2"></div>
             <div class="bar3"></div>
         </li>
         <li><a href="/home/index">Home</a></li>
         <li><a>pakketten</a></li>
         <li><a>about</a></li>
         <?php if (isset($_SESSION['username'])) : ?>
             <li><a href="/user/profile">my profile</a></li>
             <li><a href="/api/clear">Log out</a></li>
         <?php else : ?>
             <li><a id="login">Log in</a></li>
         <?php endif; ?>
     </ul>

 </nav>
 <script src="/js/navbar.js"></script>