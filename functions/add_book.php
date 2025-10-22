<?php
session_start();
require_once __DIR__ . '/dbcon.php';
require_once __DIR__ . '/../phpqrcode/qrlib.php';

$isbn = trim($_POST['ISBN'] ?? '');
$title = trim($_POST['Title'] ?? '');
$author = trim($_POST['Author'] ?? '');
$date_published = $_POST['Date_published'] ?? '';
$quantity = max(1, intval($_POST['Quantity'] ?? 1));

$coverFileName = null;

if (isset($_FILES['book_cover']) && $_FILES['book_cover']['error'] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES['book_cover']['tmp_name'];
    $ext = pathinfo($_FILES['book_cover']['name'], PATHINFO_EXTENSION);
    $coverFileName = uniqid('cover_', true) . '.' . $ext;
    move_uploaded_file($tmpName, __DIR__ . '/../assets/book_cover/' . $coverFileName);
} elseif (!empty($_POST['cover_url'])) {
    $coverUrl = $_POST['cover_url'];
    $imgData = @file_get_contents($coverUrl);
    if ($imgData !== false) {
        $ext = pathinfo(parse_url($coverUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
        if (!$ext) $ext = 'jpg';
        $coverFileName = uniqid('cover_', true) . '.' . $ext;
        file_put_contents(__DIR__ . '/../assets/book_cover/' . $coverFileName, $imgData);
    }
}

if ($isbn && $title && $author && $date_published && $quantity > 0) {
    $successCount = 0;
    for ($i = 0; $i < $quantity; $i++) {
        $sql = "INSERT INTO books (ISBN, Title, Author, Date_published, book_cover) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $isbn, $title, $author, $date_published, $coverFileName);
        if (mysqli_stmt_execute($stmt)) {
            $book_id = mysqli_insert_id($con);

            
            $qr_content = "BookID:$book_id;ISBN:$isbn;Title:$title";
            $qr_folder = __DIR__ . '/../assets/qrcodes/';
            if (!is_dir($qr_folder)) {
                mkdir($qr_folder, 0777, true);
            }
            $qrFileName = "book_" . $book_id . ".png";
            $qrFilePath = $qr_folder . $qrFileName;
            QRcode::png($qr_content, $qrFilePath, QR_ECLEVEL_L, 4);

            $qr_db_path = $qrFileName;
            $update_sql = "UPDATE books SET qr_code = ? WHERE book_id = ?";
            $update_stmt = mysqli_prepare($con, $update_sql);
            mysqli_stmt_bind_param($update_stmt, "si", $qr_db_path, $book_id);
            mysqli_stmt_execute($update_stmt);
            mysqli_stmt_close($update_stmt);

            $successCount++;
        }
        mysqli_stmt_close($stmt);
    }
    $_SESSION['alert'] = "$successCount book(s) added successfully with QR codes!";
} else {
    $_SESSION['alert'] = "All fields are required.";
}

header("Location: ../admin/manage.php");
exit;