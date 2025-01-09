<section id="footer">
    <div>Let's Connect</div>
    <div>Get in touch for opportunities or to say hi!<img id="wavingHand" src="icons/waving-hand-sign_1f44b.png" /></div>
    <div>
        <i class="fa-brands fa-linkedin"></i>
        <i class="fa-solid fa-envelope"></i>
        <i class="fa-brands fa-instagram"></i>
    </div>
</section>

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