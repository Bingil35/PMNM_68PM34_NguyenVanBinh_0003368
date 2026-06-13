<section class="d-flex flex-column gap-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
        <div>
            <p class="text-uppercase text-primary fw-bold small mb-2" style="letter-spacing: .08em;">Cập nhật lớp học</p>
            <h1 class="display-6 fw-bold mb-2">Cập nhật lớp học</h1>
            <p class="text-muted mb-0">Điều chỉnh mã lớp, tên lớp và ghi chú của lớp học.</p>
        </div>
        <a href="/lop/index" class="btn btn-light border px-4 py-2">Quay lại</a>
    </div>

    <div class="app-card p-4 p-lg-5">
        <form action="/lop/update/<?php echo (int) $lop['ID']; ?>" method="post" class="row g-4">
            <div class="col-md-6">
                <label for="malop" class="form-label fw-semibold">Mã lớp</label>
                <input type="text" name="malop" id="malop" class="form-control form-control-lg rounded-4" value="<?php echo htmlspecialchars($lop['malop']); ?>" required>
            </div>

            <div class="col-md-6">
                <label for="tenlop" class="form-label fw-semibold">Tên lớp</label>
                <input type="text" name="tenlop" id="tenlop" class="form-control form-control-lg rounded-4" value="<?php echo htmlspecialchars($lop['tenlop']); ?>" required>
            </div>

            <div class="col-12">
                <label for="ghichu" class="form-label fw-semibold">Ghi chú</label>
                <textarea name="ghichu" id="ghichu" class="form-control rounded-4" rows="4"><?php echo htmlspecialchars($lop['ghichu']); ?></textarea>
            </div>

            <div class="col-12 d-flex flex-column flex-sm-row justify-content-end gap-2 pt-2">
                <a href="/lop/index" class="btn btn-light border px-4">Hủy</a>
                <button type="submit" class="btn btn-primary px-4">Cập nhật lớp học</button>
            </div>
        </form>
    </div>
</section>
