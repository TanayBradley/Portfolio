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
            <div>I'm a <span id="titleBlock2" class="titleBlockEtc">UX</span> <span id="titleBlock3" class="titleBlockEtc">Designer</span> &amp;  <span id="titleBlock4" class="titleBlockEtc">Experience Strategist</span></div>
        </div>
        <div id="introBody">
            <span>Something doesn’t have to be broken for me to question it. If it feels off, I’m already figuring out why. I break things down, find where the disconnect is, and rethink the experience so it actually works for people. I’m both analytical and creative, so I’m not just fixing problems - I’m improving how people experience real-world systems, services, and products</span>
        </div>
    </section>
    

<section class="service-case-studies">
  <div class="service-case-header">
    <p class="section-label">Featured Work</p>
    <h2>Featured Case Studies</h2>
    <p>
      Selected UX, systems, and workflow projects focused on uncovering friction and 
      designing better ways for people to move through products and processes.
    </p>
  </div>

  <div class="service-case-grid">

    <a class="service-case-card" href="casestudy7.php">
      <span class="case-tag">Systems & Workflow Design</span>
      <h3>DESIGNING A SCALABLE RETAIL CONTENT REQUEST SYSTEM</h3>
      <p>
        Transforming a fragmented email and Excel process into a structured 
        SharePoint workflow for managing retail product content.
      </p>
      <span class="case-link">View Case Study →</span>
    </a>

    <a class="service-case-card" href="keepgoingmobile.php">
      <span class="case-tag">UX/Product Design</span>
      <h3>DESIGNING THE KEEP>GOING FIRST AID APP EXPERIENCE</h3>
      <p>
        Using research, wireframes, prototyping, and evaluation to shape an interactive 
        mobile experience around real user and stakeholder needs.
      </p>
      <span class="case-link">View Case Study →</span>
    </a>

    <a class="service-case-card" href="casestudy1.php">
      <span class="case-tag">Workflow Analysis</span>
      <h3>IMPROVING THE AMAZON ORDER PROCESSING WORKFLOW</h3>
      <p>
        Identifying duplicate work, system limitations, and ownership gaps across teams 
        to improve efficiency and reduce friction.
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