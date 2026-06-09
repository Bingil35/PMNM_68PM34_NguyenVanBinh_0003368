<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    table {
    border-collapse: collapse;
    width: 100%;
    }

    th, td {
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
    background-color: #04AA6D;
    color: white;
    }
    </style>
</head>
<body>
    <h1>Danh sách sinh viên</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>MSSV</th>
            <th>Giới tính</th>
        </tr>
        <?php foreach ($sinhviens as $index => $sinhvien): ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $sinhvien['hoten']; ?></td>
                <td><?php echo $sinhvien['mssv']; ?></td>
                <td><?php echo $sinhvien['gioitinh']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <nav aria-label="Page navigation" class="mt-4">
    <ul class="pagination justify-content-center">

        <?php
            $pageSize = 5;

            for ($i = 1; $i <= $totalpage; $i++) {
                $offset = ($i - 1) * $pageSize;
        ?>
                <li class="page-item">
                    <a class="page-link"
                       href="/sinhvien/index/<?php echo $pageSize; ?>/<?php echo $offset; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
        <?php
            }
        ?>

    </ul>
</nav>
</body>
</html>