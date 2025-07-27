var style = document.createElement("style");
style.type = "text/css";


body = document.getElementsByTagName("body")[0];
body.innerHTML=`  <div class="loader">
<div class="wrapper">
<div class="book-loader-container">
  <div class="spine"></div>
  <div class="page" style="--page-num: 1"></div>
  <div class="page" style="--page-num: 2"></div>
  <div class="page" style="--page-num: 3"></div>
  <div class="page" style="--page-num: 4"></div>
  <div class="page static right"></div>
  <div class="page static left"></div>
</div>

<h1>Looding...</h1>
</div>
</div> ${body.innerHTML}`;

var Nstyle = `
   .book-loader-container {
  --color: #eee;
  --line-width: 0.5ch;
  --_border-width: calc(var(--line-width) / 2);
  --duration: 2s;
  --spine-length: 5ch;
  --spine-height: calc(var(--spine-length) * 0.5);
  --page-length: 7ch;
  --cover-length: calc(var(--page-length) + 0ch);
  --page-offset-y: 0.4ch;
  --page-offset-x: 0.5ch;
  --page-anim-offset: calc(2s / 4);
  --_width: calc(2 * var(--cover-length) + var(--spine-length) + 2 * var(--line-width));
  --_wrapper-width: calc(var(--cover-length) + var(--line-width) + var(--spine-length) / 2);
  --_height: calc(var(--_wrapper-width) + var(--spine-height) + var(--page-offset-y));

  position: relative;
  width: var(--_width);
  height: var(--_height);
}

.book-loader-container .spine {
  border: var(--line-width) var(--color) solid;
  border-radius: 0 0 9px 9px;
  border-top: none;
  position: absolute;
  width: var(--spine-length);
  height: var(--spine-height);
  left: 50%;
  transform: translateX(-50%);
  bottom: 0;
}

.book-loader-container .spine::after,
.book-loader-container .spine::before {
  --border-radius: 15px;
  content: "";
  position: absolute;
  border: solid var(--_border-width) var(--color);
  border-radius: 15px;
  width: calc(var(--cover-length) + var(--line-width));
  top: 0;
}

.book-loader-container .spine::after {
  border-radius: 0 var(--border-radius) var(--border-radius) 0;
  left: 0;
  transform: translatex(calc(var(--spine-length) - var(--line-width)));
}

.book-loader-container .spine::before {
  border-radius: var(--border-radius) 0 0 var(--border-radius);
  right: 0;
  transform: translatex(calc(-1 * var(--spine-length) + var(--line-width)));
}

.book-loader-container .page {
  width: var(--_wrapper-width);
  position: absolute;
  right: 0;
  bottom: calc(var(--spine-height) + var(--page-offset-y));
  transform-origin: left center;
  rotate: 0deg;
}

.book-loader-container .page:not(.static) {
  animation: rotation var(--duration) linear infinite;
  animation-delay: calc((var(--page-num) - 1) * var(--page-anim-offset));
}

.book-loader-container .page.left {
  left: 0;
}

.book-loader-container .page.right {
  right: 0;
}

.book-loader-container .page::after {
  content: "";
  display: block;
  --_radius: calc(var(--page-length) + var(--line-length));
  border: solid var(--_border-width) var(--color);
  border-radius: 15px;
  width: var(--page-length);
}

.book-loader-container .page.left::after {
  transform: translatex(
    calc(
      1 * (var(--_wrapper-width) - var(--page-length)) -
        (var(--spine-length) / 2) + var(--line-width) - var(--page-offset-x)
    )
  );
}

.book-loader-container .page:not(.left)::after {
  transform: translatex(
    calc((var(--spine-length) / 2 - var(--line-width)) + var(--page-offset-x))
  );
}

.wrapper {
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  flex-direction:column;
  background: var(--color1);
  width: 100%;
  height: 100%;
  position:fixed;
  z-index: 1000;
  top: 0;
  left: 0;
}

@keyframes rotation {
  to {
    rotate: -180deg;
  }
}


`;
style.innerHTML+= Nstyle;

document.getElementsByTagName("head")[0].appendChild(style);
