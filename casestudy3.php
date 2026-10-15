<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A case study in coordinating Amazon EDI purchase order and shipment integration following a company merger.">
<title>Amazon EDI Integration | Portfolio</title>
<link rel="stylesheet" href="stylesheet.css">
<style>
:root{--ei-teal:#00b5b6;--ei-ink:#101417;--ei-muted:#526067;--ei-border:#e0e9e8;--ei-soft:#f6faf9}
.ei-page{font-family:inherit;color:var(--ei-ink);line-height:1.65;background:#fff;overflow:hidden}
.ei-wrap{width:min(1100px,calc(100% - 44px));margin:0 auto}
.ei-hero{padding:94px 0 76px;background:radial-gradient(circle at 91% 22%,#fff9df 0 20px,transparent 21px),radial-gradient(circle at 83% 68%,#f8eefa 0 32px,transparent 33px),#fff}
.ei-kicker,.ei-eyebrow{font-size:.78rem;font-weight:800;letter-spacing:.13em;text-transform:uppercase;color:#087e80;margin:0 0 14px}
.ei-hero h1{font-size:clamp(2.8rem,6vw,5.5rem);line-height:1.07;letter-spacing:-.055em;max-width:980px;margin:16px 0 22px}
.ei-hero h1 span,.ei-accent{color:var(--ei-teal)}
.ei-lede{font-size:clamp(1.12rem,2vw,1.34rem);max-width:790px;color:#45535a;margin:0}
.ei-rule{height:5px;width:95px;background:var(--ei-teal);border-radius:6px;margin:28px 0 0}
.ei-meta{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:25px;margin-top:56px}
.ei-meta>div{border-top:1px solid var(--ei-border);padding-top:17px}
.ei-meta strong{display:block;font-size:.76rem;letter-spacing:.1em;text-transform:uppercase;color:var(--ei-muted);margin-bottom:8px}
.ei-meta p{font-size:.96rem;margin:0}
.ei-section{padding:83px 0;border-top:1px solid var(--ei-border)}
.ei-section.alt{background:var(--ei-soft)}
.ei-section h2{font-size:clamp(2rem,4vw,3.25rem);line-height:1.13;letter-spacing:-.045em;margin:0 0 22px}
.ei-intro{font-size:1.08rem;color:var(--ei-muted);max-width:820px;margin:0 0 30px}
.ei-split{display:grid;grid-template-columns:1fr 1fr;gap:56px;align-items:start}
.ei-copy{font-size:1.055rem;color:#435158}.ei-copy p{margin:0 0 18px}
.ei-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px}
.ei-grid.three{grid-template-columns:repeat(3,minmax(0,1fr))}
.ei-card{background:#fff;border:1px solid var(--ei-border);border-radius:17px;padding:27px}
.ei-card h3{font-size:1.17rem;line-height:1.3;margin:0 0 12px}
.ei-card p{margin:0;color:#46545a}
.ei-number{font-size:.79rem;font-weight:800;letter-spacing:.12em;color:#087e80;margin:0 0 15px}
.ei-flow{display:flex;align-items:stretch;gap:10px;flex-wrap:wrap;margin:28px 0}
.ei-flow>div{flex:1 1 145px;border:1px solid #cce9e6;border-radius:13px;background:#f1faf9;padding:20px 14px;text-align:center}
.ei-flow strong{display:block;font-size:1rem;line-height:1.3;margin-bottom:8px}
.ei-flow span{display:block;font-size:.85rem;color:#506267}
.ei-flow>b{align-self:center;color:#088486;font-size:1.5rem}
.ei-callout{margin-top:26px;padding:25px 28px;border-left:5px solid var(--ei-teal);background:#eaf8f6;border-radius:0 14px 14px 0}
.ei-callout p{margin:0;font-size:1.07rem;color:#263c3d}
.ei-compare{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.ei-compare>div{padding:29px;border:1px solid var(--ei-border);border-radius:17px;background:#fff}
.ei-compare .after{background:#f0faf8;border-color:#cbe9e4}
.ei-compare h3{margin:0 0 14px;font-size:1.2rem}
.ei-compare ul{margin:0;padding-left:21px;color:#46545a}
.ei-compare li+li{margin-top:12px}
.ei-pills{display:flex;gap:9px;flex-wrap:wrap;margin-top:20px}
.ei-pills span{border-radius:99px;padding:7px 12px;border:1px solid #d0eae6;background:#edf9f7;color:#266367;font-weight:700;font-size:.83rem}
.ei-artifact{margin-top:28px;border:2px dashed #d4e5e2;background:#fafdfc;padding:30px;border-radius:15px;text-align:center;color:#657377}
.ei-artifact strong{display:block;color:#253739;margin-bottom:6px}
.ei-final{font-size:clamp(1.5rem,3vw,2.15rem);line-height:1.4;font-weight:750;max-width:890px;margin:0}
@media(max-width:760px){.ei-hero{padding:66px 0 55px}.ei-section{padding:58px 0}.ei-meta,.ei-grid,.ei-grid.three,.ei-split,.ei-compare{grid-template-columns:1fr}.ei-meta{margin-top:36px;gap:18px}.ei-card{padding:23px}.ei-flow{flex-direction:column}.ei-flow>b{transform:rotate(90deg)}}
</style>
</head>
<body>
<?php include "head.php"; ?>
<?php include "navigation.php"; ?>
<main class="ei-page">
<header class="ei-hero"><div class="ei-wrap">
<p class="ei-kicker">Systems Integration / Cross-Functional Workflow Case Study</p>
<h1>Integrating Amazon <span>EDI Order Workflows</span> After a Merger</h1>
<p class="ei-lede">Coordinating technical requirements, item setup, testing, and issue resolution to bring an acquired company's Amazon purchase orders and shipment communications into an existing ERP workflow.</p>
<div class="ei-rule"></div>
<div class="ei-meta"><div><strong>My role</strong><p>Requirements coordination, Amazon Support liaison, EDI and item setup support, integration testing, troubleshooting</p></div><div><strong>Skills</strong><p>Requirements gathering, root-cause analysis, systems thinking, stakeholder coordination, validation</p></div><div><strong>Systems</strong><p>Amazon Vendor Central, EDI 850 / 856, JD Edwards (JDE), internal item master and EDI processes</p></div></div>
</div></header>
<section class="ei-section"><div class="ei-wrap"><p class="ei-eyebrow">01 / Project Overview</p><div class="ei-split"><div><h2>One retail operation. Two different levels of integration.</h2></div><div class="ei-copy"><p>Following a company merger, our Retail department needed to support Amazon orders for products from the newly integrated company. Our existing Amazon business already had EDI workflows in place, but the acquired company's orders and items were not yet configured to move through the same process.</p><p>I helped bridge communication between Amazon Support, the EDI team, item setup teams, and internal stakeholders to understand Amazon's requirements, support configuration, test transactions, and troubleshoot exceptions.</p><p>The goal was to make incoming orders and outgoing shipment information flow reliably through our existing systems, reducing the need for manual intervention.</p></div></div></div></section>
<section class="ei-section alt"><div class="ei-wrap"><p class="ei-eyebrow">02 / The Challenge</p><h2>Integration required more than turning on EDI.</h2><p class="ei-intro">The acquired business needed coordinated setup across trading-partner requirements, product records, and shipment communication before orders could be processed consistently.</p><div class="ei-grid"><article class="ei-card"><div class="ei-number">01 / ORDER INTAKE</div><h3>Purchase order transactions</h3><p>Amazon EDI 850 purchase orders needed to be configured and validated so orders for the integrated company could enter the internal workflow.</p></article><article class="ei-card"><div class="ei-number">02 / ITEM SETUP</div><h3>Product identifiers and mapping</h3><p>Item records and related EDI mappings needed to align so incoming Amazon orders could be recognized and processed accurately.</p></article><article class="ei-card"><div class="ei-number">03 / SHIPPING</div><h3>Shipment notices and requirements</h3><p>EDI 856 Advance Ship Notice (ASN) requirements had to be coordinated with Amazon and internal teams to support shipment communication.</p></article><article class="ei-card"><div class="ei-number">04 / EXCEPTIONS</div><h3>Errors across team boundaries</h3><p>Integration and shipping issues required investigation across Amazon Support, EDI, JDE, and operational teams rather than a single point of resolution.</p></article></div><div class="ei-callout"><p><strong>Project question:</strong> How could we extend an existing Amazon order workflow to newly integrated products while ensuring the required transaction setup, product data, and shipment communication were working together?</p></div></div></section>
<section class="ei-section"><div class="ei-wrap"><p class="ei-eyebrow">03 / Workflow Understanding</p><h2>Connecting the order-to-shipment journey.</h2><p class="ei-intro">The work involved coordinating several connected steps, each with different owners and technical requirements.</p><div class="ei-flow"><div><strong>Amazon</strong><span>Purchase order created</span></div><b>→</b><div><strong>EDI 850</strong><span>Order transmitted and mapped</span></div><b>→</b><div><strong>JDE</strong><span>Order and item data processed</span></div><b>→</b><div><strong>Shipping</strong><span>Shipment prepared</span></div><b>→</b><div><strong>EDI 856</strong><span>ASN sent to Amazon</span></div></div><p class="ei-intro">This is a simplified representation of the business workflow, not a technical specification of the EDI architecture.</p><div class="ei-compare"><div><h3>Before — Integration gap</h3><ul><li>Existing Amazon EDI setup did not cover the newly integrated company</li><li>New product records and mappings required coordination</li><li>Order and shipment transactions needed validation</li><li>Issues could interrupt processing or require manual follow-up</li></ul></div><div class="after"><h3>Target state — Connected workflow</h3><ul><li>Amazon transaction requirements understood and communicated</li><li>EDI 850 and 856 processes configured and tested</li><li>New items correctly recognized in the internal workflow</li><li>Exceptions investigated and routed to the appropriate teams</li></ul></div></div></div></section>
<section class="ei-section alt"><div class="ei-wrap"><p class="ei-eyebrow">04 / Key Contributions</p><h2>Turning requirements into a working process.</h2><div class="ei-grid three"><article class="ei-card"><div class="ei-number">01 / DISCOVERY</div><h3>Clarified Amazon EDI requirements</h3><p>Communicated with Amazon Support to understand what was needed for purchase order and shipment transactions, then relayed requirements to the internal EDI team.</p></article><article class="ei-card"><div class="ei-number">02 / COORDINATION</div><h3>Supported EDI 850 and 856 setup</h3><p>Worked across teams to support incoming purchase order configuration and outbound ASN requirements for the newly integrated business.</p></article><article class="ei-card"><div class="ei-number">03 / DATA QUALITY</div><h3>Coordinated item setup</h3><p>Communicated with internal teams to help ensure newly integrated products were configured and mapped correctly for EDI processing.</p></article><article class="ei-card"><div class="ei-number">04 / VALIDATION</div><h3>Tested transaction flow</h3><p>Helped test and validate that orders could move through the intended process, identifying issues that required additional configuration or correction.</p></article><article class="ei-card"><div class="ei-number">05 / TROUBLESHOOTING</div><h3>Investigated integration errors</h3><p>Partnered with EDI coordinators, JDE specialists, and Amazon Support to investigate vendor, item, or mapping discrepancies that interrupted processing.</p></article><article class="ei-card"><div class="ei-number">06 / OPERATIONS</div><h3>Supported shipping issue resolution</h3><p>Helped coordinate follow-up when shipment-related problems arose, connecting operational questions with the teams responsible for resolving them.</p></article></div></div></section>
<section class="ei-section"><div class="ei-wrap"><p class="ei-eyebrow">05 / Testing & Iteration</p><h2>Validate, investigate, refine.</h2><div class="ei-split"><div class="ei-copy"><p>EDI integration was not a one-step change. Successful setup required validating the behavior of the full workflow, from the Amazon purchase order through internal processing and shipment communication.</p><p>When transactions did not behave as expected, I helped identify where the issue appeared, communicate findings to the relevant system owners, and coordinate retesting after corrections.</p></div><div class="ei-card"><h3>Areas reviewed during testing</h3><div class="ei-pills"><span>850 purchase orders</span><span>856 ASNs</span><span>Item mapping</span><span>Vendor setup</span><span>JDE order flow</span><span>Shipping exceptions</span></div><p style="margin-top:20px">Technical configuration was handled in collaboration with the responsible EDI and application teams.</p></div></div></div></section>
<section class="ei-section alt"><div class="ei-wrap"><p class="ei-eyebrow">06 / Outcomes</p><h2>Expanded integration across the retail business.</h2><p class="ei-intro">The project supported the successful setup and testing of Amazon EDI order processing for the integrated company's products.</p><div class="ei-grid"><article class="ei-card"><h3>Connected transaction requirements</h3><p>Coordinated Amazon's purchase order and shipment notice requirements with the teams responsible for the internal EDI configuration.</p></article><article class="ei-card"><h3>Supported accurate product setup</h3><p>Helped resolve item-level and mapping issues that could prevent orders from being processed as intended.</p></article><article class="ei-card"><h3>Validated order processing</h3><p>Participated in testing and troubleshooting to help establish a functioning order and shipment workflow.</p></article><article class="ei-card"><h3>Reduced reliance on workarounds</h3><p>Helped move newly integrated products toward the existing automated process instead of depending on separate manual handling.</p></article></div><p class="ei-intro" style="margin-top:26px">No specific error-rate or time-savings percentage is claimed here because those outcomes were not separately measured.</p></div></section>
<section class="ei-section"><div class="ei-wrap"><p class="ei-eyebrow">07 / Reflection</p><h2>What this project taught me.</h2><div class="ei-grid"><article class="ei-card"><h3>Requirements are shared across systems</h3><p>A purchase order can depend on trading-partner rules, item master data, EDI mappings, and downstream operational processes all aligning.</p></article><article class="ei-card"><h3>Clear communication accelerates troubleshooting</h3><p>Understanding the issue and bringing the right teams together was just as important as knowing which system displayed the error.</p></article><article class="ei-card"><h3>Testing must follow the full workflow</h3><p>Validating one transaction step is not enough when downstream shipment communication depends on upstream setup.</p></article><article class="ei-card"><h3>Operational experience informs systems design</h3><p>Working directly with order processing helped me recognize where technical integration gaps affected employees' daily work.</p></article></div></div></section>
<section class="ei-section alt"><div class="ei-wrap"><p class="ei-eyebrow">Key Takeaway</p><p class="ei-final">Successful systems integration requires more than technical configuration. It takes <span class="ei-accent">clear requirements, coordinated teams, and end-to-end validation</span> to make a workflow dependable.</p></div></section>
</main>
<hr>
<?php include "footer.php"; ?>
</body>
</html>
