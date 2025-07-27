<!-- get color1 and color0 from root -->
<style>
header *{
  margin: 0;
  padding: 0;
}
.container {
  width: 90%;
  height: 100%;
  margin: 0px auto;
}
header {
  background-color:var(--color2);
  z-index: 200;
  opacity: 1;
  width: 100%;
  height: 50px;
  color: var(--color0);
  position: fixed ;
  top: 0px;
  left: 0px;
}
.wave{
  background-color:var(--color2);
  z-index: 20;
  opacity: 1;
  width: 100%;
  height: 50px;
  filter: drop-shadow(2px 3px 2px var(--color10));
  color: var(--color0);
  position:fixed;
  top: 50px;
  left: 0px;
  --mask:
  radial-gradient(67.08px at 50% calc(100% - 90.00px),#000 99%,#0000 101%) calc(50% - 60px) 0/120px 100%,
  radial-gradient(67.08px at 50% calc(100% + 60.00px),#0000 99%,#000 101%) 50% calc(100% - 30px)/120px 100% repeat-x;
-webkit-mask: var(--mask);
        mask: var(--mask);
}
header .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  header .container > *{
    margin-top:20px;
    
  }
  header .container h2 {
    letter-spacing: 2px;
    font-size: 30px;
  }

header .container h1 {
  font-size: 40px;
  margin-top: -10px;
  -webkit-text-stroke-width: 0.1pt;
  -webkit-text-stroke-color: var(--color0);
  -webkit-text-fill-color: var(--color2);
}
header .container div:nth-child(1) {
  display: flex;
}

header .container .menu {
  overflow: hidden;
}
header .container .menu svg {
  width: 40px;
  height: 40px;
}
header .menu svg:nth-child(2) {
  display: none;
}

header label {
    display: none;
    position: relative;
    z-index: 2000;
  }



  .links div {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: max-content;
  }
  .links a {
    text-decoration: none;
    color: var(--color0);
  margin:20px;
    font-size: 20px;
  }
  .links a:hover {
    text-shadow: 0px 0px 4px rgb(255, 255, 255);
    color: white;
  }
  #check {
    display: none;
  }
  #check:checked ~ .links {
    left: 0%;
  }
  #check:checked ~ label svg:nth-child(1) {
    display: none;
  }
  #check:checked ~ label svg:nth-child(2) {
    display: inline-block;
  }




@media (max-width: 900px) {
  .links {
    position: fixed;
    top: 0px;
    left:100%;
    transition: 0.2s;
    width:100%;
    height:100%;
    z-index: 2;
  }

  .links div {
    position: absolute;
    right: 0px;
    top: 0px;
    background-color: var(--color2);
    width: max-content;
    height: min-content;
    padding:50px 50px 20px 20px ;
    border-radius: 0px 20px 0px 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    box-shadow: 0px 0px 20px #00000036;
  }
  .links div a {
    margin-top: 10px;
  }
  .links div a:hover {
    text-shadow: 0px 0px 6px rgb(255, 255, 255);
    color: white;
  }
  header label {
    display: inline-block;
  }
}
</style>
<header>
  <div class="container">
    <div>
      <h2>mass<h1>.Book</h1>
      </h2>
    </div>

    <div class="menu">
      <input type="checkbox" id="check">
      <label for="check">
        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
          <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill=#fff stroke="none">
            <path d="M2321 5110 c-497 -48 -990 -251 -1376 -565 -114 -92 -294 -274 -384
-387 -229 -287 -417 -675 -495 -1023 -49 -218 -60 -325 -60 -575 0 -250 11
-357 60 -575 79 -355 272 -749 509 -1040 92 -114 274 -294 387 -384 287 -229
675 -417 1023 -495 218 -49 325 -60 575 -60 250 0 357 11 575 60 261 58 603
204 828 353 389 259 688 599 893 1016 125 255 196 484 241 775 24 161 24 539
0 700 -45 291 -116 520 -241 775 -134 272 -283 480 -498 692 -211 209 -404
346 -673 478 -252 124 -486 197 -765 240 -126 19 -468 27 -599 15z m474 -430
c656 -74 1243 -450 1591 -1020 275 -452 369 -998 263 -1530 -113 -567 -480
-1085 -989 -1396 -452 -275 -998 -369 -1530 -263 -567 113 -1085 480 -1396
989 -156 258 -260 562 -294 865 -22 200 -10 457 31 665 113 567 480 1085 989
1396 251 153 562 260 850 293 107 12 379 13 485 1z" />
            <path d="M1437 3616 c-66 -18 -104 -52 -137 -121 -25 -52 -25 -109 1 -165 27
