<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Perpustakaan Buku Digital' ?></title>
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap-icons.min.css') ?>" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .navbar-brand { font-weight: 700; }
        .card { border: none; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .pagination { margin-bottom: 0; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('buku') ?>">
            <i class="bi bi-book-half"></i> Perpustakaan Buku Digital
        </a>
        <?php if (isset($logged_in_user) && $logged_in_user['id']): ?>
        <div class="d-flex align-items-center">
            <span class="text-light me-3">
                <i class="bi bi-person-circle"></i> <?= htmlspecialchars($logged_in_user['name']) ?>
            </span>
            <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-light btn-sm"
               onclick="return confirm('Yakin ingin logout?');">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
        <?php endif; ?>
    </div>
</nav>

<div class="container mb-5">

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> <?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle"></i> <?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
