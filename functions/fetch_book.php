<?php
require_once __DIR__ . '/dbcon.php'; // defines $con
header('Content-Type: application/json');

// Throw exceptions on MySQLi errors
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$raw = trim($_GET['raw'] ?? '');
if ($raw === '') {
    echo json_encode(['success' => false, 'error' => 'Empty scan']);
    exit;
}

// Parse BookID and ISBN from QR like: BookID:59;ISBN9780131103627;Title:...
$bookId = null;
if (preg_match('/BookID[:]?(\d+)/i', $raw, $m)) {
    $bookId = (int)$m[1];
}
$isbn = null;
if (preg_match('/ISBN[:\s-]*([0-9Xx\-\s]{10,17})/i', $raw, $m)) {
    $isbn = preg_replace('/[-\s]/', '', $m[1]);
} else {
    if (preg_match('/97[89]\d{10}/', $raw, $m)) $isbn = $m[0];
    elseif (preg_match('/\b\d{9}[\dXx]\b/', $raw, $m)) $isbn = $m[0];
}

if (!$bookId && !$isbn) {
    echo json_encode(['success' => false, 'error' => 'No BookID/ISBN found']);
    exit;
}

try {
    // Try exact book_id first
    if ($bookId) {
        $stmt = mysqli_prepare($con, "SELECT book_id, ISBN, Title, Author, book_cover FROM books WHERE book_id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $bookId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $cover = $row['book_cover'] ?: 'default_cover.png'; // Default if null/empty
            echo json_encode([
                'success' => true,
                'book' => [
                    'id'       => $row['book_id'],
                    'isbn'     => $row['ISBN'],
                    'title'    => $row['Title'],
                    'author'   => $row['Author'],
                    'cover'    => $cover,
                ]
            ]);
            exit;
        }
    }

    // Fallback to ISBN
    if ($isbn) {
        $stmt = mysqli_prepare($con, "SELECT book_id, ISBN, Title, Author, book_cover FROM books WHERE ISBN = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "s", $isbn);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $cover = $row['book_cover'] ?: 'default_cover.png'; // Default if null/empty
            echo json_encode([
                'success' => true,
                'book' => [
                    'id'       => $row['book_id'],
                    'isbn'     => $row['ISBN'],
                    'title'    => $row['Title'],
                    'author'   => $row['Author'],
                    'cover'    => $cover,
                ]
            ]);
            exit;
        }
    }

    echo json_encode(['success' => false, 'error' => 'Book not found']);
} catch (Throwable $e) {
    error_log('fetch_book.php error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Server error']);
}
