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
            <div>I'm a <span id="titleBlock2" class="titleBlockEtc">Usability</span> <span id="titleBlock3" class="titleBlockEtc">Analyst</span> &amp;  <span id="titleBlock4" class="titleBlockEtc">Creative Storyteller</span></div>
        </div>
        <div id="introBody">
            <span>Something doesn't have to be broken for me to question it. If it feels off, I'm already figuring out why. I break things down, find where the disconnect is, and rethink the experience so it actually makes sense for people. I'm both analytical and creative, so I'm not just fixing problems - I'm changing how they're experienced.</span>
        </div>
    </section>

    <section id="highlightedWork">
        <h3>Case Studies</h3>
        <div class="projectListing">
            <div class="projectDesc">
                <span class="projectTitle">Reduced inefficiencies in Amazon order processing workflow</span>
                <span class="projectSubtitle">Identified duplicate manual work and misaligned ownership across CS and shipping teams</span>
                </div>
                <div class="arrow">
        <img src="images/arrow.png" alt="arrow">
    </div>
        </div>
        <div class="projectListing">
            <div class="projectDesc">
                <span class="projectTitle">Designed an automated workflow for Amazon order processing </span>
                <span class="projectSubtitle">Reduced manual workload through automation while identifying system limitations</span>
            </div>
            <div class="arrow">
        <img src="images/arrow.png" alt="arrow">
    </div>
        </div>
        <div class="projectListing">
            <div class="projectDesc">
                <span class="projectTitle">Resolved a purchase order integration issues between Amazon and ERP</span>
                <span class="projectSubtitle">Diagnosed and fixed data mapping issues preventing automated PO processing</span>
            </div>
            <div class="arrow">
        <img src="images/arrow.png" alt="arrow">
    </div>
        </div>
            <div class="projectListing">
        <div class="projectDesc">
                <span class="projectTitle">Designed a scalable content request system for retail products listings</span>
                <span class="projectSubtitle">Replaced manual email/Excel workflow with a scalable self-service solution</span>
        </div>
        <div class="arrow">
        <img src="images/arrow.png" alt="arrow">
    </div>
        </div>
             <div class="projectListing">
        <div class="projectDesc">
                 <span class="projectTitle">Developed digital content strategy for retail product listings</span>
                <span class="projectSubtitle">Improved product content consistency and usability across retail channels</span>
        </div>
        <div class="arrow">
        <img src="images/arrow.png" alt="arrow">
    </div>
        </div>
            <div class="projectListing">
        <div class="projectDesc">
                <span class="projectTitle">Improved website UX through form design optimization</span>
                 <span class="projectSubtitle">Enhanced for usability to reduce friction and improve user flow</span>
         </div>
         <div class="arrow">
        <img src="images/arrow.png" alt="arrow">
    </div>
        </div>
    </section>

    <?php include "footer.php"; ?>

</body>

</html>