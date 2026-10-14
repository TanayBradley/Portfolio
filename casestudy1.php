<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A workflow improvement case study on reducing manual Amazon order processing through cross-functional systems improvements and automation.">
<title>Amazon Order Processing Workflow | Portfolio</title>
<link rel="stylesheet" href="stylesheet.css">
<style>
:root{--aw-teal:#00b5b6;--aw-ink:#101417;--aw-muted:#566269;--aw-border:#e2e8e8;--aw-soft:#f7faf9}
.aw-page{font-family:inherit;color:var(--aw-ink);line-height:1.65;overflow:hidden;background:white}
.aw-wrap{width:min(1100px,calc(100% - 44px));margin:auto}
.aw-hero{padding:95px 0 75px;background:radial-gradient(circle at 94% 19%,#fff9df 0 18px,transparent 19px),radial-gradient(circle at 83% 70%,#f7edf7 0 32px,transparent 33px),white}
.aw-kicker{font-size:.78rem;letter-spacing:.16em;text-transform:uppercase;font-weight:800;color:#087d80}
.aw-hero h1{font-size:clamp(2.8rem,6vw,5.7rem);letter-spacing:-.055em;line-height:1.07;margin:18px 0 22px;max-width:950px}
.aw-hero h1 span,.aw-highlight-number{color:var(--aw-teal)}
.aw-lede{font-size:clamp(1.1rem,2vw,1.35rem);color:#465156;max-width:780px;margin:0}
.aw-rule{height:5px;width:94px;border-radius:10px;background:var(--aw-teal);margin:26px 0 0}
.aw-meta{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:58px}
.aw-meta>div{border-top:1px solid var(--aw-border);padding-top:18px}
.aw-meta strong,.aw-label{display:block;text-transform:uppercase;font-size:.75rem;letter-spacing:.11em;color:var(--aw-muted);margin-bottom:9px}
.aw-meta p{margin:0;font-size:.95rem}
.aw-section{padding:85px 0;border-top:1px solid var(--aw-border)}
.aw-section.alt{background:var(--aw-soft)}
.aw-section h2{font-size:clamp(2rem,4vw,3.25rem);line-height:1.12;letter-spacing:-.045em;margin:0 0 18px}
.aw-section-intro{max-width:760px;color:var(--aw-muted);font-size:1.08rem;margin:0 0 30px}
.aw-eyebrow{color:#087d80;font-size:.77rem;letter-spacing:.13em;font-weight:800;text-transform:uppercase;margin:0 0 12px}
.aw-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px}
.aw-grid.three{grid-template-columns:repeat(3,minmax(0,1fr))}
.aw-card{border:1px solid var(--aw-border);background:white;border-radius:17px;padding:28px}
.aw-card h3{font-size:1.16rem;line-height:1.3;margin:0 0 12px}
.aw-card p{color:#49555b;margin:0}
.aw-card .num{color:#087d80;font-weight:800;font-size:.8rem;letter-spacing:.12em;margin-bottom:16px}
.aw-split{display:grid;grid-template-columns:1fr 1fr;gap:55px;align-items:start}
.aw-copy{color:#475158;font-size:1.06rem}
.aw-copy p{margin:0 0 18px}
.aw-metric-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:32px}
.aw-metric{border:1px solid var(--aw-border);border-radius:17px;padding:26px;background:white}
.aw-metric strong{display:block;font-size:clamp(2rem,4vw,3.3rem);letter-spacing:-.05em;line-height:1.15;margin:9px 0}
.aw-metric span{font-size:.9rem;color:var(--aw-muted)}
.aw-metric.featured{background:#eaf9f6;border-color:#c9efea}
.aw-note{font-size:.9rem;color:var(--aw-muted);margin-top:17px}
.aw-compare{display:grid;grid-template-columns:1fr 1fr;gap:22px}
.aw-compare-col{border:1px solid var(--aw-border);border-radius:18px;background:white;padding:30px}
.aw-compare-col.after{border-color:#ccebe6;background:#f2fbf9}
.aw-compare-col h3{font-size:1.25rem;margin:0 0 19px}
.aw-compare-col ul{padding-left:20px;margin:0;color:#465156}
.aw-compare-col li+li{margin-top:14px}
.aw-process{display:flex;align-items:stretch;gap:9px;margin:30px 0;flex-wrap:wrap}
.aw-process div{flex:1 1 150px;border:1px solid #d5eae7;background:#f0f8f7;border-radius:12px;padding:17px 13px;text-align:center;font-weight:700;font-size:.88rem}
.aw-process b{align-self:center;color:#087d80;font-size:1.4rem}
.aw-pillrow{display:flex;flex-wrap:wrap;gap:9px;margin-top:20px}
.aw-pill{background:#edf8f7;border:1px solid #d3eae7;border-radius:99px;padding:7px 12px;font-size:.83rem;color:#226265;font-weight:700}
.aw-highlight{border-left:5px solid var(--aw-teal);background:#eaf9f6;border-radius:0 14px 14px 0;padding:25px 28px;margin-top:26px}
.aw-highlight p{margin:0;color:#263c3e;font-size:1.08rem}
.aw-artifact{margin-top:26px;border:2px dashed #d4e4e3;background:#f9fcfc;border-radius:16px;padding:32px;text-align:center;color:#647175}
.aw-artifact strong{display:block;color:#243638;margin-bottom:6px}
.aw-footerline{font-size:clamp(1.4rem,3vw,2.1rem);line-height:1.4;font-weight:750;max-width:870px;margin:0}
@media(max-width:760px){.aw-hero{padding:65px 0 55px}.aw-section{padding:60px 0}.aw-meta,.aw-grid,.aw-grid.three,.aw-split,.aw-metric-grid,.aw-compare{grid-template-columns:1fr}.aw-meta{gap:18px;margin-top:36px}.aw-card,.aw-compare-col{padding:23px}.aw-process{flex-direction:column}.aw-process b{transform:rotate(90deg)}}
</style>
</head>
<body>
<?php include "head.php"; ?>
<?php include "navigation.php"; ?>
<main class="aw-page">
<header class="aw-hero"><div class="aw-wrap">
<p class="aw-kicker">Workflow Analysis / Process Improvement Case Study</p>
<h1>Improving the Amazon Order <span>Processing Workflow</span></h1>
<p class="aw-lede">Reducing repetitive order-entry work through system configuration, cross-functional collaboration, and targeted automation.</p>
<div class="aw-rule"></div>
<div class="aw-meta"><div><strong>My contribution</strong><p>Current-state analysis, problem identification, requirements input, cross-functional coordination, testing and process refinement</p></div><div><strong>Skills</strong><p>Workflow analysis, process improvement, stakeholder collaboration, systems thinking</p></div><div><strong>Systems</strong><p>Amazon Vendor Central, JD Edwards (JDE), internal automation tools</p></div></div>
</div></header>
<section class="aw-section"><div class="aw-wrap"><p class="aw-eyebrow">01 / Project Overview</p><div class="aw-split"><div><h2>Too many manual steps for every order.</h2></div><div class="aw-copy"><p>Processing Amazon purchase orders originally required roughly two full working days. Customer Service staff repeatedly entered carrier details, checked and canceled out-of-stock lines, scheduled shipments individually in Amazon Vendor Central, and copied shipment reference numbers back into JDE.</p><p>Because these steps were repeated across orders, the workflow was time-consuming and prone to avoidable rework. I helped identify opportunities to simplify the process and collaborated with JDE application specialists and an automation team on targeted improvements.</p></div></div>
<div class="aw-metric-grid"><div class="aw-metric"><span>Previous processing time</span><strong>2 days</strong><span>Per processing cycle</span></div><div class="aw-metric"><span>Current processing time</span><strong>1.25 days</strong><span>Per processing cycle</span></div><div class="aw-metric featured"><span>Reported time reduction</span><strong class="aw-highlight-number">37.5%</strong><span>Approximately 0.75 day saved per cycle</span></div></div><p class="aw-note">Time comparison is based on observed/reported workflow duration. The recently introduced AI-assisted ARN step is not separately attributed to this reduction.</p></div></section>
<section class="aw-section alt"><div class="aw-wrap"><p class="aw-eyebrow">02 / Problem Discovery</p><h2>Where the time went</h2><p class="aw-section-intro">The challenge was not a single broken feature. It was the cumulative effort of repeated manual actions across two systems.</p><div class="aw-grid"><article class="aw-card"><div class="num">01</div><h3>Re-entering carrier information</h3><p>Carrier information had to be entered into JDE for each purchase order, even when Amazon orders used a small, predictable set of carriers.</p></article><article class="aw-card"><div class="num">02</div><h3>Checking and canceling out-of-stock lines</h3><p>Employees manually reviewed availability and canceled unavailable items within individual orders.</p></article><article class="aw-card"><div class="num">03</div><h3>Scheduling shipments one by one</h3><p>Shipments were scheduled individually in Amazon Vendor Central, requiring repeated navigation and data entry.</p></article><article class="aw-card"><div class="num">04</div><h3>Copying ARN references into JDE</h3><p>After scheduling, staff manually transferred each ARN reference back into the corresponding JDE order.</p></article></div><div class="aw-highlight"><p><strong>Design question:</strong> How could we reduce repetitive entry while keeping employees in control of order accuracy, pricing, inventory exceptions, and shipment issues?</p></div></div></section>
<section class="aw-section"><div class="aw-wrap"><p class="aw-eyebrow">03 / Before & After</p><h2>Redesigning the work, not just the screen.</h2><div class="aw-compare"><div class="aw-compare-col"><h3>Before — Manual processing</h3><ul><li>Enter carrier details for each order</li><li>Manually inspect and cancel out-of-stock lines</li><li>Schedule shipments individually in Vendor Central</li><li>Copy each ARN back into JDE</li><li>Repeat the process for the next order</li></ul></div><div class="aw-compare-col after"><h3>After — Targeted automation</h3><ul><li>Standard carrier information is prefilled in JDE</li><li>JDE automatically cancels out-of-stock items</li><li>Employees validate order details and pricing</li><li>New AI-assisted tooling enters shipment ARNs into JDE</li><li>Teams handle exceptions when carrier, shipping, or Amazon support is needed</li></ul></div></div><div class="aw-process"><div>Order received in JDE</div><b>→</b><div>Carrier details populated</div><b>→</b><div>Out-of-stock lines canceled</div><b>→</b><div>Employee verifies order</div><b>→</b><div>Shipment scheduled / ARN recorded</div></div></div></section>
<section class="aw-section alt"><div class="aw-wrap"><p class="aw-eyebrow">04 / Key Contributions</p><h2>Three improvements, one smoother workflow.</h2><div class="aw-grid three"><article class="aw-card"><div class="num">01 / STANDARDIZATION</div><h3>Automatic carrier details</h3><p>Helped simplify order setup by using standardized carrier information in JDE for recurring Amazon shipping patterns, reducing repeated manual entry. Exceptions are handled with the relevant support teams.</p></article><article class="aw-card"><div class="num">02 / JDE COLLABORATION</div><h3>Automated stock cancellations</h3><p>Worked with the JDE applications team to develop functionality that automatically cancels out-of-stock order lines. Employees continue to verify the remaining items and pricing.</p></article><article class="aw-card"><div class="num">03 / AUTOMATION COLLABORATION</div><h3>AI-assisted ARN entry</h3><p>Collaborated with the automation team on a recently implemented tool that transfers shipment ARN references into JDE, replacing another repetitive Customer Service entry step.</p></article></div><div class="aw-artifact"><strong>Optional project visual</strong>Add a redacted JDE screenshot, a before-and-after workflow diagram, or a process map here. Replace this block with an &lt;img&gt; tag when ready.</div></div></section>
<section class="aw-section"><div class="aw-wrap"><p class="aw-eyebrow">05 / Outcomes</p><h2>Less data entry. More time for validation.</h2><div class="aw-split"><div class="aw-copy"><p>The processing cycle decreased from approximately two days to one and a quarter days—a reported reduction of <strong>37.5%</strong>. Standardizing recurring information and automating repetitive actions allowed the team to spend less time re-entering data.</p><p>Manual review still matters. Employees check item accuracy and pricing, and they coordinate with carriers, Shipping, or Amazon Support when exceptions arise.</p></div><div class="aw-card"><h3>What changed</h3><div class="aw-pillrow"><span class="aw-pill">Fewer repetitive entries</span><span class="aw-pill">Automated stock cancellation</span><span class="aw-pill">Standardized carrier setup</span><span class="aw-pill">Cross-team delivery</span><span class="aw-pill">AI-assisted ARN entry</span></div><p style="margin-top:20px">The ARN automation was implemented recently; its independent impact should be measured over future processing cycles.</p></div></div></div></section>
<section class="aw-section alt"><div class="aw-wrap"><p class="aw-eyebrow">06 / Reflection</p><h2>What I learned</h2><div class="aw-grid"><article class="aw-card"><h3>Look for repetition across the full journey</h3><p>Small manual actions can become major time costs when they are repeated across every purchase order.</p></article><article class="aw-card"><h3>Collaborate with system owners</h3><p>Working with JDE application specialists and the automation team made it possible to improve the process inside the systems employees already used.</p></article><article class="aw-card"><h3>Keep human review where it matters</h3><p>Automation reduced routine entry, while staff retained responsibility for checking order details and resolving exceptions.</p></article><article class="aw-card"><h3>Measure change carefully</h3><p>Comparing cycle times helped communicate progress. Future measurement can isolate the additional benefit of AI-assisted ARN entry.</p></article></div></div></section>
<section class="aw-section"><div class="aw-wrap"><p class="aw-eyebrow">Key Takeaway</p><p class="aw-footerline">A better workflow isn't always a new interface. Sometimes it's <span class="aw-highlight-number">removing repetitive steps</span> so people can focus on the decisions that actually need them.</p></div></section>
</main>
<hr>
<?php include "footer.php"; ?>
</body>
</html>
