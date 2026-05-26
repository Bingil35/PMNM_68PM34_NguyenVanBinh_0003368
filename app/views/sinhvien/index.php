<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
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
</body>
</html>