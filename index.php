<!DOCTYPE html>
<html lang="en">
<head> 
    <!-- Character encoding for proper text rendering -->
    <meta charset="UTF-8"> 

    <!-- Viewport settings for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <!-- Page title displayed on the browser tab -->
    <title>Tanay Bradley</title> 

    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="stylesheet.css">
</head>

<?php include "head.php"; ?>

<body>
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <?php include "navigation.php"; ?>

    <section id="intro">
        <div id="introTitle">
            <div>Hey there, <span id="titleBlock1" onmouseover="block1dark()" onmouseout="block1light()">I'm Tanay</span> 👋🏽</div>
            <div>I'm a <span id="titleBlock2" class="titleBlockEtc">Multi-creative</span> <span id="titleBlock3" class="titleBlockEtc">UX Designer</span> &amp;  <span id="titleBlock4" class="titleBlockEtc">Soulful Storyteller</span></div>
        </div>
        <div id="introBody">
            <span>Something doesn't have to be broken for me to question it. If it feels off, I'm already figuring out why. I break things dow, find where the disconnect is, and rethink the experience so it actually makes sense for people. I'm both analytical and creative, so I'm not just fixing problems - I'm changing how they're experienced.</span>
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