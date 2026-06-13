<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dang nhap - Student Manager</title>
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
            background:
                radial-gradient(circle at 12% 12%, rgba(37, 99, 235, 0.12), transparent 28rem),
                linear-gradient(135deg, #f6f7fb 0%, #eef4ff 48%, #f8fafc 100%);
            color: var(--app-ink);
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .login-shell {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 32px 16px;
        }

        .login-panel {
            width: min(960px, 100%);
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            border: 1px solid rgba(231, 234, 240, 0.95);
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.94);
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.12);
        }

        .brand-side {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 540px;
            padding: 40px;
            background:
                linear-gradient(145deg, rgba(37, 99, 235, 0.94), rgba(14, 165, 233, 0.78)),
                url("https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1200&q=80") center/cover;
            background-blend-mode: multiply;
            color: #fff;
        }

        .brand-mark {
            width: 52px;
            height: 52px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.28);
            font-weight: 800;
        }

        .form-side {
            padding: 48px;
        }

        .form-control {
            min-height: 54px;
            border-color: var(--app-line);
            border-radius: 16px;
        }

        .form-control:focus {
            border-color: var(--app-accent);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.14);
        }

        .btn-primary {
            min-height: 52px;
            border-radius: 999px;
            background: var(--app-accent);
            border-color: var(--app-accent);
            font-weight: 700;
        }

        .btn-primary:hover {
            background: var(--app-accent-dark);
            border-color: var(--app-accent-dark);
        }

        .text-muted {
            color: var(--app-muted) !important;
        }

        @media (max-width: 800px) {
            .login-panel {
                grid-template-columns: 1fr;
            }

            .brand-side {
                min-height: 260px;
                padding: 28px;
            }

            .form-side {
                padding: 32px 24px;
            }
        }
    </style>
</head>
<body>
    <main class="login-shell">
        <section class="login-panel">
            <div class="brand-side">
                <div>
                    <div class="brand-mark mb-4">SM</div>
                    <h1 class="fw-bold mb-3">Student Manager</h1>
                    <p class="mb-0 opacity-75">Đăng nhập để quản lý danh sách, mã số và thông tin sinh viên trong hệ thống.</p>
                </div>
                <div class="small opacity-75">Quản lý sinh viên gọn gàng và dễ theo dõi.</div>
            </div>

            <div class="form-side d-flex flex-column justify-content-center">
                <p class="text-uppercase text-primary fw-bold small mb-2" style="letter-spacing: .08em;">Đăng nhập</p>
                <h2 class="fw-bold mb-2">Chào mừng trở lại</h2>
                <p class="text-muted mb-4">Nhập tài khoản của bạn để tiếp tục vào hệ thống.</p>

                <form action="/auth/login" method="POST" class="d-flex flex-column gap-3">
                    <div>
                        <label for="username" class="form-label fw-semibold">Tên đăng nhập</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Nhập tên đăng nhập" autocomplete="username" required>
                    </div>

                    <div>
                        <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu" autocomplete="current-password" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-2">Đăng nhập</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
