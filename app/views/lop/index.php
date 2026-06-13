<?php
    $pageSize = isset($limit) ? (int) $limit : 5;
    $currentOffset = isset($offset) ? (int) $offset : 0;
    $currentPage = $pageSize > 0 ? (int) floor($currentOffset / $pageSize) + 1 : 1;
    $classCount = isset($lops) ? count($lops) : 0;
?>

<section class="d-flex flex-column gap-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3">
        <div>
            <p class="text-uppercase text-primary fw-bold small mb-2" style="letter-spacing: .08em;">Quản lý lớp học</p>
            <h1 class="display-6 fw-bold mb-2">Danh sách lớp học</h1>
            <p class="text-muted mb-0">Quản lý mã lớp, tên lớp và ghi chú của từng lớp trong hệ thống.</p>
        </div>
        <a href="/lop/create" class="btn btn-primary px-4 py-2">Thêm lớp học</a>
    </div>

    <?php if (!empty($message)): ?>
        <div class="alert alert-warning mb-0">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="app-card p-4 h-100">
                <p class="text-muted mb-1">Đang hiển thị</p>
                <div class="h2 fw-bold mb-0"><?php echo $classCount; ?></div>
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
                <h2 class="h5 fw-bold mb-1">Thông tin lớp học</h2>
                <p class="text-muted mb-0">Danh sách lớp học được sắp xếp theo bản ghi mới nhất.</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr class="text-uppercase small text-muted">
                        <th class="ps-4 py-3 fw-bold">STT</th>
                        <th class="py-3 fw-bold">Mã lớp</th>
                        <th class="py-3 fw-bold">Tên lớp</th>
                        <th class="py-3 fw-bold">Ghi chú</th>
                        <th class="pe-4 py-3 fw-bold text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($classCount > 0): ?>
                        <?php foreach ($lops as $index => $lop): ?>
                            <tr>
                                <td class="ps-4 fw-semibold text-muted"><?php echo $currentOffset + $index + 1; ?></td>
                                <td class="fw-semibold"><?php echo htmlspecialchars($lop['malop']); ?></td>
                                <td><?php echo htmlspecialchars($lop['tenlop']); ?></td>
                                <td class="text-muted"><?php echo htmlspecialchars($lop['ghichu']); ?></td>
                                <td class="pe-4">
                                    <div class="d-flex justify-content-end align-items-center gap-2 flex-nowrap">
                                        <a href="/lop/edit/<?php echo (int) $lop['ID']; ?>" class="btn btn-sm btn-light border px-3 text-nowrap">Sửa</a>
                                        <form class="m-0" action="/lop/delete/<?php echo (int) $lop['ID']; ?>" method="post" onsubmit="return confirm('Bạn có chắc muốn xóa lớp học này? Chỉ có thể xóa khi không còn sinh viên thuộc lớp.');">
                                            <button type="submit" class="btn btn-sm btn-outline-danger px-3 text-nowrap">Xóa</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center p-5">
                                <h3 class="h5 fw-bold mb-2">Chưa có lớp học</h3>
                                <p class="text-muted mb-3">Thêm lớp học đầu tiên để bắt đầu quản lý danh sách.</p>
                                <a href="/lop/create" class="btn btn-primary px-4">Thêm lớp học</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($totalpage) && (int) $totalpage > 1): ?>
            <nav aria-label="Phân trang danh sách lớp học" class="p-4 border-top">
                <ul class="pagination justify-content-center mb-0 gap-2">
                    <?php for ($i = 1; $i <= (int) $totalpage; $i++): ?>
                        <?php $pageOffset = ($i - 1) * $pageSize; ?>
                        <li class="page-item <?php echo $i === $currentPage ? 'active' : ''; ?>">
                            <a class="page-link rounded-pill border-0 px-3" href="/lop/index/<?php echo $pageSize; ?>/<?php echo $pageOffset; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</section>
