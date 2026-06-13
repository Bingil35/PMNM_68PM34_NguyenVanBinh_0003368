<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? htmlspecialchars($title) : 'Quan ly sinh vien'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --app-bg: #f6f7fb;
            --app-surface: #ffffff;
            --app-ink: #18212f;
            --app-muted: #6d7787;
            --app-line: #e7eaf0;
            --app-accent: #2563eb;
            --app-accent-dark: #1d4ed8;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.10), transparent 32rem),
                var(--app-bg);
            color: var(--app-ink);
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .app-shell {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .app-main {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
            padding: 32px 0 44px;
            flex: 1;
        }

        .app-card {
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(231, 234, 240, 0.92);
            border-radius: 22px;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
        }

        .backdrop-blur {
            backdrop-filter: blur(18px);
        }

        .btn {
            border-radius: 999px;
            font-weight: 600;
        }

        .btn-primary {
            background: var(--app-accent);
            border-color: var(--app-accent);
        }

        .btn-primary:hover {
            background: var(--app-accent-dark);
            border-color: var(--app-accent-dark);
        }

        .text-muted {
            color: var(--app-muted) !important;
        }
    </style>
</head>
<body>
    <div class="app-shell">
        <?php require_once '../app/views/partial/header.php'; ?>

        <main class="app-main">
            <?php require_once '../app/views/' . $viewname . '.php'; ?>
        </main>

        <?php require_once '../app/views/partial/footer.php'; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
