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

    <section class="designListing">
        <div class="designImage">
            <img src="images/DoublePhones.png" />
        </div>
    </section>

    <section class="designListing">
        <div class="designTitle">
                <span>Order</span> Integration <span> EDI + JDE</span>
        </div>

        <div class="designDescSplit">
            <div>
                <div class="designDescTitle">Project Overview</div>
                <div class="designDescBodyPrimary">
                    Investigated and resolved issues preventing Amazon purchase orders from automatically integrating into the ERP system (JDE), ensuring accurate and reliable data flow between external and interal systems.
                    <br/><br/>
                </div>
            </div>
            <div>
                <div class="designDescTitle">Skills Demonstrated</div>
                <div class="designDescBodyPrimary">
                    <span>UX Analyst</span><br/><br/>
                    Root cause analysis, Data mapping issues (SKU mismatches), Partnered with EDI coordinators to troubeshoot and correct item-level errors, Ensured successful automation of. future PO processing
                </div>
            </div>
        </div>
    </section>

    <section class="designListing">
        <div class="designTitle">
            <span>Problem Focus</span>
        </div>
        <div class="designDesc">
            <div class="designDescBodySecondary">
                Purchase orders were failing to integrate into JDE due to vendor code mismatches and incorrect data mapping (e.g., SKU discrepancies), causing delays and manual intervention.
            </div> <br/><br/>
        <div class="additional-text">
</div>

        </div>
    </section>

    <section class="designListing">
        <div class="designTitle">
            <span>Key contributions</span>
        </div>
        <div class="designDesc">
            <div class="designDescBodySecondary">
                Identified root causes of failed purchase order integrations, collaborated with JDE analysts and EDI team to align vendor code structures, diagnosed and resolved mapping issues (SKU mismatches), partnered with EDI coordinators to troubleshoot and correct item-level errors, Ensured successful automation of future purchase order processing.
            </div> 
            <br/><br/>


        </div>
    </section>

    <section class="designListing">
        <div class="designTitle">
            <span>Impact</span>
        </div>
        <div class="designDesc">
            <div class="designDescBodySecondary">
                Enables successful automated purchase order integration into ERP, reduced manual intervention and processing errors, improved data accuracy between Amazon and internal systems.
        </div>
    </section>

    <hr/>

    <?php include "footer.php"; ?>
</body>

</html>