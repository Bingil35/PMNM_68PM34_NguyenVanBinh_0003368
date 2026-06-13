<?php
    $formData = $sinhvien ?? [];
    $selectedGender = $formData['gioitinh'] ?? '';
    $selectedClass = $formData['malop'] ?? '';
?>

<section class="d-flex flex-column gap-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
        <div>
            <p class="text-uppercase text-primary fw-bold small mb-2" style="letter-spacing: .08em;">Hồ sơ mới</p>
            <h1 class="display-6 fw-bold mb-2">Thêm sinh viên</h1>
            <p class="text-muted mb-0">Nhập thông tin cơ bản và chọn lớp học cho sinh viên.</p>
        </div>
        <a href="/sinhvien/index" class="btn btn-light border px-4 py-2">Quay lại</a>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger mb-0">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <div class="app-card p-4 p-lg-5">
        <form action="/sinhvien/store" method="post" class="row g-4">
            <div class="col-12">
                <label for="hoten" class="form-label fw-semibold">Họ tên</label>
                <input type="text" name="hoten" id="hoten" class="form-control form-control-lg rounded-4" placeholder="Nguyễn Văn A" value="<?php echo htmlspecialchars($formData['hoten'] ?? ''); ?>" required>
            </div>

            <div class="col-md-4">
                <label for="mssv" class="form-label fw-semibold">MSSV</label>
                <input type="text" name="mssv" id="mssv" class="form-control form-control-lg rounded-4" placeholder="SV001" value="<?php echo htmlspecialchars($formData['mssv'] ?? ''); ?>" required>
            </div>

            <div class="col-md-4">
                <label for="malop" class="form-label fw-semibold">Lớp học</label>
                <select name="malop" id="malop" class="form-select form-select-lg rounded-4" required>
                    <option value="">Chọn lớp học</option>
                    <?php foreach (($lops ?? []) as $lop): ?>
                        <option value="<?php echo htmlspecialchars($lop['malop']); ?>" <?php echo $selectedClass === $lop['malop'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($lop['malop'] . ' - ' . $lop['tenlop']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="gioitinh" class="form-label fw-semibold">Giới tính</label>
                <select name="gioitinh" id="gioitinh" class="form-select form-select-lg rounded-4" required>
                    <option value="">Chọn giới tính</option>
                    <option value="Nam" <?php echo $selectedGender === 'Nam' ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo $selectedGender === 'Nữ' ? 'selected' : ''; ?>>Nữ</option>
                    <option value="Khác" <?php echo $selectedGender === 'Khác' ? 'selected' : ''; ?>>Khác</option>
                </select>
            </div>

            <?php if (empty($lops)): ?>
                <div class="col-12">
                    <div class="alert alert-warning mb-0">
                        Chưa có lớp học. Hãy tạo lớp học trước khi thêm sinh viên.
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-12 d-flex flex-column flex-sm-row justify-content-end gap-2 pt-2">
                <a href="/sinhvien/index" class="btn btn-light border px-4">Hủy</a>
                <button type="submit" class="btn btn-primary px-4" <?php echo empty($lops) ? 'disabled' : ''; ?>>Lưu sinh viên</button>
            </div>
        </form>
    </div>
</section>
