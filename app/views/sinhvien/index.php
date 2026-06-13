<?php
    $pageSize = isset($limit) ? (int) $limit : 5;
    $currentOffset = isset($offset) ? (int) $offset : 0;
    $currentPage = $pageSize > 0 ? (int) floor($currentOffset / $pageSize) + 1 : 1;
    $studentCount = isset($sinhviens) ? count($sinhviens) : 0;
    $totalRecord = isset($totalrecord) ? (int) $totalrecord : $studentCount;
    $searchKeyword = $keyword ?? '';
    $keywordQuery = $searchKeyword !== '' ? '?keyword=' . urlencode($searchKeyword) : '';
?>

<section class="d-flex flex-column gap-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3">
        <div>
            <p class="text-uppercase text-primary fw-bold small mb-2" style="letter-spacing: .08em;">Quản lý sinh viên</p>
            <h1 class="display-6 fw-bold mb-2">Danh sách sinh viên</h1>
            <p class="text-muted mb-0">Tìm kiếm theo MSSV, họ tên, mã lớp hoặc tên lớp.</p>
        </div>
        <a href="/sinhvien/create" class="btn btn-primary px-4 py-2">Thêm sinh viên</a>
    </div>

    <form action="/sinhvien/index" method="get" class="app-card p-3">
        <div class="row g-2 align-items-center">
            <div class="col-lg">
                <label for="keyword" class="visually-hidden">Từ khóa tìm kiếm</label>
                <input
                    type="search"
                    name="keyword"
                    id="keyword"
                    class="form-control form-control-lg rounded-4"
                    placeholder="Nhập MSSV, họ tên, mã lớp hoặc tên lớp"
                    value="<?php echo htmlspecialchars($searchKeyword); ?>"
                >
            </div>
            <div class="col-lg-auto d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4 py-2">Tìm kiếm</button>
                <?php if ($searchKeyword !== ''): ?>
                    <a href="/sinhvien/index" class="btn btn-light border px-4 py-2">Xóa lọc</a>
                <?php endif; ?>
            </div>
        </div>
    </form>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="app-card p-4 h-100">
                <p class="text-muted mb-1"><?php echo $searchKeyword !== '' ? 'Kết quả tìm thấy' : 'Đang hiển thị'; ?></p>
                <div class="h2 fw-bold mb-0"><?php echo $searchKeyword !== '' ? $totalRecord : $studentCount; ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="app-card p-4 h-100">
                <p class="text-muted mb-1">Trang hiện tại</p>
                <div class="h2 fw-bold mb-0"><?php echo $currentPage; ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="app-card p-4 h-100">
                <p class="text-muted mb-1">Tổng số trang</p>
                <div class="h2 fw-bold mb-0"><?php echo isset($totalpage) ? (int) $totalpage : 0; ?></div>
            </div>
        </div>
    </div>

    <div class="app-card overflow-hidden">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 p-4 border-bottom">
            <div>
                <h2 class="h5 fw-bold mb-1">Hồ sơ sinh viên</h2>
                <p class="text-muted mb-0">
                    <?php if ($searchKeyword !== ''): ?>
                        Đang lọc theo từ khóa "<?php echo htmlspecialchars($searchKeyword); ?>".
                    <?php else: ?>
                        Danh sách được sắp xếp theo bản ghi mới nhất.
                    <?php endif; ?>
                </p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr class="text-uppercase small text-muted">
                        <th class="ps-4 py-3 fw-bold">STT</th>
                        <th class="py-3 fw-bold">Họ tên</th>
                        <th class="py-3 fw-bold">MSSV</th>
                        <th class="py-3 fw-bold">Lớp</th>
                        <th class="py-3 fw-bold">Giới tính</th>
                        <th class="pe-4 py-3 fw-bold text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($studentCount > 0): ?>
                        <?php foreach ($sinhviens as $index => $sinhvien): ?>
                            <tr>
                                <td class="ps-4 fw-semibold text-muted"><?php echo $currentOffset + $index + 1; ?></td>
                                <td class="fw-semibold"><?php echo htmlspecialchars($sinhvien['hoten']); ?></td>
                                <td><?php echo htmlspecialchars($sinhvien['mssv']); ?></td>
                                <td>
                                    <div class="fw-semibold"><?php echo htmlspecialchars($sinhvien['malop']); ?></div>
                                    <div class="small text-muted"><?php echo htmlspecialchars($sinhvien['tenlop'] ?? ''); ?></div>
                                </td>
                                <td class="text-muted"><?php echo htmlspecialchars($sinhvien['gioitinh']); ?></td>
                                <td class="pe-4">
                                    <div class="d-flex justify-content-end align-items-center gap-2 flex-nowrap">
                                        <a href="/sinhvien/edit/<?php echo (int) $sinhvien['ID']; ?>" class="btn btn-sm btn-light border px-3 text-nowrap">Sửa</a>
                                        <form class="m-0" action="/sinhvien/delete/<?php echo (int) $sinhvien['ID']; ?>" method="post" onsubmit="return confirm('Bạn có chắc muốn xóa sinh viên này?');">
                                            <button type="submit" class="btn btn-sm btn-outline-danger px-3 text-nowrap">Xóa</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center p-5">
                                <h3 class="h5 fw-bold mb-2">Không tìm thấy sinh viên</h3>
                                <p class="text-muted mb-3">
                                    <?php echo $searchKeyword !== '' ? 'Hãy thử tìm bằng từ khóa khác.' : 'Thêm sinh viên đầu tiên để bắt đầu quản lý danh sách.'; ?>
                                </p>
                                <?php if ($searchKeyword !== ''): ?>
                                    <a href="/sinhvien/index" class="btn btn-light border px-4">Xóa lọc</a>
                                <?php else: ?>
                                    <a href="/sinhvien/create" class="btn btn-primary px-4">Thêm sinh viên</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($totalpage) && (int) $totalpage > 1): ?>
            <nav aria-label="Phân trang danh sách sinh viên" class="p-4 border-top">
                <ul class="pagination justify-content-center mb-0 gap-2">
                    <?php for ($i = 1; $i <= (int) $totalpage; $i++): ?>
                        <?php $pageOffset = ($i - 1) * $pageSize; ?>
                        <li class="page-item <?php echo $i === $currentPage ? 'active' : ''; ?>">
                            <a class="page-link rounded-pill border-0 px-3" href="/sinhvien/index/<?php echo $pageSize; ?>/<?php echo $pageOffset; ?><?php echo $keywordQuery; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</section>
