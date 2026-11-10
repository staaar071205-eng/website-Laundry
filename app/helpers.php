<?php

// Mencetak teks dengan aman di view (mencegah XSS)
function e(?string $teks): string
{
    return htmlspecialchars($teks ?? '', ENT_QUOTES, 'UTF-8');
}

function rupiah(int|string $angka): string
{
    return 'Rp ' . number_format((int) $angka, 0, ',', '.');
}

// Token CSRF untuk setiap formulir POST
function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="_token" value="' . e(csrf_token()) . '">';
}

function csrf_valid(): bool
{
    return isset($_POST['_token'], $_SESSION['csrf'])
        && hash_equals($_SESSION['csrf'], $_POST['_token']);
}
