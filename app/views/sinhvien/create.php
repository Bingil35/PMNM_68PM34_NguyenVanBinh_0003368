<section class="d-flex flex-column gap-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
        <div>
            <p class="text-uppercase text-primary fw-bold small mb-2" style="letter-spacing: .08em;">Hồ sơ mới</p>
            <h1 class="display-6 fw-bold mb-2">Thêm sinh viên</h1>
            <p class="text-muted mb-0">Nhập thông tin cơ bản để tạo hồ sơ sinh viên trong hệ thống.</p>
        </div>
        <a href="/sinhvien/index" class="btn btn-light border px-4 py-2">Quay lại</a>
    </div>

    <div class="app-card p-4 p-lg-5">
        <form action="/sinhvien/store" method="post" class="row g-4">
            <div class="col-12">
                <label for="hoten" class="form-label fw-semibold">Họ tên</label>
                <input type="text" name="hoten" id="hoten" class="form-control form-control-lg rounded-4" placeholder="Nguyen Van A" required>
            </div>

            <div class="col-md-6">
                <label for="mssv" class="form-label fw-semibold">MSSV</label>
                <input type="text" name="mssv" id="mssv" class="form-control form-control-lg rounded-4" placeholder="SV001" required>
            </div>

            <div class="col-md-6">
                <label for="gioitinh" class="form-label fw-semibold">Giới tính</label>
                <select name="gioitinh" id="gioitinh" class="form-select form-select-lg rounded-4" required>
                    <option value="">Chọn giới tính</option>
                    <option value="Nam">Nam</option>
                    <option value="Nu">Nữ</option>
                    <option value="Khac">Khác</option>
                </select>
            </div>

            <div class="col-12 d-flex flex-column flex-sm-row justify-content-end gap-2 pt-2">
                <a href="/sinhvien/index" class="btn btn-light border px-4">Hủy</a>
                <button type="submit" class="btn btn-primary px-4">Lưu sinh viên</button>
            </div>
        </form>
    </div>
</section>
