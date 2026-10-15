<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="UX case study: redesigning the RectorSeal customer login and account request experience.">
<title>Website Login UX Redesign | Tanay Bradley</title>
<link rel="stylesheet" href="stylesheet.css">
<style>
:root{--ux-teal:#00b5b6;--ux-ink:#101417;--ux-muted:#526067;--ux-border:#e0e9e8;--ux-soft:#f6faf9}
.ux-page{font-family:inherit;color:var(--ux-ink);line-height:1.65;background:#fff;overflow:hidden}
.ux-page *{box-sizing:border-box}
.ux-wrap{width:min(1100px,calc(100% - 44px));margin:0 auto}
.ux-hero{padding:94px 0 76px;background:radial-gradient(circle at 91% 22%,#fff9df 0 20px,transparent 21px),radial-gradient(circle at 83% 68%,#f8eefa 0 32px,transparent 33px),#fff}
.ux-kicker,.ux-eyebrow{font-size:.78rem;font-weight:800;letter-spacing:.13em;text-transform:uppercase;color:#087e80;margin:0 0 14px}
.ux-hero h1{font-size:clamp(2.8rem,6vw,5.5rem);line-height:1.07;letter-spacing:-.055em;max-width:980px;margin:16px 0 22px}
.ux-hero h1 span,.ux-accent{color:var(--ux-teal)}
.ux-lede{font-size:clamp(1.12rem,2vw,1.34rem);max-width:790px;color:#45535a;margin:0}
.ux-rule{height:5px;width:95px;background:var(--ux-teal);border-radius:6px;margin:28px 0 0}
.ux-meta{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:25px;margin-top:56px}
.ux-meta>div{border-top:1px solid var(--ux-border);padding-top:17px}
.ux-meta strong{display:block;font-size:.76rem;letter-spacing:.1em;text-transform:uppercase;color:var(--ux-muted);margin-bottom:8px}
.ux-meta p{font-size:.96rem;margin:0}
.ux-section{padding:83px 0;border-top:1px solid var(--ux-border)}
.ux-section.alt{background:var(--ux-soft)}
.ux-section h2{font-size:clamp(2rem,4vw,3.25rem);line-height:1.13;letter-spacing:-.045em;margin:0 0 22px}
.ux-intro{font-size:1.08rem;color:var(--ux-muted);max-width:820px;margin:0 0 30px}
.ux-split{display:grid;grid-template-columns:1fr 1fr;gap:56px;align-items:start}
.ux-copy{font-size:1.055rem;color:#435158}.ux-copy p{margin:0 0 18px}
.ux-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px}
.ux-grid.three{grid-template-columns:repeat(3,minmax(0,1fr))}
.ux-card{background:#fff;border:1px solid var(--ux-border);border-radius:17px;padding:27px}
.ux-card h3{font-size:1.17rem;line-height:1.3;margin:0 0 12px}
.ux-card p{margin:0;color:#46545a}
.ux-number{font-size:.79rem;font-weight:800;letter-spacing:.12em;color:#087e80;margin:0 0 15px}
.ux-callout{margin-top:26px;padding:25px 28px;border-left:5px solid var(--ux-teal);background:#eaf8f6;border-radius:0 14px 14px 0}
.ux-callout p{margin:0;font-size:1.07rem;color:#263c3d}
.ux-compare{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.ux-compare>div{padding:29px;border:1px solid var(--ux-border);border-radius:17px;background:#fff}
.ux-compare .after{background:#f0faf8;border-color:#cbe9e4}
.ux-compare h3{margin:0 0 14px;font-size:1.2rem}
.ux-compare ul{margin:0;padding-left:21px;color:#46545a}
.ux-compare li+li{margin-top:12px}
.ux-shot{margin:0 0 38px}
.ux-shot-head{display:flex;align-items:center;justify-content:space-between;gap:14px;margin-bottom:14px}
.ux-shot-head h3{margin:0;font-size:1.2rem}
.ux-shot-label{font-size:.77rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:#087e80}
.ux-shot-frame{border:1px solid var(--ux-border);border-radius:17px;background:#fff;padding:14px;overflow:hidden}
.ux-shot-frame img{display:block;width:100%;height:auto;border-radius:7px}
.ux-shot figcaption{font-size:.94rem;color:var(--ux-muted);margin-top:12px}
.ux-final{font-size:clamp(1.5rem,3vw,2.15rem);line-height:1.4;font-weight:750;max-width:890px;margin:0}
@media(max-width:760px){.ux-hero{padding:66px 0 55px}.ux-section{padding:58px 0}.ux-meta,.ux-grid,.ux-grid.three,.ux-split,.ux-compare{grid-template-columns:1fr}.ux-meta{margin-top:36px;gap:18px}.ux-card{padding:23px}.ux-shot-frame{padding:7px}}
</style>
</head>
<body>
<?php include "head.php"; ?>
<?php include "navigation.php"; ?>
<main class="ux-page">
<header class="ux-hero"><div class="ux-wrap">
<p class="ux-kicker">UX / UI Design Case Study</p>
<h1>Website Login <span>Experience Redesign</span></h1>
<p class="ux-lede">Making a customer login page easier to scan and use through clearer language, stronger visual hierarchy, and more purposeful form design.</p>
<div class="ux-rule"></div>
<div class="ux-meta">
<div><strong>Project</strong><p>Academic redesign of the RectorSeal customer login and account request page</p></div>
<div><strong>My role</strong><p>Usability evaluation, content simplification, interface redesign</p></div>
<div><strong>Skills</strong><p>UX/UI design, heuristic evaluation, visual hierarchy, UX writing, form design</p></div>
</div></div></header>

<section class="ux-section"><div class="ux-wrap"><p class="ux-eyebrow">01 / Project Overview</p><div class="ux-split"><div><h2>Making a familiar task feel simpler.</h2></div><div class="ux-copy"><p>For a school UX design assignment, I chose to evaluate a real customer-facing form on RectorSeal's website, where I worked. The page allowed existing customers to sign in and new customers to request an account.</p><p>As I reviewed the interface, I noticed repeated instructions, extra required-field messaging, and an opportunity to make the account request benefits easier to understand.</p><p>I created a redesigned concept that kept the company's existing branding while making the two primary tasks clearer: <strong>sign in</strong> or <strong>request an account</strong>.</p></div></div></div></section>

<section class="ux-section alt"><div class="ux-wrap"><p class="ux-eyebrow">02 / The Problem</p><h2>The page worked, but the information could work harder.</h2><p class="ux-intro">The original interface contained the necessary fields and actions. My focus was reducing unnecessary friction in how those elements were presented.</p><div class="ux-grid">
<article class="ux-card"><div class="ux-number">01 / REPETITION</div><h3>Too many sign-in instructions</h3><p>“Customer Login,” “Sign in to your account,” and another instruction to sign in repeated the same message instead of helping customers move forward.</p></article>
<article class="ux-card"><div class="ux-number">02 / VISUAL CLUTTER</div><h3>Redundant required-field cues</h3><p>The email and password fields used asterisks plus a separate “Required Fields” note. I saw an opportunity to simplify this presentation for a basic two-field form.</p></article>
<article class="ux-card"><div class="ux-number">03 / HIERARCHY</div><h3>Limited separation between tasks</h3><p>The sign-in and account request areas sat side by side but could be more clearly grouped to help users recognize their next action.</p></article>
<article class="ux-card"><div class="ux-number">04 / CONTENT DESIGN</div><h3>Account benefits were easy to overlook</h3><p>Faster checkout, saved addresses, and order tracking appeared in a compact paragraph rather than distinct, scannable benefits.</p></article>
</div><div class="ux-callout"><p><strong>Design question:</strong> How might I simplify the login experience and help customers quickly understand whether to sign in or request an account?</p></div></div></section>

<section class="ux-section"><div class="ux-wrap"><p class="ux-eyebrow">03 / Before &amp; After</p><h2>From a functional form to a clearer interface.</h2><p class="ux-intro">These screenshots show the original website and my proposed redesign. The redesign is a design concept, not a screenshot of the current live website.</p>
<!-- Replace these two paths with your actual image filenames and locations. -->
<figure class="ux-shot"><div class="ux-shot-head"><h3>Original customer login</h3><span class="ux-shot-label">Before</span></div><div class="ux-shot-frame"><img src="images/Old.png" alt="Original RectorSeal customer login and account request page" loading="lazy"></div><figcaption>The original page used repeated login messaging and presented account benefits in a single paragraph.</figcaption></figure>
<figure class="ux-shot"><div class="ux-shot-head"><h3>My proposed redesign</h3><span class="ux-shot-label">After</span></div><div class="ux-shot-frame"><img src="images/New.png" alt="Proposed redesigned login page with distinct panels and scannable account benefits" loading="lazy"></div><figcaption>The concept separates the two tasks into panels, streamlines field content, and makes registration benefits easier to scan.</figcaption></figure>
<div class="ux-compare"><div><h3>Before</h3><ul><li>Repeated sign-in headings and instructions</li><li>Required-field asterisks and explanatory note</li><li>Less distinct task grouping</li><li>Account benefits combined in a paragraph</li></ul></div><div class="after"><h3>After — Design concept</h3><ul><li>Shorter, more purposeful instructions</li><li>Clearly labeled fields with helpful placeholders</li><li>Distinct sign-in and registration panels</li><li>Individual benefits with icons and descriptions</li></ul></div></div>
</div></section>

<section class="ux-section alt"><div class="ux-wrap"><p class="ux-eyebrow">04 / Design Decisions</p><h2>Every change had a purpose.</h2><div class="ux-grid">
<article class="ux-card"><div class="ux-number">01 / UX WRITING</div><h3>Removed unnecessary repetition</h3><p>I reduced repeated login language so customers could focus on the form rather than reading multiple versions of the same instruction.</p></article>
<article class="ux-card"><div class="ux-number">02 / FORM DESIGN</div><h3>Made fields easier to scan</h3><p>I positioned field labels above the inputs, introduced clear placeholder text, and simplified the presentation of required information.</p></article>
<article class="ux-card"><div class="ux-number">03 / VISUAL HIERARCHY</div><h3>Separated the two user paths</h3><p>I used distinct panels and stronger action buttons to distinguish signing in from requesting an account.</p></article>
<article class="ux-card"><div class="ux-number">04 / INFORMATION DESIGN</div><h3>Made account benefits more useful</h3><p>I broke the registration benefits into smaller sections with icons and descriptions, making them easier to recognize without reading a full paragraph.</p></article>
</div></div></section>

<section class="ux-section"><div class="ux-wrap"><p class="ux-eyebrow">05 / Implementation &amp; Outcome</p><h2>A classroom concept with some real-world adoption.</h2><div class="ux-split"><div class="ux-copy"><p>Although this began as an academic assignment, portions of the redesign were later implemented on the company's website before I had completed the full concept.</p><p>Those changes are no longer visible on the current site, so I present the screenshots here as a comparison between the original interface and my proposed design—not as evidence that the complete redesign is live today.</p></div><div class="ux-card"><h3>What I can demonstrate</h3><p>Identifying usability issues in an existing interface, making specific design decisions, and communicating a more organized customer-facing experience.</p><p style="margin-top:17px"><strong>Not claimed:</strong> Measured conversion improvements, usability-test results, or permanent implementation of the complete redesign.</p></div></div></div></section>

<section class="ux-section alt"><div class="ux-wrap"><p class="ux-eyebrow">06 / Reflection</p><h2>What I learned.</h2><div class="ux-grid three"><article class="ux-card"><h3>Clear writing is part of UX</h3><p>Even small amounts of unnecessary text can make a straightforward interaction feel more complicated.</p></article><article class="ux-card"><h3>Hierarchy guides decisions</h3><p>Grouping related elements helps users distinguish between different tasks without adding more instructions.</p></article><article class="ux-card"><h3>Design must be communicated</h3><p>A before-and-after comparison makes it easier to explain not just what changed, but why each change matters.</p></article></div></div></section>

<section class="ux-section"><div class="ux-wrap"><p class="ux-eyebrow">Key Takeaway</p><p class="ux-final">Good UX isn't always about adding features. Sometimes it's about <span class="ux-accent">removing repetition, clarifying choices, and making the next step obvious.</span></p></div></section>
</main>
<hr>
<?php include "footer.php"; ?>
</body>
</html>
