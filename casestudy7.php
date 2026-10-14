<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A UX and service design case study on building a scalable retail content management and request system.">
  <title>Retail Content System | Tanay Bradley</title>
  <link rel="stylesheet" href="stylesheet.css">
  <style>
    :root{--rc-ink:#111315;--rc-muted:#59636a;--rc-teal:#00b5b6;--rc-teal-dark:#087b7e;--rc-line:#e6eaec;--rc-soft:#f7faf9;--rc-lilac:#f6eff9;--rc-yellow:#fff9df;--rc-blue:#edf5ff}
    .rc-page{color:var(--rc-ink);font-family:inherit;line-height:1.65;overflow:hidden}
    .rc-container{width:min(1120px,calc(100% - 48px));margin-inline:auto}
    .rc-hero{position:relative;padding:95px 0 70px;background:radial-gradient(circle at 93% 20%,#fff8d9 0 15px,transparent 16px),radial-gradient(circle at 80% 78%,#f6eaf4 0 27px,transparent 28px),#fff}
    .rc-eyebrow{display:inline-block;color:var(--rc-teal-dark);font-size:.8rem;font-weight:800;letter-spacing:.17em;text-transform:uppercase;margin-bottom:20px}
    .rc-hero h1{max-width:900px;margin:0;font-size:clamp(2.6rem,6vw,5.6rem);line-height:1.08;letter-spacing:-.055em;font-weight:800}
    .rc-hero h1 em{color:var(--rc-teal);font-style:normal}
    .rc-lede{font-size:clamp(1.08rem,1.8vw,1.32rem);max-width:780px;margin:28px 0 0;color:#41494d;line-height:1.7}
    .rc-accent{height:5px;width:85px;background:var(--rc-teal);border-radius:20px;margin:28px 0}
    .rc-meta{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:20px;margin-top:55px}
    .rc-meta-item{border-top:1px solid var(--rc-line);padding-top:17px}
    .rc-meta-label,.rc-small-label{display:block;color:var(--rc-muted);font-size:.72rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase;margin-bottom:9px}
    .rc-meta-item p{margin:0;font-size:.95rem;line-height:1.6}
    .rc-section{padding:85px 0;border-top:1px solid var(--rc-line)}
    .rc-section--soft{background:var(--rc-soft)}
    .rc-section-head{margin-bottom:35px;max-width:760px}
    .rc-kicker{color:var(--rc-teal-dark);font-weight:800;letter-spacing:.14em;font-size:.76rem;text-transform:uppercase;margin:0 0 10px}
    .rc-section h2{font-size:clamp(2rem,4vw,3.4rem);letter-spacing:-.045em;line-height:1.13;margin:0 0 17px}
    .rc-section-head>p:last-child{color:var(--rc-muted);font-size:1.1rem;margin:0}
    .rc-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:22px}
    .rc-grid--3{grid-template-columns:repeat(3,minmax(0,1fr))}
    .rc-card{background:#fff;border:1px solid var(--rc-line);border-radius:18px;padding:30px;box-shadow:0 10px 28px rgba(16,39,40,.025)}
    .rc-card h3{font-size:1.18rem;line-height:1.3;margin:0 0 12px;letter-spacing:-.015em}
    .rc-card p{margin:0;color:#465156}
    .rc-card-number{color:var(--rc-teal-dark);font-size:.78rem;font-weight:800;letter-spacing:.1em;margin-bottom:20px}
    .rc-highlight{background:#e9f8f6;border-left:5px solid var(--rc-teal);padding:26px 30px;border-radius:0 14px 14px 0;margin-top:30px}
    .rc-highlight strong{display:block;margin-bottom:8px}
    .rc-highlight p{margin:0;font-size:1.08rem}
    .rc-copy{max-width:790px;color:#41494d;font-size:1.06rem}
    .rc-copy p{margin:0 0 18px}
    .rc-pill-list{display:flex;flex-wrap:wrap;gap:10px;margin-top:18px}
    .rc-pill{padding:7px 13px;background:#eef7f6;border:1px solid #d8efeb;border-radius:99px;font-size:.84rem;font-weight:650;color:#215e5f}
    .rc-research{display:grid;grid-template-columns:1fr 1fr;gap:22px}
    .rc-research .rc-card:first-child{background:var(--rc-blue)}
    .rc-research .rc-card:last-child{background:var(--rc-lilac)}
    .rc-card ul{padding-left:20px;margin:14px 0 0;color:#465156}
    .rc-card li+li{margin-top:9px}
    .rc-split{display:grid;grid-template-columns:.9fr 1.1fr;gap:50px;align-items:start}
    .rc-steps{counter-reset:step;display:grid;gap:12px;margin-top:24px}
    .rc-step{display:grid;grid-template-columns:42px 1fr;gap:15px;align-items:start;background:#fff;border:1px solid var(--rc-line);border-radius:14px;padding:17px}
    .rc-step::before{counter-increment:step;content:counter(step,decimal-leading-zero);font-weight:800;color:var(--rc-teal-dark);font-size:.9rem}
    .rc-step p{margin:0;color:#465156}
    .rc-step strong{color:var(--rc-ink)}
    .rc-diagram{background:#fff;border:1px solid var(--rc-line);border-radius:18px;padding:27px;margin-top:26px}
    .rc-diagram-title{font-size:.78rem;letter-spacing:.1em;text-transform:uppercase;color:var(--rc-muted);font-weight:800;margin:0 0 17px}
    .rc-flow{display:flex;gap:10px;align-items:stretch;flex-wrap:wrap}
    .rc-flow-node{flex:1 1 140px;min-width:125px;background:#f1f8f7;border:1px solid #d4eae6;border-radius:12px;padding:15px;text-align:center;font-size:.88rem;font-weight:700;line-height:1.4}
    .rc-flow-arrow{display:flex;align-items:center;justify-content:center;color:var(--rc-teal-dark);font-size:1.5rem;font-weight:800}
    .rc-artifact{border:2px dashed #d5e3e3;border-radius:18px;min-height:210px;display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center;padding:25px;background:linear-gradient(145deg,#fbfefe,#f3f9f9);color:#5d6b6d;margin-top:25px}
    .rc-artifact strong{color:#24393b;font-size:1.05rem}
    .rc-artifact span{max-width:450px;font-size:.9rem;margin-top:7px}
    .rc-outcomes{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:13px}
    .rc-outcome{border-bottom:1px solid var(--rc-line);padding:15px 0 15px 27px;position:relative;font-weight:650}
    .rc-outcome:before{content:'✓';position:absolute;left:0;color:var(--rc-teal-dark);font-weight:900}
    .rc-note{color:var(--rc-muted);font-size:.93rem;margin-top:25px}
    .rc-footer-quote{font-size:clamp(1.5rem,3vw,2.3rem);font-weight:750;line-height:1.35;letter-spacing:-.025em;max-width:920px;margin:0}
    .rc-footer-quote span{color:var(--rc-teal-dark)}
    @media(max-width:760px){.rc-container{width:min(100% - 32px,1120px)}.rc-hero{padding:65px 0 55px}.rc-section{padding:62px 0}.rc-meta,.rc-grid,.rc-grid--3,.rc-research,.rc-split,.rc-outcomes{grid-template-columns:1fr}.rc-meta{gap:18px;margin-top:40px}.rc-card{padding:23px}.rc-flow{flex-direction:column}.rc-flow-arrow{transform:rotate(90deg)}.rc-flow-node{flex:auto;min-width:0}.rc-split{gap:20px}}
    @media(prefers-reduced-motion:no-preference){.rc-card{transition:transform .2s ease,box-shadow .2s ease}.rc-card:hover{transform:translateY(-3px);box-shadow:0 16px 30px rgba(16,39,40,.06)}}
  </style>
</head>
<body>
  <?php include "head.php"; ?>
  <?php include "navigation.php"; ?>
  <main class="rc-page" id="main-content">
    <header class="rc-hero">
      <div class="rc-container">
        <span class="rc-eyebrow">UX / Service Design Case Study</span>
        <h1>Designing a Scalable <em>Retail Content</em> Request System</h1>
        <div class="rc-accent"></div>
        <p class="rc-lede">From scattered files and repeated requests to a centralized, searchable content experience—designed around how Retail and Graphic Design teams actually work.</p>
        <div class="rc-meta">
          <div class="rc-meta-item"><span class="rc-meta-label">My role</span><p>Stakeholder discovery, information architecture, workflow design, automation development, testing</p></div>
          <div class="rc-meta-item"><span class="rc-meta-label">Skills</span><p>UX research, service design, process improvement, cross-functional collaboration</p></div>
          <div class="rc-meta-item"><span class="rc-meta-label">Tools</span><p>SharePoint, Power Automate, Excel, Power BI</p></div>
        </div>
      </div>
    </header>

    <section class="rc-section" aria-labelledby="overview-title">
      <div class="rc-container rc-split">
        <div class="rc-section-head"><p class="rc-kicker">01 / Context</p><h2 id="overview-title">Project overview</h2><p>A content system built for a growing retail organization.</p></div>
        <div class="rc-copy"><p>Following a company merger, the retail organization needed a more efficient way to access, organize, manage, and distribute product assets across a larger catalog.</p><p>Retail employees previously requested files through a central Marketing contact using email, Teams, spreadsheets, and shared folders. Graphic designers stored assets in Dropbox folders organized by item number.</p><p>I designed and implemented a SharePoint-based retail content system to make assets easier to find, prepare, submit, and manage—while supporting future catalog growth.</p></div>
      </div>
    </section>

    <section class="rc-section rc-section--soft" aria-labelledby="problem-title">
      <div class="rc-container"><div class="rc-section-head"><p class="rc-kicker">02 / The challenge</p><h2 id="problem-title">What wasn't working?</h2><p>The original process depended on manual coordination and folder-by-folder navigation.</p></div>
        <div class="rc-grid">
          <article class="rc-card"><div class="rc-card-number">01 / ACCESS</div><h3>Repeated requests for the same content</h3><p>Retail employees relied on another team to locate and send files, even when those assets had already been shared before.</p></article>
          <article class="rc-card"><div class="rc-card-number">02 / DISCOVERABILITY</div><h3>Folders without useful filtering</h3><p>Dropbox organized products by item number, but users couldn't easily filter across products to retrieve all data sheets, safety sheets, or main images.</p></article>
          <article class="rc-card"><div class="rc-card-number">03 / PREPARATION</div><h3>Extra steps before customer delivery</h3><p>Employees needed customer-ready file names and faster ways to collect multiple assets without repeated navigation and renaming.</p></article>
          <article class="rc-card"><div class="rc-card-number">04 / SCALE</div><h3>A growing catalog after the merger</h3><p>The combined product portfolio made the existing request-and-folder approach harder to maintain and audit.</p></article>
        </div>
        <div class="rc-highlight"><strong>Design challenge</strong><p>How might we make retail content easier to find, manage, and distribute while supporting the different needs of Retail and Graphic Design?</p></div>
      </div>
    </section>

    <section class="rc-section" aria-labelledby="research-title">
      <div class="rc-container"><div class="rc-section-head"><p class="rc-kicker">03 / Discovery</p><h2 id="research-title">Learning from the people doing the work</h2><p>I met with stakeholders before defining the system structure.</p></div>
        <div class="rc-research">
          <article class="rc-card"><div class="rc-card-number">STAKEHOLDER GROUP A</div><h3>Graphic Design</h3><p>I reviewed the team's Dropbox setup and discussed what they needed from a new content environment.</p><ul><li>Product folders were named by item number.</li><li>Asset-type filtering and bulk retrieval were limited.</li><li>Designers needed a structure that supported organization and auditing.</li></ul></article>
          <article class="rc-card"><div class="rc-card-number">STAKEHOLDER GROUP B</div><h3>Retail</h3><p>I discussed how employees retrieve assets and prepare content for retail customers.</p><ul><li>Direct, self-service access was a priority.</li><li>Fewer clicks and bulk downloads would simplify retrieval.</li><li>Consistent file names would reduce preparation before sharing.</li></ul></article>
        </div>
        <div class="rc-diagram"><p class="rc-diagram-title">Research translated into system requirements</p><div class="rc-pill-list"><span class="rc-pill">Centralized access</span><span class="rc-pill">Searchable metadata</span><span class="rc-pill">Asset-type views</span><span class="rc-pill">Bulk downloads</span><span class="rc-pill">Standardized naming</span><span class="rc-pill">Automated intake &amp; review</span></div></div>
      </div>
    </section>

    <section class="rc-section rc-section--soft" aria-labelledby="architecture-title">
      <div class="rc-container"><div class="rc-section-head"><p class="rc-kicker">04 / System design</p><h2 id="architecture-title">Two connected experiences. One content system.</h2><p>I separated where files enter the system from where employees retrieve finished content.</p></div>
        <div class="rc-grid">
          <article class="rc-card"><div class="rc-card-number">INPUT / ASSET INTAKE</div><h3>A structured place to submit content</h3><p>Files enter through category-specific folders: Needs Review, Packaging, Product Data Sheets, Product Images, and Safety Data Sheets. Subfolders identify types such as Box Label, MAIN, FRONT, BACK, and PT01.</p></article>
          <article class="rc-card"><div class="rc-card-number">OUTPUT / PRODUCT CONTENT</div><h3>A searchable destination for product assets</h3><p>Each product has a Document Set associated with item number, UPC, ASIN, brand, and category. Employees can use metadata and views to locate and download relevant content.</p></article>
        </div>
        <div class="rc-diagram"><p class="rc-diagram-title">How the two parts connect</p><div class="rc-flow"><div class="rc-flow-node">Upload to asset-type folder</div><div class="rc-flow-arrow" aria-hidden="true">→</div><div class="rc-flow-node">Identify product &amp; asset type</div><div class="rc-flow-arrow" aria-hidden="true">→</div><div class="rc-flow-node">Rename &amp; route automatically</div><div class="rc-flow-arrow" aria-hidden="true">→</div><div class="rc-flow-node">Find in Product Content</div></div></div>
        <div class="rc-artifact">
    <img
        src="images/8539.jpg"
        alt="SharePoint retail content management system"
        style="width:100%; height:auto; display:block; border-radius:12px;"
    >
</div>
<div class="rc-artifact">
    <img
        src="images/8542.jpg"
        alt="SharePoint retail content management system"
        style="width:100%; height:auto; display:block; border-radius:12px;"
    >
</div>
<div class="rc-artifact">
    <img
        src="images/8543.jpg"
        alt="SharePoint retail content management system"
        style="width:100%; height:auto; display:block; border-radius:12px;"
    >
</div>
        <div class="rc-highlight"><strong>A deliberate design decision: customer-ready names</strong><p>Files follow a consistent pattern such as <code>ItemNumber_UPC_MAIN</code> or <code>ItemNumber_UPC_BOX LABEL</code>, reducing the need for employees to rename assets before sharing them.</p></div>
      </div>
    </section>

    <section class="rc-section" aria-labelledby="implementation-title">
      <div class="rc-container"><div class="rc-section-head"><p class="rc-kicker">05 / Implementation</p><h2 id="implementation-title">Turning the design into a working workflow</h2><p>Two Power Automate processes connect product records, file intake, and the content library.</p></div>
        <div class="rc-grid">
          <article class="rc-card"><div class="rc-card-number">FLOW 01</div><h3>Create product Document Sets</h3><div class="rc-steps"><div class="rc-step"><p><strong>Read product records</strong> from the centralized Excel table.</p></div><div class="rc-step"><p><strong>Check SharePoint</strong> for an existing Document Set.</p></div><div class="rc-step"><p><strong>Create or update</strong> the product structure and metadata as appropriate.</p></div></div></article>
          <article class="rc-card"><div class="rc-card-number">FLOW 02</div><h3>Process incoming assets</h3><div class="rc-steps"><div class="rc-step"><p><strong>Detect the intake category</strong> and identify the product.</p></div><div class="rc-step"><p><strong>Look up item information</strong> and apply a consistent file name.</p></div><div class="rc-step"><p><strong>Route the file</strong> to its product location, with review for processing issues.</p></div></div></article>
        </div>
        <div class="rc-artifact">
    <img
        src="images/8358.jpg"
        alt="SharePoint retail content management system"
        style="width:100%; height:auto; display:block; border-radius:12px;"
    >
</div>
<div class="rc-artifact">
    <img
        src="images/869.jpg"
        alt="SharePoint retail content management system"
        style="width:100%; height:auto; display:block; border-radius:12px;"
    >
</div>
        <div class="rc-copy" style="margin-top:32px"><h3>Testing and iteration</h3><p>I tested the relationships between Excel data, SharePoint metadata, and automated actions. Troubleshooting included missing item information, mismatched asset categories, blank file paths, and conditional behavior. These investigations informed refinements to the intake structure and processing logic.</p></div>
      </div>
    </section>

    <section class="rc-section rc-section--soft" aria-labelledby="priorities-title">
      <div class="rc-container rc-split"><div class="rc-section-head"><p class="rc-kicker">06 / Rollout strategy</p><h2 id="priorities-title">Using sales data to decide what came first</h2><p>Building a system was only one part of the challenge. The content rollout needed a clear priority.</p></div>
        <div><div class="rc-copy"><p>I reviewed item-level retail sales information in Power BI and used it to identify which retail customer should receive content updates first.</p><p>Rather than uploading assets without a plan, I prioritized the retailer with the highest relevant item sales and organized the initial migration around those products.</p></div>
          <div class="rc-diagram"><p class="rc-diagram-title">Phased rollout</p><div class="rc-steps"><div class="rc-step"><p>Review retailer and item-level sales</p></div><div class="rc-step"><p>Identify priority products and customer</p></div><div class="rc-step"><p>Prepare and upload relevant content</p></div><div class="rc-step"><p>Expand to additional retail customers</p></div></div></div>
        </div></div>
    </section>

    <section class="rc-section" aria-labelledby="outcomes-title">
      <div class="rc-container"><div class="rc-section-head"><p class="rc-kicker">07 / Outcomes</p><h2 id="outcomes-title">What the system now makes possible</h2><p>The project established a structured foundation for retail-specific content management.</p></div>
        <div class="rc-outcomes"><div class="rc-outcome">Centralized access for retail content</div><div class="rc-outcome">Product-level metadata and searchable views</div><div class="rc-outcome">Standardized file naming</div><div class="rc-outcome">Automated Document Set creation</div><div class="rc-outcome">Automated asset classification and routing</div><div class="rc-outcome">Bulk retrieval and a review path for exceptions</div></div>
        <p class="rc-note">These are delivered system capabilities, not measured performance gains. Time saved, adoption, and error reduction can be evaluated as usage grows.</p>
      </div>
    </section>

    <section class="rc-section rc-section--soft" aria-labelledby="reflection-title">
      <div class="rc-container"><div class="rc-section-head"><p class="rc-kicker">08 / Reflection</p><h2 id="reflection-title">What I learned</h2></div>
        <div class="rc-grid rc-grid--3"><article class="rc-card"><h3>Research before building</h3><p>Understanding the existing tools, data, and employee workflows helped me make more informed system decisions.</p></article><article class="rc-card"><h3>Design for different users</h3><p>Retail needed fast retrieval and customer-ready assets; designers needed organization and auditability.</p></article><article class="rc-card"><h3>Deliver value in phases</h3><p>Sales-based prioritization and iterative testing made it possible to progress on a long-term project without waiting for every asset to be migrated.</p></article></div>
        <div class="rc-highlight" style="margin-top:40px"><p class="rc-footer-quote">Better UX isn't always a new interface. Sometimes it's <span>removing friction from the way people work.</span></p></div>
      </div>
    </section>
  </main>
  <hr>
  <?php include "footer.php"; ?>
</body>
</html>