-60 45 -79 104 -106 l50 -24 1105 0 c1089 0 1106 1 1150 21 60 27 79 45 106
104 40 85 24 172 -42 239 -65 65 11 61 -1194 63 -867 1 -1105 -1 -1143 -11z" />
            <path d="M1405 2751 c-72 -32 -125 -113 -125 -191 0 -78 53 -159 125 -191 38
-18 98 -19 1155 -19 1057 0 1117 1 1155 19 72 32 125 113 125 191 0 78 -53
159 -125 191 -38 18 -98 19 -1155 19 -1057 0 -1117 -1 -1155 -19z" />
            <path d="M1405 1896 c-27 -13 -58 -32 -67 -42 -29 -33 -58 -107 -58 -149 0
-79 65 -171 139 -197 53 -19 2229 -19 2282 0 74 26 138 118 139 197 0 44 -36
131 -66 157 -11 9 -40 26 -64 37 -44 20 -61 21 -1150 21 l-1105 0 -50 -24z" />
          </g>
        </svg>
        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
          <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill=#fff stroke="none">
            <path d="M2332 5110 c-611 -59 -1163 -320 -1589 -751 -406 -411 -648 -908
-725 -1489 -16 -123 -16 -497 0 -620 77 -581 319 -1078 725 -1489 214 -216
414 -360 692 -496 366 -181 705 -259 1120 -259 224 0 326 9 510 46 603 121
1134 450 1525 946 141 179 292 455 374 684 529 1471 -349 3055 -1874 3382
-209 45 -554 65 -758 46z m485 -405 c158 -20 289 -48 414 -89 708 -230 1253
-816 1428 -1537 338 -1395 -732 -2722 -2159 -2676 -246 8 -416 37 -633 109
-592 196 -1086 666 -1321 1258 -106 269 -152 539 -143 850 6 220 26 356 81
545 106 367 296 678 582 955 339 327 744 521 1224 584 142 19 383 19 527 1z" />
            <path d="M1781 3448 c-49 -24 -95 -87 -105 -144 -5 -21 -1 -55 8 -87 14 -48
36 -73 311 -347 l295 -295 -289 -290 c-159 -159 -296 -304 -304 -320 -51 -101
-12 -221 87 -272 42 -22 132 -21 176 2 19 10 166 147 325 306 l291 289 284
-286 c162 -162 302 -294 325 -306 85 -45 200 -16 252 63 35 53 43 140 18 190
-9 19 -148 166 -308 326 l-292 293 292 293 c191 191 298 305 308 329 69 166
-100 334 -260 259 -26 -12 -141 -120 -325 -305 -157 -157 -289 -286 -295 -286
-5 0 -140 130 -300 290 -192 191 -303 294 -327 305 -52 21 -115 19 -167 -7z" />
          </g>
        </svg>
      </label>
      <div class="links">
        <div>
          <a href="index.php">Home</a>
          <a href="index.php#Pbooks">Popular Books</a>
          <a href="index.php#Rbooks">Recent Books</a>
          <?php
            if(isset($_SESSION["userType"]) && $_SESSION["userType"] == "admin") {
              echo  '<a href="upload.php">Upload Book</a>';
            
            }
          ?>
          
            <?php
            if (isset($_SESSION["userName"]) && $_SESSION["userName"] != "") {
              echo  "<a href='profile/",$_SESSION["userUname"] , ".html'>",$_SESSION["userName"] , "</a>";
            } else {
              echo " <a href='login.php'> Login 》</a>";
            }
            ?>

        </div>
      </div>
    </div>
  </div>
</header>
<div class="wave">
</div>