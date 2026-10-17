<?php
/*
 * VELVET INK STUDIO — private/unlisted music + storytelling workspace
 * Suggested URL: https://tanaybradley.com/velvet-ink-studio.php
 *
 * Upload this single file to the root of your website. Do not add it to public
 * navigation. The noindex rules below discourage search indexing, but an
 * unlisted URL is not password protection. Use host-level password protection
 * if the writing is sensitive.
 *
 * Most data stays in this browser's localStorage. Use Export Backup regularly.
 * The optional in-page Studio Coach requires PHP cURL and server environment
 * variables OPENAI_API_KEY and (optionally) OPENAI_MODEL. Never put an API key
 * in browser JavaScript. The Copy + Open ChatGPT workflow works without an API.
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['studio_coach'])) {
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');

    $raw = file_get_contents('php://input');
    $payload = json_decode($raw ?: '', true);
    $question = trim((string)($payload['question'] ?? ''));
    $context = trim((string)($payload['context'] ?? ''));
    $thread = is_array($payload['thread'] ?? null) ? array_slice($payload['thread'], -8) : [];

    $textLength = function ($value) { return function_exists('mb_strlen') ? mb_strlen($value) : strlen($value); };
    $textSlice = function ($value, $length) { return function_exists('mb_substr') ? mb_substr($value, 0, $length) : substr($value, 0, $length); };
    if ($question === '' || $textLength($question) > 2500 || $textLength($context) > 24000) {
        http_response_code(422);
        echo json_encode(['error' => 'Please include a shorter question and selected context.']);
        exit;
    }

    $apiKey = getenv('OPENAI_API_KEY');
    if (!$apiKey) {
        http_response_code(503);
        echo json_encode(['error' => 'The in-page coach is not configured yet. Use Copy + Open ChatGPT, or add OPENAI_API_KEY on the server.']);
        exit;
    }
    if (!function_exists('curl_init')) {
        http_response_code(503);
        echo json_encode(['error' => 'PHP cURL is not enabled on this server.']);
        exit;
    }

    $history = '';
    foreach ($thread as $message) {
        $role = (($message['role'] ?? '') === 'assistant') ? 'Coach' : 'Writer';
        $body = $textSlice(trim((string)($message['text'] ?? '')), 2500);
        if ($body !== '') $history .= "\n{$role}: {$body}";
    }

    $requestBody = [
        'model' => getenv('OPENAI_MODEL') ?: 'gpt-6-astra',
        'store' => false,
        'max_output_tokens' => 900,
        'instructions' => 'You are Velvet Ink Studio Coach, a warm but honest creative partner for one songwriter and storyteller. Preserve the writer’s voice. Never claim ownership. Do not rewrite an entire piece unless directly asked. Keep advice concrete, concise, and organized into: What is working, What may be drifting, and One next move. When helpful, offer 2-4 options rather than one answer. Treat all supplied journal context as private. Do not invent details that are not present.',
        'input' => "SELECTED PRIVATE CONTEXT:\n{$context}\n\nRECENT PROJECT CONVERSATION:{$history}\n\nWRITER REQUEST:\n{$question}"
    ];

    $curl = curl_init('https://api.openai.com/v1/responses');
    curl_setopt_array($curl, [
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 45,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json'
        ],
        CURLOPT_POSTFIELDS => json_encode($requestBody)
    ]);
    $responseBody = curl_exec($curl);
    $status = (int)curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $curlError = curl_error($curl);
    curl_close($curl);

    if ($responseBody === false || $curlError) {
        http_response_code(502);
        echo json_encode(['error' => 'The coach could not reach the API. Please try again later.']);
        exit;
    }

    $response = json_decode($responseBody, true);
    if ($status < 200 || $status >= 300) {
        http_response_code(502);
        $message = $response['error']['message'] ?? 'The coach request could not be completed.';
        echo json_encode(['error' => $message]);
        exit;
    }

    $answer = trim((string)($response['output_text'] ?? ''));
    if ($answer === '' && is_array($response['output'] ?? null)) {
        foreach ($response['output'] as $item) {
            foreach (($item['content'] ?? []) as $content) {
                if (($content['type'] ?? '') === 'output_text' && isset($content['text'])) {
                    $answer .= ($answer ? "\n" : '') . $content['text'];
                }
            }
        }
    }
    if ($answer === '') $answer = 'I could not form a response this time. Try a more specific question.';
    echo json_encode(['answer' => $answer]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow, noarchive, nosnippet">
  <meta name="googlebot" content="noindex, nofollow, noarchive, nosnippet">
  <meta name="referrer" content="no-referrer">
  <meta name="theme-color" content="#3f254f">
  <title>Velvet Ink Studio | Tanay's Music + Story Lab</title>
  <style>
    :root {
      --ink:#34223f; --muted:#72657a; --plum:#583167; --plum-2:#7b4a8c;
      --paper:#fffaf5; --cream:#fff2dc; --lilac:#e9d8ff; --lav:#c8b1ff;
      --pink:#ffafd2; --coral:#ff9b91; --mint:#b8ead7; --sky:#bce1ff;
      --gold:#ffd982; --green:#438b71; --red:#bd486c; --white:#fff;
      --line:2px solid rgba(70,42,83,.12); --shadow:0 18px 48px rgba(62,37,75,.14);
      --soft-shadow:0 9px 24px rgba(62,37,75,.1); --radius:24px; --sidebar:270px;
    }
    *{box-sizing:border-box} html{scroll-behavior:smooth} [hidden]{display:none!important}
    body{margin:0;min-height:100vh;color:var(--ink);font-family:"Trebuchet MS","Avenir Next",Avenir,Arial,sans-serif;line-height:1.5;background:radial-gradient(circle at 5% 7%,rgba(255,175,210,.3),transparent 24%),radial-gradient(circle at 90% 11%,rgba(188,225,255,.38),transparent 22%),radial-gradient(circle at 72% 90%,rgba(184,234,215,.35),transparent 26%),linear-gradient(140deg,#fffaf5,#f8f1ff 52%,#f4fbff)}
    body:before{content:"";position:fixed;inset:0;z-index:-2;opacity:.38;pointer-events:none;background-image:radial-gradient(rgba(88,49,103,.17) 1px,transparent 1px);background-size:23px 23px}
    body.privacy .sensitive{filter:blur(8px);user-select:none;transition:filter .2s} body.privacy .sensitive:hover{filter:blur(3px)}
    button,input,select,textarea{font:inherit} button{color:inherit} a{color:#69427a} :focus-visible{outline:3px solid #8a5be1;outline-offset:3px}
    .skip{position:fixed;left:12px;top:-60px;z-index:200;background:#fff;padding:10px 15px;border-radius:12px}.skip:focus{top:12px}
    .shell{display:grid;grid-template-columns:var(--sidebar) minmax(0,1fr);min-height:100vh}
    .sidebar{position:fixed;inset:0 auto 0 0;width:var(--sidebar);z-index:30;overflow:auto;padding:24px 18px;color:#fff;background:linear-gradient(160deg,rgba(63,37,79,.98),rgba(100,54,111,.97));box-shadow:13px 0 38px rgba(52,27,62,.2)}
    .sidebar:after{content:"✦  ·  ♫  ·  ✧";position:absolute;top:10px;right:13px;color:rgba(255,255,255,.2);letter-spacing:8px;transform:rotate(7deg)}
    .brand{position:relative;display:flex;align-items:center;gap:12px;margin:8px 4px 26px;z-index:1}.brand-mark{display:grid;place-items:center;width:56px;height:56px;border-radius:20px;background:linear-gradient(135deg,var(--pink),var(--gold));border:2px solid rgba(255,255,255,.55);font-size:28px;box-shadow:0 10px 20px rgba(24,11,31,.28);transform:rotate(-5deg)}
    .brand strong{display:block;font-family:Georgia,serif;font-size:1.05rem}.brand small{color:#e9dff0;font-size:.73rem}
    .nav-label{margin:18px 12px 8px;color:#cdbfd4;font-size:.67rem;font-weight:900;letter-spacing:.15em;text-transform:uppercase}
    .nav{display:grid;gap:7px}.nav button{display:flex;gap:11px;align-items:center;width:100%;min-height:48px;padding:10px 13px;border:0;border-radius:15px;background:transparent;color:#f4edf7;text-align:left;cursor:pointer;transition:.18s}.nav button:hover{background:rgba(255,255,255,.1);transform:translateX(3px)}.nav button.active{color:var(--ink);background:#fff;box-shadow:0 9px 22px rgba(24,11,31,.25)}.nav .icon{width:25px;text-align:center;font-size:1.15rem}
    .side-card{margin-top:24px;padding:15px;border:1px solid rgba(255,255,255,.2);border-radius:18px;background:rgba(255,255,255,.09);font-size:.78rem}.side-card strong{display:block;margin-bottom:5px}.side-card p{margin:0;color:#e6dbe9}.save-dot{display:inline-block;width:8px;height:8px;border-radius:50%;background:var(--mint);box-shadow:0 0 0 4px rgba(184,234,215,.14)}
    .main{grid-column:2;min-width:0;padding:25px clamp(17px,3vw,44px) 60px}.topbar{display:flex;justify-content:space-between;align-items:center;gap:18px;margin-bottom:22px}.topbar h1{margin:0;font-family:Georgia,serif;font-size:clamp(1.65rem,3vw,2.35rem)}.topbar p{margin:4px 0 0;color:var(--muted)}.top-actions,.actions,.inline-actions{display:flex;align-items:center;gap:9px;flex-wrap:wrap}
    .mobile-menu{display:none}.btn{display:inline-flex;align-items:center;justify-content:center;gap:7px;min-height:42px;padding:9px 14px;border:var(--line);border-radius:14px;background:#fff;box-shadow:var(--soft-shadow);font-weight:800;font-size:.83rem;cursor:pointer;transition:transform .16s,box-shadow .16s}.btn:hover{transform:translateY(-2px);box-shadow:0 12px 28px rgba(62,37,75,.15)}.btn.primary{color:#fff;border-color:transparent;background:linear-gradient(135deg,var(--plum-2),#8f64c5)}.btn.pink{background:linear-gradient(135deg,var(--pink),#ffd0bf);border-color:transparent}.btn.mint{background:linear-gradient(135deg,var(--mint),#dbf4dd);border-color:transparent}.btn.ghost{box-shadow:none;background:transparent}.btn.danger{color:var(--red);background:#fff5f7}.btn.small{min-height:34px;padding:6px 10px;font-size:.76rem}.icon-btn{width:38px;height:38px;border:var(--line);border-radius:13px;background:#fff;cursor:pointer}.help{display:inline-grid;place-items:center;width:22px;height:22px;border:0;border-radius:50%;background:var(--lilac);font-weight:900;cursor:pointer}
    .banner{display:flex;justify-content:space-between;gap:12px;align-items:center;margin-bottom:20px;padding:11px 14px;border:1px solid rgba(88,49,103,.1);border-radius:15px;background:rgba(255,255,255,.67);font-size:.79rem;color:var(--muted)}
    .view{display:none}.view.active{display:block}.hero{position:relative;overflow:hidden;padding:clamp(24px,4vw,42px);border:var(--line);border-radius:32px;background:linear-gradient(120deg,rgba(255,255,255,.95),rgba(255,242,220,.88));box-shadow:var(--shadow)}.hero:after{content:"♫";position:absolute;right:5%;bottom:-34px;color:rgba(123,74,140,.1);font-size:180px;transform:rotate(-12deg)}.eyebrow{margin:0 0 8px;color:var(--plum-2);font-size:.74rem;font-weight:900;letter-spacing:.14em;text-transform:uppercase}.hero h2{max-width:720px;margin:0;font-family:Georgia,serif;font-size:clamp(2rem,5vw,4.2rem);line-height:1.02}.hero p{max-width:670px;color:var(--muted);font-size:1.02rem}.hero-actions{position:relative;z-index:2;display:flex;gap:10px;flex-wrap:wrap;margin-top:20px}
    .sparkle{display:inline-block;animation:twinkle 2.1s infinite alternate}@keyframes twinkle{from{transform:scale(.85) rotate(-7deg);opacity:.55}to{transform:scale(1.15) rotate(7deg);opacity:1}}
    .grid{display:grid;gap:18px}.grid.two{grid-template-columns:repeat(2,minmax(0,1fr))}.grid.three{grid-template-columns:repeat(3,minmax(0,1fr))}.grid.four{grid-template-columns:repeat(4,minmax(0,1fr))}.section-space{margin-top:22px}.card{position:relative;padding:20px;border:var(--line);border-radius:var(--radius);background:rgba(255,255,255,.9);box-shadow:var(--soft-shadow)}.card.tint-pink{background:linear-gradient(145deg,#fff,#fff0f6)}.card.tint-mint{background:linear-gradient(145deg,#fff,#edfbf6)}.card.tint-lilac{background:linear-gradient(145deg,#fff,#f3ecff)}.card.tint-gold{background:linear-gradient(145deg,#fff,#fff7df)}.card h2,.card h3{margin:0 0 7px}.card h2{font-family:Georgia,serif}.card p{color:var(--muted)}.card-top{display:flex;justify-content:space-between;align-items:flex-start;gap:12px}.sticker{display:grid;place-items:center;width:44px;height:44px;border-radius:15px;background:var(--cream);font-size:22px;transform:rotate(3deg)}
    .stat{padding:18px;border:var(--line);border-radius:20px;background:rgba(255,255,255,.8)}.stat b{display:block;font-family:Georgia,serif;font-size:1.8rem}.stat small{color:var(--muted)}
    .progress{height:10px;overflow:hidden;border-radius:999px;background:#eee6ef}.progress i{display:block;height:100%;border-radius:inherit;background:linear-gradient(90deg,var(--pink),var(--plum-2));transition:width .3s}
    .section-head{display:flex;justify-content:space-between;align-items:end;gap:15px;margin-bottom:18px}.section-head h2{margin:0;font-family:Georgia,serif;font-size:clamp(1.45rem,3vw,2.15rem)}.section-head p{margin:4px 0 0;color:var(--muted)}
    .field{display:grid;gap:6px}.field label,.label{font-size:.77rem;font-weight:900;color:#5e4c67}.field small{color:var(--muted)}input,select,textarea{width:100%;border:2px solid #e6dce9;border-radius:13px;background:#fff;padding:10px 12px;color:var(--ink)}textarea{min-height:120px;resize:vertical}input:focus,select:focus,textarea:focus{border-color:#9c76d5;outline:0;box-shadow:0 0 0 4px rgba(156,118,213,.14)}.compact textarea{min-height:82px}.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px}.span-2{grid-column:1/-1}.check{display:flex;align-items:flex-start;gap:9px}.check input{width:18px;margin-top:3px}.chips{display:flex;gap:7px;flex-wrap:wrap}.chip{display:inline-flex;align-items:center;gap:5px;padding:5px 9px;border-radius:999px;background:var(--lilac);font-size:.72rem;font-weight:800}.chip.status{background:var(--mint)}.chip.warn{background:var(--gold)}
    .tabs{display:flex;gap:7px;overflow:auto;padding:3px 2px 10px}.tab{white-space:nowrap;padding:8px 12px;border:var(--line);border-radius:999px;background:#fff;cursor:pointer;font-weight:800;font-size:.8rem}.tab.active{color:#fff;background:var(--plum);border-color:var(--plum)}
    .empty{padding:34px 20px;border:2px dashed rgba(88,49,103,.2);border-radius:22px;text-align:center;color:var(--muted);background:rgba(255,255,255,.55)}.empty .emoji{display:block;font-size:2.4rem;margin-bottom:9px}.list{display:grid;gap:11px}.list-item{display:flex;justify-content:space-between;gap:12px;padding:14px;border:var(--line);border-radius:17px;background:#fff}.list-item h4{margin:0 0 3px}.list-item p{margin:0;color:var(--muted);font-size:.82rem}.clickable{cursor:pointer}.clickable:hover{border-color:rgba(123,74,140,.32);transform:translateY(-1px)}
    .filterbar{display:flex;gap:9px;align-items:center;flex-wrap:wrap;margin-bottom:15px}.filterbar input{max-width:300px}.filterbar select{width:auto;min-width:145px}.search{position:relative}.search input{padding-left:36px}.search:before{content:"⌕";position:absolute;left:13px;top:8px;font-size:20px;color:var(--muted)}
    .workspace{display:grid;grid-template-columns:260px minmax(0,1fr);gap:18px}.project-rail{align-self:start;position:sticky;top:18px;max-height:calc(100vh - 36px);overflow:auto;padding:14px;border:var(--line);border-radius:22px;background:rgba(255,255,255,.78);box-shadow:var(--soft-shadow)}.rail-head{display:flex;justify-content:space-between;align-items:center;gap:8px;margin-bottom:10px}.rail-project{display:block;width:100%;padding:11px;margin:6px 0;border:0;border-radius:13px;background:transparent;text-align:left;cursor:pointer}.rail-project:hover{background:#f7f0fa}.rail-project.active{background:var(--lilac)}.rail-project b{display:block}.rail-project small{color:var(--muted)}.work-main{min-width:0}.work-toolbar{position:sticky;top:0;z-index:10;display:flex;justify-content:space-between;gap:12px;align-items:center;margin-bottom:13px;padding:11px 13px;border:var(--line);border-radius:17px;background:rgba(255,250,245,.94);backdrop-filter:blur(12px);box-shadow:var(--soft-shadow)}
    .compass{border:2px solid rgba(123,74,140,.18);background:linear-gradient(135deg,#fff,#f6eeff)}.compass:before{content:"✦";position:absolute;right:18px;top:14px;color:#bd91e5;font-size:28px}.compass summary,.fold summary{cursor:pointer;font-weight:900}.compass-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px;margin-top:15px}.guided{padding:10px 12px;border-radius:13px;background:#fff6d9;color:#6e5730;font-size:.78rem}.guided strong{color:#49391f}body:not(.guided-on) .guided{display:none}
    .section-switcher{display:grid;grid-template-columns:auto minmax(160px,1fr) auto;gap:8px;align-items:center;margin-bottom:12px}.section-switcher select{min-width:0}.lyrics{min-height:390px;font-family:Georgia,serif;font-size:1.04rem;line-height:1.75;background:linear-gradient(#fff,#fffdfb)}.counter{display:flex;justify-content:space-between;margin-top:7px;color:var(--muted);font-size:.75rem}.sticky-note{padding:15px;border-radius:4px 18px 18px 18px;background:#fff2b9;box-shadow:4px 6px 0 rgba(126,91,26,.1);transform:rotate(-.3deg)}.sticky-note p{margin:5px 0;color:#5f4c24}.alt-line{padding:10px;border-left:4px solid var(--pink);background:#fff7fa;border-radius:0 12px 12px 0}
    .revision-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:9px}.revision{padding:11px;border:var(--line);border-radius:14px;background:#fff}.revision.done{background:#eefaf5;text-decoration:line-through;color:#547368}
    .week-nav{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:13px}.week-title{font-weight:900;text-align:center}.calendar{display:grid;grid-template-columns:repeat(7,minmax(120px,1fr));gap:8px;overflow:auto;padding-bottom:6px}.day{min-height:170px;padding:10px;border:var(--line);border-radius:16px;background:rgba(255,255,255,.8)}.day.today{border-color:#9970c7;background:#faf5ff}.day-head{display:flex;justify-content:space-between;margin-bottom:8px;font-size:.76rem;font-weight:900}.session{display:block;width:100%;margin:6px 0;padding:8px;border:0;border-left:4px solid var(--coral);border-radius:9px;background:#fff0f2;text-align:left;cursor:pointer;font-size:.72rem}.session.done{opacity:.62;text-decoration:line-through;border-color:var(--green);background:#edf9f5}
    .board{display:grid;grid-template-columns:repeat(3,minmax(250px,1fr));gap:12px;overflow:auto}.column{min-height:300px;padding:12px;border:var(--line);border-radius:19px;background:rgba(255,255,255,.57)}.column h3{margin:2px 0 11px}.project-card{margin-bottom:10px;padding:13px;border:var(--line);border-radius:14px;background:#fff;box-shadow:0 5px 13px rgba(52,34,63,.06)}.project-card h4{margin:0 0 4px}.project-card p{margin:0 0 9px;font-size:.77rem;color:var(--muted)}
    .template-card{display:flex;flex-direction:column;min-height:250px}.template-card .template-icon{font-size:2rem}.template-card .actions{margin-top:auto}.preview-box{white-space:pre-wrap;padding:14px;border-radius:15px;background:#f8f3fb;color:#54435c;font-size:.83rem}
    dialog{width:min(720px,calc(100% - 28px));max-height:88vh;padding:0;border:0;border-radius:26px;background:var(--paper);box-shadow:0 30px 90px rgba(33,15,41,.35)}dialog::backdrop{background:rgba(39,22,45,.55);backdrop-filter:blur(5px)}.dialog-head{position:sticky;top:0;z-index:3;display:flex;justify-content:space-between;gap:12px;align-items:center;padding:18px 21px;border-bottom:var(--line);background:rgba(255,250,245,.96)}.dialog-head h2{margin:0;font-family:Georgia,serif}.dialog-body{padding:21px;overflow:auto}.dialog-foot{position:sticky;bottom:0;display:flex;justify-content:flex-end;gap:9px;padding:14px 21px;border-top:var(--line);background:rgba(255,250,245,.97)}
    .coach-layout{display:grid;grid-template-columns:240px minmax(0,1fr);gap:14px}.coach-scope{padding:14px;border-radius:18px;background:#f5edfb}.coach-chat{min-height:280px;max-height:420px;overflow:auto;padding:14px;border:var(--line);border-radius:18px;background:#fff}.bubble{max-width:88%;margin:8px 0;padding:11px 13px;border-radius:15px;white-space:pre-wrap;font-size:.84rem}.bubble.user{margin-left:auto;background:var(--lilac)}.bubble.assistant{background:#edf9f5}.coach-reply-actions{display:flex;gap:7px;flex-wrap:wrap;margin:9px 0 16px}
    .toast{position:fixed;right:20px;bottom:20px;z-index:300;max-width:340px;padding:13px 16px;border-radius:15px;color:#fff;background:#3b2944;box-shadow:var(--shadow);transform:translateY(120px);opacity:0;transition:.25s}.toast.show{transform:none;opacity:1}.confetti{position:fixed;inset:0;z-index:290;pointer-events:none;overflow:hidden}.confetti i{position:absolute;top:-20px;width:9px;height:16px;border-radius:3px;animation:fall 1.8s linear forwards}@keyframes fall{to{transform:translateY(110vh) rotate(620deg)}}
    .sr-only{position:absolute!important;width:1px!important;height:1px!important;padding:0!important;margin:-1px!important;overflow:hidden!important;clip:rect(0,0,0,0)!important;white-space:nowrap!important;border:0!important}.muted{color:var(--muted)}.small-text{font-size:.78rem}.danger-zone{border-color:rgba(189,72,108,.25);background:#fff7f9}.divider{height:1px;margin:16px 0;background:#e9dfe9}.privacy-note{padding:13px;border-radius:14px;background:#fff1d9;color:#6a4b1f;font-size:.8rem}.version{padding:11px;border-bottom:1px solid #eadfea}.version:last-child{border:0}
    @media(max-width:1050px){.grid.four{grid-template-columns:repeat(2,1fr)}.grid.three{grid-template-columns:repeat(2,1fr)}.workspace{grid-template-columns:220px minmax(0,1fr)}.revision-grid{grid-template-columns:repeat(2,1fr)}}
    @media(max-width:820px){:root{--sidebar:0px}.shell{display:block}.sidebar{transform:translateX(-105%);width:min(300px,86vw);transition:.22s}.sidebar.open{transform:none}.main{padding:15px 14px 45px}.mobile-menu{display:inline-grid}.topbar{align-items:flex-start}.topbar p{font-size:.8rem}.top-actions .hide-mobile{display:none}.workspace{display:block}.project-rail{position:relative;top:auto;max-height:260px;margin-bottom:14px}.compass-grid,.form-grid{grid-template-columns:1fr}.span-2{grid-column:auto}.coach-layout{grid-template-columns:1fr}.work-toolbar{top:4px}.board{grid-template-columns:repeat(3,270px)}}
    @media(max-width:620px){.grid.two,.grid.three,.grid.four{grid-template-columns:1fr}.hero h2{font-size:2.25rem}.topbar h1{font-size:1.55rem}.top-actions{justify-content:flex-end}.revision-grid{grid-template-columns:1fr}.calendar{grid-template-columns:repeat(7,150px)}.section-switcher{grid-template-columns:42px minmax(130px,1fr) 42px}.dialog-body{padding:16px}.card{padding:17px}.work-toolbar{align-items:flex-start}.work-toolbar .actions{justify-content:flex-end}}
  </style>
</head>
<body class="guided-on">
  <a class="skip" href="#main">Skip to studio</a>
  <div class="shell">
    <aside class="sidebar" id="sidebar" aria-label="Studio navigation">
      <div class="brand">
        <div class="brand-mark" aria-hidden="true">🪩</div>
        <div><strong>Velvet Ink Studio</strong><small>Tanay's private creative room</small></div>
      </div>
      <div class="nav-label">Create</div>
      <nav class="nav">
        <button class="active" data-view="home"><span class="icon">🏠</span>Studio Home</button>
        <button data-view="journal"><span class="icon">📓</span>Journal + Sparks</button>
        <button data-view="songs"><span class="icon">🎧</span>Song Lab</button>
        <button data-view="stories"><span class="icon">🎬</span>Story Lab</button>
      </nav>
      <div class="nav-label">Organize</div>
      <nav class="nav">
        <button data-view="library"><span class="icon">🧃</span>Templates + Inspo</button>
        <button data-view="projects"><span class="icon">🗂️</span>Project Board</button>
        <button data-view="settings"><span class="icon">⚙️</span>Settings + Backup</button>
      </nav>
      <div class="side-card">
        <strong><span class="save-dot"></span> <span id="save-status">Saved in this browser</span></strong>
        <p>Your journal is not sent anywhere unless you deliberately use a coach action.</p>
      </div>
      <div class="side-card">
        <strong>Need your north star?</strong>
        <p>Open any project and tap <em>Find my way back</em>. The studio will return you to the central truth.</p>
      </div>
    </aside>

    <main class="main" id="main">
      <header class="topbar">
        <div class="top-actions">
          <button class="icon-btn mobile-menu" id="mobile-menu" aria-label="Open navigation">☰</button>
          <div><h1 id="page-title">Studio Home</h1><p id="page-subtitle">A soft place to turn real moments into songs and stories.</p></div>
        </div>
        <div class="top-actions">
          <button class="btn ghost hide-mobile" id="guided-toggle" title="Show or hide small explanations">💡 Guided: On</button>
          <button class="btn ghost" id="privacy-toggle" title="Blur private writing on screen">👁️ Privacy</button>
          <button class="btn primary" data-action="quick-capture">＋ Catch a spark</button>
        </div>
      </header>

      <div class="banner">
        <span>🔒 Private by design: unlisted + noindex, with browser-only autosave.</span>
        <button class="btn small ghost" data-help="privacy">What does that mean?</button>
      </div>

      <section class="view active" id="view-home">
        <div class="hero">
          <p class="eyebrow">Your creative headquarters <span class="sparkle">✦</span></p>
          <h2>Find the line. Follow the feeling. Finish the story.</h2>
          <p>This studio helps you protect the original truth of an idea—even while the song or story changes shape.</p>
          <div class="hero-actions">
            <button class="btn pink" data-action="quick-capture">✨ Save a phrase</button>
            <button class="btn primary" data-action="new-song">🎵 Start a song</button>
            <button class="btn mint" data-action="new-story">🎞️ Start a story</button>
          </div>
        </div>

        <div class="grid four section-space" id="home-stats"></div>

        <div class="grid two section-space">
          <div class="card tint-lilac">
            <div class="card-top"><div><p class="eyebrow">Continue</p><h2>Pick up the thread</h2></div><div class="sticker">🧵</div></div>
            <div id="continue-list" class="list section-space"></div>
          </div>
          <div class="card tint-pink">
            <div class="card-top"><div><p class="eyebrow">Tiny action</p><h2>What can happen in 15 minutes?</h2></div><div class="sticker">⏳</div></div>
            <div id="next-move-card"></div>
          </div>
        </div>

        <div class="card section-space">
          <div class="card-top">
            <div><p class="eyebrow">Studio rhythm</p><h2>Creative week</h2><p>Switch weeks, open any session to edit it, or mark it complete.</p></div>
            <div class="actions">
              <button class="btn small" id="session-scope">Showing: This week</button>
              <button class="btn primary small" data-action="new-session">＋ Plan session</button>
            </div>
          </div>
          <div class="week-nav section-space">
            <button class="icon-btn" id="week-prev" aria-label="Previous week">←</button>
            <div class="week-title" id="week-title"></div>
            <div class="actions"><button class="btn small ghost" id="week-today">Today</button><button class="icon-btn" id="week-next" aria-label="Next week">→</button></div>
          </div>
          <div class="calendar" id="studio-calendar"></div>
          <div id="all-sessions" hidden></div>
        </div>

        <div class="card section-space tint-mint">
          <div class="card-top"><div><p class="eyebrow">After you create</p><h2>Session breadcrumb</h2><p>Leave your future self a simple way back in.</p></div><button class="help" data-help="breadcrumbs" aria-label="Explain session breadcrumbs">?</button></div>
          <div id="recent-breadcrumbs" class="grid three section-space"></div>
        </div>
      </section>

      <section class="view" id="view-journal">
        <div class="section-head">
          <div><p class="eyebrow">Journal mining</p><h2>Turn lived moments into creative material</h2><p>Keep the context, protect the important line, then decide what it wants to become.</p></div>
          <div class="actions"><button class="btn" data-action="new-journal">＋ Journal entry</button><button class="btn primary" data-action="quick-capture">✨ Quick spark</button></div>
        </div>
        <div class="tabs" id="journal-tabs">
          <button class="tab active" data-journal-tab="entries">Journal entries</button>
          <button class="tab" data-journal-tab="mine">Mining desk</button>
          <button class="tab" data-journal-tab="sparks">Spark vault</button>
        </div>

        <div id="journal-panel-entries">
          <div class="filterbar">
            <div class="search"><input id="journal-search" placeholder="Search title, mood, or words…" aria-label="Search journal"></div>
            <select id="journal-sort" aria-label="Sort journal"><option value="newest">Newest first</option><option value="oldest">Oldest first</option><option value="title">Title A–Z</option></select>
          </div>
          <div id="journal-list" class="grid two"></div>
        </div>

        <div id="journal-panel-mine" hidden>
          <div class="grid two">
            <div class="card tint-gold">
              <div class="card-top"><div><h2>1. Bring in a journal page</h2><p>Choose a saved entry or paste something here.</p></div><button class="help" data-help="mining" aria-label="Explain journal mining">?</button></div>
              <div class="field section-space"><label for="mine-source">Saved entry</label><select id="mine-source"><option value="">Paste something new</option></select></div>
              <div class="field section-space"><label for="mine-text">Journal text</label><textarea id="mine-text" class="sensitive" rows="14" placeholder="Paste the honest, messy version here…"></textarea></div>
            </div>
            <div class="card tint-pink">
              <h2>2. Highlight the line that glows</h2>
              <p>Select words inside the journal box, then save the selection. If selecting is awkward on your device, type the phrase below.</p>
              <div class="field section-space"><label for="mine-manual">Important phrase</label><textarea id="mine-manual" class="sensitive" rows="4" placeholder="The line I cannot stop thinking about…"></textarea></div>
              <div class="field"><label for="mine-why">Why it matters</label><textarea id="mine-why" rows="3" placeholder="What truth, memory, image, or tension lives in it?"></textarea></div>
              <div class="actions section-space"><button class="btn primary" id="save-mined-spark">✦ Save selected phrase</button><button class="btn" data-coach="journal">Ask Studio Coach</button></div>
              <div class="guided section-space"><strong>Try this:</strong> Choose a line with an image, contradiction, secret, unanswered question, or emotional shift. It does not need to sound like a lyric yet.</div>
            </div>
          </div>
        </div>

        <div id="journal-panel-sparks" hidden>
          <div class="filterbar">
            <div class="search"><input id="spark-search" placeholder="Search sparks…" aria-label="Search sparks"></div>
            <select id="spark-use-filter" aria-label="Filter sparks by use"><option value="all">All uses</option><option>Undecided</option><option>Song</option><option>Story</option><option>Both</option></select>
            <select id="spark-priority-filter" aria-label="Filter sparks by priority"><option value="all">All priorities</option><option>Now</option><option>Soon</option><option>Someday</option></select>
          </div>
          <div id="spark-list" class="grid three"></div>
        </div>
      </section>

      <section class="view" id="view-songs">
        <div class="section-head">
          <div><p class="eyebrow">Song lab</p><h2>Build the song without losing its heartbeat</h2><p>Move freely between sections, save alternate lines, and use your Creative Compass whenever the draft drifts.</p></div>
          <button class="btn primary" data-action="new-song">＋ New song</button>
        </div>
        <div id="song-workspace"></div>
      </section>

      <section class="view" id="view-stories">
        <div class="section-head">
          <div><p class="eyebrow">Story lab</p><h2>Shape a true feeling into a clear journey</h2><p>Follow the character’s want, need, and changing belief from scene to scene.</p></div>
          <button class="btn primary" data-action="new-story">＋ New story</button>
        </div>
        <div id="story-workspace"></div>
      </section>

      <section class="view" id="view-library">
        <div class="section-head">
          <div><p class="eyebrow">Creative support shelf</p><h2>Templates + Inspiration</h2><p>Use structure when you need it. Leave it behind when the piece knows where it is going.</p></div>
          <button class="btn" data-action="new-inspiration">＋ Save inspiration</button>
        </div>
        <div class="tabs" id="library-tabs">
          <button class="tab active" data-library-tab="templates">Templates</button>
          <button class="tab" data-library-tab="inspiration">Inspiration shelf</button>
        </div>
        <div id="library-panel-templates">
          <div class="filterbar"><select id="template-filter"><option value="all">All templates</option><option value="journal">Journal</option><option value="song">Song</option><option value="story">Story</option></select></div>
          <div id="template-list" class="grid three"></div>
        </div>
        <div id="library-panel-inspiration" hidden>
          <div class="filterbar"><div class="search"><input id="inspiration-search" placeholder="Search inspiration…" aria-label="Search inspiration"></div><select id="inspiration-type-filter"><option value="all">All kinds</option><option>Song</option><option>Film</option><option>Book</option><option>Visual</option><option>Conversation</option><option>Other</option></select></div>
          <div id="inspiration-list" class="grid three"></div>
        </div>
      </section>

      <section class="view" id="view-projects">
        <div class="section-head">
          <div><p class="eyebrow">Projects + archive</p><h2>See every idea, not just the loudest one</h2><p>Filter by type or status, move projects forward, and reopen anything at any time.</p></div>
        </div>
        <div class="filterbar">
          <div class="search"><input id="project-search" placeholder="Search all projects…" aria-label="Search projects"></div>
          <select id="project-type-filter"><option value="all">Songs + stories</option><option value="song">Songs</option><option value="story">Stories</option></select>
          <select id="project-status-filter"><option value="all">All statuses</option><option>Spark</option><option>Developing</option><option>Drafting</option><option>Revising</option><option>Finalizing</option><option>Finished</option><option>Shared</option><option>Archived</option></select>
        </div>
        <div class="board" id="project-board"></div>
      </section>

      <section class="view" id="view-settings">
        <div class="section-head"><div><p class="eyebrow">Make the room yours</p><h2>Settings, privacy + backup</h2><p>Your creative archive deserves care. Back it up before clearing browser data or changing devices.</p></div></div>
        <div class="grid two">
          <div class="card tint-lilac">
            <h2>Studio preferences</h2>
            <div class="form-grid section-space">
              <div class="field"><label for="setting-name">Your name</label><input id="setting-name" placeholder="Tanay"></div>
              <div class="field"><label for="setting-studio">Studio name</label><input id="setting-studio" placeholder="Velvet Ink Studio"></div>
              <label class="check span-2"><input type="checkbox" id="setting-guided"><span><b>Guided explanations</b><br><small class="muted">Show small prompts and reminders inside the workspaces.</small></span></label>
              <label class="check span-2"><input type="checkbox" id="setting-privacy"><span><b>Privacy blur on startup</b><br><small class="muted">Blur journal, lyric, and story text until you turn it off.</small></span></label>
            </div>
            <button class="btn primary section-space" id="save-settings">Save preferences</button>
          </div>
          <div class="card tint-mint">
            <h2>Backup your whole studio</h2>
            <p>Export makes one JSON file containing projects, notes, versions, sessions, and settings. Import restores one of those files.</p>
            <div class="actions section-space"><button class="btn primary" id="export-data">⬇ Export backup</button><button class="btn" id="import-data">⬆ Import backup</button><input id="import-file" type="file" accept=".json,application/json" hidden></div>
            <p class="small-text"><b>Good rhythm:</b> export after a big writing day and before changing browsers or devices.</p>
          </div>
          <div class="card">
            <h2>Studio Coach setup</h2>
            <p><b>Copy + Open ChatGPT</b> works immediately and lets you paste only the context you choose. The optional in-page coach needs server-side API configuration.</p>
            <div class="privacy-note">For the in-page coach, set <code>OPENAI_API_KEY</code> on the server—not in this file or browser—and optionally set <code>OPENAI_MODEL</code>. API usage is separate from a ChatGPT subscription and may have usage costs.</div>
            <button class="btn section-space" data-coach="general">Open Studio Coach</button>
          </div>
          <div class="card">
            <h2>Privacy reality check</h2>
            <p><b>Hidden is not the same as locked.</b> This page tells search engines not to index it and does not appear in your main navigation. Anyone who knows the exact URL may still be able to open it.</p>
            <p>For stronger privacy, turn on directory/password protection in your web host and use HTTPS. Do not add this URL to a public sitemap.</p>
          </div>
          <div class="card danger-zone span-2">
            <h2>Reset studio</h2><p>This permanently erases this studio’s local browser data. Export a backup first.</p>
            <button class="btn danger" id="reset-data">Erase local studio data</button>
          </div>
        </div>
      </section>
    </main>
  </div>

  <dialog id="generic-dialog">
    <div class="dialog-head"><h2 id="generic-title">Edit</h2><button class="icon-btn" data-close-dialog aria-label="Close">×</button></div>
    <form id="generic-form"><div class="dialog-body" id="generic-body"></div><div class="dialog-foot"><button class="btn" type="button" data-close-dialog>Cancel</button><button class="btn primary" type="submit" id="generic-submit">Save</button></div></form>
  </dialog>

  <dialog id="help-dialog">
    <div class="dialog-head"><h2 id="help-title">How this works</h2><button class="icon-btn" data-close-dialog aria-label="Close">×</button></div>
    <div class="dialog-body" id="help-body"></div>
    <div class="dialog-foot"><button class="btn primary" data-close-dialog>Got it</button></div>
  </dialog>

  <dialog id="coach-dialog">
    <div class="dialog-head"><div><h2>✨ Studio Coach</h2><div class="small-text muted">You decide what context leaves the page.</div></div><button class="icon-btn" data-close-dialog aria-label="Close">×</button></div>
    <div class="dialog-body">
      <div class="coach-layout">
        <aside class="coach-scope">
          <b>Context to include</b>
          <p class="small-text">Nothing is sent until you press an ask button.</p>
          <label class="check"><input type="radio" name="coach-scope" value="current" checked><span>Current section</span></label>
          <label class="check"><input type="radio" name="coach-scope" value="compass"><span>Creative Compass</span></label>
          <label class="check"><input type="radio" name="coach-scope" value="project"><span>Entire project</span></label>
          <label class="check"><input type="radio" name="coach-scope" value="journal"><span>Journal/mining text</span></label>
          <label class="check"><input type="radio" name="coach-scope" value="custom"><span>Custom selection only</span></label>
          <div class="field section-space"><label for="coach-custom">Custom context</label><textarea id="coach-custom" rows="6" placeholder="Paste only what you want included…"></textarea></div>
          <div class="divider"></div>
          <b>Quick requests</b>
          <div class="list small-text section-space">
            <button class="btn small coach-preset" data-prompt="Ask me three questions that will help me uncover the central truth without writing it for me.">Find the truth</button>
            <button class="btn small coach-preset" data-prompt="Check whether this section supports my Creative Compass. Point out drift and give one next move.">Check direction</button>
            <button class="btn small coach-preset" data-prompt="Give me four fresh image or sensory-detail directions that fit my voice. Do not write a full verse or scene.">Find imagery</button>
            <button class="btn small coach-preset" data-prompt="Help me find a memorable hook or story question. Offer four concise directions.">Find a hook</button>
          </div>
        </aside>
        <div>
          <div id="coach-chat" class="coach-chat"><div class="empty"><span class="emoji">🫧</span>Ask for questions, structure, imagery, or a direction check. The coach never edits your project automatically.</div></div>
          <div class="field section-space"><label for="coach-question">What do you want help with?</label><textarea id="coach-question" rows="3" placeholder="Example: The second verse feels repetitive. What new job could it do?"></textarea></div>
          <div class="actions section-space">
            <button class="btn primary" id="coach-ask">Ask in this page</button>
            <button class="btn" id="coach-open-chatgpt">Copy + Open ChatGPT</button>
            <button class="btn ghost" id="coach-copy-prompt">Copy prompt</button>
          </div>
          <p class="small-text muted">In-page answers use the website’s API connection if configured. Suggestions are saved only when you choose “Save as note.”</p>
        </div>
      </div>
    </div>
  </dialog>

  <dialog id="version-dialog">
    <div class="dialog-head"><h2>Project versions</h2><button class="icon-btn" data-close-dialog aria-label="Close">×</button></div>
    <div class="dialog-body" id="version-list"></div>
    <div class="dialog-foot"><button class="btn primary" data-close-dialog>Done</button></div>
  </dialog>

  <dialog id="direction-dialog">
    <div class="dialog-head"><h2 id="direction-title">Find my way back</h2><button class="icon-btn" data-close-dialog aria-label="Close">×</button></div>
    <div class="dialog-body" id="direction-body"></div>
    <div class="dialog-foot"><button class="btn" id="copy-direction">Copy prompts</button><button class="btn primary" data-close-dialog>Back to creating</button></div>
  </dialog>

  <div class="toast" id="toast" role="status" aria-live="polite"></div>
  <div class="confetti" id="confetti" aria-hidden="true"></div>

  <script>
    (() => {
      'use strict';

      const STORAGE_KEY = 'velvetInkStudio.v1';
      const STATUSES = ['Spark','Developing','Drafting','Revising','Finalizing','Finished','Shared','Archived'];
      const REVISION_PASSES = ['Meaning','Structure','Imagery','Rhythm','Language','Performance'];
      const SECTION_JOBS = {
        Intro:'Set the world or mood without explaining everything.',
        'Verse 1':'Give us the first specific moment, image, or version of the problem.',
        'Pre-Chorus':'Increase tension and lean toward the emotional turn.',
        Chorus:'State or embody the central truth—the part we remember.',
        'Verse 2':'Reveal new information, a consequence, or a changed angle.',
        Bridge:'Break the pattern with the deepest admission, realization, or reversal.',
        'Final Chorus':'Return to the truth with new meaning or higher stakes.',
        Outro:'Leave us with the final image, echo, or unresolved feeling.',
        Custom:'Give this section one clear job before filling it with lines.'
      };
      const HELP = {
        privacy: ['Private by design','The page includes noindex instructions and your writing is stored in this browser. That keeps it out of normal site navigation and search results, but it is not a password. Use your web host’s password protection for stronger privacy.'],
        breadcrumbs: ['Session breadcrumbs','Before stopping, write what you accomplished, what is still unclear, and the smallest next step. The next time you open the project, you will not have to reconstruct your thinking.'],
        mining: ['Journal mining','The goal is not to make the journal entry “good.” Look for one phrase with energy—an image, contradiction, secret, question, or emotional turn—then save it with enough context to remember why it mattered.'],
        compass: ['Creative Compass','This is the promise the project makes to itself. It protects the original spark, central truth, and emotional destination. Use it to evaluate ideas, not to trap yourself. You can evolve it and keep the old version in history.'],
        sidequest: ['Side Quest Parking Lot','A strong line can still be wrong for this project. Parking it protects the idea without forcing it into the draft. You can move it back later.'],
        versions: ['Versions','A snapshot freezes the project as it is right now. Make one before major restructuring. Restoring creates a safety snapshot first, so experimentation stays reversible.'],
        coach: ['Studio Coach','Choose exactly how much context to include. “Copy + Open ChatGPT” keeps you in control and works without API setup. The in-page option requires a server API key and never places that secret in the browser.']
      };
      const TEMPLATES = [
        {id:'j-truth',type:'journal',icon:'🕯️',name:'Find the real story',desc:'Move beneath what happened and locate the emotional truth.',preview:'What happened?\\nWhat did I say versus what did I mean?\\nWhat detail keeps replaying?\\nWhat changed in me?\\nThe sentence I am afraid to write is…'},
        {id:'j-shift',type:'journal',icon:'🌗',name:'The moment something changed',desc:'Capture a before-and-after moment without overexplaining it.',preview:'Before this moment, I believed…\\nThe exact moment was…\\nMy body noticed…\\nAfterward, I could no longer…\\nThe image that holds it is…'},
        {id:'j-unsaid',type:'journal',icon:'☎️',name:'The conversation I wish we had',desc:'Find tension, voice, and the words that stayed inside.',preview:'You said…\\nI answered…\\nWhat I wanted to say was…\\nWhat I needed you to understand…\\nWhat I understand now…'},
        {id:'s-hook',type:'song',icon:'🪩',name:'Hook-first song',desc:'Build outward from one unforgettable phrase.',preview:'Hook / title\\nVerse 1: Where are we?\\nPre: Why can’t this stay contained?\\nChorus: Central truth\\nVerse 2: What changed?\\nBridge: Deepest admission'},
        {id:'s-story',type:'song',icon:'🎞️',name:'Story song',desc:'Use scenes and a clear emotional turn.',preview:'Cold open image\\nVerse 1: Before\\nChorus: What it means\\nVerse 2: The turning moment\\nBridge: After / realization\\nFinal chorus: Same truth, changed meaning'},
        {id:'s-anthem',type:'song',icon:'💖',name:'Self-return anthem',desc:'Move from outside judgment to inner authority.',preview:'Verse 1: The pressure\\nPre: The cost\\nChorus: My declaration\\nVerse 2: Evidence of growth\\nBridge: What I choose now\\nFinal chorus: Bigger declaration'},
        {id:'s-fragment',type:'song',icon:'🎮',name:'Eight-bar fragment',desc:'A tiny container for days when “finish a song” is too large.',preview:'Image (2 bars)\\nTension (2 bars)\\nTurn (2 bars)\\nHook (2 bars)'},
        {id:'t-short',type:'story',icon:'🍿',name:'Short story arc',desc:'A focused change built from five essential beats.',preview:'Opening image\\nWant appears\\nPressure / obstacle\\nChoice or realization\\nClosing image that shows change'},
        {id:'t-personal',type:'story',icon:'📼',name:'Personal narrative',desc:'Turn memory into meaning without flattening the truth.',preview:'Present-day doorway\\nSpecific memory\\nWhat I believed then\\nWhat complicated it\\nWhat I understand now'},
        {id:'t-scene',type:'story',icon:'🎭',name:'Single scene',desc:'Write one charged moment with a clear scene job.',preview:'Where and when\\nWho wants what\\nWhat is unsaid\\nWhat shifts\\nLast image / line'},
        {id:'t-video',type:'story',icon:'🎬',name:'Animated music story',desc:'Plan a visual narrative that can live beside a song.',preview:'Visual motif\\nCharacter state\\nInciting image\\nEscalating images\\nEmotional turn\\nFinal visual echo'}
      ];

      const uid = prefix => (prefix || 'id') + '-' + Date.now().toString(36) + '-' + Math.random().toString(36).slice(2,7);
      const isoDate = d => {
        const x = new Date(d); x.setMinutes(x.getMinutes() - x.getTimezoneOffset());
        return x.toISOString().slice(0,10);
      };
      const now = () => new Date().toISOString();
      const deep = value => JSON.parse(JSON.stringify(value));
      const esc = value => String(value ?? '').replace(/[&<>"']/g, char => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
      const nl = value => esc(value).replace(/\n/g,'<br>');
      const safeUrl = value => { try { const url=new URL(String(value||''),location.href); return ['http:','https:'].includes(url.protocol)?url.href:''; } catch(e){ return ''; } };
      const fmtDate = value => value ? new Date(value.length === 10 ? value + 'T12:00:00' : value).toLocaleDateString(undefined,{month:'short',day:'numeric',year:'numeric'}) : 'No date';
      const wordCount = value => (String(value || '').trim().match(/\S+/g) || []).length;
      const firstWords = (value, count=22) => {
        const words = String(value || '').trim().split(/\s+/).filter(Boolean);
        return words.slice(0,count).join(' ') + (words.length > count ? '…' : '');
      };
      const slugWords = value => String(value || '').toLowerCase().match(/[a-z0-9']+/g) || [];
      const blankCompass = () => ({spark:'',truth:'',destination:'',beginBelief:'',endBelief:'',mustKeep:'',notThis:'',history:[]});
      const blankBreadcrumb = () => ({accomplished:'',figuring:'',nextStep:'',openTo:'',updatedAt:''});
      const defaultSection = (name='Verse 1', type=name) => ({id:uid('sec'),name,type,purpose:SECTION_JOBS[type] || SECTION_JOBS.Custom,lyrics:'',bars:'',status:'Idea',notes:'',alternates:[]});
      const storyScene = (name='Scene 1') => ({id:uid('scene'),name,purpose:'',setting:'',characters:'',want:'',conflict:'',turn:'',draft:'',notes:'',status:'Idea'});

      function makeSong(title='Untitled Song', templateId='s-story', spark='') {
        let names = ['Intro','Verse 1','Pre-Chorus','Chorus','Verse 2','Bridge','Final Chorus','Outro'];
        if (templateId === 's-fragment') names = ['Eight-bar fragment'];
        if (templateId === 's-hook') names = ['Hook Lab','Verse 1','Pre-Chorus','Chorus','Verse 2','Bridge','Final Chorus'];
        const sections = names.map(name => defaultSection(name, SECTION_JOBS[name] ? name : 'Custom'));
        return {id:uid('song'),kind:'song',title,status:'Spark',createdAt:now(),updatedAt:now(),sourceSparkId:'',genre:'',tempo:'',key:'',references:'',audioLink:'',productionNotes:'',compass:{...blankCompass(),spark},sections,activeSectionId:sections[0].id,parkingLot:[],revision:Object.fromEntries(REVISION_PASSES.map(x=>[x,false])),breadcrumb:blankBreadcrumb(),versions:[],coachNotes:[],templateId};
      }
      function makeStory(title='Untitled Story', templateId='t-short', spark='') {
        const sceneNames = templateId === 't-scene' ? ['The scene'] : templateId === 't-video' ? ['Opening image','Inciting image','Escalation','Emotional turn','Final echo'] : ['Opening','Pressure builds','Turning point','Aftermath','Closing image'];
        const scenes = sceneNames.map(storyScene);
        return {id:uid('story'),kind:'story',title,status:'Spark',createdAt:now(),updatedAt:now(),sourceSparkId:'',format:'Short story',logline:'',theme:'',compass:{...blankCompass(),want:'',need:'',theme:''},characters:[],scenes,activeSceneId:scenes[0].id,outline:'',draft:'',parkingLot:[],bridge:{songId:'',originalTruth:'',storyTruth:'',songTruth:''},revision:Object.fromEntries(REVISION_PASSES.slice(0,5).map(x=>[x,false])),breadcrumb:blankBreadcrumb(),versions:[],coachNotes:[],templateId};
      }
      const defaults = () => ({
        version:1,
        settings:{name:'Tanay',studioName:'Velvet Ink Studio',guided:true,privacyOnStart:false},
        journal:[],sparks:[],songs:[],stories:[],inspiration:[],sessions:[],
        activeSongId:'',activeStoryId:'',coachThreads:{general:[]}
      });
      function loadState() {
        try {
          const saved = JSON.parse(localStorage.getItem(STORAGE_KEY));
          if (!saved || typeof saved !== 'object') return defaults();
          const base = defaults();
          const merged = {...base,...saved,settings:{...base.settings,...(saved.settings || {})}};
          ['journal','sparks','songs','stories','inspiration','sessions'].forEach(k => { if (!Array.isArray(merged[k])) merged[k]=[]; });
          if (!merged.coachThreads || typeof merged.coachThreads !== 'object') merged.coachThreads={general:[]};
          return merged;
        } catch (error) { return defaults(); }
      }
      let state = loadState();
      let ui = {view:'home',journalTab:'entries',libraryTab:'templates',weekStart:startOfWeek(new Date()),sessionScope:'week',coachSource:'general',coachLastReply:'',genericSubmit:null,directionText:''};
      let saveTimer;

      function saveState(message='Saved') {
        clearTimeout(saveTimer);
        const status = document.getElementById('save-status');
        if (status) status.textContent = 'Saving…';
        saveTimer = setTimeout(() => {
          try { localStorage.setItem(STORAGE_KEY,JSON.stringify(state)); if (status) status.textContent = message + ' in this browser'; }
          catch(error) { if(status)status.textContent='Could not save'; toast('This browser could not save. Export a backup and check storage space.'); }
        },180);
      }
      function touch(project) { project.updatedAt=now(); saveState(); }
      function startOfWeek(date) {
        const d = new Date(date); d.setHours(12,0,0,0);
        const day = d.getDay(); d.setDate(d.getDate() - day);
        return d;
      }
      function toast(message) {
        const el=document.getElementById('toast'); el.textContent=message; el.classList.add('show');
        clearTimeout(toast.timer); toast.timer=setTimeout(()=>el.classList.remove('show'),2600);
      }
      function confetti() {
        const box=document.getElementById('confetti'); box.innerHTML='';
        const colors=['#ffafd2','#ffd982','#b8ead7','#c8b1ff','#ff9b91'];
        for(let i=0;i<55;i++){const bit=document.createElement('i');bit.style.left=Math.random()*100+'%';bit.style.background=colors[i%colors.length];bit.style.animationDelay=Math.random()*.5+'s';box.appendChild(bit);}
        setTimeout(()=>box.innerHTML='',2500);
      }
      async function copyText(text) {
        try { await navigator.clipboard.writeText(text); toast('Copied to your clipboard ✦'); }
        catch(e){ const area=document.createElement('textarea'); area.value=text;document.body.appendChild(area);area.select();document.execCommand('copy');area.remove();toast('Copied to your clipboard ✦'); }
      }
      function closeDialogs(){document.querySelectorAll('dialog[open]').forEach(d=>d.close());}
      function openHelp(key) {
        const item=HELP[key] || ['A little help','This feature is here to make the next creative step smaller and clearer.'];
        document.getElementById('help-title').textContent=item[0];
        document.getElementById('help-body').innerHTML='<p>'+esc(item[1])+'</p>';
        document.getElementById('help-dialog').showModal();
      }
      function openForm(title, html, submitLabel, handler) {
        document.getElementById('generic-title').textContent=title;
        document.getElementById('generic-body').innerHTML=html;
        document.getElementById('generic-submit').textContent=submitLabel || 'Save';
        ui.genericSubmit=handler;
        document.getElementById('generic-dialog').showModal();
      }
      function field(name,label,value='',type='text',extra='') {
        if(type==='textarea') return '<div class="field '+extra+'"><label for="f-'+name+'">'+label+'</label><textarea id="f-'+name+'" name="'+name+'">'+esc(value)+'</textarea></div>';
        return '<div class="field '+extra+'"><label for="f-'+name+'">'+label+'</label><input id="f-'+name+'" name="'+name+'" type="'+type+'" value="'+esc(value)+'"></div>';
      }
      function selectField(name,label,value,options,extra='') {
        return '<div class="field '+extra+'"><label for="f-'+name+'">'+label+'</label><select id="f-'+name+'" name="'+name+'">'+options.map(x=>'<option '+(x===value?'selected':'')+'>'+esc(x)+'</option>').join('')+'</select></div>';
      }
      function values(form){ return Object.fromEntries(new FormData(form).entries()); }
      function allProjects(){return [...state.songs,...state.stories];}
      function getProject(id){return allProjects().find(p=>p.id===id);}
      function activeSong(){return state.songs.find(x=>x.id===state.activeSongId) || state.songs[0];}
      function activeStory(){return state.stories.find(x=>x.id===state.activeStoryId) || state.stories[0];}
      function projectProgress(project) {
        const index=STATUSES.indexOf(project.status);
        return Math.max(7,Math.round(((index<0?0:index+1)/STATUSES.length)*100));
      }
      function setView(name) {
        ui.view=name;
        document.querySelectorAll('.view').forEach(v=>v.classList.toggle('active',v.id==='view-'+name));
        document.querySelectorAll('.nav button[data-view]').forEach(b=>b.classList.toggle('active',b.dataset.view===name));
        const titles={
          home:['Studio Home','A soft place to turn real moments into songs and stories.'],
          journal:['Journal + Sparks','Mine your real life for the lines that glow.'],
          songs:['Song Lab','Write with structure while protecting the feeling.'],
          stories:['Story Lab','Build scenes, characters, and change one clear move at a time.'],
          library:['Templates + Inspiration','Support when you need it; freedom when you do not.'],
          projects:['Project Board','Every spark has a place, even before it has a plan.'],
          settings:['Settings + Backup','Keep your creative room comfortable and safe.']
        };
        document.getElementById('page-title').textContent=titles[name][0];
        document.getElementById('page-subtitle').textContent=titles[name][1];
        document.getElementById('sidebar').classList.remove('open');
        if(name==='songs') renderSongs();
        if(name==='stories') renderStories();
        if(name==='journal') renderJournal();
        if(name==='library') renderLibrary();
        if(name==='projects') renderProjects();
        if(name==='settings') renderSettings();
        window.scrollTo({top:0,behavior:'smooth'});
      }

      function renderHome() {
        const words=state.journal.reduce((n,x)=>n+wordCount(x.body),0)+state.songs.reduce((n,s)=>n+s.sections.reduce((m,x)=>m+wordCount(x.lyrics),0),0)+state.stories.reduce((n,s)=>n+wordCount(s.draft)+s.scenes.reduce((m,x)=>m+wordCount(x.draft),0),0);
        const stats=[['✨',state.sparks.length,'sparks protected'],['🎧',state.songs.length,'songs growing'],['🎬',state.stories.length,'stories growing'],['📝',words.toLocaleString(),'words captured']];
        document.getElementById('home-stats').innerHTML=stats.map(x=>'<div class="stat"><span>'+x[0]+'</span><b>'+x[1]+'</b><small>'+x[2]+'</small></div>').join('');
        const projects=allProjects().sort((a,b)=>String(b.updatedAt).localeCompare(String(a.updatedAt))).slice(0,3);
        document.getElementById('continue-list').innerHTML=projects.length?projects.map(p=>'<button class="list-item clickable" data-open-project="'+p.id+'"><span><h4>'+esc(p.title)+'</h4><p>'+esc(p.kind==='song'?'Song':'Story')+' · '+esc(p.status)+' · updated '+fmtDate(p.updatedAt)+'</p></span><span>→</span></button>').join(''):'<div class="empty"><span class="emoji">🎹</span>Your first project will wait here for you.</div>';
        const next=projects.find(p=>p.breadcrumb && p.breadcrumb.nextStep) || projects[0];
        document.getElementById('next-move-card').innerHTML=next?'<div class="sticky-note"><b>'+esc(next.title)+'</b><p>'+esc(next.breadcrumb.nextStep || (next.kind==='song'?'Name the central truth, then write four imperfect lines.':'Name what the character wants in the opening scene.'))+'</p></div><button class="btn small section-space" data-open-project="'+next.id+'">Open project →</button>':'<p>Catch one sentence from your day. Do not decide what it means yet.</p><button class="btn pink" data-action="quick-capture">Catch it now</button>';
        const breadcrumbs=projects.filter(p=>p.breadcrumb && (p.breadcrumb.accomplished||p.breadcrumb.figuring||p.breadcrumb.nextStep)).slice(0,3);
        document.getElementById('recent-breadcrumbs').innerHTML=breadcrumbs.length?breadcrumbs.map(p=>'<div class="sticky-note"><b>'+esc(p.title)+'</b><p><b>Next:</b> '+esc(p.breadcrumb.nextStep||'Choose one small move.')+'</p><button class="btn small" data-open-project="'+p.id+'">Resume</button></div>').join(''):'<div class="empty span-2">Finish a studio session and leave a breadcrumb for future you.</div>';
        renderCalendar();
      }

      function renderCalendar() {
        const cal=document.getElementById('studio-calendar'), all=document.getElementById('all-sessions');
        document.getElementById('session-scope').textContent='Showing: '+(ui.sessionScope==='week'?'This week':'All sessions');
        cal.hidden=ui.sessionScope!=='week'; all.hidden=ui.sessionScope==='week';
        const start=new Date(ui.weekStart), end=new Date(start); end.setDate(end.getDate()+6);
        document.getElementById('week-title').textContent=start.toLocaleDateString(undefined,{month:'short',day:'numeric'})+' – '+end.toLocaleDateString(undefined,{month:'short',day:'numeric',year:'numeric'});
        cal.innerHTML='';
        for(let i=0;i<7;i++){
          const day=new Date(start);day.setDate(start.getDate()+i);const key=isoDate(day);
          const sessions=state.sessions.filter(x=>x.date===key).sort((a,b)=>String(a.time).localeCompare(String(b.time)));
          const cell=document.createElement('div');cell.className='day '+(key===isoDate(new Date())?'today':'');
          cell.innerHTML='<div class="day-head"><span>'+day.toLocaleDateString(undefined,{weekday:'short'})+'</span><span>'+day.getDate()+'</span></div>'+sessions.map(s=>'<button class="session '+(s.done?'done':'')+'" data-edit-session="'+s.id+'"><b>'+esc(s.time||'Anytime')+'</b><br>'+esc(s.title)+'</button>').join('')+'<button class="btn small ghost" data-add-session-date="'+key+'">＋</button>';
          cal.appendChild(cell);
        }
        const sorted=[...state.sessions].sort((a,b)=>(a.date+a.time).localeCompare(b.date+b.time));
        all.innerHTML=sorted.length?'<div class="list">'+sorted.map(s=>'<button class="list-item clickable" data-edit-session="'+s.id+'"><span><h4>'+esc(s.title)+'</h4><p>'+fmtDate(s.date)+' · '+esc(s.time||'Anytime')+' · '+esc(s.type||'Creative session')+'</p></span><span>'+ (s.done?'✓':'→') +'</span></button>').join('')+'</div>':'<div class="empty">No studio sessions planned yet.</div>';
      }

      function openSession(id='',date='') {
        const old=state.sessions.find(x=>x.id===id) || {id:'',title:'Creative session',date:date||isoDate(new Date()),time:'18:00',duration:'45',type:'Songwriting',projectId:'',goal:'',accomplished:'',nextStep:'',done:false};
        const projects=allProjects();
        const projectOptions='<option value="">No linked project</option>'+projects.map(p=>'<option value="'+p.id+'" '+(p.id===old.projectId?'selected':'')+'>'+esc(p.title)+' ('+p.kind+')</option>').join('');
        openForm(old.id?'Edit studio session':'Plan a studio session',
          '<div class="form-grid">'+field('title','Session name',old.title)+field('date','Date',old.date,'date')+field('time','Start time',old.time,'time')+field('duration','Minutes',old.duration,'number')+
          selectField('type','Focus',old.type,['Songwriting','Storytelling','Journal mining','Revision','Listening / research','Performance practice','Other'])+
          '<div class="field"><label for="f-projectId">Project</label><select id="f-projectId" name="projectId">'+projectOptions+'</select></div>'+
          field('goal','One goal',old.goal,'textarea','span-2')+field('accomplished','What I accomplished',old.accomplished,'textarea')+field('nextStep','Next smallest step',old.nextStep,'textarea')+
          '<label class="check span-2"><input type="checkbox" name="done" '+(old.done?'checked':'')+'><span><b>Mark session complete</b></span></label></div>'+
          (old.id?'<div class="actions section-space"><button class="btn small" type="button" data-google-session="'+old.id+'">Open in Google Calendar</button><button class="btn small danger" type="button" data-delete-session="'+old.id+'">Delete session</button></div>':''),
          old.id?'Save changes':'Plan session',
          form=>{
            const v=values(form), item={...old,...v,done:form.elements.done.checked,id:old.id||uid('session'),updatedAt:now()};
            const i=state.sessions.findIndex(x=>x.id===item.id); if(i>=0)state.sessions[i]=item;else state.sessions.push(item);
            if(item.projectId&&item.done){const p=getProject(item.projectId);if(p){p.breadcrumb.accomplished=item.accomplished;p.breadcrumb.nextStep=item.nextStep;p.breadcrumb.updatedAt=now();touch(p);}}
            saveState();renderHome();toast(item.done?'Session complete—beautiful work ✦':'Session saved');if(item.done)confetti();
          });
      }
      function googleCalendarUrl(session) {
        const start=(session.date||isoDate(new Date())).replaceAll('-','')+'T'+(session.time||'18:00').replace(':','')+'00';
        const minutes=Math.max(15,Number(session.duration)||45);const d=new Date((session.date||isoDate(new Date()))+'T'+(session.time||'18:00'));d.setMinutes(d.getMinutes()+minutes);
        const end=isoDate(d).replaceAll('-','')+'T'+String(d.getHours()).padStart(2,'0')+String(d.getMinutes()).padStart(2,'0')+'00';
        const details=[session.goal?'Goal: '+session.goal:'',session.projectId&&getProject(session.projectId)?'Project: '+getProject(session.projectId).title:''].filter(Boolean).join('\\n');
        return 'https://calendar.google.com/calendar/render?action=TEMPLATE&text='+encodeURIComponent(session.title)+'&dates='+start+'/'+end+'&details='+encodeURIComponent(details);
      }

      function openQuickCapture(prefill='',why='') {
        openForm('Catch a spark',
          '<div class="form-grid">'+field('phrase','The phrase, image, or idea',prefill,'textarea','span-2')+
          field('context','Where it came from','')+field('emotion','Emotion / energy','')+
          field('theme','Possible theme','')+selectField('use','What might it become?','Undecided',['Undecided','Song','Story','Both'])+
          selectField('priority','When should it return?','Soon',['Now','Soon','Someday'])+
          field('why','Why it matters',why,'textarea','span-2')+'</div>',
          'Protect this spark',
          form=>{
            const v=values(form); if(!v.phrase.trim()){toast('Give the spark at least one line.');return false;}
            state.sparks.unshift({...v,id:uid('spark'),createdAt:now(),updatedAt:now(),private:true});
            saveState();renderAll();toast('Spark protected in the vault ✦');
          });
      }
      function openJournal(id='',templateId='') {
        const old=state.journal.find(x=>x.id===id) || {id:'',title:'',date:isoDate(new Date()),mood:'',tags:'',body:templateId?(TEMPLATES.find(t=>t.id===templateId)?.preview||''):'',favoriteLine:''};
        openForm(old.id?'Edit journal entry':'New journal entry',
          '<div class="form-grid">'+field('title','Entry title',old.title)+field('date','Date',old.date,'date')+field('mood','Mood / energy',old.mood)+field('tags','Tags (comma separated)',old.tags)+field('body','Write the honest version',old.body,'textarea','span-2')+field('favoriteLine','Line to remember',old.favoriteLine,'textarea','span-2')+'</div>'+
          '<div class="guided section-space"><strong>No performance required:</strong> this is source material, not a finished piece. Specific details are usually more useful than polished sentences.</div>'+
          (old.id?'<button type="button" class="btn danger small section-space" data-delete-journal="'+old.id+'">Delete entry</button>':''),
          old.id?'Save entry':'Save entry',
          form=>{
            const v=values(form);if(!v.title.trim()&&!v.body.trim()){toast('Add a title or a few words first.');return false;}
            const item={...old,...v,title:v.title.trim()||'Untitled journal entry',id:old.id||uid('journal'),updatedAt:now(),createdAt:old.createdAt||now()};
            const i=state.journal.findIndex(x=>x.id===item.id);if(i>=0)state.journal[i]=item;else state.journal.unshift(item);
            saveState();renderJournal();renderHome();toast('Journal entry saved');
          });
      }
      function openSpark(id='') {
        const old=state.sparks.find(x=>x.id===id) || {id:'',phrase:'',context:'',emotion:'',theme:'',use:'Undecided',priority:'Soon',why:''};
        openForm(old.id?'Edit spark':'New spark',
          '<div class="form-grid">'+field('phrase','The spark',old.phrase,'textarea','span-2')+field('context','Source / context',old.context)+field('emotion','Emotion / energy',old.emotion)+field('theme','Theme',old.theme)+selectField('use','Possible use',old.use,['Undecided','Song','Story','Both'])+selectField('priority','Priority',old.priority,['Now','Soon','Someday'])+field('why','Why it matters',old.why,'textarea','span-2')+'</div>'+
          (old.id?'<button type="button" class="btn danger small section-space" data-delete-spark="'+old.id+'">Delete spark</button>':''),
          old.id?'Save spark':'Protect spark',
          form=>{
            const v=values(form);if(!v.phrase.trim()){toast('Give the spark at least one line.');return false;}
            const item={...old,...v,id:old.id||uid('spark'),createdAt:old.createdAt||now(),updatedAt:now(),private:true};
            const i=state.sparks.findIndex(x=>x.id===item.id);if(i>=0)state.sparks[i]=item;else state.sparks.unshift(item);
            saveState();renderJournal();renderHome();toast('Spark saved');
          });
      }
      function renderJournal() {
        document.querySelectorAll('[data-journal-tab]').forEach(b=>b.classList.toggle('active',b.dataset.journalTab===ui.journalTab));
        ['entries','mine','sparks'].forEach(name=>document.getElementById('journal-panel-'+name).hidden=name!==ui.journalTab);
        const search=(document.getElementById('journal-search')?.value||'').toLowerCase();
        const sort=document.getElementById('journal-sort')?.value||'newest';
        let entries=state.journal.filter(x=>(x.title+' '+x.mood+' '+x.tags+' '+x.body).toLowerCase().includes(search));
        entries.sort((a,b)=>sort==='oldest'?String(a.date).localeCompare(String(b.date)):sort==='title'?a.title.localeCompare(b.title):String(b.date).localeCompare(String(a.date)));
        document.getElementById('journal-list').innerHTML=entries.length?entries.map(x=>`
          <article class="card tint-gold">
            <div class="card-top"><div><span class="chip">${fmtDate(x.date)}</span><h3 class="section-space">${esc(x.title)}</h3></div><div class="sticker">📓</div></div>
            <p class="sensitive">${esc(firstWords(x.body,32)||'No journal text yet.')}</p>
            <div class="chips">${x.mood?'<span class="chip">'+esc(x.mood)+'</span>':''}${String(x.tags||'').split(',').filter(Boolean).slice(0,3).map(t=>'<span class="chip">'+esc(t.trim())+'</span>').join('')}</div>
            <div class="actions section-space"><button class="btn small" data-edit-journal="${x.id}">Edit</button><button class="btn small primary" data-mine-journal="${x.id}">Mine this entry</button></div>
          </article>`).join(''):'<div class="empty span-2"><span class="emoji">📖</span>Your journal pages will live here. Start with the version only you know.</div>';
        const source=document.getElementById('mine-source');
        const current=source.value;
        source.innerHTML='<option value="">Paste something new</option>'+state.journal.map(x=>'<option value="'+x.id+'">'+esc(x.title)+'</option>').join('');
        if(state.journal.some(x=>x.id===current))source.value=current;
        const sparkSearch=(document.getElementById('spark-search')?.value||'').toLowerCase();
        const use=document.getElementById('spark-use-filter')?.value||'all';
        const priority=document.getElementById('spark-priority-filter')?.value||'all';
        const sparks=state.sparks.filter(x=>(x.phrase+' '+x.context+' '+x.emotion+' '+x.theme).toLowerCase().includes(sparkSearch)&&(use==='all'||x.use===use)&&(priority==='all'||x.priority===priority));
        document.getElementById('spark-list').innerHTML=sparks.length?sparks.map(x=>`
          <article class="card tint-pink">
            <div class="card-top"><span class="chip ${x.priority==='Now'?'warn':''}">${esc(x.priority)}</span><button class="icon-btn" data-edit-spark="${x.id}" aria-label="Edit spark">✎</button></div>
            <h3 class="sensitive">“${esc(x.phrase)}”</h3>
            <p>${esc(x.why||x.context||'No note added yet.')}</p>
            <div class="chips"><span class="chip">${esc(x.use)}</span>${x.emotion?'<span class="chip">'+esc(x.emotion)+'</span>':''}</div>
            <div class="actions section-space"><button class="btn small primary" data-develop-spark="${x.id}" data-kind="song">Make song</button><button class="btn small" data-develop-spark="${x.id}" data-kind="story">Make story</button></div>
          </article>`).join(''):'<div class="empty span-2"><span class="emoji">✨</span>No sparks match this view yet. Save the line before you decide what it is.</div>';
      }

      function openNewSong(sparkId='',templateId='s-story') {
        const spark=state.sparks.find(x=>x.id===sparkId);
        const songTemplates=TEMPLATES.filter(t=>t.type==='song');
        openForm('Start a song',
          '<div class="form-grid">'+field('title','Working title',spark?firstWords(spark.phrase,6):'')+
          '<div class="field"><label for="f-template">Starting shape</label><select id="f-template" name="template">'+songTemplates.map(t=>'<option value="'+t.id+'" '+(t.id===templateId?'selected':'')+'>'+esc(t.name)+'</option>').join('')+'</select></div>'+
          field('spark','Original spark',spark?spark.phrase:'','textarea','span-2')+'</div><div class="guided section-space"><strong>Working title means temporary.</strong> You can rename the song at any time. The original spark stays in your Creative Compass.</div>',
          'Open Song Lab',
          form=>{const v=values(form),song=makeSong(v.title.trim()||'Untitled Song',v.template,v.spark);song.sourceSparkId=sparkId;state.songs.unshift(song);state.activeSongId=song.id;saveState();setView('songs');toast('New song room opened 🎧');}
        );
      }
      function openNewStory(sparkId='',templateId='t-short') {
        const spark=state.sparks.find(x=>x.id===sparkId);
        const storyTemplates=TEMPLATES.filter(t=>t.type==='story');
        openForm('Start a story',
          '<div class="form-grid">'+field('title','Working title',spark?firstWords(spark.phrase,6):'')+
          '<div class="field"><label for="f-template">Starting shape</label><select id="f-template" name="template">'+storyTemplates.map(t=>'<option value="'+t.id+'" '+(t.id===templateId?'selected':'')+'>'+esc(t.name)+'</option>').join('')+'</select></div>'+
          field('spark','Original spark',spark?spark.phrase:'','textarea','span-2')+'</div>',
          'Open Story Lab',
          form=>{const v=values(form),story=makeStory(v.title.trim()||'Untitled Story',v.template,v.spark);story.sourceSparkId=sparkId;state.stories.unshift(story);state.activeStoryId=story.id;saveState();setView('stories');toast('New story room opened 🎬');}
        );
      }

      function renderSongs() {
        const root=document.getElementById('song-workspace');
        if(!state.songs.length){root.innerHTML='<div class="empty"><span class="emoji">🎤</span><h3>Your Song Lab is ready</h3><p>Begin with a journal spark, a hook, an image, or a feeling you cannot name yet.</p><button class="btn primary" data-action="new-song">Start the first song</button></div>';return;}
        if(!activeSong())state.activeSongId=state.songs[0].id;
        const p=activeSong();state.activeSongId=p.id;
        if(!p.sections?.length)p.sections=[defaultSection()];
        let section=p.sections.find(x=>x.id===p.activeSectionId)||p.sections[0];p.activeSectionId=section.id;
        const rail=state.songs.map(x=>`<button class="rail-project ${x.id===p.id?'active':''}" data-select-song="${x.id}"><b>${esc(x.title)}</b><small>${esc(x.status)} · ${fmtDate(x.updatedAt)}</small></button>`).join('');
        const sectionOptions=p.sections.map((x,i)=>'<option value="'+x.id+'" '+(x.id===section.id?'selected':'')+'>'+(i+1)+'. '+esc(x.name)+'</option>').join('');
        const parking=p.parkingLot?.length?p.parkingLot.map(x=>`<div class="list-item"><span><h4 class="sensitive">${esc(x.text)}</h4><p>${esc(x.note||'Saved for later')}</p></span><span class="actions"><button class="btn small" data-return-line="${x.id}">Move into section</button><button class="icon-btn" data-delete-parking="${x.id}" aria-label="Delete parked line">×</button></span></div>`).join(''):'<div class="empty">No side quests parked. That is allowed too.</div>';
        const alternates=section.alternates?.length?section.alternates.map((x,i)=>'<div class="alt-line"><div class="sensitive">'+esc(x)+'</div><div class="actions section-space"><button class="btn small" data-use-alternate="'+i+'">Move to lyrics</button><button class="btn small ghost" data-delete-alternate="'+i+'">Delete</button></div></div>').join(''):'<p class="muted small-text">Alternate lines can wait here without crowding the draft.</p>';
        const notes=(p.coachNotes||[]).slice().reverse().slice(0,4).map(n=>'<div class="sticky-note"><p>'+esc(firstWords(n.text,35))+'</p><small>'+fmtDate(n.createdAt)+'</small></div>').join('');
        root.innerHTML=`
          <div class="workspace">
            <aside class="project-rail">
              <div class="rail-head"><b>My songs</b><button class="icon-btn" data-action="new-song" aria-label="New song">＋</button></div>
              <div class="field"><input id="song-rail-search" placeholder="Search songs…" aria-label="Search songs"></div>
              <div id="song-rail-list">${rail}</div>
            </aside>
            <div class="work-main">
              <div class="work-toolbar">
                <div><b class="sensitive">${esc(p.title)}</b><div class="small-text muted">${wordCount(p.sections.map(x=>x.lyrics).join(' '))} lyric words · saved locally</div></div>
                <div class="actions">
                  <select data-song-field="status" aria-label="Song status">${STATUSES.map(x=>'<option '+(x===p.status?'selected':'')+'>'+x+'</option>').join('')}</select>
                  <button class="btn small" data-song-snapshot>📸 Snapshot</button>
                  <button class="btn small" data-versions="song">Versions</button>
                </div>
              </div>

              <details class="card compass" open>
                <summary>Creative Compass <button type="button" class="help" data-help="compass" aria-label="Explain Creative Compass">?</button></summary>
                <div class="guided section-space"><strong>North star:</strong> answer in plain language. These are decisions, not polished lyrics. If the song changes honestly, use “Evolve compass” and keep the older direction in history.</div>
                <div class="compass-grid">
                  ${fieldMarkup('Original spark','spark',p.compass.spark,'What sentence or image began this?',true,'compass')}
                  ${fieldMarkup('Central truth','truth',p.compass.truth,'What is this really saying?',true,'compass')}
                  ${fieldMarkup('Emotional destination','destination',p.compass.destination,'What should the listener feel or understand?',true,'compass')}
                  ${fieldMarkup('Beginning belief','beginBelief',p.compass.beginBelief,'What does the speaker believe at first?',true,'compass')}
                  ${fieldMarkup('Ending belief','endBelief',p.compass.endBelief,'What changes by the end?',true,'compass')}
                  ${fieldMarkup('Must-keep line','mustKeep',p.compass.mustKeep,'Which line carries the heartbeat?',true,'compass')}
                  ${fieldMarkup('Not this song','notThis',p.compass.notThis,'What tempting direction does not belong?',true,'compass')}
                </div>
                <div class="actions section-space"><button class="btn primary" data-direction="song">🧭 Find my way back</button><button class="btn" data-check-song>Check current section</button><button class="btn ghost" data-evolve-compass="song">Evolve compass</button></div>
              </details>

              <div class="grid two section-space">
                <section class="card">
                  <div class="card-top"><div><p class="eyebrow">Guided lyrics</p><h2>${esc(section.name)}</h2></div><button class="help" data-help="sidequest" aria-label="Explain side quests">?</button></div>
                  <div class="section-switcher section-space"><button class="icon-btn" data-section-move="-1" aria-label="Previous section">←</button><select id="song-section-select">${sectionOptions}</select><button class="icon-btn" data-section-move="1" aria-label="Next section">→</button></div>
                  <div class="guided"><strong>This section’s job:</strong> ${esc(section.purpose||SECTION_JOBS[section.type]||SECTION_JOBS.Custom)}</div>
                  <div class="form-grid section-space">
                    <div class="field"><label>Section name</label><input data-section-field="name" value="${esc(section.name)}"></div>
                    <div class="field"><label>Section type</label><select data-section-field="type">${Object.keys(SECTION_JOBS).map(x=>'<option '+(x===section.type?'selected':'')+'>'+x+'</option>').join('')}</select></div>
                    <div class="field span-2"><label>Its one job</label><input data-section-field="purpose" value="${esc(section.purpose)}"></div>
                  </div>
                  <div class="field section-space"><label for="song-lyrics">Lyrics / fragments</label><textarea id="song-lyrics" class="lyrics sensitive" data-section-field="lyrics" placeholder="Write the imperfect version. Line breaks count.">${esc(section.lyrics)}</textarea></div>
                  <div class="counter"><span id="lyric-count">${wordCount(section.lyrics)} words · ${String(section.lyrics||'').split(/\n/).filter(Boolean).length} lines</span><span>Section ${p.sections.indexOf(section)+1} of ${p.sections.length}</span></div>
                  <div class="form-grid section-space">
                    <div class="field"><label>Bar count</label><input data-section-field="bars" value="${esc(section.bars)}" placeholder="8"></div>
                    <div class="field"><label>Section status</label><select data-section-field="status">${['Idea','Rough','Working','Strong','Locked'].map(x=>'<option '+(x===section.status?'selected':'')+'>'+x+'</option>').join('')}</select></div>
                    <div class="field span-2"><label>Performance / production notes</label><textarea data-section-field="notes">${esc(section.notes)}</textarea></div>
                  </div>
                  <div class="actions section-space"><button class="btn pink" data-park-selection>Park selected lines</button><button class="btn" data-add-alternate>Add alternate line</button><button class="btn" data-section-add>＋ Section</button><button class="btn ghost" data-reorder-section="-1">Move section up</button><button class="btn ghost" data-reorder-section="1">Move section down</button><button class="btn danger" data-section-delete>Delete section</button></div>
                </section>
                <aside class="grid">
                  <section class="card tint-gold"><div class="card-top"><div><h3>Alternate lines</h3><p>Options are not commitments.</p></div><div class="sticker">🔀</div></div><div class="list section-space">${alternates}</div></section>
                  <section class="card tint-pink"><div class="card-top"><div><h3>Side Quest Parking Lot</h3><p>Keep the gem. Protect the song.</p></div><button class="help" data-help="sidequest">?</button></div><div class="list section-space">${parking}</div><button class="btn small section-space" data-add-parking>＋ Park an idea</button></section>
                </aside>
              </div>

              <details class="card fold section-space">
                <summary>Song details + production</summary>
                <div class="form-grid section-space">
                  ${fieldMarkup('Working title','title',p.title,'',false,'song')}
                  ${fieldMarkup('Genre / sonic world','genre',p.genre,'',false,'song')}
                  ${fieldMarkup('Tempo','tempo',p.tempo,'BPM or feel',false,'song')}
                  ${fieldMarkup('Key','key',p.key,'',false,'song')}
                  ${fieldMarkup('Reference songs / links','references',p.references,'What are you studying—not copying?',true,'song','span-2')}
                  ${fieldMarkup('Voice memo / FL Studio link','audioLink',p.audioLink,'Paste a cloud or local reference link',false,'song','span-2')}
                  ${fieldMarkup('Production notes','productionNotes',p.productionNotes,'Texture, instruments, vocal approach, transitions…',true,'song','span-2')}
                </div>
              </details>

              <div class="grid two section-space">
                <section class="card tint-mint">
                  <div class="card-top"><div><h2>Revision passes</h2><p>Change one layer at a time so everything does not feel broken at once.</p></div><div class="sticker">🧼</div></div>
                  <div class="revision-grid section-space">${REVISION_PASSES.map(name=>'<button class="revision '+(p.revision[name]?'done':'')+'" data-revision="'+name+'">'+(p.revision[name]?'✓ ':'')+name+'</button>').join('')}</div>
                </section>
                <section class="card">
                  <h2>Session breadcrumb</h2><p>Make tomorrow’s start easier.</p>
                  <div class="form-grid compact">
                    ${breadcrumbMarkup(p)}
                  </div>
                </section>
              </div>

              <section class="card section-space tint-lilac">
                <div class="card-top"><div><p class="eyebrow">Optional support</p><h2>Studio Coach</h2><p>Ask questions, check direction, or find options. Nothing overwrites your work.</p></div><button class="help" data-help="coach">?</button></div>
                <div class="actions section-space"><button class="btn primary" data-coach="song">Ask about this section</button><button class="btn" data-coach="song">Find a hook</button></div>
                ${notes?'<div class="grid two section-space">'+notes+'</div>':''}
              </section>

              <div class="actions section-space"><button class="btn" data-archive-project="${p.id}">Move song to archive</button></div>
            </div>
          </div>`;
      }
      function fieldMarkup(label,name,value,placeholder='',area=false,scope='song',extra='') {
        const attr=scope==='compass'?'data-compass-field="'+name+'"':'data-'+scope+'-field="'+name+'"';
        return '<div class="field '+extra+'"><label>'+label+'</label>'+(area?'<textarea '+attr+' placeholder="'+esc(placeholder)+'">'+esc(value)+'</textarea>':'<input '+attr+' value="'+esc(value)+'" placeholder="'+esc(placeholder)+'">')+'</div>';
      }
      function breadcrumbMarkup(p) {
        const b=p.breadcrumb||blankBreadcrumb();
        return fieldMarkup('What I accomplished','accomplished',b.accomplished,'',true,'breadcrumb')+fieldMarkup('What I am figuring out','figuring',b.figuring,'',true,'breadcrumb')+fieldMarkup('Next smallest step','nextStep',b.nextStep,'',true,'breadcrumb')+fieldMarkup('Open to this next time','openTo',b.openTo,'',true,'breadcrumb');
      }

      function renderStories() {
        const root=document.getElementById('story-workspace');
        if(!state.stories.length){root.innerHTML='<div class="empty"><span class="emoji">🎬</span><h3>Your Story Lab is ready</h3><p>Begin with a memory, a character, one charged scene, or a question you cannot answer yet.</p><button class="btn primary" data-action="new-story">Start the first story</button></div>';return;}
        if(!activeStory())state.activeStoryId=state.stories[0].id;
        const p=activeStory();state.activeStoryId=p.id;
        if(!p.scenes?.length)p.scenes=[storyScene()];
        let scene=p.scenes.find(x=>x.id===p.activeSceneId)||p.scenes[0];p.activeSceneId=scene.id;
        const rail=state.stories.map(x=>`<button class="rail-project ${x.id===p.id?'active':''}" data-select-story="${x.id}"><b>${esc(x.title)}</b><small>${esc(x.status)} · ${fmtDate(x.updatedAt)}</small></button>`).join('');
        const sceneOptions=p.scenes.map((x,i)=>'<option value="'+x.id+'" '+(x.id===scene.id?'selected':'')+'>'+(i+1)+'. '+esc(x.name)+'</option>').join('');
        const characters=p.characters?.length?p.characters.map(x=>`<div class="list-item"><span><h4>${esc(x.name)}</h4><p><b>Wants:</b> ${esc(x.want||'—')} · <b>Needs:</b> ${esc(x.need||'—')}</p><p>${esc(x.contradiction||'')}</p></span><button class="icon-btn" data-edit-character="${x.id}" aria-label="Edit character">✎</button></div>`).join(''):'<div class="empty">Add only the characters this draft needs.</div>';
        const parking=p.parkingLot?.length?p.parkingLot.map(x=>'<div class="list-item"><span><h4 class="sensitive">'+esc(x.text)+'</h4><p>'+esc(x.note||'A good idea for another place')+'</p></span><button class="icon-btn" data-delete-story-parking="'+x.id+'">×</button></div>').join(''):'<div class="empty">Scenes and ideas that do not belong can rest here.</div>';
        const linkedSong=state.songs.find(x=>x.id===p.bridge?.songId);
        const notes=(p.coachNotes||[]).slice().reverse().slice(0,4).map(n=>'<div class="sticky-note"><p>'+esc(firstWords(n.text,35))+'</p><small>'+fmtDate(n.createdAt)+'</small></div>').join('');
        root.innerHTML=`
          <div class="workspace">
            <aside class="project-rail">
              <div class="rail-head"><b>My stories</b><button class="icon-btn" data-action="new-story" aria-label="New story">＋</button></div>
              <div class="field"><input id="story-rail-search" placeholder="Search stories…" aria-label="Search stories"></div>
              <div id="story-rail-list">${rail}</div>
            </aside>
            <div class="work-main">
              <div class="work-toolbar">
                <div><b class="sensitive">${esc(p.title)}</b><div class="small-text muted">${wordCount(p.draft)+p.scenes.reduce((n,x)=>n+wordCount(x.draft),0)} story words · saved locally</div></div>
                <div class="actions">
                  <select data-story-field="status" aria-label="Story status">${STATUSES.map(x=>'<option '+(x===p.status?'selected':'')+'>'+x+'</option>').join('')}</select>
                  <button class="btn small" data-story-snapshot>📸 Snapshot</button><button class="btn small" data-versions="story">Versions</button>
                </div>
              </div>

              <details class="card compass" open>
                <summary>Story Compass <button type="button" class="help" data-help="compass">?</button></summary>
                <div class="guided section-space"><strong>The story’s promise:</strong> name what the character wants on the surface, needs underneath, and must come to understand. Evolving the compass is allowed; silent drift is what makes a draft confusing.</div>
                <div class="compass-grid">
                  ${fieldMarkup('Original spark','spark',p.compass.spark,'What moment, line, or image began this?',true,'compass')}
                  ${fieldMarkup('Theme / central truth','truth',p.compass.truth||p.compass.theme,'What human truth are you exploring?',true,'compass')}
                  ${fieldMarkup('Character wants','want',p.compass.want,'What are they actively trying to get?',true,'compass')}
                  ${fieldMarkup('Character needs','need',p.compass.need,'What truth or change do they actually need?',true,'compass')}
                  ${fieldMarkup('Beginning belief','beginBelief',p.compass.beginBelief,'What false or incomplete belief guides them?',true,'compass')}
                  ${fieldMarkup('Ending realization','endBelief',p.compass.endBelief,'What can they see by the end?',true,'compass')}
                  ${fieldMarkup('Emotional destination','destination',p.compass.destination,'What should the audience carry away?',true,'compass')}
                  ${fieldMarkup('Not this story','notThis',p.compass.notThis,'Which direction belongs somewhere else?',true,'compass')}
                </div>
                <div class="actions section-space"><button class="btn primary" data-direction="story">🧭 Find my way back</button><button class="btn" data-check-story>Check current scene</button><button class="btn ghost" data-evolve-compass="story">Evolve compass</button></div>
              </details>

              <div class="grid two section-space">
                <section class="card">
                  <div class="card-top"><div><p class="eyebrow">Scene workshop</p><h2>${esc(scene.name)}</h2></div><div class="sticker">🎭</div></div>
                  <div class="section-switcher section-space"><button class="icon-btn" data-scene-move="-1">←</button><select id="story-scene-select">${sceneOptions}</select><button class="icon-btn" data-scene-move="1">→</button></div>
                  <div class="guided"><strong>Scene test:</strong> somebody wants something, something resists them, and at least one thing changes—even if the change is internal.</div>
                  <div class="form-grid section-space">
                    ${fieldMarkup('Scene name','name',scene.name,'',false,'scene')}
                    ${fieldMarkup('Scene status','status',scene.status,'Idea / working / strong',false,'scene')}
                    ${fieldMarkup('One job','purpose',scene.purpose,'Why must this scene exist?',true,'scene','span-2')}
                    ${fieldMarkup('Where / when','setting',scene.setting,'',false,'scene')}
                    ${fieldMarkup('Who is here','characters',scene.characters,'',false,'scene')}
                    ${fieldMarkup('What is wanted','want',scene.want,'',true,'scene')}
                    ${fieldMarkup('What resists it','conflict',scene.conflict,'',true,'scene')}
                    ${fieldMarkup('What changes','turn',scene.turn,'',true,'scene','span-2')}
                  </div>
                  <div class="field section-space"><label>Scene draft</label><textarea class="lyrics sensitive" data-scene-field="draft" placeholder="Enter late. Leave after the turn.">${esc(scene.draft)}</textarea></div>
                  <div class="counter"><span>${wordCount(scene.draft)} words</span><span>Scene ${p.scenes.indexOf(scene)+1} of ${p.scenes.length}</span></div>
                  <div class="field section-space"><label>Scene notes</label><textarea data-scene-field="notes">${esc(scene.notes)}</textarea></div>
                  <div class="actions section-space"><button class="btn" data-scene-add>＋ Scene</button><button class="btn ghost" data-reorder-scene="-1">Move scene up</button><button class="btn ghost" data-reorder-scene="1">Move scene down</button><button class="btn pink" data-park-scene>Park scene idea</button><button class="btn danger" data-scene-delete>Delete scene</button></div>
                </section>
                <aside class="grid">
                  <section class="card tint-lilac"><div class="card-top"><div><h3>Characters</h3><p>Track the tension inside the person.</p></div><button class="btn small" data-add-character>＋ Add</button></div><div class="list section-space">${characters}</div></section>
                  <section class="card tint-gold"><div class="card-top"><div><h3>Scenes that belong elsewhere</h3><p>Protect the idea without bending this story around it.</p></div><button class="help" data-help="sidequest">?</button></div><div class="list section-space">${parking}</div></section>
                </aside>
              </div>

              <details class="card fold section-space">
                <summary>Story foundation + full draft</summary>
                <div class="form-grid section-space">
                  ${fieldMarkup('Working title','title',p.title,'',false,'story')}
                  ${fieldMarkup('Format','format',p.format,'Short story, personal narrative, video…',false,'story')}
                  ${fieldMarkup('One-sentence logline','logline',p.logline,'A character wants X, but Y forces them to…',true,'story','span-2')}
                  ${fieldMarkup('Loose outline','outline',p.outline,'List the essential beats. This can stay messy.',true,'story','span-2')}
                  ${fieldMarkup('Full draft / assembled story','draft',p.draft,'Bring scenes together here when ready.',true,'story','span-2')}
                </div>
              </details>

              <details class="card fold section-space">
                <summary>Story ↔ Song bridge</summary>
                <p>Compare what stays true and what changes when the same emotional material moves between forms.</p>
                <div class="form-grid section-space">
                  <div class="field"><label>Linked song</label><select data-bridge-field="songId"><option value="">No linked song</option>${state.songs.map(x=>'<option value="'+x.id+'" '+(x.id===p.bridge?.songId?'selected':'')+'>'+esc(x.title)+'</option>').join('')}</select></div>
                  <div class="field"><label>Link status</label><input readonly value="${linkedSong?'Connected to '+esc(linkedSong.title):'Independent story'}"></div>
                  ${fieldMarkup('Original truth','originalTruth',p.bridge?.originalTruth||'','What both forms begin from',true,'bridge','span-2')}
                  ${fieldMarkup('What the story can hold','storyTruth',p.bridge?.storyTruth||'','Character, scene, sequence, context…',true,'bridge')}
                  ${fieldMarkup('What the song can hold','songTruth',p.bridge?.songTruth||'','Compression, repetition, sound, hook…',true,'bridge')}
                </div>
              </details>

              <div class="grid two section-space">
                <section class="card tint-mint"><div class="card-top"><div><h2>Revision passes</h2><p>Focus the lens instead of fixing everything at once.</p></div><div class="sticker">🔍</div></div><div class="revision-grid section-space">${Object.keys(p.revision).map(name=>'<button class="revision '+(p.revision[name]?'done':'')+'" data-story-revision="'+name+'">'+(p.revision[name]?'✓ ':'')+name+'</button>').join('')}</div></section>
                <section class="card"><h2>Session breadcrumb</h2><p>Make tomorrow’s start easier.</p><div class="form-grid compact">${breadcrumbMarkup(p)}</div></section>
              </div>

              <section class="card section-space tint-pink">
                <div class="card-top"><div><p class="eyebrow">Optional support</p><h2>Studio Coach</h2><p>Pressure-test a character choice, scene job, or emotional turn.</p></div><button class="help" data-help="coach">?</button></div>
                <div class="actions section-space"><button class="btn primary" data-coach="story">Ask about this scene</button><button class="btn" data-coach="story">Check the character arc</button></div>
                ${notes?'<div class="grid two section-space">'+notes+'</div>':''}
              </section>
              <div class="actions section-space"><button class="btn" data-archive-project="${p.id}">Move story to archive</button></div>
            </div>
          </div>`;
      }

      function openCharacter(id='') {
        const p=activeStory();if(!p)return;
        const old=p.characters.find(x=>x.id===id)||{id:'',name:'',role:'',want:'',need:'',fear:'',contradiction:'',voice:''};
        openForm(old.id?'Edit character':'Add character',
          '<div class="form-grid">'+field('name','Name',old.name)+field('role','Role in story',old.role)+field('want','What they want',old.want,'textarea')+field('need','What they need',old.need,'textarea')+field('fear','What they fear',old.fear,'textarea')+field('contradiction','Interesting contradiction',old.contradiction,'textarea')+field('voice','Voice / behavior notes',old.voice,'textarea','span-2')+'</div>'+
          (old.id?'<button type="button" class="btn danger small section-space" data-delete-character="'+old.id+'">Delete character</button>':''),
          old.id?'Save character':'Add character',
          form=>{const v=values(form);if(!v.name.trim()){toast('Give the character a working name.');return false;}const item={...old,...v,id:old.id||uid('char')};const i=p.characters.findIndex(x=>x.id===item.id);if(i>=0)p.characters[i]=item;else p.characters.push(item);touch(p);renderStories();}
        );
      }

      function renderLibrary() {
        document.querySelectorAll('[data-library-tab]').forEach(b=>b.classList.toggle('active',b.dataset.libraryTab===ui.libraryTab));
        document.getElementById('library-panel-templates').hidden=ui.libraryTab!=='templates';
        document.getElementById('library-panel-inspiration').hidden=ui.libraryTab!=='inspiration';
        const filter=document.getElementById('template-filter')?.value||'all';
        const templates=TEMPLATES.filter(x=>filter==='all'||x.type===filter);
        document.getElementById('template-list').innerHTML=templates.map(t=>`<article class="card template-card"><div class="template-icon">${t.icon}</div><span class="chip">${esc(t.type)}</span><h3>${esc(t.name)}</h3><p>${esc(t.desc)}</p><details><summary>See the prompts</summary><div class="preview-box section-space">${esc(t.preview)}</div></details><div class="actions"><button class="btn primary small" data-use-template="${t.id}">Use template</button></div></article>`).join('');
        const q=(document.getElementById('inspiration-search')?.value||'').toLowerCase(),type=document.getElementById('inspiration-type-filter')?.value||'all';
        const items=state.inspiration.filter(x=>(x.title+' '+x.creator+' '+x.works+' '+x.tags).toLowerCase().includes(q)&&(type==='all'||x.type===type));
        document.getElementById('inspiration-list').innerHTML=items.length?items.map(x=>`<article class="card tint-lilac"><div class="card-top"><span class="chip">${esc(x.type)}</span><button class="icon-btn" data-edit-inspiration="${x.id}">✎</button></div><h3>${esc(x.title)}</h3><p>${esc(x.creator||'')}</p><p><b>What works:</b> ${esc(x.works||'—')}</p><p><b>Do not copy:</b> ${esc(x.avoid||'—')}</p><div class="actions">${safeUrl(x.link)?'<a class="btn small" href="'+esc(safeUrl(x.link))+'" target="_blank" rel="noopener noreferrer">Open reference</a>':''}</div></article>`).join(''):'<div class="empty span-2"><span class="emoji">📻</span>Save references for what they teach you—not so you can become them.</div>';
      }
      function openInspiration(id='') {
        const old=state.inspiration.find(x=>x.id===id)||{id:'',title:'',type:'Song',creator:'',link:'',works:'',avoid:'',tags:''};
        openForm(old.id?'Edit inspiration':'Save inspiration',
          '<div class="form-grid">'+field('title','Title',old.title)+selectField('type','Kind',old.type,['Song','Film','Book','Visual','Conversation','Other'])+field('creator','Creator / source',old.creator)+field('link','Link',old.link,'url')+field('works','What works and why',old.works,'textarea','span-2')+field('avoid','What I do not want to copy',old.avoid,'textarea','span-2')+field('tags','Tags',old.tags,'text','span-2')+'</div>'+
          (old.id?'<button type="button" class="btn danger small section-space" data-delete-inspiration="'+old.id+'">Delete reference</button>':''),
          'Save reference',
          form=>{const v=values(form);if(!v.title.trim()){toast('Add a title first.');return false;}const item={...old,...v,id:old.id||uid('inspo'),createdAt:old.createdAt||now()};const i=state.inspiration.findIndex(x=>x.id===item.id);if(i>=0)state.inspiration[i]=item;else state.inspiration.unshift(item);saveState();renderLibrary();}
        );
      }

      function renderProjects() {
        const q=(document.getElementById('project-search')?.value||'').toLowerCase(),type=document.getElementById('project-type-filter')?.value||'all',status=document.getElementById('project-status-filter')?.value||'all';
        const projects=allProjects().filter(p=>(p.title+' '+(p.compass?.truth||'')).toLowerCase().includes(q)&&(type==='all'||p.kind===type)&&(status==='all'||p.status===status));
        const groups=[['Seeds',['Spark','Developing']],['In the making',['Drafting','Revising','Finalizing']],['Complete + archive',['Finished','Shared','Archived']]];
        document.getElementById('project-board').innerHTML=groups.map(group=>`<section class="column"><h3>${group[0]} <span class="chip">${projects.filter(p=>group[1].includes(p.status)).length}</span></h3>${projects.filter(p=>group[1].includes(p.status)).sort((a,b)=>String(b.updatedAt).localeCompare(String(a.updatedAt))).map(p=>`<article class="project-card"><div class="card-top"><span class="chip">${p.kind==='song'?'🎧 Song':'🎬 Story'}</span><span class="small-text">${projectProgress(p)}%</span></div><h4 class="sensitive">${esc(p.title)}</h4><p>${esc(firstWords(p.compass?.truth||p.logline||p.breadcrumb?.nextStep||'No central truth yet.',18))}</p><div class="progress"><i style="width:${projectProgress(p)}%"></i></div><div class="actions section-space"><button class="btn small primary" data-open-project="${p.id}">Open</button><select class="small-text" data-board-status="${p.id}">${STATUSES.map(x=>'<option '+(x===p.status?'selected':'')+'>'+x+'</option>').join('')}</select>${p.status==='Archived'?'<button class="btn small danger" data-delete-project="'+p.id+'">Delete</button>':''}</div></article>`).join('')||'<div class="empty">Nothing here yet.</div>'}</section>`).join('');
      }

      function createSnapshot(kind,label='Manual snapshot') {
        const p=kind==='song'?activeSong():activeStory();if(!p)return;
        const copy=deep(p);copy.versions=[];
        p.versions=p.versions||[];
        p.versions.unshift({id:uid('version'),label,createdAt:now(),data:copy});
        p.versions=p.versions.slice(0,30);touch(p);toast('Snapshot saved 📸');
      }
      function showVersions(kind) {
        const p=kind==='song'?activeSong():activeStory();if(!p)return;
        ui.versionKind=kind;
        document.getElementById('version-list').innerHTML='<div class="privacy-note">Snapshots are a safety net before major changes. Restoring one first saves the current version automatically.</div>'+
          (p.versions?.length?p.versions.map(v=>'<div class="version"><div class="card-top"><div><b>'+esc(v.label)+'</b><div class="small-text muted">'+fmtDate(v.createdAt)+' · '+new Date(v.createdAt).toLocaleTimeString([],{hour:'numeric',minute:'2-digit'})+'</div></div><button class="btn small" data-restore-version="'+v.id+'">Restore</button></div></div>').join(''):'<div class="empty section-space">No snapshots yet. Make one before a big restructure.</div>');
        document.getElementById('version-dialog').showModal();
      }
      function restoreVersion(versionId) {
        const kind=ui.versionKind,p=kind==='song'?activeSong():activeStory();if(!p)return;
        const version=p.versions.find(v=>v.id===versionId);if(!version)return;
        if(!confirm('Restore this snapshot? Your current project will be saved as a safety snapshot first.'))return;
        const safety=deep(p);safety.versions=[];
        const history=[{id:uid('version'),label:'Before restore',createdAt:now(),data:safety},...(p.versions||[])];
        const restored=deep(version.data);restored.versions=history.slice(0,30);restored.updatedAt=now();
        const list=kind==='song'?state.songs:state.stories,index=list.findIndex(x=>x.id===p.id);list[index]=restored;
        if(kind==='song')state.activeSongId=restored.id;else state.activeStoryId=restored.id;
        saveState();document.getElementById('version-dialog').close();kind==='song'?renderSongs():renderStories();toast('Snapshot restored');
      }
      function evolveCompass(kind) {
        const p=kind==='song'?activeSong():activeStory();if(!p)return;
        openForm('Let the '+kind+' evolve',
          '<div class="privacy-note">The current compass will be saved in history. Changing direction is not failure; naming the change keeps the project coherent.</div><div class="form-grid section-space">'+
          field('reason','What changed, and why?', '', 'textarea','span-2')+
          field('truth','New central truth',p.compass.truth,'textarea','span-2')+
          field('destination','New emotional destination',p.compass.destination,'textarea','span-2')+
          field('notThis','What no longer belongs',p.compass.notThis,'textarea','span-2')+'</div>',
          'Evolve compass',
          form=>{const v=values(form);p.compass.history=p.compass.history||[];p.compass.history.unshift({createdAt:now(),reason:v.reason,compass:deep({...p.compass,history:[]})});p.compass.truth=v.truth;p.compass.destination=v.destination;p.compass.notThis=v.notThis;touch(p);kind==='song'?renderSongs():renderStories();toast('New direction named; old compass preserved');}
        );
      }
      function directionReport(kind,checkOnly=false) {
        const p=kind==='song'?activeSong():activeStory();if(!p)return;
        const unit=kind==='song'?(p.sections.find(x=>x.id===p.activeSectionId)||p.sections[0]):(p.scenes.find(x=>x.id===p.activeSceneId)||p.scenes[0]);
        const body=kind==='song'?unit.lyrics:unit.draft;
        const truth=p.compass.truth||p.compass.theme||'Not named yet';
        const truthWords=new Set(slugWords(truth).filter(w=>w.length>3));
        const bodyWords=new Set(slugWords(body));
        const shared=[...truthWords].filter(w=>bodyWords.has(w));
        const issues=[];
        if(!p.compass.spark)issues.push('The original spark is blank. Name the first line, image, or moment so the draft has an origin.');
        if(!p.compass.truth)issues.push('The central truth is blank. Explain what this is really about in ordinary language.');
        if(!body.trim())issues.push('This '+(kind==='song'?'section':'scene')+' is still open. Start with one sensory image or one action.');
        if(body.trim()&&truthWords.size&&shared.length===0)issues.push('The current draft does not echo the language of the truth yet. That is not automatically wrong—check whether the connection is emotional, visual, or missing.');
        if(kind==='song'&&!(unit.purpose||'').trim())issues.push('Give this section one job before polishing its lines.');
        if(kind==='story'&&body.trim()&&!unit.turn)issues.push('Name what changes by the end of this scene.');
        const promptList=kind==='song'?[
          'What new information belongs in '+unit.name+'—not a repeat of the chorus?',
          'Which image could prove “'+truth+'” without explaining it?',
          'What is the bravest honest line the speaker is avoiding?'
        ]:[
          'What does the character try to get in this scene?',
          'What resistance makes “'+truth+'” visible through action?',
          'What is different by the last line of the scene?'
        ];
        ui.directionText='Original spark: '+(p.compass.spark||'Not named')+'\\nCentral truth: '+truth+'\\nEmotional destination: '+(p.compass.destination||'Not named')+'\\nCurrent '+(kind==='song'?'section':'scene')+' job: '+(unit.purpose||'Not named')+'\\n\\nQuestions:\\n- '+promptList.join('\\n- ');
        document.getElementById('direction-title').textContent=checkOnly?'Direction check':'Find my way back';
        document.getElementById('direction-body').innerHTML=`
          <div class="grid two">
            <div class="card tint-lilac"><p class="eyebrow">The heartbeat</p><h3>${esc(truth)}</h3><p><b>Started from:</b> ${esc(p.compass.spark||'Not named yet')}</p><p><b>Moving toward:</b> ${esc(p.compass.destination||'Not named yet')}</p></div>
            <div class="card tint-mint"><p class="eyebrow">Current job</p><h3>${esc(unit.name)}</h3><p>${esc(unit.purpose||'Give this part one job.')}</p><p><b>Must-keep:</b> ${esc(p.compass.mustKeep||'Nothing marked yet')}</p></div>
          </div>
          <div class="card section-space"><h3>What the studio notices</h3>${issues.length?'<ul>'+issues.map(x=>'<li>'+esc(x)+'</li>').join('')+'</ul>':'<p>This part has a named truth, a clear job, and language that connects. Keep going before judging it too hard.</p>'}</div>
          <div class="card section-space tint-gold"><h3>Choose one next question</h3><ol>${promptList.map(x=>'<li>'+esc(x)+'</li>').join('')}</ol></div>`;
        document.getElementById('direction-dialog').showModal();
      }

      function coachThreadKey() {
        if(ui.coachSource==='song'&&activeSong())return 'song:'+activeSong().id;
        if(ui.coachSource==='story'&&activeStory())return 'story:'+activeStory().id;
        return ui.coachSource==='journal'?'journal':'general';
      }
      function openCoach(source='general') {
        ui.coachSource=source;
        if(source==='journal')document.querySelector('input[name="coach-scope"][value="journal"]').checked=true;
        else document.querySelector('input[name="coach-scope"][value="current"]').checked=true;
        renderCoachThread();document.getElementById('coach-dialog').showModal();
      }
      function renderCoachThread() {
        const key=coachThreadKey(),thread=state.coachThreads[key]||[],chat=document.getElementById('coach-chat');
        if(!thread.length){chat.innerHTML='<div class="empty"><span class="emoji">🫧</span>Ask for questions, structure, imagery, or a direction check. The coach never edits your project automatically.</div>';return;}
        chat.innerHTML=thread.map((m,i)=>'<div class="bubble '+esc(m.role)+'">'+nl(m.text)+'</div>'+(m.role==='assistant'?'<div class="coach-reply-actions"><button class="btn small" data-copy-coach="'+i+'">Copy</button><button class="btn small" data-save-coach="'+i+'">Save as note</button>'+(ui.coachSource==='song'?'<button class="btn small" data-alt-coach="'+i+'">Save as alternate</button>':'')+'</div>':'')).join('');
        chat.scrollTop=chat.scrollHeight;
      }
      function coachContext() {
        const scope=document.querySelector('input[name="coach-scope"]:checked')?.value||'current';
        const custom=document.getElementById('coach-custom').value.trim();
        if(scope==='custom')return custom||'[No custom context supplied]';
        if(scope==='journal')return 'JOURNAL / MINING TEXT\\n'+(document.getElementById('mine-text').value||'[blank]')+'\\nIMPORTANT PHRASE\\n'+(document.getElementById('mine-manual').value||'[blank]');
        if(ui.coachSource==='song'&&activeSong()){
          const p=activeSong(),s=p.sections.find(x=>x.id===p.activeSectionId)||p.sections[0];
          if(scope==='compass')return 'SONG: '+p.title+'\\nCREATIVE COMPASS\\n'+JSON.stringify(p.compass,null,2);
          if(scope==='project')return 'SONG PROJECT\\n'+JSON.stringify({...p,versions:[],coachNotes:[]},null,2);
          return 'SONG: '+p.title+'\\nSECTION: '+s.name+'\\nSECTION JOB: '+s.purpose+'\\nLYRICS:\\n'+s.lyrics+'\\nCENTRAL TRUTH: '+(p.compass.truth||'[blank]');
        }
        if(ui.coachSource==='story'&&activeStory()){
          const p=activeStory(),s=p.scenes.find(x=>x.id===p.activeSceneId)||p.scenes[0];
          if(scope==='compass')return 'STORY: '+p.title+'\\nSTORY COMPASS\\n'+JSON.stringify(p.compass,null,2);
          if(scope==='project')return 'STORY PROJECT\\n'+JSON.stringify({...p,versions:[],coachNotes:[]},null,2);
          return 'STORY: '+p.title+'\\nSCENE: '+s.name+'\\nSCENE JOB: '+s.purpose+'\\nDRAFT:\\n'+s.draft+'\\nCENTRAL TRUTH: '+(p.compass.truth||'[blank]');
        }
        return custom||'General creative planning. No project text included.';
      }
      function fullCoachPrompt() {
        const question=document.getElementById('coach-question').value.trim()||'Ask me three useful questions that help me find my own next move.';
        return 'Act as a warm, honest songwriting and storytelling coach. Preserve my voice. Do not rewrite the whole piece unless I ask. Tell me what is working, what may be drifting, and one next move.\\n\\nSELECTED CONTEXT:\\n'+coachContext()+'\\n\\nMY REQUEST:\\n'+question;
      }
      async function askCoach() {
        const question=document.getElementById('coach-question').value.trim();if(!question){toast('Tell the coach what you want help with.');return;}
        const key=coachThreadKey(),thread=state.coachThreads[key]||[];thread.push({role:'user',text:question,createdAt:now()});state.coachThreads[key]=thread;saveState();renderCoachThread();
        const button=document.getElementById('coach-ask');button.disabled=true;button.textContent='Thinking…';
        try{
          const url=new URL(location.href);url.search='studio_coach=1';
          const response=await fetch(url.toString(),{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({question,context:coachContext().slice(0,23000),thread:thread.slice(0,-1).slice(-8)})});
          const data=await response.json();if(!response.ok)throw new Error(data.error||'Coach request failed.');
          thread.push({role:'assistant',text:data.answer,createdAt:now()});ui.coachLastReply=data.answer;saveState();renderCoachThread();document.getElementById('coach-question').value='';
        }catch(error){thread.pop();saveState();renderCoachThread();toast(error.message||'The coach is unavailable. Copy the prompt instead.');}
        finally{button.disabled=false;button.textContent='Ask in this page';}
      }
      function saveCoachNote(index,asAlternate=false) {
        const thread=state.coachThreads[coachThreadKey()]||[],message=thread[index];if(!message)return;
        if(asAlternate&&activeSong()){const s=activeSong().sections.find(x=>x.id===activeSong().activeSectionId)||activeSong().sections[0];s.alternates=s.alternates||[];s.alternates.push(message.text);touch(activeSong());renderSongs();toast('Saved as an alternate—not applied');return;}
        const p=ui.coachSource==='song'?activeSong():ui.coachSource==='story'?activeStory():null;
        if(p){p.coachNotes=p.coachNotes||[];p.coachNotes.push({id:uid('note'),text:message.text,createdAt:now()});touch(p);ui.coachSource==='song'?renderSongs():renderStories();toast('Coach reply saved as a note');}
        else {copyText(message.text);}
      }

      function renderSettings() {
        const brand=document.querySelector('.brand strong');if(brand)brand.textContent=state.settings.studioName||'Velvet Ink Studio';
        document.title=(state.settings.studioName||'Velvet Ink Studio')+' | Tanay’s Music + Story Lab';
        document.getElementById('setting-name').value=state.settings.name||'';
        document.getElementById('setting-studio').value=state.settings.studioName||'';
        document.getElementById('setting-guided').checked=!!state.settings.guided;
        document.getElementById('setting-privacy').checked=!!state.settings.privacyOnStart;
      }
      function renderAll(){renderHome();renderJournal();renderSongs();renderStories();renderLibrary();renderProjects();renderSettings();}
      function openProject(id) {
        const p=getProject(id);if(!p)return;
        if(p.kind==='song'){state.activeSongId=id;setView('songs');}else{state.activeStoryId=id;setView('stories');}
      }

      document.addEventListener('click',event=>{
        const t=event.target.closest('button,a');if(!t)return;
        if(t.matches('[data-close-dialog]')){t.closest('dialog')?.close();return;}
        if(t.dataset.view){setView(t.dataset.view);return;}
        if(t.dataset.help){event.preventDefault();openHelp(t.dataset.help);return;}
        if(t.dataset.action==='quick-capture'){openQuickCapture();return;}
        if(t.dataset.action==='new-journal'){openJournal();return;}
        if(t.dataset.action==='new-song'){openNewSong();return;}
        if(t.dataset.action==='new-story'){openNewStory();return;}
        if(t.dataset.action==='new-inspiration'){openInspiration();return;}
        if(t.dataset.action==='new-session'){openSession();return;}
        if(t.dataset.openProject){openProject(t.dataset.openProject);return;}
        if(t.dataset.journalTab){ui.journalTab=t.dataset.journalTab;renderJournal();return;}
        if(t.dataset.libraryTab){ui.libraryTab=t.dataset.libraryTab;renderLibrary();return;}
        if(t.dataset.editJournal){openJournal(t.dataset.editJournal);return;}
        if(t.dataset.editSpark){openSpark(t.dataset.editSpark);return;}
        if(t.dataset.mineJournal){
          const j=state.journal.find(x=>x.id===t.dataset.mineJournal);if(j){ui.journalTab='mine';renderJournal();document.getElementById('mine-source').value=j.id;document.getElementById('mine-text').value=j.body;document.getElementById('mine-manual').value=j.favoriteLine||'';setView('journal');}
          return;
        }
        if(t.dataset.developSpark){t.dataset.kind==='song'?openNewSong(t.dataset.developSpark):openNewStory(t.dataset.developSpark);return;}
        if(t.id==='save-mined-spark'){
          const area=document.getElementById('mine-text'),selected=area.value.slice(area.selectionStart,area.selectionEnd).trim(),manual=document.getElementById('mine-manual').value.trim();
          const phrase=selected||manual;if(!phrase){toast('Select words in the journal box or type the phrase.');return;}
          openQuickCapture(phrase,document.getElementById('mine-why').value);return;
        }
        if(t.dataset.selectSong){state.activeSongId=t.dataset.selectSong;saveState();renderSongs();return;}
        if(t.dataset.selectStory){state.activeStoryId=t.dataset.selectStory;saveState();renderStories();return;}
        if(t.dataset.sectionMove){
          const p=activeSong(),i=p.sections.findIndex(x=>x.id===p.activeSectionId),next=Math.min(p.sections.length-1,Math.max(0,i+Number(t.dataset.sectionMove)));p.activeSectionId=p.sections[next].id;saveState();renderSongs();return;
        }
        if(t.hasAttribute('data-section-add')){
          const p=activeSong();const s=defaultSection('New section','Custom');const i=p.sections.findIndex(x=>x.id===p.activeSectionId);p.sections.splice(i+1,0,s);p.activeSectionId=s.id;touch(p);renderSongs();return;
        }
        if(t.dataset.reorderSection){
          const p=activeSong(),i=p.sections.findIndex(x=>x.id===p.activeSectionId),j=i+Number(t.dataset.reorderSection);if(j>=0&&j<p.sections.length){[p.sections[i],p.sections[j]]=[p.sections[j],p.sections[i]];touch(p);renderSongs();}return;
        }
        if(t.hasAttribute('data-section-delete')){
          const p=activeSong();if(p.sections.length===1){toast('A song needs at least one writing section.');return;}if(confirm('Delete this section? Make a snapshot first if you may want it back.')){const i=p.sections.findIndex(x=>x.id===p.activeSectionId);p.sections.splice(i,1);p.activeSectionId=p.sections[Math.max(0,i-1)].id;touch(p);renderSongs();}return;
        }
        if(t.hasAttribute('data-park-selection')){
          const p=activeSong(),area=document.getElementById('song-lyrics'),text=area.value.slice(area.selectionStart,area.selectionEnd).trim();if(!text){toast('Select one or more lyric lines first.');return;}p.parkingLot=p.parkingLot||[];p.parkingLot.push({id:uid('park'),text,note:'Moved from '+(p.sections.find(x=>x.id===p.activeSectionId)?.name||'section')});area.setRangeText('',area.selectionStart,area.selectionEnd,'end');const s=p.sections.find(x=>x.id===p.activeSectionId);s.lyrics=area.value;touch(p);renderSongs();toast('Line protected in the parking lot');return;
        }
        if(t.hasAttribute('data-add-parking')){const text=prompt('What line or idea should wait here?');if(text?.trim()){const p=activeSong();p.parkingLot.push({id:uid('park'),text:text.trim(),note:''});touch(p);renderSongs();}return;}
        if(t.dataset.returnLine){const p=activeSong(),item=p.parkingLot.find(x=>x.id===t.dataset.returnLine),s=p.sections.find(x=>x.id===p.activeSectionId);if(item&&s){s.lyrics+=(s.lyrics?'\\n':'')+item.text;p.parkingLot=p.parkingLot.filter(x=>x.id!==item.id);touch(p);renderSongs();}return;}
        if(t.dataset.deleteParking){const p=activeSong();p.parkingLot=p.parkingLot.filter(x=>x.id!==t.dataset.deleteParking);touch(p);renderSongs();return;}
        if(t.hasAttribute('data-add-alternate')){const text=prompt('Save an alternate line or direction:');if(text?.trim()){const p=activeSong(),s=p.sections.find(x=>x.id===p.activeSectionId);s.alternates=s.alternates||[];s.alternates.push(text.trim());touch(p);renderSongs();}return;}
        if(t.dataset.useAlternate!==undefined){const p=activeSong(),s=p.sections.find(x=>x.id===p.activeSectionId),i=Number(t.dataset.useAlternate),text=s.alternates[i];if(text!==undefined){s.lyrics+=(s.lyrics?'\n':'')+text;s.alternates.splice(i,1);touch(p);renderSongs();toast('Alternate moved into the lyrics');}return;}
        if(t.dataset.deleteAlternate!==undefined){const p=activeSong(),s=p.sections.find(x=>x.id===p.activeSectionId);s.alternates.splice(Number(t.dataset.deleteAlternate),1);touch(p);renderSongs();return;}
        if(t.dataset.revision){const p=activeSong();p.revision[t.dataset.revision]=!p.revision[t.dataset.revision];touch(p);renderSongs();return;}
        if(t.hasAttribute('data-song-snapshot')){createSnapshot('song');return;}
        if(t.hasAttribute('data-story-snapshot')){createSnapshot('story');return;}
        if(t.dataset.versions){showVersions(t.dataset.versions);return;}
        if(t.dataset.restoreVersion){restoreVersion(t.dataset.restoreVersion);return;}
        if(t.dataset.direction){directionReport(t.dataset.direction,false);return;}
        if(t.hasAttribute('data-check-song')){directionReport('song',true);return;}
        if(t.hasAttribute('data-check-story')){directionReport('story',true);return;}
        if(t.dataset.evolveCompass){evolveCompass(t.dataset.evolveCompass);return;}
        if(t.dataset.sceneMove){
          const p=activeStory(),i=p.scenes.findIndex(x=>x.id===p.activeSceneId),next=Math.min(p.scenes.length-1,Math.max(0,i+Number(t.dataset.sceneMove)));p.activeSceneId=p.scenes[next].id;saveState();renderStories();return;
        }
        if(t.hasAttribute('data-scene-add')){const p=activeStory(),s=storyScene('New scene'),i=p.scenes.findIndex(x=>x.id===p.activeSceneId);p.scenes.splice(i+1,0,s);p.activeSceneId=s.id;touch(p);renderStories();return;}
        if(t.dataset.reorderScene){const p=activeStory(),i=p.scenes.findIndex(x=>x.id===p.activeSceneId),j=i+Number(t.dataset.reorderScene);if(j>=0&&j<p.scenes.length){[p.scenes[i],p.scenes[j]]=[p.scenes[j],p.scenes[i]];touch(p);renderStories();}return;}
        if(t.hasAttribute('data-scene-delete')){
          const p=activeStory();if(p.scenes.length===1){toast('A story needs at least one scene.');return;}if(confirm('Delete this scene? Make a snapshot first if needed.')){const i=p.scenes.findIndex(x=>x.id===p.activeSceneId);p.scenes.splice(i,1);p.activeSceneId=p.scenes[Math.max(0,i-1)].id;touch(p);renderStories();}return;
        }
        if(t.hasAttribute('data-park-scene')){const text=prompt('What scene or idea belongs somewhere else?');if(text?.trim()){const p=activeStory();p.parkingLot.push({id:uid('park'),text:text.trim(),note:'Parked from '+(p.scenes.find(x=>x.id===p.activeSceneId)?.name||'scene')});touch(p);renderStories();}return;}
        if(t.dataset.deleteStoryParking){const p=activeStory();p.parkingLot=p.parkingLot.filter(x=>x.id!==t.dataset.deleteStoryParking);touch(p);renderStories();return;}
        if(t.hasAttribute('data-add-character')){openCharacter();return;}
        if(t.dataset.editCharacter){openCharacter(t.dataset.editCharacter);return;}
        if(t.dataset.storyRevision){const p=activeStory();p.revision[t.dataset.storyRevision]=!p.revision[t.dataset.storyRevision];touch(p);renderStories();return;}
        if(t.dataset.useTemplate){
          const temp=TEMPLATES.find(x=>x.id===t.dataset.useTemplate);if(!temp)return;
          if(temp.type==='journal')openJournal('',temp.id);else if(temp.type==='song')openNewSong('',temp.id);else openNewStory('',temp.id);return;
        }
        if(t.dataset.editInspiration){openInspiration(t.dataset.editInspiration);return;}
        if(t.dataset.coach){openCoach(t.dataset.coach);return;}
        if(t.classList.contains('coach-preset')){document.getElementById('coach-question').value=t.dataset.prompt;return;}
        if(t.id==='coach-ask'){askCoach();return;}
        if(t.id==='coach-copy-prompt'){copyText(fullCoachPrompt());return;}
        if(t.id==='coach-open-chatgpt'){copyText(fullCoachPrompt());window.open('https://chatgpt.com/','_blank','noopener,noreferrer');toast('Prompt copied. Paste it into the new ChatGPT tab.');return;}
        if(t.dataset.copyCoach){copyText((state.coachThreads[coachThreadKey()]||[])[Number(t.dataset.copyCoach)]?.text||'');return;}
        if(t.dataset.saveCoach){saveCoachNote(Number(t.dataset.saveCoach),false);return;}
        if(t.dataset.altCoach){saveCoachNote(Number(t.dataset.altCoach),true);return;}
        if(t.id==='copy-direction'){copyText(ui.directionText);return;}
        if(t.dataset.editSession){openSession(t.dataset.editSession);return;}
        if(t.dataset.addSessionDate){openSession('',t.dataset.addSessionDate);return;}
        if(t.dataset.googleSession){const s=state.sessions.find(x=>x.id===t.dataset.googleSession);if(s)window.open(googleCalendarUrl(s),'_blank','noopener,noreferrer');return;}
        if(t.dataset.deleteSession){if(confirm('Delete this studio session?')){state.sessions=state.sessions.filter(x=>x.id!==t.dataset.deleteSession);saveState();document.getElementById('generic-dialog').close();renderHome();}return;}
        if(t.dataset.deleteJournal){if(confirm('Delete this journal entry? Export a backup first if needed.')){state.journal=state.journal.filter(x=>x.id!==t.dataset.deleteJournal);saveState();closeDialogs();renderJournal();renderHome();}return;}
        if(t.dataset.deleteSpark){if(confirm('Delete this spark?')){state.sparks=state.sparks.filter(x=>x.id!==t.dataset.deleteSpark);saveState();closeDialogs();renderJournal();renderHome();}return;}
        if(t.dataset.deleteCharacter){const p=activeStory();if(confirm('Delete this character card?')){p.characters=p.characters.filter(x=>x.id!==t.dataset.deleteCharacter);touch(p);closeDialogs();renderStories();}return;}
        if(t.dataset.deleteInspiration){if(confirm('Delete this inspiration reference?')){state.inspiration=state.inspiration.filter(x=>x.id!==t.dataset.deleteInspiration);saveState();closeDialogs();renderLibrary();}return;}
        if(t.dataset.archiveProject){const p=getProject(t.dataset.archiveProject);if(p){p.status='Archived';touch(p);renderAll();setView('projects');toast('Project moved to the archive');}return;}
        if(t.dataset.deleteProject){const p=getProject(t.dataset.deleteProject);if(p&&confirm('Delete “'+p.title+'” from this browser? Export a backup first if you may want it later.')){if(p.kind==='song')state.songs=state.songs.filter(x=>x.id!==p.id);else state.stories=state.stories.filter(x=>x.id!==p.id);saveState();renderAll();toast('Project removed from this browser');}return;}
        if(t.id==='week-prev'){ui.weekStart=new Date(ui.weekStart);ui.weekStart.setDate(ui.weekStart.getDate()-7);renderCalendar();return;}
        if(t.id==='week-next'){ui.weekStart=new Date(ui.weekStart);ui.weekStart.setDate(ui.weekStart.getDate()+7);renderCalendar();return;}
        if(t.id==='week-today'){ui.weekStart=startOfWeek(new Date());ui.sessionScope='week';renderCalendar();return;}
        if(t.id==='session-scope'){ui.sessionScope=ui.sessionScope==='week'?'all':'week';renderCalendar();return;}
        if(t.id==='mobile-menu'){document.getElementById('sidebar').classList.toggle('open');return;}
        if(t.id==='guided-toggle'){state.settings.guided=!state.settings.guided;document.body.classList.toggle('guided-on',state.settings.guided);t.textContent='💡 Guided: '+(state.settings.guided?'On':'Off');saveState();return;}
        if(t.id==='privacy-toggle'){document.body.classList.toggle('privacy');toast(document.body.classList.contains('privacy')?'Private writing blurred':'Privacy blur off');return;}
        if(t.id==='save-settings'){
          state.settings.name=document.getElementById('setting-name').value;state.settings.studioName=document.getElementById('setting-studio').value;state.settings.guided=document.getElementById('setting-guided').checked;state.settings.privacyOnStart=document.getElementById('setting-privacy').checked;document.body.classList.toggle('guided-on',state.settings.guided);document.getElementById('guided-toggle').textContent='💡 Guided: '+(state.settings.guided?'On':'Off');renderSettings();saveState('Preferences saved');toast('Studio preferences saved');return;
        }
        if(t.id==='export-data'){
          const blob=new Blob([JSON.stringify(state,null,2)],{type:'application/json'}),a=document.createElement('a');a.href=URL.createObjectURL(blob);a.download='velvet-ink-studio-backup-'+isoDate(new Date())+'.json';a.click();setTimeout(()=>URL.revokeObjectURL(a.href),1000);toast('Backup downloaded');return;
        }
        if(t.id==='import-data'){document.getElementById('import-file').click();return;}
        if(t.id==='reset-data'){const answer=prompt('Type DELETE to erase this studio’s local browser data.');if(answer==='DELETE'){localStorage.removeItem(STORAGE_KEY);state=defaults();renderAll();setView('home');toast('Local studio reset');}return;}
      });

      document.addEventListener('input',event=>{
        const el=event.target;
        let p,unit;
        if(el.dataset.songField!==undefined&&(p=activeSong())){p[el.dataset.songField]=el.value;touch(p);}
        if(el.dataset.storyField!==undefined&&(p=activeStory())){p[el.dataset.storyField]=el.value;touch(p);}
        if(el.dataset.compassField!==undefined){
          p=ui.view==='stories'?activeStory():activeSong();if(p){p.compass[el.dataset.compassField]=el.value;touch(p);}
        }
        if(el.dataset.sectionField!==undefined&&(p=activeSong())){unit=p.sections.find(x=>x.id===p.activeSectionId);if(unit){unit[el.dataset.sectionField]=el.value;if(el.dataset.sectionField==='type'&&!unit.purpose)unit.purpose=SECTION_JOBS[el.value]||SECTION_JOBS.Custom;touch(p);if(el.dataset.sectionField==='lyrics'){const counter=document.getElementById('lyric-count');if(counter)counter.textContent=wordCount(el.value)+' words · '+el.value.split(/\\n/).filter(Boolean).length+' lines';}}}
        if(el.dataset.sceneField!==undefined&&(p=activeStory())){unit=p.scenes.find(x=>x.id===p.activeSceneId);if(unit){unit[el.dataset.sceneField]=el.value;touch(p);}}
        if(el.dataset.breadcrumbField!==undefined){p=ui.view==='stories'?activeStory():activeSong();if(p){p.breadcrumb=p.breadcrumb||blankBreadcrumb();p.breadcrumb[el.dataset.breadcrumbField]=el.value;p.breadcrumb.updatedAt=now();touch(p);}}
        if(el.dataset.bridgeField!==undefined&&(p=activeStory())){p.bridge=p.bridge||{};p.bridge[el.dataset.bridgeField]=el.value;touch(p);}
      });
      document.addEventListener('change',event=>{
        const el=event.target;
        if(el.id==='journal-sort'||el.id==='journal-search'||el.id==='spark-search'||el.id==='spark-use-filter'||el.id==='spark-priority-filter')renderJournal();
        if(el.id==='template-filter'||el.id==='inspiration-search'||el.id==='inspiration-type-filter')renderLibrary();
        if(el.id==='project-search'||el.id==='project-type-filter'||el.id==='project-status-filter')renderProjects();
        if(el.id==='mine-source'){const j=state.journal.find(x=>x.id===el.value);document.getElementById('mine-text').value=j?.body||'';document.getElementById('mine-manual').value=j?.favoriteLine||'';}
        if(el.id==='song-section-select'){const p=activeSong();p.activeSectionId=el.value;saveState();renderSongs();}
        if(el.id==='story-scene-select'){const p=activeStory();p.activeSceneId=el.value;saveState();renderStories();}
        if(el.dataset.boardStatus){const p=getProject(el.dataset.boardStatus);if(p){const old=p.status;p.status=el.value;touch(p);renderProjects();if(!['Finished','Shared'].includes(old)&&['Finished','Shared'].includes(p.status)){confetti();toast('You finished something real ✦');}}}
        if(el.dataset.songField==='status'||el.dataset.storyField==='status'){
          const p=el.dataset.songField!==undefined?activeSong():activeStory();p.status=el.value;touch(p);if(['Finished','Shared'].includes(p.status)){confetti();toast('You finished something real ✦');}
        }
        if(el.dataset.sectionField==='type'){const p=activeSong(),s=p.sections.find(x=>x.id===p.activeSectionId);s.purpose=SECTION_JOBS[el.value]||SECTION_JOBS.Custom;touch(p);renderSongs();}
      });
      document.addEventListener('input',event=>{
        if(event.target.id==='journal-search'||event.target.id==='spark-search')renderJournal();
        if(event.target.id==='inspiration-search')renderLibrary();
        if(event.target.id==='project-search')renderProjects();
        if(event.target.id==='song-rail-search'){const q=event.target.value.toLowerCase();document.querySelectorAll('#song-rail-list .rail-project').forEach(b=>b.hidden=!b.textContent.toLowerCase().includes(q));}
        if(event.target.id==='story-rail-search'){const q=event.target.value.toLowerCase();document.querySelectorAll('#story-rail-list .rail-project').forEach(b=>b.hidden=!b.textContent.toLowerCase().includes(q));}
      });
      document.getElementById('generic-form').addEventListener('submit',event=>{
        event.preventDefault();if(typeof ui.genericSubmit==='function'){const result=ui.genericSubmit(event.currentTarget);if(result!==false)document.getElementById('generic-dialog').close();}
      });
      document.getElementById('import-file').addEventListener('change',event=>{
        const file=event.target.files[0];if(!file)return;const reader=new FileReader();
        reader.onload=()=>{try{const data=JSON.parse(reader.result);if(!data||!Array.isArray(data.songs)||!Array.isArray(data.stories))throw new Error('Not a Velvet Ink backup');if(confirm('Import this backup and replace the studio data currently in this browser?')){state={...defaults(),...data,settings:{...defaults().settings,...(data.settings||{})}};saveState('Backup restored');renderAll();setView('home');toast('Studio backup restored');}}catch(e){toast('That file does not look like a valid studio backup.');}event.target.value='';};
        reader.readAsText(file);
      });
      document.addEventListener('keydown',event=>{
        if((event.ctrlKey||event.metaKey)&&event.key.toLowerCase()==='s'){event.preventDefault();if(ui.view==='songs'&&activeSong())createSnapshot('song','Keyboard snapshot');else if(ui.view==='stories'&&activeStory())createSnapshot('story','Keyboard snapshot');else{saveState();toast('Studio saved');}}
        if(event.key==='Escape')document.getElementById('sidebar').classList.remove('open');
      });

      state.settings.guided=state.settings.guided!==false;
      document.body.classList.toggle('guided-on',state.settings.guided);
      document.body.classList.toggle('privacy',!!state.settings.privacyOnStart);
      document.getElementById('guided-toggle').textContent='💡 Guided: '+(state.settings.guided?'On':'Off');
      renderAll();
    })();
  </script>
</body>
</html>
