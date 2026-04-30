<section id="footer">
    <div>Let's Connect</div>
    <div>Get in touch for opportunities or to say hi! 👋🏽</div>
    <div>
        <i class="fa-brands fa-linkedin"></i>
        <i class="fa-solid fa-envelope"></i>
        <i class="fa-brands fa-instagram"></i>
    </div>
</section>
<script>
  const container = document.querySelector(".floating-balls");

  if (container) {
    const colors = ["#EFC5F0", "#ACCDFE", "#FFF6A8", "#99E2E3", "#F8D7E8", "#DFF7E8"];

    for (let i = 0; i < 14; i++) {
      const ball = document.createElement("span");

      ball.style.left = Math.random() * 100 + "%";
      ball.style.animationDuration = (12 + Math.random() * 10) + "s";
      ball.style.animationDelay = Math.random() * 5 + "s";
      ball.style.width = (18 + Math.random() * 45) + "px";
      ball.style.height = ball.style.width;
      ball.style.background = colors[Math.floor(Math.random() * colors.length)];

      container.appendChild(ball);
    }
  }
</script>
<script>
    function lightMode(){
        document.querySelector("body").style.backgroundColor = "white";
        document.querySelector("body").style.color = "black";
        if( window.location.pathname.includes("index") ){
            document.querySelector("#titleBlock1").style.color = "black";
            document.querySelector("#titleBlock1").style.backgroundColor = "#EFC5F0";
            document.querySelectorAll(".titleBlockEtc").forEach((blocketc) => {
                blocketc.style.color = "white";
            })
        }
        document.querySelector("#contrastMode").classList.add("light-mode");
        document.querySelector("#contrastMode").classList.remove("dark-mode");
        window.localStorage.setItem("contrastMode", "light");
    }

    function darkMode(){
        document.querySelector("body").style.backgroundColor = "#1E232E";
        document.querySelector("body").style.color = "white";
        if( window.location.pathname.includes("index") ){
            document.querySelector("#titleBlock1").style.color = "white";
            document.querySelector("#titleBlock1").style.backgroundColor = "#8F1592";
            document.querySelectorAll(".titleBlockEtc").forEach((blocketc) => {
                blocketc.style.color = "transparent";
            })
        }
        document.querySelector("#contrastMode").classList.add("dark-mode");
        document.querySelector("#contrastMode").classList.remove("light-mode");
        window.localStorage.setItem("contrastMode", "dark");
    }

    if( window.localStorage.getItem("contrastMode") === null ){
        window.localStorage.setItem("contrastMode", "light");
    }else if( window.localStorage.getItem("contrastMode") == "light" ){
        lightMode();
    }else if( window.localStorage.getItem("contrastMode") == "dark" ){
        darkMode();
    }

    function switchMode(){
        if( window.localStorage.getItem("contrastMode") == "light" ){
            darkMode();
        }else if( window.localStorage.getItem("contrastMode") == "dark" ){
            lightMode();
        }
    }

    function block1dark(){
        if( window.localStorage.getItem("contrastMode") == "dark" ){
            document.querySelector("#titleBlock1").style.color = "transparent";
        }
    }

    function block1light(){
        if( window.localStorage.getItem("contrastMode") == "dark" ){
            document.querySelector("#titleBlock1").style.color = "white";
        }
    }
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const cursor = document.querySelector(".custom-cursor");
  const dot = document.querySelector(".cursor-dot");

  if (!cursor || !dot) return;

  let mouseX = 0;
  let mouseY = 0;
  let cursorX = 0;
  let cursorY = 0;

  document.addEventListener("mousemove", function (e) {
    mouseX = e.clientX;
    mouseY = e.clientY;

    dot.style.left = mouseX + "px";
    dot.style.top = mouseY + "px";
  });

  function animateCursor() {
    cursorX += (mouseX - cursorX) * 0.12;
    cursorY += (mouseY - cursorY) * 0.12;

    cursor.style.left = cursorX + "px";
    cursor.style.top = cursorY + "px";

    requestAnimationFrame(animateCursor);
  }

  animateCursor();

  const clickableItems = document.querySelectorAll("a, button, .projectLink, .service-case-card, #contrastMode, .navOption");

  clickableItems.forEach(function (item) {
    item.addEventListener("mouseenter", function () {
      cursor.classList.add("cursor-hover");
    });

    item.addEventListener("mouseleave", function () {
      cursor.classList.remove("cursor-hover");
    });
  });
});
document.addEventListener("click", () => {
  const cursor = document.querySelector(".custom-cursor");

  cursor.style.transform = "translate(-50%, -50%) scale(0.8)";

  setTimeout(() => {
    cursor.style.transform = "translate(-50%, -50%) scale(1)";
  }, 120);
});
</script>