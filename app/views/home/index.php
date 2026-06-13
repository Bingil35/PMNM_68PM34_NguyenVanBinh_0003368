<?php
    $username = $_SESSION['username'] ?? 'người dùng';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Student Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --app-bg: #f6f7fb;
            --app-ink: #18212f;
            --app-muted: #6d7787;
            --app-line: #e7eaf0;
            --app-accent: #2563eb;
            --app-accent-dark: #1d4ed8;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background: var(--app-bg);
            color: var(--app-ink);
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .app-shell {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .backdrop-blur {
            backdrop-filter: blur(16px);
        }

        .home-main {
            width: min(980px, calc(100% - 32px));
            margin: 0 auto;
            padding: 56px 0;
            flex: 1;
        }

        .home-panel {
            border: 1px solid var(--app-line);
            border-radius: 18px;
            background: #fff;
            padding: 36px;
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.07);
        }

        .btn {
            border-radius: 999px;
            font-weight: 700;
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

        @media (max-width: 576px) {
            .home-main {
                width: min(100% - 24px, 980px);
                padding: 32px 0;
            }

            .home-panel {
                padding: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="app-shell">
        <?php require_once '../app/views/partial/header.php'; ?>

        <main class="home-main">
            <section class="home-panel">
                <p class="text-uppercase text-primary fw-bold small mb-2" style="letter-spacing: .08em;">Trang chủ hệ thống</p>
                <h1 class="display-6 fw-bold mb-3">Chào mừng, <?php echo htmlspecialchars($username); ?></h1>
                <p class="text-muted mb-4">
                    Bạn đã đăng nhập thành công. Hãy chọn khu vực quản lý trong thanh điều hướng để tiếp tục làm việc.
                </p>
                <div class="d-flex flex-column flex-sm-row gap-2">
                    <a href="/sinhvien/index" class="btn btn-primary px-4 py-2">Quản lý sinh viên</a>
                    <a href="/lop/index" class="btn btn-light border px-4 py-2">Quản lý lớp học</a>
                </div>
            </section>
        </main>

        <?php require_once '../app/views/partial/footer.php'; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
