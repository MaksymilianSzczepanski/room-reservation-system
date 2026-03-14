<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? 'Room Reservation System' }}</title>

        <style>
            :root {
                --bg: #f3efe7;
                --panel: rgba(255, 252, 246, 0.88);
                --panel-strong: #fffdf8;
                --text: #1f2933;
                --muted: #667085;
                --line: rgba(31, 41, 51, 0.12);
                --accent: #c26139;
                --accent-dark: #7d3324;
                --ok: #2b6f54;
                --shadow: 0 24px 60px rgba(72, 47, 31, 0.16);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                font-family: Georgia, "Times New Roman", serif;
                color: var(--text);
                background:
                    radial-gradient(circle at top left, rgba(194, 97, 57, 0.18), transparent 30%),
                    radial-gradient(circle at bottom right, rgba(43, 111, 84, 0.16), transparent 28%),
                    linear-gradient(135deg, #efe6d9 0%, #f8f4ec 45%, #efe8dd 100%);
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            .shell {
                width: min(1120px, calc(100% - 32px));
                margin: 0 auto;
                padding: 32px 0 48px;
            }

            .topbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 16px;
                margin-bottom: 24px;
            }

            .brand {
                display: flex;
                flex-direction: column;
                gap: 4px;
            }

            .eyebrow {
                font-size: 0.75rem;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                color: var(--accent-dark);
            }

            .brand h1 {
                margin: 0;
                font-size: clamp(1.8rem, 3vw, 2.8rem);
                font-weight: 700;
            }

            .brand p {
                margin: 0;
                color: var(--muted);
                max-width: 50ch;
            }

            .card {
                background: var(--panel);
                border: 1px solid var(--line);
                border-radius: 24px;
                box-shadow: var(--shadow);
                backdrop-filter: blur(12px);
            }

            .button,
            button {
                border: 0;
                border-radius: 999px;
                padding: 12px 18px;
                font: inherit;
                font-size: 0.95rem;
                cursor: pointer;
                transition: transform 120ms ease, opacity 120ms ease, background 120ms ease;
            }

            .button:hover,
            button:hover {
                transform: translateY(-1px);
            }

            .button-primary {
                color: #fffaf4;
                background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            }

            .button-secondary {
                color: var(--text);
                background: rgba(255, 255, 255, 0.68);
                border: 1px solid var(--line);
            }

            .status {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 8px 12px;
                border-radius: 999px;
                font-size: 0.9rem;
                background: rgba(43, 111, 84, 0.12);
                color: var(--ok);
            }

            .status::before {
                content: "";
                width: 8px;
                height: 8px;
                border-radius: 999px;
                background: currentColor;
            }

            .flash,
            .errors {
                margin-bottom: 20px;
                padding: 16px 18px;
                border-radius: 18px;
                border: 1px solid var(--line);
            }

            .flash {
                background: rgba(43, 111, 84, 0.08);
                color: var(--ok);
            }

            .flash-error {
                background: rgba(125, 51, 36, 0.08);
                color: var(--accent-dark);
            }

            .errors {
                background: rgba(125, 51, 36, 0.08);
                color: var(--accent-dark);
            }

            .errors ul {
                margin: 0;
                padding-left: 18px;
            }

            @media (max-width: 720px) {
                .shell {
                    width: min(100% - 20px, 1120px);
                    padding-top: 20px;
                }

                .topbar {
                    align-items: flex-start;
                    flex-direction: column;
                }
            }
        </style>
    </head>
    <body>
        <div class="shell">
            @yield('content')
        </div>
    </body>
</html>
