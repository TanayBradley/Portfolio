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
      <div class="floating-balls"></div>
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
            <span>Something doesn’t have to be broken for me to question it. If it feels off, I’m already figuring out why. I break things down, find where the disconnect is, and rethink the experience so it actually works for people. I’m both analytical and creative, so I’m not just fixing problems - I’m improving how people experience real-world systems through service design.</span>
        </div>
    </section>
    

<section class="service-case-studies">
  <div class="service-case-header">
    <p class="section-label">Service Design</p>
    <h2>Service Design Case Studies</h2>
    <p>
      Real-world experience improvements focused on how people move through systems,
      spaces, and services.
    </p>
  </div>

  <div class="service-case-grid">

    <a class="service-case-card" href="case-studies/sidewalk-walkability.pdf" target="_blank">
      <span class="case-tag">Neighborhood Experience</span>
      <h3>Improving Neighborhood Walkability</h3>
      <p>
        A service design case study exploring a sidewalk gap that disrupts pedestrian flow,
        safety, and accessibility.
      </p>
      <span class="case-link">View Case Study →</span>
    </a>

    <a class="service-case-card" href="case-studies/whataburger-drive-thru.pdf" target="_blank">
      <span class="case-tag">Drive-Thru Experience</span>
      <h3>Improving the Whataburger Customer Drive-Thru Experience</h3>
      <p>
        An analysis of customer flow, wait times, weather exposure, and order accuracy within
        the drive-thru service experience.
      </p>
      <span class="case-link">View Case Study →</span>
    </a>

    <a class="service-case-card" href="case-studies/chickfila-drive-thru.pdf" target="_blank">
      <span class="case-tag">Service Optimization</span>
      <h3>Optimizing Chick-fil-A’s Drive-Thru Delivery Flow</h3>
      <p>
        A case study identifying how early food handoff can create service friction when
        vehicle flow does not match order readiness.
      </p>
      <span class="case-link">View Case Study →</span>
    </a>

  </div>
</section>

    <section id="highlightedWork">
        <h3>Workflow Improvement Case Studies</h3>
      <a href="casestudy1.php" class="projectLink">
    <div class="projectListing">
        <div class="projectDesc">
            <span class="projectTitle">Reduced inefficiencies in Amazon order processing workflow</span>
            <span class="projectSubtitle">Identified duplicate manual work and misaligned ownership across CS and shipping teams</span>
        </div>
        <div class="arrow">
            <img src="images/arrow.png" alt="arrow">
        </div>
    </div>
</a>
      <a href="casestudy2.php" class="projectLink">
        <div class="projectListing">
            <div class="projectDesc">
                <span class="projectTitle">Designed an automated workflow for Amazon order processing </span>
                <span class="projectSubtitle">Reduced manual workload through automation while identifying system limitations</span>
            </div>
          <div class="arrow">
            <img src="images/arrow.png" alt="arrow">
        </div>
     </div>
</a>
      <a href="casestudy3.php" class="projectLink">
        <div class="projectListing">
            <div class="projectDesc">
                <span class="projectTitle">Resolved a purchase order integration issues between Amazon and ERP</span>
                <span class="projectSubtitle">Diagnosed and fixed data mapping issues preventing automated PO processing</span>
            </div>
          <div class="arrow">
            <img src="images/arrow.png" alt="arrow">
        </div>
     </div>
</a>
      <a href="casestudy4.php" class="projectLink">
            <div class="projectListing">
              <div class="projectDesc">
                <span class="projectTitle">Designed a scalable content request system for retail products listings</span>
                <span class="projectSubtitle">Replaced manual email/Excel workflow with a scalable self-service solution</span>
            </div>
          <div class="arrow">
            <img src="images/arrow.png" alt="arrow">
        </div>
    </div>
</a>
        <a href="casestudy5.php" class="projectLink">
             <div class="projectListing">
                <div class="projectDesc">
                 <span class="projectTitle">Developed digital content strategy for retail product listings</span>
                 <span class="projectSubtitle">Improved product content consistency and usability across retail channels</span>
             </div>
          <div class="arrow">
             <img src="images/arrow.png" alt="arrow">
         </div>
     </div>
</a>
        <a href="casestudy6.php" class="projectLink">
            <div class="projectListing">
                <div class="projectDesc">
                <span class="projectTitle">Improved website UX through form design optimization</span>
                 <span class="projectSubtitle">Enhanced for usability to reduce friction and improve user flow</span>
            </div>
         <div class="arrow">
            <img src="images/arrow.png" alt="arrow">
        </div>
    </div>
</a>
    </section>


    <?php include "footer.php"; ?>

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


</body>

</html>