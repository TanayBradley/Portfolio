<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<?php include "head.php"; ?>

<body>
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <?php include "navigation.php"; ?>

    <section id="intro">
        <div id="introTitle">
            <div>Hey there, <span id="titleBlock1" onmouseover="block1dark()" onmouseout="block1light()">I'm Tanay</span></div>
            <div>I <span id="titleBlock2" class="titleBlockEtc">design</span>, <span id="titleBlock3" class="titleBlockEtc">sing</span>, &amp; I'm an <span id="titleBlock4" class="titleBlockEtc">outdoorsy bookworm</span></div>
        </div>
        <div id="introBody">
            <span>I'm a UX/UI designer based in Houston, Texas with basic knowledge in coding and a strong foundation in Graphic Design. I’m excited to share my knowledge and skills to create designs that provide a seamless, enjoyable user experience.</span>
        </div>
    </section>

    <section id="highlightedWork">
        <h3>My Recent Work</h3>
        <div class="projectListing">
            <div class="projectImage">
                <img src="images/DoublePhones.png" />
            </div>
            <div class="projectDesc">
                <span class="projectTitle">Keep Going > First Aid</span>
                <span class="projectSubtitle">A fun and educational matching game for your kids to learn the importance of safety.</span>
            </div>
        </div>
        <div class="projectListing">
            <div class="projectImage">
                <img src="images/Laptop.png" />
            </div>
            <div class="projectDesc">
                <span class="projectTitle">Keep Going > First Aid</span>
                <span class="projectSubtitle">A backend system for processing online orders</span>
            </div>
        </div>
        <div class="projectListing">
            <div class="projectImage">
                <img src="images/SinglePhone.png" />
            </div>
            <div class="projectDesc">
                <span class="projectTitle">Gante</span>
                <span class="projectSubtitle">An easy way to shop for furniture online</span>
            </div>
        </div>
    </section>

    <?php include "footer.php"; ?>

</body>

</html>