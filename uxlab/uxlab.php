<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="robots" content="noindex, nofollow, noarchive">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>UX Quest: Boba & Beats</title>
<style>
:root {
  --bg:#fffaf4; --panel:#ffffff; --ink:#241f2d; --muted:#6f687a;
  --accent:#b84fe0; --accent2:#6aa8ff; --accent3:#ffcc65;
  --good:#2c9d76; --bad:#d45664; --line:#eadff0; --shadow:0 18px 50px rgba(73,45,90,.12);
}
*{box-sizing:border-box}
body{margin:0;font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;background:
radial-gradient(circle at 10% 10%,rgba(214,133,239,.18),transparent 25%),
radial-gradient(circle at 90% 8%,rgba(255,220,113,.22),transparent 22%),
radial-gradient(circle at 90% 90%,rgba(111,180,255,.15),transparent 25%),var(--bg);color:var(--ink);min-height:100vh}
button,input,textarea,select{font:inherit}
button{cursor:pointer}
.app{max-width:1200px;margin:0 auto;padding:24px}
.topbar{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:22px}
.brand{display:flex;align-items:center;gap:14px}
.logo{width:52px;height:52px;border-radius:18px;background:linear-gradient(135deg,var(--accent),var(--accent2));display:grid;place-items:center;font-size:26px;box-shadow:var(--shadow)}
.brand h1{font-size:24px;margin:0} .brand p{margin:2px 0 0;color:var(--muted);font-size:13px}
.stats{display:flex;gap:10px;flex-wrap:wrap;justify-content:flex-end}
.stat{background:rgba(255,255,255,.82);border:1px solid var(--line);border-radius:16px;padding:9px 12px;font-size:13px;box-shadow:0 6px 18px rgba(73,45,90,.05)}
.stat b{font-size:15px}
.card{background:rgba(255,255,255,.94);border:1px solid var(--line);border-radius:24px;box-shadow:var(--shadow)}
.hero{padding:28px;display:grid;grid-template-columns:1.4fr .8fr;gap:24px;margin-bottom:20px}
.hero h2{font-size:38px;line-height:1.05;margin:0 0 10px}
.hero p{color:var(--muted);max-width:720px;line-height:1.6}
.hero-art{display:grid;place-items:center;min-height:180px;border-radius:20px;background:linear-gradient(135deg,#fae7ff,#e7f3ff 55%,#fff2c9);position:relative;overflow:hidden}
.boba{font-size:92px;filter:drop-shadow(0 12px 10px rgba(0,0,0,.10));animation:bob 2.2s ease-in-out infinite}
.note{position:absolute;font-size:26px;animation:float 3s ease-in-out infinite} .note.n1{top:25px;left:35px} .note.n2{bottom:28px;right:36px;animation-delay:.8s}
@keyframes bob{50%{transform:translateY(-8px) rotate(2deg)}} @keyframes float{50%{transform:translateY(-10px) rotate(8deg)}}
.btn{border:0;border-radius:14px;padding:12px 16px;background:var(--ink);color:white;font-weight:800;box-shadow:0 6px 16px rgba(0,0,0,.08)}
.btn.secondary{background:white;color:var(--ink);border:1px solid var(--line)} .btn.accent{background:linear-gradient(135deg,var(--accent),#8e67e8)} .btn.good{background:var(--good)}
.grid{display:grid;grid-template-columns:2fr 1fr;gap:20px}
.section{padding:22px} .section h3{margin:0 0 6px;font-size:20px} .section .sub{color:var(--muted);font-size:14px;margin-bottom:16px}
.levels{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px}
.level{padding:16px;border:1px solid var(--line);border-radius:18px;background:white;display:flex;gap:12px;align-items:center;transition:.18s}
.level:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(65,40,90,.08)}
.level.locked{opacity:.55;filter:grayscale(.2)} .lvl-num{min-width:42px;height:42px;border-radius:14px;display:grid;place-items:center;background:linear-gradient(135deg,#f2d8ff,#dcecff);font-weight:900}
.level h4{margin:0 0 4px} .level p{margin:0;color:var(--muted);font-size:12px;line-height:1.35}
.progress{height:8px;background:#f0eaf3;border-radius:99px;overflow:hidden;margin-top:8px} .progress>span{display:block;height:100%;background:linear-gradient(90deg,var(--accent),var(--accent2));width:0}
.mode-list{display:grid;gap:10px}
.mode{padding:14px;border:1px solid var(--line);border-radius:16px;background:white}
.mode b{display:block;margin-bottom:3px} .mode small{color:var(--muted);line-height:1.35}
.daily{padding:16px;border-radius:18px;background:linear-gradient(135deg,#fff0c9,#fbe6ff);border:1px solid #f2ddea}
.reward-row{display:flex;gap:8px;flex-wrap:wrap;margin-top:10px}
.badge{display:inline-flex;align-items:center;gap:6px;background:#fff;border:1px solid var(--line);border-radius:999px;padding:7px 10px;font-size:12px}
.shop{display:grid;gap:10px} .shop-item{display:flex;justify-content:space-between;align-items:center;gap:10px;padding:12px;border:1px solid var(--line);border-radius:15px;background:white}
.shop-item small{color:var(--muted);display:block}
.overlay{position:fixed;inset:0;background:rgba(26,18,35,.5);backdrop-filter:blur(7px);display:none;align-items:center;justify-content:center;padding:20px;z-index:20}
.overlay.show{display:flex} .modal{width:min(860px,100%);max-height:92vh;overflow:auto;padding:26px;background:var(--panel);border-radius:26px;box-shadow:0 30px 80px rgba(0,0,0,.2)}
.modal-head{display:flex;justify-content:space-between;align-items:flex-start;gap:12px;margin-bottom:18px} .modal-head h2{margin:0} .close{border:0;background:#f5eff7;border-radius:10px;padding:8px 11px;font-weight:900}
.q-meta{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:12px} .pill{font-size:12px;font-weight:800;padding:6px 9px;border-radius:999px;background:#f6eff9;color:#6f3a83}
.question{font-size:26px;line-height:1.25;margin:10px 0 18px}
.answers{display:grid;gap:10px} .answer{text-align:left;border:1px solid var(--line);background:white;padding:14px;border-radius:14px;font-weight:700}
.answer:hover{border-color:#c99bdd;background:#fcf7ff} .answer.correct{border-color:var(--good);background:#eefaf6;color:#17664e} .answer.wrong{border-color:var(--bad);background:#fff1f2;color:#9b2f3b}
.feedback{margin-top:16px;padding:16px;border-radius:16px;background:#f7f2fa;line-height:1.5;display:none} .feedback.show{display:block}
.text-answer{width:100%;min-height:120px;border:1px solid var(--line);border-radius:14px;padding:14px;resize:vertical}
.model-answer{margin-top:12px;padding:14px;border-radius:14px;background:#eef7ff;border:1px solid #d7e9ff}
.quest-footer{display:flex;justify-content:space-between;align-items:center;gap:12px;margin-top:18px}
.flash-card{min-height:270px;display:grid;place-items:center;padding:28px;border:2px dashed #d8c9df;border-radius:20px;background:linear-gradient(135deg,#fff,#fbf5ff);text-align:center}
.flash-card .term{font-size:36px;font-weight:900} .flash-card .hint{color:var(--muted);font-size:13px;margin-top:8px}
.flash-tabs{display:flex;gap:8px;flex-wrap:wrap;margin-top:14px}
.tab{border:1px solid var(--line);background:white;padding:8px 10px;border-radius:10px;font-weight:700} .tab.active{background:var(--ink);color:white}
.glossary{display:grid;gap:8px} .gl-item{border:1px solid var(--line);border-radius:14px;padding:12px;background:white} .gl-item b{display:block} .gl-item span{color:var(--muted);font-size:13px}
.toast{position:fixed;right:20px;bottom:20px;background:#241f2d;color:white;padding:13px 16px;border-radius:14px;box-shadow:var(--shadow);opacity:0;transform:translateY(10px);pointer-events:none;transition:.25s;z-index:30} .toast.show{opacity:1;transform:translateY(0)}
.confetti{position:fixed;inset:0;pointer-events:none;overflow:hidden;z-index:40} .confetti i{position:absolute;top:-20px;width:10px;height:14px;border-radius:3px;animation:fall 1.6s linear forwards} @keyframes fall{to{transform:translateY(110vh) rotate(720deg)}}
.footer-tools{display:flex;gap:8px;flex-wrap:wrap;justify-content:center;margin:24px 0 10px}
.kbd{font-family:ui-monospace,monospace;background:#f1edf3;border:1px solid #ddd3e2;padding:2px 6px;border-radius:6px;font-size:11px}
@media(max-width:850px){.hero,.grid{grid-template-columns:1fr}.levels{grid-template-columns:1fr}.topbar{align-items:flex-start;flex-direction:column}.stats{justify-content:flex-start}.hero h2{font-size:31px}}
</style>
</head>
<body>
<div class="app">
  <div class="topbar">
    <div class="brand"><div class="logo">🎮</div><div><h1>UX Quest: Boba & Beats</h1><p>Learn UX like a game. Keep the boba. Lose the boring.</p></div></div>
    <div class="stats">
      <div class="stat">⭐ XP <b id="xp">0</b></div>
      <div class="stat">🧋 Pearls <b id="pearls">0</b></div>
      <div class="stat">🔥 Streak <b id="streak">0</b></div>
      <div class="stat">🏆 Rank <b id="rank">UX Rookie</b></div>
    </div>
  </div>

  <section class="hero card">
    <div>
      <div class="pill" style="display:inline-flex">90-DAY UX COMEBACK ARC</div>
      <h2>Train your UX brain.<br>Then talk like you know it. 🎤</h2>
      <p>Every concept is practiced three ways: <b>what it means</b>, <b>when to use it</b>, and <b>how to explain it in a project</b>. Your weak spots automatically return in review rounds.</p>
      <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:18px">
        <button class="btn accent" onclick="startDaily()">Start Today's Mission</button>
        <button class="btn secondary" onclick="openReview()">Review My Misses</button>
        <button class="btn secondary" onclick="openGlossary()">UX Glossary</button>
      </div>
    </div>
    <div class="hero-art"><div class="note n1">♫</div><div class="boba">🧋</div><div class="note n2">♪</div></div>
  </section>

  <div class="grid">
    <section class="section card">
      <h3>🗺️ Quest Map</h3>
      <div class="sub">Eight worlds. Forty-eight core concepts. Definition → scenario → interview language.</div>
      <div class="levels" id="levels"></div>
    </section>

    <aside>
      <section class="section card" style="margin-bottom:20px">
        <h3>🎯 Today's Mini Mission</h3>
        <div class="sub">Three concepts chosen for today.</div>
        <div class="daily" id="dailyBox"></div>
      </section>

      <section class="section card" style="margin-bottom:20px">
        <h3>🎮 Practice Modes</h3>
        <div class="sub">Same knowledge, different brain workout.</div>
        <div class="mode-list">
          <button class="mode" onclick="startMode('flash')"><b>🃏 Flashcard Flip</b><small>Term → meaning → when → project language.</small></button>
          <button class="mode" onclick="startMode('scenario')"><b>🕵🏾 Research & Scenario Sprint</b><small>Choose the right concept in context.</small></button>
          <button class="mode" onclick="startMode('speak')"><b>🎤 Speak Like a UX Designer</b><small>Write the explanation you would give in an interview.</small></button>
          <button class="mode" onclick="startMode('mixed')"><b>👾 Arcade Mix</b><small>Random definitions, scenarios, and interview prompts.</small></button>
        </div>
      </section>

      <section class="section card">
        <h3>🧋 Boba & Beat Shop</h3>
        <div class="sub">Spend pearls you earn from correct answers.</div>
        <div class="shop" id="shop"></div>
      </section>
    </aside>
  </div>

  <div class="footer-tools">
    <button class="btn secondary" onclick="exportProgress()">Export Progress</button>
    <label class="btn secondary" style="cursor:pointer">Import Progress<input id="importFile" type="file" accept=".json" style="display:none"></label>
    <button class="btn secondary" onclick="resetProgress()">Reset Game</button>
  </div>
</div>

<div class="overlay" id="overlay" role="dialog" aria-modal="true">
  <div class="modal" id="modal"></div>
</div>
<div class="toast" id="toast" aria-live="polite"></div>
<div class="confetti" id="confetti"></div>

<script>
const CONCEPTS = [{"level": 1, "term": "User need", "definition": "A goal, problem, or requirement a person must satisfy to succeed.", "when": "Use it when deciding what the product should help people accomplish—not what feature to build first.", "scenario": "A team wants to add a dashboard because competitors have one. What should you identify before deciding whether it belongs?", "options": ["The user's underlying need", "The brand color palette", "The engineering framework", "The competitor's font"], "answer": 0, "projectPrompt": "Explain how you would talk about identifying a user need in a project.", "keywords": ["need", "user", "goal", "problem"], "model": "I identified the user's underlying goal before designing a solution, then used that need to guide which features and flows were actually necessary."}, {"level": 1, "term": "Pain point", "definition": "A specific frustration, obstacle, or difficulty that creates friction for a user.", "when": "Use it when describing where an experience becomes difficult, slow, confusing, risky, or annoying.", "scenario": "Users abandon checkout because they must re-enter the same shipping information on every order. What have you identified?", "options": ["A pain point", "A visual style", "A persona", "A KPI"], "answer": 0, "projectPrompt": "Explain a pain point you could identify in an order-processing or content-request workflow.", "keywords": ["friction", "problem", "manual", "duplicate", "user"], "model": "I identified duplicate manual entry as a pain point because it created unnecessary effort, increased error risk, and slowed the user's workflow."}, {"level": 1, "term": "Mental model", "definition": "A person's internal belief about how a system works based on prior experience.", "when": "Use it when users expect an interface to behave a certain way because of patterns they already know.", "scenario": "Users repeatedly click the company logo expecting to return to the home page. Which concept best explains that expectation?", "options": ["Mental model", "Card sorting", "Visual hierarchy", "MVP"], "answer": 0, "projectPrompt": "Explain how a mental model could influence one of your design decisions.", "keywords": ["expect", "mental model", "familiar", "convention"], "model": "Testing showed users expected the logo to return home based on a familiar mental model, so I preserved that convention instead of introducing a new behavior."}, {"level": 1, "term": "Affordance", "definition": "A quality of an object or interface that suggests what actions are possible.", "when": "Use it when evaluating whether a control's form helps people understand how it can be used.", "scenario": "A raised rectangular control looks pressable even before someone reads its label. What UX concept is this?", "options": ["Affordance", "Taxonomy", "Metric", "Persona"], "answer": 0, "projectPrompt": "Explain how you might improve an affordance in an interface.", "keywords": ["action", "button", "click", "afford"], "model": "I strengthened the button's affordance by making it visually distinct from static content so users could immediately tell it was interactive."}, {"level": 1, "term": "Signifier", "definition": "A visible or perceivable cue that communicates where or how an action should happen.", "when": "Use it when discussing labels, icons, underlines, arrows, hover states, and other cues that communicate interaction.", "scenario": "An underlined blue word signals that the text can be clicked. What is the underline functioning as?", "options": ["A signifier", "A KPI", "A constraint", "A persona"], "answer": 0, "projectPrompt": "Explain a signifier you could add to reduce uncertainty.", "keywords": ["cue", "icon", "label", "click", "signifier"], "model": "I added a clear arrow and link styling as signifiers so users could recognize that the card opened a full case study."}, {"level": 1, "term": "Constraint", "definition": "A limitation or condition that narrows which design solutions are possible.", "when": "Use it when discussing technical, business, legal, time, budget, or platform limits that affect a design.", "scenario": "The design must work inside an existing ERP that cannot support real-time updates. What is that limitation?", "options": ["A constraint", "A user need", "A signifier", "A journey map"], "answer": 0, "projectPrompt": "Explain how you would describe designing around a constraint.", "keywords": ["constraint", "limit", "technical", "worked around"], "model": "Because the existing system could not support the ideal automation, I treated that technical limitation as a constraint and designed a workable interim flow."}, {"level": 1, "term": "Feedback", "definition": "A system response that tells users what happened after they took an action.", "when": "Use it when people need confirmation, status, success, warning, loading, or error information.", "scenario": "After clicking Save, the page displays 'Changes saved' and a checkmark. What UX principle is being provided?", "options": ["Feedback", "Taxonomy", "Desirability", "Card sorting"], "answer": 0, "projectPrompt": "Explain how feedback can improve a form experience.", "keywords": ["feedback", "confirm", "status", "success", "error"], "model": "I added immediate feedback after submission so users knew whether the request succeeded, failed, or still needed attention."}, {"level": 1, "term": "Cognitive load", "definition": "The amount of mental effort required to understand information or complete a task.", "when": "Use it when an interface forces users to remember too much, process too many choices, or interpret unnecessary complexity.", "scenario": "A form asks users to remember a 12-digit item code from a previous screen instead of showing it. What is unnecessarily increasing?", "options": ["Cognitive load", "Viability", "Brand awareness", "Affordance"], "answer": 0, "projectPrompt": "Explain one way you could reduce cognitive load in a workflow.", "keywords": ["cognitive", "remember", "mental", "simplify"], "model": "I reduced cognitive load by keeping important context visible and removing steps that forced users to remember information from earlier screens."}, {"level": 2, "term": "Generative research", "definition": "Research used to discover needs, behaviors, opportunities, and problems before deciding on a solution.", "when": "Use it early when you need to learn what is happening and why before designing.", "scenario": "You know customers struggle with scheduling service visits, but you do not yet know why. Which research type fits best?", "options": ["Generative research", "Evaluative research", "A/B testing only", "Heuristic scoring only"], "answer": 0, "projectPrompt": "Explain when you would use generative research on a new project.", "keywords": ["early", "discover", "needs", "behaviors", "before"], "model": "I would use generative research early to understand user behaviors, needs, and pain points before committing to a solution."}, {"level": 2, "term": "Evaluative research", "definition": "Research used to assess how well an existing design or concept works.", "when": "Use it after you have something to evaluate, such as a prototype, workflow, or live product.", "scenario": "You have a clickable prototype and want to know whether users can complete checkout successfully. What type of research is this?", "options": ["Evaluative research", "Generative research", "Market sizing", "Taxonomy design"], "answer": 0, "projectPrompt": "Explain how evaluative research could improve an existing prototype.", "keywords": ["evaluate", "prototype", "test", "works", "improve"], "model": "I used evaluative research on the prototype to identify where users struggled, then iterated the flow based on observed usability issues."}, {"level": 2, "term": "Qualitative research", "definition": "Research focused on understanding experiences, motivations, behaviors, and the reasons behind them.", "when": "Use it when you need depth and context more than numerical prevalence.", "scenario": "You conduct eight interviews to understand why technicians avoid a mobile ordering feature. What kind of data are you primarily collecting?", "options": ["Qualitative", "Quantitative", "Financial", "Telemetry only"], "answer": 0, "projectPrompt": "Explain what qualitative research can reveal that analytics alone may not.", "keywords": ["why", "motivation", "context", "qualitative"], "model": "Qualitative research helped me understand why users behaved a certain way and the context behind the patterns that analytics alone could not explain."}, {"level": 2, "term": "Quantitative research", "definition": "Research focused on numerical patterns, frequency, magnitude, or measurable behavior.", "when": "Use it when you need to know how often, how many, how much, or whether a measurable pattern exists.", "scenario": "You analyze the percentage of users who abandon a form at each step. What type of research is this?", "options": ["Quantitative", "Qualitative", "Contextual inquiry", "Design critique"], "answer": 0, "projectPrompt": "Explain how quantitative data could support a UX decision.", "keywords": ["data", "percent", "measure", "quantitative", "rate"], "model": "I used quantitative data to measure where drop-off was highest, which helped prioritize the part of the flow that needed attention first."}, {"level": 2, "term": "User interview", "definition": "A structured conversation used to learn about a person's experiences, behaviors, needs, and motivations.", "when": "Use it when you need firsthand explanations from people with relevant experience.", "scenario": "You want to understand how shipping coordinators currently handle exceptions and why. Which method is most appropriate?", "options": ["User interviews", "Color testing", "Tree testing", "Benchmarking only"], "answer": 0, "projectPrompt": "Explain how you would describe conducting user interviews in a case study.", "keywords": ["interview", "participants", "questions", "patterns", "needs"], "model": "I interviewed people who performed the workflow, asked open-ended questions about their current process, and synthesized recurring needs and pain points."}, {"level": 2, "term": "Usability testing", "definition": "Observing representative users attempt realistic tasks to uncover usability problems.", "when": "Use it when you need evidence about whether people can understand and use a design.", "scenario": "You ask five users to submit a content request using a prototype while you observe where they struggle. What are you doing?", "options": ["Usability testing", "Card sorting", "Stakeholder mapping", "Market research"], "answer": 0, "projectPrompt": "Explain what you would report from a usability test.", "keywords": ["task", "observe", "users", "struggle", "iteration"], "model": "I observed users completing realistic tasks, documented where they hesitated or failed, and used those findings to prioritize design changes."}, {"level": 2, "term": "Survey", "definition": "A standardized set of questions used to collect responses from a larger group efficiently.", "when": "Use it when you need broader self-reported patterns and can ask questions that respondents can answer reliably.", "scenario": "You want to compare how frequently 300 customers use several account features. Which method could efficiently gather this self-reported data?", "options": ["Survey", "Contextual inquiry", "Design studio", "Cognitive walkthrough"], "answer": 0, "projectPrompt": "Explain one good use of a survey and one thing it would not tell you by itself.", "keywords": ["survey", "many", "pattern", "why", "self-report"], "model": "I would use a survey to measure broad self-reported patterns across many users, but I would not rely on it alone to explain why those patterns occur."}, {"level": 2, "term": "Contextual inquiry", "definition": "Research that combines observation and questioning while users perform real work in their natural context.", "when": "Use it when the environment, tools, interruptions, or workarounds are important to understanding behavior.", "scenario": "You sit with a coordinator while they process real orders and ask questions about workarounds as they happen. Which method is this?", "options": ["Contextual inquiry", "A/B testing", "Tree testing", "Diary study only"], "answer": 0, "projectPrompt": "Explain why contextual inquiry could be useful for an internal workflow project.", "keywords": ["observe", "real work", "context", "workflow", "questions"], "model": "I observed the workflow in context and asked questions as workarounds happened, which exposed friction that users might not remember to mention later."}, {"level": 3, "term": "Problem statement", "definition": "A concise description of the user problem, context, and impact that design work should address.", "when": "Use it to align the team on the problem before jumping into solutions.", "scenario": "A team keeps proposing features without agreeing on what user problem they are solving. What should they create first?", "options": ["A problem statement", "A color system", "A launch campaign", "A design token"], "answer": 0, "projectPrompt": "Explain how you would frame a problem statement for a confusing content-request process.", "keywords": ["problem", "user", "impact", "context"], "model": "I framed the problem around users struggling to submit complete requests through scattered channels, which created rework, missing information, and delays."}, {"level": 3, "term": "How Might We question", "definition": "An open-ended question that reframes a problem into an opportunity for exploration without prescribing one solution.", "when": "Use it during ideation to turn research insights into focused design opportunities.", "scenario": "Which prompt is the best How Might We question?", "options": ["How might we reduce repeat data entry during checkout?", "We should add autofill.", "Why are users bad at forms?", "Build a new checkout now."], "answer": 0, "projectPrompt": "Write the kind of How Might We question you could use for a workflow with unclear ownership.", "keywords": ["how might we", "ownership", "clarify", "reduce", "handoff"], "model": "How might we make ownership visible at each handoff so users know who is responsible for the next action?"}, {"level": 3, "term": "Hypothesis", "definition": "A testable prediction about what change may lead to a specific outcome and why.", "when": "Use it when you want to make an assumption explicit and test whether a design change has the expected effect.", "scenario": "Which statement is a UX hypothesis?", "options": ["If we show shipping costs earlier, fewer users will abandon checkout because the total is less surprising.", "Blue is the best color.", "Users hate everything.", "Let's redesign the page."], "answer": 0, "projectPrompt": "Explain a hypothesis you could test on a login or request form.", "keywords": ["if", "then", "because", "test"], "model": "I hypothesized that clearer field guidance would reduce submission errors because users would understand what information was expected before submitting."}, {"level": 3, "term": "Assumption", "definition": "Something believed to be true without enough evidence yet.", "when": "Use it when identifying what the team is taking for granted and what may need validation.", "scenario": "The team says, 'Customers definitely want a dashboard,' but no one has asked customers. What is that statement?", "options": ["An assumption", "A validated need", "A success metric", "A taxonomy"], "answer": 0, "projectPrompt": "Explain how you would handle an assumption during a project.", "keywords": ["assumption", "validate", "evidence", "test"], "model": "I documented the assumption instead of treating it as fact, then looked for research or testing that could validate or challenge it."}, {"level": 3, "term": "Persona", "definition": "A research-grounded archetype representing important behaviors, goals, and needs of a user group.", "when": "Use it when meaningful user patterns help the team design for distinct groups rather than an imaginary 'average user.'", "scenario": "A persona should primarily be based on what?", "options": ["Research patterns", "A designer's imagination", "Demographics alone", "A stakeholder's favorite customer"], "answer": 0, "projectPrompt": "Explain what makes a persona useful instead of decorative.", "keywords": ["research", "behavior", "goal", "needs", "persona"], "model": "I would base the persona on recurring research patterns and use it to keep key behaviors, goals, and needs visible during design decisions."}, {"level": 3, "term": "Jobs to Be Done", "definition": "A framework that focuses on the progress a person is trying to make in a specific situation.", "when": "Use it when you want to understand the underlying job users are 'hiring' a product or service to accomplish.", "scenario": "A contractor is not merely 'using an ordering app'; they are trying to restock before tomorrow's job without delaying the crew. What framework emphasizes that progress?", "options": ["Jobs to Be Done", "Visual hierarchy", "WCAG", "Heuristic evaluation"], "answer": 0, "projectPrompt": "Explain a job-to-be-done for a retail content request system.", "keywords": ["job", "progress", "when", "so I can"], "model": "When a retailer requests new product content, the requester needs to submit complete assets in one place so the listing can be updated without repeated follow-up."}, {"level": 3, "term": "Journey map", "definition": "A visualization of a user's experience across stages, actions, thoughts, emotions, pain points, and touchpoints.", "when": "Use it when a problem spans multiple steps, channels, or moments over time.", "scenario": "You want to understand a customer's experience from finding a product through ordering, delivery, and support. What artifact fits best?", "options": ["Journey map", "Color palette", "Design token", "Single wireframe"], "answer": 0, "projectPrompt": "Explain what a journey map could reveal in a cross-channel experience.", "keywords": ["journey", "stages", "touchpoints", "pain points"], "model": "The journey map made friction visible across stages and channels, helping the team see problems that were not obvious when looking at individual screens."}, {"level": 3, "term": "Prioritization", "definition": "Choosing what to address first based on factors such as user impact, evidence, effort, risk, and business value.", "when": "Use it when research produces more problems or ideas than the team can tackle at once.", "scenario": "Research reveals 14 usability issues, but the team can only fix four before launch. What activity is required?", "options": ["Prioritization", "Card sorting", "Branding", "Recruiting"], "answer": 0, "projectPrompt": "Explain how you would prioritize UX issues responsibly.", "keywords": ["impact", "effort", "risk", "evidence", "priority"], "model": "I prioritized issues using user impact, frequency, risk, and implementation effort so the team could address the most consequential problems first."}, {"level": 4, "term": "Information architecture", "definition": "The structure, organization, and labeling of information so people can find and understand it.", "when": "Use it when designing navigation, content grouping, hierarchies, categories, or complex information systems.", "scenario": "Users cannot find safety data sheets because content is scattered across inconsistent categories. What discipline should you examine?", "options": ["Information architecture", "Motion design", "Pricing strategy", "A/B copywriting only"], "answer": 0, "projectPrompt": "Explain how information architecture could improve a SharePoint content system.", "keywords": ["organize", "structure", "find", "information", "metadata"], "model": "I improved the information architecture by organizing content into predictable categories and metadata so users could find and manage assets consistently."}, {"level": 4, "term": "Taxonomy", "definition": "A system of categories and classification rules used to organize information consistently.", "when": "Use it when deciding how items, documents, products, or content should be categorized.", "scenario": "A content library defines categories such as Images, Safety Sheets, Data Sheets, and Packaging. What are those categories part of?", "options": ["A taxonomy", "A prototype", "A KPI", "A heuristic"], "answer": 0, "projectPrompt": "Explain why a clear taxonomy matters in a content library.", "keywords": ["taxonomy", "categories", "consistent", "content"], "model": "I created a clear taxonomy so content was classified consistently, which reduced ambiguity and made filtering and retrieval easier."}, {"level": 4, "term": "Labeling", "definition": "Choosing the words and names used for navigation, categories, actions, and content so users understand them.", "when": "Use it when users misinterpret menu items, categories, buttons, or field names.", "scenario": "Users do not understand whether 'Resources' contains manuals, forms, or training. What IA issue should you investigate?", "options": ["Labeling", "Latency", "Contrast", "Feasibility"], "answer": 0, "projectPrompt": "Explain how you would improve confusing labels.", "keywords": ["label", "clear", "language", "understand"], "model": "I replaced internal jargon with labels that matched the language users naturally used, making navigation easier to understand."}, {"level": 4, "term": "Navigation", "definition": "The system that helps users move between locations or sections within a product or information space.", "when": "Use it when evaluating menus, breadcrumbs, tabs, links, and wayfinding.", "scenario": "Users reach a product page but cannot tell how to return to its parent category. What part of the experience is weak?", "options": ["Navigation", "Quantitative research", "Viability", "Persona fidelity"], "answer": 0, "projectPrompt": "Explain a navigation improvement you could make on a complex B2B site.", "keywords": ["navigation", "menu", "find", "move", "wayfinding"], "model": "I simplified the navigation hierarchy and added clearer wayfinding so users could move between categories without losing their place."}, {"level": 4, "term": "Card sorting", "definition": "A research method where participants group and sometimes label content to reveal how they mentally organize information.", "when": "Use it when you need evidence for categories, groupings, or navigation structure.", "scenario": "You give users 40 content cards and ask them to organize the cards into groups that make sense to them. What method is this?", "options": ["Card sorting", "Tree testing", "Usability benchmarking", "Diary study"], "answer": 0, "projectPrompt": "Explain how card sorting could help before redesigning a content-heavy site.", "keywords": ["cards", "group", "categories", "organize"], "model": "I would use card sorting to understand how users naturally group content, then use those patterns to inform the site's category structure."}, {"level": 4, "term": "Tree testing", "definition": "A method that tests whether people can find information within a text-only hierarchy before visual design is involved.", "when": "Use it to evaluate an information architecture or navigation hierarchy independently from page styling.", "scenario": "You want to know whether users can find 'Warranty Information' in a proposed menu structure without showing the final interface. What method fits?", "options": ["Tree testing", "Card sorting", "A/B color testing", "Prototype animation"], "answer": 0, "projectPrompt": "Explain what a failed tree-test task might tell you.", "keywords": ["tree", "find", "hierarchy", "label", "structure"], "model": "If users repeatedly chose the wrong branch, I would investigate whether the hierarchy or labels matched how they expected the information to be organized."}, {"level": 4, "term": "Sitemap", "definition": "A hierarchical representation of the pages or content areas within a website or product.", "when": "Use it when planning or communicating the overall structure of a digital experience.", "scenario": "A designer creates a diagram showing Home → Products → HVAC → Sealants → Product Detail. What is this artifact?", "options": ["Sitemap", "Journey map", "Persona", "KPI dashboard"], "answer": 0, "projectPrompt": "Explain how a sitemap supports design work.", "keywords": ["sitemap", "pages", "hierarchy", "structure"], "model": "I used a sitemap to make the page hierarchy visible so the team could review the overall structure before designing individual screens."}, {"level": 4, "term": "User flow", "definition": "A sequence of steps a user takes to complete a task or reach a goal.", "when": "Use it when designing or analyzing how people move through a task from entry to completion.", "scenario": "Email link → Login → Search order → View status → Download invoice is what kind of artifact?", "options": ["User flow", "Persona", "Taxonomy", "Design system"], "answer": 0, "projectPrompt": "Explain what a user flow helped you identify in a project.", "keywords": ["flow", "steps", "task", "bottleneck", "path"], "model": "Mapping the user flow exposed unnecessary steps and decision points, which helped me simplify the path to task completion."}, {"level": 5, "term": "Wireframe", "definition": "A low- or mid-fidelity layout showing structure, hierarchy, and functionality without final visual polish.", "when": "Use it to explore layout and flow quickly before investing in detailed UI.", "scenario": "A grayscale screen shows content placement, buttons, and fields but not final branding. What is it?", "options": ["Wireframe", "Final UI", "Journey map", "Taxonomy"], "answer": 0, "projectPrompt": "Explain why you might start with wireframes instead of polished screens.", "keywords": ["wireframe", "layout", "early", "iterate", "structure"], "model": "I used wireframes to test structure and task flow early, which made it faster to iterate before spending time on visual polish."}, {"level": 5, "term": "Prototype", "definition": "An interactive representation of a proposed experience used to explore, communicate, or test behavior.", "when": "Use it when you need people to experience interactions before the final product is built.", "scenario": "Users can click through a simulated checkout in Figma before development begins. What are they using?", "options": ["A prototype", "A sitemap", "A taxonomy", "A KPI"], "answer": 0, "projectPrompt": "Explain what you learned from testing a prototype.", "keywords": ["prototype", "test", "interaction", "before", "iterate"], "model": "I tested the prototype before development to observe how users moved through the flow and identify changes while iteration was still inexpensive."}, {"level": 5, "term": "Interaction design", "definition": "Designing how users and systems behave in response to actions over time.", "when": "Use it when defining controls, states, transitions, feedback, task behavior, and interactive flows.", "scenario": "You are deciding what happens after a user selects a filter, how it updates, and how they clear it. What discipline is this?", "options": ["Interaction design", "Taxonomy", "Market research", "Typography only"], "answer": 0, "projectPrompt": "Explain an interaction decision you could discuss in an interview.", "keywords": ["interaction", "action", "response", "state", "feedback"], "model": "I designed the interaction so the interface immediately reflected the selected filter and provided a clear way to remove it, reducing uncertainty."}, {"level": 5, "term": "Visual hierarchy", "definition": "The arrangement of visual elements so importance and reading order are clear.", "when": "Use it when deciding what users should notice first, second, and third.", "scenario": "The primary action looks identical to secondary links, so users miss it. What is the main UX/UI problem?", "options": ["Weak visual hierarchy", "Poor taxonomy", "Invalid persona", "Low viability"], "answer": 0, "projectPrompt": "Explain how you improved visual hierarchy on a page.", "keywords": ["hierarchy", "primary", "attention", "size", "contrast"], "model": "I strengthened visual hierarchy by making the primary action more prominent and reducing the visual weight of secondary information."}, {"level": 5, "term": "Consistency", "definition": "Using predictable patterns, language, and behaviors so users do not have to relearn the interface.", "when": "Use it when similar actions or components behave or look differently without a good reason.", "scenario": "One page says 'Submit,' another says 'Send,' and another says 'Complete' for the same action. What principle is being violated?", "options": ["Consistency", "Desirability", "Card sorting", "Quantitative validity"], "answer": 0, "projectPrompt": "Explain why consistency matters in a design system or workflow.", "keywords": ["consistent", "predictable", "pattern", "learn"], "model": "I standardized repeated controls and terminology so users could apply what they learned in one part of the experience to another."}, {"level": 5, "term": "Error prevention", "definition": "Designing the experience to reduce the chance of mistakes before they happen.", "when": "Use it when errors are predictable and can be prevented through constraints, defaults, validation, confirmation, or clearer choices.", "scenario": "A destructive action requires confirmation and clearly names what will be deleted. Which usability principle is this?", "options": ["Error prevention", "Progressive disclosure", "Taxonomy", "Viability"], "answer": 0, "projectPrompt": "Explain one way you could prevent form errors before submission.", "keywords": ["prevent", "error", "validation", "before", "clear"], "model": "I added clear field guidance and validation before submission so users could correct problems before the request entered the workflow."}, {"level": 5, "term": "Progressive disclosure", "definition": "Showing essential information first and revealing additional complexity only when it becomes relevant.", "when": "Use it when presenting everything at once would overwhelm users or clutter the interface.", "scenario": "Advanced filters remain collapsed until a user chooses 'More filters.' What pattern is this?", "options": ["Progressive disclosure", "Affordance", "Benchmarking", "JTBD"], "answer": 0, "projectPrompt": "Explain how progressive disclosure could simplify a complex form.", "keywords": ["progressive", "show", "later", "advanced", "complex"], "model": "I kept the most common fields visible and revealed advanced options only when needed, reducing initial complexity without removing functionality."}, {"level": 5, "term": "Visibility of system status", "definition": "Keeping users informed about what the system is doing through timely, understandable feedback.", "when": "Use it for loading, syncing, processing, saving, uploading, and other states where silence creates uncertainty.", "scenario": "A file upload takes 20 seconds and shows no progress indicator. Which usability principle is missing?", "options": ["Visibility of system status", "Persona quality", "Taxonomy depth", "Viability"], "answer": 0, "projectPrompt": "Explain how you would communicate system status during a long-running action.", "keywords": ["status", "loading", "progress", "feedback", "inform"], "model": "I added visible progress and completion states so users understood whether the system was still working or the action had finished."}, {"level": 6, "term": "Usability", "definition": "How effectively, efficiently, and satisfactorily people can accomplish goals with a product or service.", "when": "Use it when evaluating whether an experience is understandable and workable for its intended users.", "scenario": "Users eventually complete a task, but only after repeated errors and confusion. Is the interface necessarily usable just because they finished?", "options": ["No—completion alone does not prove good usability", "Yes—completion is all that matters", "Yes—if the screen looks modern", "No—because all forms are unusable"], "answer": 0, "projectPrompt": "Explain how you would describe improving usability.", "keywords": ["effective", "efficient", "easy", "task", "usability"], "model": "I improved usability by reducing unnecessary steps and confusion so users could complete the task more effectively and efficiently."}, {"level": 6, "term": "Heuristic evaluation", "definition": "An expert review of an interface against established usability principles to identify likely problems.", "when": "Use it for a fast structured review when user testing is unavailable or as a complement to research.", "scenario": "A UX designer reviews a site using Nielsen's usability heuristics and documents violations. What method is this?", "options": ["Heuristic evaluation", "Contextual inquiry", "Survey", "Card sorting"], "answer": 0, "projectPrompt": "Explain the limitation of a heuristic evaluation compared with usability testing.", "keywords": ["heuristic", "expert", "users", "not replace", "testing"], "model": "A heuristic evaluation can quickly identify likely issues, but it does not replace observing real users because expert predictions may differ from actual behavior."}, {"level": 6, "term": "WCAG", "definition": "Web Content Accessibility Guidelines: widely used recommendations for making digital content more accessible.", "when": "Use it when evaluating or designing accessibility for perceivability, operability, understandability, and robustness.", "scenario": "You are checking color contrast, keyboard access, focus indicators, and text alternatives. Which standard is most relevant?", "options": ["WCAG", "JTBD", "Scrum", "OKR"], "answer": 0, "projectPrompt": "Explain how WCAG could influence a design decision.", "keywords": ["WCAG", "accessibility", "contrast", "keyboard", "guideline"], "model": "I used WCAG guidance to check contrast, keyboard interaction, and labels so the interface would work for a wider range of users."}, {"level": 6, "term": "Color contrast", "definition": "The difference in luminance between foreground and background colors that affects legibility.", "when": "Use it when evaluating whether text, controls, and important visual information are distinguishable.", "scenario": "Light gray text on white is difficult to read for many users. What accessibility issue should you check?", "options": ["Color contrast", "Taxonomy", "Persona drift", "Feasibility"], "answer": 0, "projectPrompt": "Explain why color contrast is more than a visual preference.", "keywords": ["contrast", "read", "accessibility", "text"], "model": "I treated contrast as an accessibility requirement rather than a style preference because insufficient contrast can prevent users from reading important content."}, {"level": 6, "term": "Keyboard navigation", "definition": "The ability to operate an interface using a keyboard without requiring a mouse or touch input.", "when": "Use it when checking interactive elements, focus order, menus, forms, dialogs, and accessibility.", "scenario": "A dropdown opens with a mouse but cannot be reached or used with Tab and arrow keys. What accessibility area is failing?", "options": ["Keyboard navigation", "Journey mapping", "Content strategy", "Viability"], "answer": 0, "projectPrompt": "Explain what you would inspect when testing keyboard accessibility.", "keywords": ["keyboard", "tab", "focus", "interactive"], "model": "I checked whether every interactive element could be reached and operated by keyboard and whether focus moved in a logical, visible order."}, {"level": 6, "term": "Alternative text", "definition": "Text that communicates the purpose or meaning of meaningful images to users who cannot perceive them visually.", "when": "Use it for informative images and graphics that convey content not otherwise available in text.", "scenario": "A product image communicates a critical installation orientation. What should assistive technology receive?", "options": ["Meaningful alternative text", "A decorative filename only", "No description under any circumstances", "A color palette"], "answer": 0, "projectPrompt": "Explain when an image should have meaningful alt text versus empty alt text.", "keywords": ["alt", "meaningful", "decorative", "image", "screen reader"], "model": "I provide meaningful alt text when an image conveys information, but use empty alt text for purely decorative images so screen readers can skip them."}, {"level": 6, "term": "Form label", "definition": "Persistent text that identifies the purpose of an input control.", "when": "Use it so users and assistive technologies can understand what information a field requires.", "scenario": "A form uses placeholder text as the only description of each field, and the text disappears once typing begins. What is missing?", "options": ["Persistent form labels", "A persona", "A sitemap", "A KPI"], "answer": 0, "projectPrompt": "Explain why labels should not rely on placeholder text alone.", "keywords": ["label", "placeholder", "field", "accessible", "persistent"], "model": "I used persistent labels because placeholders disappear during entry and may not provide enough context or accessibility support."}, {"level": 6, "term": "Error recovery", "definition": "Helping users recognize, understand, and recover from mistakes after they occur.", "when": "Use it when validation or failures happen and users need a clear path forward.", "scenario": "A form says only 'Error 1042' after submission. What UX principle needs improvement?", "options": ["Error recovery", "Card sorting", "Viability", "Affordance"], "answer": 0, "projectPrompt": "Explain what makes an error message helpful.", "keywords": ["error", "what happened", "fix", "specific", "recover"], "model": "I made error messages specific, explained what went wrong, and told users exactly how to correct it instead of showing a generic failure."}, {"level": 7, "term": "Stakeholder", "definition": "A person or group with an interest in, influence over, or impact from a product, service, or project.", "when": "Use it when identifying whose goals, constraints, knowledge, approvals, or outcomes matter to the work.", "scenario": "Sales, customer service, engineering, and end users are all affected by a new ordering workflow. What are they in relation to the project?", "options": ["Stakeholders", "Personas only", "Design tokens", "Heuristics"], "answer": 0, "projectPrompt": "Explain how you would handle competing stakeholder needs.", "keywords": ["stakeholder", "needs", "align", "tradeoff", "goals"], "model": "I clarified each stakeholder's goals and constraints, then made tradeoffs visible so the team could align around user needs and business priorities."}, {"level": 7, "term": "Requirement", "definition": "A condition or capability a solution must satisfy.", "when": "Use it when documenting what the product or system needs to do or support.", "scenario": "The content request form must capture SKU, retailer, due date, and asset type before submission. What are these?", "options": ["Requirements", "Personas", "Aesthetics", "Hypotheses only"], "answer": 0, "projectPrompt": "Explain how requirements differ from solutions.", "keywords": ["requirement", "must", "need", "solution"], "model": "I treated requirements as what the experience must support, while leaving room to explore different design solutions for meeting those needs."}, {"level": 7, "term": "MVP", "definition": "Minimum Viable Product: the smallest useful version that can deliver core value and support learning.", "when": "Use it when the team needs to limit scope while still solving the most important problem.", "scenario": "The team postpones advanced reporting and launches the essential request-and-track workflow first. What product approach is this?", "options": ["MVP", "Full redesign", "Card sorting", "Journey mapping"], "answer": 0, "projectPrompt": "Explain how you would decide what belongs in an MVP.", "keywords": ["MVP", "core", "value", "scope", "learn"], "model": "I would include the smallest set of capabilities needed to deliver the core user value and test the riskiest assumptions, while deferring lower-priority features."}, {"level": 7, "term": "KPI", "definition": "Key Performance Indicator: a measurable signal used to track progress toward an important business or product objective.", "when": "Use it when the team needs to monitor whether a product or initiative is achieving a meaningful outcome.", "scenario": "The business tracks the percentage of orders completed without manual correction as a primary success measure. What is that measure?", "options": ["A KPI", "A persona", "A wireframe", "A signifier"], "answer": 0, "projectPrompt": "Explain how you would connect a UX change to a KPI without overclaiming causation.", "keywords": ["KPI", "measure", "outcome", "track", "evidence"], "model": "I would define the KPI before launch and compare the relevant outcome after the change, while being careful not to claim the design alone caused every shift."}, {"level": 7, "term": "Tradeoff", "definition": "A decision where improving one thing requires accepting a cost or limitation somewhere else.", "when": "Use it when time, scope, usability, performance, risk, or business goals cannot all be optimized simultaneously.", "scenario": "A richer dashboard would help power users but delay launch by three months. The team must decide what matters more right now. What are they evaluating?", "options": ["A tradeoff", "A mental model", "A taxonomy", "A card sort"], "answer": 0, "projectPrompt": "Explain how you would communicate a design tradeoff.", "keywords": ["tradeoff", "benefit", "cost", "decision", "impact"], "model": "I made the tradeoff explicit by showing the user benefit, implementation cost, and risks of each option so the team could make an informed decision."}, {"level": 7, "term": "Feasibility", "definition": "Whether a solution can realistically be built and supported with available technology, resources, and constraints.", "when": "Use it when evaluating whether an idea can be implemented in the real environment.", "scenario": "A concept depends on real-time ERP data, but the system exposes no API. Which lens is most directly affected?", "options": ["Feasibility", "Desirability", "Visual hierarchy", "Persona quality"], "answer": 0, "projectPrompt": "Explain how feasibility influenced one of your workflow ideas.", "keywords": ["feasible", "technical", "system", "constraint", "build"], "model": "I adjusted the proposed workflow after learning the current systems could not support real-time integration, balancing the ideal experience with technical feasibility."}, {"level": 7, "term": "Desirability", "definition": "Whether a solution addresses real user needs and is something people actually want or value.", "when": "Use it when assessing whether a concept is meaningful from the user's perspective.", "scenario": "A feature is technically impressive, but research shows users do not need or want it. Which product lens is weak?", "options": ["Desirability", "Feasibility", "Viability", "Contrast"], "answer": 0, "projectPrompt": "Explain how research helps evaluate desirability.", "keywords": ["desirable", "user", "need", "value", "research"], "model": "I used research to determine whether the concept solved a meaningful user need instead of assuming that a technically possible feature would be valuable."}, {"level": 7, "term": "Viability", "definition": "Whether a solution can create sustainable value for the organization or business.", "when": "Use it when considering costs, revenue, strategy, operations, risk, or long-term organizational value.", "scenario": "A service would delight users and is technically possible, but costs more to operate than the business can sustain. Which lens is the problem?", "options": ["Viability", "Desirability", "Affordance", "Card sorting"], "answer": 0, "projectPrompt": "Explain why UX designers should understand viability even if they are not business analysts.", "keywords": ["viability", "business", "sustain", "value", "cost"], "model": "I consider viability because a user-centered solution still has to work within the organization's business and operational realities to survive."}, {"level": 8, "term": "Design rationale", "definition": "A clear explanation of why a design decision was made, grounded in evidence, goals, and constraints.", "when": "Use it when presenting work, defending decisions, or helping others understand the reasoning behind a solution.", "scenario": "A stakeholder asks, 'Why did you move this field earlier in the flow?' What should you provide instead of 'because it looks better'?", "options": ["Design rationale", "A new persona", "A color palette", "A sitemap"], "answer": 0, "projectPrompt": "Explain a design decision using a strong rationale.", "keywords": ["because", "research", "user", "constraint", "decision"], "model": "I moved the field earlier because testing showed users needed that information to make the next decision, reducing backtracking in the flow."}, {"level": 8, "term": "Stakeholder alignment", "definition": "Building shared understanding and agreement among people who influence or depend on the project.", "when": "Use it when teams have conflicting expectations, goals, terminology, or priorities.", "scenario": "Marketing, operations, and engineering disagree about what the project is solving. What does the team need before moving forward?", "options": ["Stakeholder alignment", "More decorative UI", "A larger survey only", "A new font"], "answer": 0, "projectPrompt": "Explain how you would create stakeholder alignment early in a project.", "keywords": ["align", "stakeholder", "shared", "goal", "scope"], "model": "I would align stakeholders on the problem, goals, constraints, and decision criteria early so later design conversations are grounded in the same expectations."}, {"level": 8, "term": "Design critique", "definition": "A structured discussion that evaluates design decisions against goals, evidence, and principles to improve the work.", "when": "Use it when a team needs thoughtful feedback on a design rather than personal taste.", "scenario": "Which comment belongs in a healthy design critique?", "options": ["The primary action may be hard to find because it has the same visual weight as secondary links.", "I just hate blue.", "Make it pop.", "My cousin would never use this."], "answer": 0, "projectPrompt": "Explain how you would give useful critique to another designer.", "keywords": ["goal", "evidence", "specific", "design", "feedback"], "model": "I would connect feedback to the user goal or design principle, describe the specific issue I see, and invite discussion rather than presenting my preference as fact."}, {"level": 8, "term": "Developer handoff", "definition": "The process of communicating design specifications, behavior, assets, states, and context needed for implementation.", "when": "Use it when designs move from design into engineering and questions must be resolved collaboratively.", "scenario": "A designer provides only a static happy-path screen with no empty, loading, hover, or error states. What part of the process is incomplete?", "options": ["Developer handoff", "Card sorting", "Persona research", "Business viability"], "answer": 0, "projectPrompt": "Explain what you would include in a strong developer handoff.", "keywords": ["handoff", "states", "behavior", "spec", "developer"], "model": "I would document key states and interactions, provide specifications and assets, and stay available to resolve implementation questions with developers."}, {"level": 8, "term": "Experiment", "definition": "A structured test used to learn whether a change produces an expected effect.", "when": "Use it when uncertainty can be reduced by comparing outcomes under controlled or measurable conditions.", "scenario": "The team tests two versions of a call-to-action with randomly assigned traffic to compare conversion. What are they running?", "options": ["An experiment", "A card sort", "A sitemap", "A persona workshop"], "answer": 0, "projectPrompt": "Explain what makes an experiment stronger than simply launching a change and hoping.", "keywords": ["experiment", "hypothesis", "measure", "compare", "outcome"], "model": "A strong experiment starts with a hypothesis and success measure, then compares outcomes in a way that helps isolate whether the change had the expected effect."}, {"level": 8, "term": "Success metric", "definition": "A specific measure used to determine whether a design or product change achieved its intended outcome.", "when": "Use it before or during implementation so 'success' is defined in measurable terms.", "scenario": "The goal is to reduce incomplete requests. Which is the strongest success metric?", "options": ["Percentage of requests submitted with all required information", "Whether stakeholders like the new color", "Number of design files created", "How modern the page feels"], "answer": 0, "projectPrompt": "Explain a success metric for a workflow improvement.", "keywords": ["metric", "measure", "rate", "time", "errors", "success"], "model": "I would measure the rate of complete submissions and the amount of follow-up required, because those directly reflect whether the workflow reduced rework."}, {"level": 8, "term": "Iteration", "definition": "Improving a design through repeated cycles of learning, change, and evaluation.", "when": "Use it when evidence shows the first solution needs refinement rather than treating the first concept as final.", "scenario": "Testing reveals users misunderstand the filter labels, so the team revises them and tests again. What process is this?", "options": ["Iteration", "Taxonomy freeze", "One-and-done design", "Business modeling"], "answer": 0, "projectPrompt": "Explain why iteration is an important part of your case-study story.", "keywords": ["iterate", "test", "change", "learn", "again"], "model": "I show iteration because it demonstrates how evidence changed the design instead of presenting the final screen as if it appeared perfectly on the first try."}, {"level": 8, "term": "Retrospective", "definition": "A structured reflection on what worked, what did not, and what the team should change next time.", "when": "Use it after a project or milestone to improve future collaboration and process.", "scenario": "At the end of a project, the team discusses what to keep, stop, and change in the next cycle. What are they doing?", "options": ["A retrospective", "A card sort", "A usability test", "A persona interview"], "answer": 0, "projectPrompt": "Explain what you could say in an interview when asked what you would do differently.", "keywords": ["learned", "different", "next", "reflect", "improve"], "model": "I would explain what I learned, name one decision or process I would change with hindsight, and describe how that lesson would improve my next project."}];
const LEVEL_INFO = {"1": ["UX Foundations", "Learn the language that explains how people experience interfaces."], "2": ["Research Detective", "Choose the right way to learn what users do, need, and struggle with."], "3": ["Problem Framing", "Turn messy observations into clear opportunities and testable questions."], "4": ["Information Architecture", "Organize content so people can actually find and understand it."], "5": ["Interaction & UI", "Design clear structure, behavior, feedback, and flows."], "6": ["Usability & Accessibility", "Make experiences easier to use and more inclusive."], "7": ["Product Reality", "Balance user value with business goals and technical reality."], "8": ["Interview Boss Battle", "Explain your work like a confident UX professional."]};

const defaultState = {
  xp:0, pearls:0, streak:0, lastDay:null,
  stats:{}, unlockedThemes:["Classic Milk Tea"], activeTheme:"Classic Milk Tea",
  unlockedSounds:["Arcade Pop"], activeSound:"Arcade Pop",
  badges:[], levelProgress:{}
};
let state = loadState();
let session = null;
let flashIndex = 0;
let flashTab = "definition";

const themes = {
  "Classic Milk Tea":{bg:"#fffaf4",accent:"#b84fe0",accent2:"#6aa8ff",accent3:"#ffcc65"},
  "Taro Dream":{bg:"#fbf7ff",accent:"#8e5bd9",accent2:"#c79cff",accent3:"#ffd67e"},
  "Matcha Mode":{bg:"#f7fbf3",accent:"#6a9b57",accent2:"#9bcf82",accent3:"#f0d781"},
  "Blueberry Arcade":{bg:"#f5f8ff",accent:"#526fd8",accent2:"#7eb6ff",accent3:"#f0b5dc"}
};
const shopItems = [
  {kind:"theme",name:"Taro Dream",cost:120,emoji:"💜",desc:"Soft purple focus mode."},
  {kind:"theme",name:"Matcha Mode",cost:140,emoji:"🍵",desc:"Calm green study mode."},
  {kind:"theme",name:"Blueberry Arcade",cost:160,emoji:"🫐",desc:"Cool blue game-night mode."},
  {kind:"sound",name:"Neo-Soul Chime",cost:100,emoji:"🎹",desc:"Smooth synth reward sound."},
  {kind:"sound",name:"Boba Pop",cost:80,emoji:"🧋",desc:"Bubble-pop reward sound."},
  {kind:"sound",name:"Boss Win",cost:180,emoji:"👾",desc:"Mini victory fanfare."}
];

function loadState(){
  try{ return Object.assign(structuredClone(defaultState), JSON.parse(localStorage.getItem("uxQuestState")||"{}")); }
  catch(e){ return structuredClone(defaultState); }
}
function saveState(){ localStorage.setItem("uxQuestState",JSON.stringify(state)); updateUI(); }
function statKey(term,type){ return term+"|"+type; }
function getStat(term,type){ return state.stats[statKey(term,type)]||{right:0,wrong:0}; }
function record(term,type,correct){
  const k=statKey(term,type); state.stats[k]=state.stats[k]||{right:0,wrong:0};
  state.stats[k][correct?"right":"wrong"]++;
}
function todayKey(){ return new Date().toISOString().slice(0,10); }
function updateStreak(){
  const today=todayKey();
  if(state.lastDay===today) return;
  if(state.lastDay){
    const d1=new Date(state.lastDay+"T12:00:00"), d2=new Date(today+"T12:00:00");
    const days=Math.round((d2-d1)/86400000);
    state.streak = days===1 ? state.streak+1 : 1;
  } else state.streak=1;
  state.lastDay=today;
}
function rank(){
  const x=state.xp;
  if(x>=6000)return "UX Boss";
  if(x>=4000)return "Experience Strategist";
  if(x>=2500)return "Friction Finder";
  if(x>=1400)return "Research Detective";
  if(x>=600)return "UX Adventurer";
  return "UX Rookie";
}
function levelCompletion(level){
  const items=CONCEPTS.filter(c=>c.level===level); let earned=0,total=items.length*3;
  items.forEach(c=>["definition","scenario","speak"].forEach(t=>{if(getStat(c.term,t).right>0)earned++;}));
  return Math.round(100*earned/total);
}
function updateUI(){
  document.getElementById("xp").textContent=state.xp;
  document.getElementById("pearls").textContent=state.pearls;
  document.getElementById("streak").textContent=state.streak;
  document.getElementById("rank").textContent=rank();
  applyTheme(); renderLevels(); renderDaily(); renderShop();
}
function applyTheme(){
  const t=themes[state.activeTheme]||themes["Classic Milk Tea"];
  document.documentElement.style.setProperty("--bg",t.bg);
  document.documentElement.style.setProperty("--accent",t.accent);
  document.documentElement.style.setProperty("--accent2",t.accent2);
  document.documentElement.style.setProperty("--accent3",t.accent3);
}
function renderLevels(){
  const el=document.getElementById("levels"); el.innerHTML="";
  Object.keys(LEVEL_INFO).forEach(k=>{
    const level=+k, info=LEVEL_INFO[k], pct=levelCompletion(level);
    const b=document.createElement("button"); b.className="level"; b.onclick=()=>startLevel(level);
    b.innerHTML=`<div class="lvl-num">${level}</div><div style="text-align:left;flex:1"><h4>${info[0]}</h4><p>${info[1]}</p><div class="progress"><span style="width:${pct}%"></span></div><p style="margin-top:5px">${pct}% mastered</p></div>`;
    el.appendChild(b);
  });
}
function hashDate(s){ let h=0; for(const ch of s) h=(h*31+ch.charCodeAt(0))>>>0; return h; }
function dailyConcepts(){
  const arr=[...CONCEPTS], seed=hashDate(todayKey());
  arr.sort((a,b)=>((hashDate(a.term)+seed)%997)-((hashDate(b.term)+seed)%997));
  return arr.slice(0,3);
}
function renderDaily(){
  const list=dailyConcepts();
  document.getElementById("dailyBox").innerHTML=list.map(c=>`<div class="badge">🎧 ${c.term}</div>`).join("")+
  `<div style="margin-top:12px;color:var(--muted);font-size:13px">Finish all three for a <b>+25 pearl</b> bonus.</div>`;
}
function renderShop(){
  const el=document.getElementById("shop"); el.innerHTML="";
  shopItems.forEach(it=>{
    const unlocked=it.kind==="theme"?state.unlockedThemes.includes(it.name):state.unlockedSounds.includes(it.name);
    const active=it.kind==="theme"?state.activeTheme===it.name:state.activeSound===it.name;
    const d=document.createElement("div"); d.className="shop-item";
    d.innerHTML=`<div><b>${it.emoji} ${it.name}</b><small>${it.desc}</small></div>`;
    const btn=document.createElement("button"); btn.className="btn secondary";
    btn.textContent=active?"Active":unlocked?"Use":`${it.cost} 🧋`;
    btn.disabled=active;
    btn.onclick=()=>buyItem(it);
    d.appendChild(btn); el.appendChild(d);
  });
}
function buyItem(it){
  const list=it.kind==="theme"?state.unlockedThemes:state.unlockedSounds;
  if(!list.includes(it.name)){
    if(state.pearls<it.cost) return toast("Not enough pearls yet. Keep questing 🧋");
    state.pearls-=it.cost; list.push(it.name); celebrate(); toast(`${it.name} unlocked!`);
  }
  if(it.kind==="theme")state.activeTheme=it.name; else state.activeSound=it.name;
  saveState(); playReward();
}
function reward(correct,bonus=0){
  if(correct){
    state.xp+=100+bonus; state.pearls+=8+Math.floor(bonus/20); updateStreak(); playReward();
  }
  saveState();
}
function playTone(freq=520,dur=.08,type="sine",delay=0){
  try{ const ctx=playTone.ctx||(playTone.ctx=new (window.AudioContext||window.webkitAudioContext)());
    const o=ctx.createOscillator(),g=ctx.createGain(); o.type=type;o.frequency.value=freq;o.connect(g);g.connect(ctx.destination);
    const t=ctx.currentTime+delay; g.gain.setValueAtTime(.0001,t);g.gain.exponentialRampToValueAtTime(.12,t+.01);g.gain.exponentialRampToValueAtTime(.0001,t+dur);
    o.start(t);o.stop(t+dur+.02);
  }catch(e){}
}
function playReward(){
  const s=state.activeSound;
  if(s==="Neo-Soul Chime"){ playTone(392,.16,"triangle");playTone(523,.18,"triangle",.08);playTone(659,.22,"sine",.16); }
  else if(s==="Boba Pop"){ playTone(260,.06,"sine");playTone(520,.07,"sine",.06); }
  else if(s==="Boss Win"){ [330,440,554,659].forEach((f,i)=>playTone(f,.16,"square",i*.07)); }
  else { playTone(520,.07,"square");playTone(700,.08,"square",.07); }
}
function celebrate(){
  const box=document.getElementById("confetti"); box.innerHTML="";
  const colors=["#b84fe0","#6aa8ff","#ffcc65","#ff8cb3","#74c69d"];
  for(let i=0;i<32;i++){ const p=document.createElement("i");p.style.left=Math.random()*100+"%";p.style.background=colors[i%colors.length];p.style.animationDelay=(Math.random()*.35)+"s";box.appendChild(p); }
  setTimeout(()=>box.innerHTML="",2000);
}
function toast(msg){ const t=document.getElementById("toast");t.textContent=msg;t.classList.add("show");clearTimeout(toast.timer);toast.timer=setTimeout(()=>t.classList.remove("show"),2200); }
function showModal(html){ document.getElementById("modal").innerHTML=html;document.getElementById("overlay").classList.add("show"); }
function closeModal(){ document.getElementById("overlay").classList.remove("show");session=null; }
document.getElementById("overlay").addEventListener("click",e=>{if(e.target.id==="overlay")closeModal();});
document.addEventListener("keydown",e=>{ if(e.key==="Escape")closeModal(); if(session && session.type==="quiz" && ["1","2","3","4"].includes(e.key)){ const btn=document.querySelectorAll(".answer")[+e.key-1]; if(btn)btn.click(); } });

function startLevel(level){
  const pool=CONCEPTS.filter(c=>c.level===level);
  startQuiz(pool,"mixed",8,`Level ${level} · ${LEVEL_INFO[level][0]}`);
}
function startDaily(){
  startQuiz(dailyConcepts(),"mixed",6,"Today's Mini Mission",true);
}
function openReview(){
  const weak=CONCEPTS.filter(c=>["definition","scenario","speak"].some(t=>getStat(c.term,t).wrong>getStat(c.term,t).right));
  if(!weak.length) return toast("No weak spots yet. Play a few rounds first 🎮");
  startQuiz(weak,"mixed",Math.min(8,weak.length*2),"Review My Misses");
}
function startMode(mode){
  if(mode==="flash") return openFlashcards();
  startQuiz(CONCEPTS,mode,8, mode==="scenario"?"Scenario Sprint":mode==="speak"?"Speak Like a UX Designer":"Arcade Mix");
}
function shuffled(a){ return [...a].sort(()=>Math.random()-.5); }
function startQuiz(pool,mode,count,title,daily=false){
  const qs=[];
  const chosen=shuffled(pool).slice(0,Math.max(3,Math.ceil(count/2)));
  for(const c of chosen){
    const types=mode==="scenario"?["scenario"]:mode==="speak"?["speak"]:mode==="mixed"?shuffled(["definition","scenario","speak"]):["definition","scenario","speak"];
    for(const type of types){ qs.push({c,type}); if(qs.length>=count)break; }
    if(qs.length>=count)break;
  }
  while(qs.length<count){
    const c=pool[Math.floor(Math.random()*pool.length)], type=mode==="scenario"?"scenario":mode==="speak"?"speak":["definition","scenario","speak"][Math.floor(Math.random()*3)];
    qs.push({c,type});
  }
  session={type:"quiz",questions:qs,index:0,score:0,title,daily};
  renderQuestion();
}
function renderQuestion(){
  const q=session.questions[session.index], c=q.c, type=q.type;
  let body="";
  if(type==="definition"){
    const distract=shuffled(CONCEPTS.filter(x=>x.level===c.level && x.term!==c.term)).slice(0,3).map(x=>x.definition);
    const opts=shuffled([c.definition,...distract]); const ans=opts.indexOf(c.definition);
    session.currentAnswer=ans;
    body=`<div class="q-meta"><span class="pill">🧠 WHAT DOES IT MEAN?</span><span class="pill">Level ${c.level}</span></div>
      <div class="question">Which definition best matches <b>${c.term}</b>?</div>
      <div class="answers">${opts.map((o,i)=>`<button class="answer" onclick="answerMC(${i})"><span class="kbd">${i+1}</span> ${o}</button>`).join("")}</div>`;
  } else if(type==="scenario"){
    session.currentAnswer=c.answer;
    body=`<div class="q-meta"><span class="pill">🕵🏾 WHEN WOULD I USE IT?</span><span class="pill">Level ${c.level}</span></div>
      <div class="question">${c.scenario}</div>
      <div class="answers">${c.options.map((o,i)=>`<button class="answer" onclick="answerMC(${i})"><span class="kbd">${i+1}</span> ${o}</button>`).join("")}</div>`;
  } else {
    body=`<div class="q-meta"><span class="pill">🎤 PROJECT TRANSLATOR</span><span class="pill">Level ${c.level}</span></div>
      <div class="question">${c.projectPrompt}</div>
      <p style="color:var(--muted)">Write it the way you'd explain it in an interview or case study. You don't need to match the model answer word-for-word.</p>
      <textarea class="text-answer" id="speakAnswer" placeholder="Try your answer here..."></textarea>
      <div style="margin-top:10px"><button class="btn accent" onclick="gradeSpeak()">Check My Answer</button></div>`;
  }
  showModal(`<div class="modal-head"><div><small style="color:var(--muted)">${session.title} · ${session.index+1}/${session.questions.length}</small><h2>${c.term}</h2></div><button class="close" onclick="closeModal()">✕</button></div>${body}<div class="feedback" id="feedback"></div><div class="quest-footer"><span>Score: <b>${session.score}</b></span><span>⭐ ${state.xp} XP · 🧋 ${state.pearls}</span></div>`);
}
function answerMC(i){
  const q=session.questions[session.index], correct=i===session.currentAnswer;
  document.querySelectorAll(".answer").forEach((b,idx)=>{b.disabled=true;if(idx===session.currentAnswer)b.classList.add("correct");else if(idx===i&&!correct)b.classList.add("wrong");});
  record(q.c.term,q.type,correct); if(correct){session.score++;reward(true);} else saveState();
  const fb=document.getElementById("feedback");fb.classList.add("show");
  fb.innerHTML=`<b>${correct?"✅ Nice!":"❌ Not quite."}</b><br>${q.type==="definition"?q.c.when:q.c.definition}<br><button class="btn secondary" style="margin-top:10px" onclick="nextQuestion()">Next →</button>`;
}
function gradeSpeak(){
  const q=session.questions[session.index], txt=(document.getElementById("speakAnswer").value||"").toLowerCase().trim();
  if(txt.length<12)return toast("Give it a real try first 😭");
  const hits=q.c.keywords.filter(k=>txt.includes(k.toLowerCase())).length;
  const pass=hits>=Math.max(2,Math.ceil(q.c.keywords.length*.35));
  record(q.c.term,q.type,pass); if(pass){session.score++;reward(true,40);} else saveState();
  const fb=document.getElementById("feedback");fb.classList.add("show");
  fb.innerHTML=`<b>${pass?"🎤 That sounds UX-ready.":"📝 Good start—make the reasoning more explicit."}</b>
  <div class="model-answer"><b>Model answer:</b><br>${q.c.model}</div>
  <div style="margin-top:8px;color:var(--muted);font-size:13px">Helpful ideas to include: ${q.c.keywords.join(", ")}</div>
  <button class="btn secondary" style="margin-top:10px" onclick="nextQuestion()">Next →</button>`;
}
function nextQuestion(){
  session.index++;
  if(session.index>=session.questions.length)return finishQuest();
  renderQuestion();
}
function finishQuest(){
  const pct=Math.round(100*session.score/session.questions.length);
  let bonus=0;
  if(pct>=80){bonus=30;state.pearls+=bonus;}
  if(session.daily && pct>=70){state.pearls+=25;bonus+=25;}
  const earnedBadge = pct===100 ? "Perfect Pour" : pct>=80 ? "Boba Scholar" : null;
  if(earnedBadge && !state.badges.includes(earnedBadge)) state.badges.push(earnedBadge);
  saveState(); if(pct>=80)celebrate();
  showModal(`<div class="modal-head"><div><small>QUEST COMPLETE</small><h2>${pct>=80?"🧋 Boba break earned.":"🎮 Run it back when you're ready."}</h2></div><button class="close" onclick="closeModal()">✕</button></div>
    <div style="font-size:72px;text-align:center;margin:10px 0">${pct>=80?"🎧🧋":"📝"}</div>
    <div style="text-align:center"><div style="font-size:44px;font-weight:900">${session.score} / ${session.questions.length}</div><p style="color:var(--muted)">You scored ${pct}%. ${bonus?`Bonus: +${bonus} pearls.`:"Every miss is now eligible for targeted review."}</p></div>
    <div class="reward-row" style="justify-content:center">${state.badges.map(b=>`<span class="badge">🏆 ${b}</span>`).join("")}</div>
    <div style="display:flex;justify-content:center;gap:10px;margin-top:22px"><button class="btn accent" onclick="closeModal();startMode('mixed')">Play Another Round</button><button class="btn secondary" onclick="closeModal()">Back to Map</button></div>`);
}
function openFlashcards(){
  flashIndex=0;flashTab="definition";renderFlash();
}
function renderFlash(){
  const c=CONCEPTS[flashIndex%CONCEPTS.length];
  let content=flashTab==="definition"?c.definition:flashTab==="when"?c.when:c.model;
  showModal(`<div class="modal-head"><div><small>FLASHCARD FLIP · ${flashIndex+1}/${CONCEPTS.length}</small><h2>🃏 UX Flashcards</h2></div><button class="close" onclick="closeModal()">✕</button></div>
  <div class="flash-card"><div><div class="term">${c.term}</div><div class="hint">Use the tabs below to reveal all three layers.</div><div style="font-size:18px;line-height:1.5;margin-top:22px">${content}</div></div></div>
  <div class="flash-tabs"><button class="tab ${flashTab==="definition"?"active":""}" onclick="flashTab='definition';renderFlash()">Meaning</button><button class="tab ${flashTab==="when"?"active":""}" onclick="flashTab='when';renderFlash()">When to use</button><button class="tab ${flashTab==="project"?"active":""}" onclick="flashTab='project';renderFlash()">Project language</button></div>
  <div class="quest-footer"><button class="btn secondary" onclick="flashIndex=Math.max(0,flashIndex-1);renderFlash()">← Previous</button><button class="btn accent" onclick="flashIndex=(flashIndex+1)%CONCEPTS.length;renderFlash()">Next →</button></div>`);
}
function openGlossary(){
  const grouped={};CONCEPTS.forEach(c=>(grouped[c.level]=grouped[c.level]||[]).push(c));
  showModal(`<div class="modal-head"><div><small>REFERENCE MODE</small><h2>📚 UX Glossary</h2></div><button class="close" onclick="closeModal()">✕</button></div>
    <input id="glSearch" oninput="filterGlossary()" placeholder="Search a term..." style="width:100%;padding:12px;border:1px solid var(--line);border-radius:12px;margin-bottom:14px">
    <div id="glossaryList" class="glossary">${CONCEPTS.map(c=>`<div class="gl-item" data-search="${(c.term+" "+c.definition).toLowerCase()}"><b>${c.term}</b><span>${c.definition}</span></div>`).join("")}</div>`);
}
function filterGlossary(){
 const q=document.getElementById("glSearch").value.toLowerCase();
 document.querySelectorAll(".gl-item").forEach(x=>x.style.display=x.dataset.search.includes(q)?"block":"none");
}
function exportProgress(){
  const blob=new Blob([JSON.stringify(state,null,2)],{type:"application/json"});const a=document.createElement("a");a.href=URL.createObjectURL(blob);a.download="ux-quest-progress.json";a.click();URL.revokeObjectURL(a.href);
}
document.getElementById("importFile").addEventListener("change",e=>{
  const f=e.target.files[0];if(!f)return;const r=new FileReader();r.onload=()=>{try{state=Object.assign(structuredClone(defaultState),JSON.parse(r.result));saveState();toast("Progress imported 🎮");}catch(err){toast("That file didn't work.")}};r.readAsText(f);
});
function resetProgress(){
  if(confirm("Reset all UX Quest progress, rewards, and unlocks?")){state=structuredClone(defaultState);saveState();toast("Fresh save file started.");}
}
updateUI();
</script>
</body>
</html>