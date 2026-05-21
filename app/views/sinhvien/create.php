<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Student</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-container { max-width: 600px; margin: auto; }
        label { display: block; margin-bottom: 6px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 8px; margin-bottom: 14px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 18px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Create New Student</h1>
        <form method="post" action="/sinhvien/store">
            <label for="masv">Student ID (Mã sinh viên)</label>
            <input type="text" id="masv" name="masv" required>

            <label for="hoten">Full Name</label>
            <input type="text" id="hoten" name="hoten" required>

            <label for="gioitinh">Gender</label>
            <select id="gioitinh" name="gioitinh" required>
                <option value="">Select gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label for="ngaysinh">Date of Birth</label>
            <input type="date" id="ngaysinh" name="ngaysinh" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email">

            <label for="sdt">Phone</label>
            <input type="tel" id="sdt" name="sdt">

            <label for="diachi">Address</label>
            <textarea id="diachi" name="diachi" rows="3"></textarea>

            <label for="lop">Class</label>
            <input type="text" id="lop" name="lop">

            <button type="submit">Create Student</button>
        </form>
    </div>
</body>
</html>