<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url('dashboard'); ?>">PKBM ISTA</a>
        </div>
        <ul class="sidebar-menu">
            <?php if (auth()->user()->inGroup('admin')) : ?>
                <li class="menu-header">Manajemen User</li>
                <li><a class="nav-link" href="<?= base_url('users'); ?>"><i class="fas fa-users"></i> <span>Users</span></a></li>
            <?php endif; ?>

            <li class="menu-header">Menu Utama</li>
            <li><a class="nav-link" href="<?= base_url('dashboard'); ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            <li><a class="nav-link" href="<?= base_url('pages'); ?>"><i class="fas fa-columns"></i> <span>Pages</span></a></li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-newspaper"></i><span>Post</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url('kategori-blog'); ?>">Kategori Post</a></li>
                    <li><a class="nav-link" href="<?= base_url('posts'); ?>">Post</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hiking"></i><span>Kegiatan Siswa</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url('kategori-kegiatan'); ?>">Kategori Kegiatan</a></li>
                    <li><a class="nav-link" href="<?= base_url('kegiatan'); ?>">Kegiatan</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-images"></i><span>Galeri Sarpras</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url('kategori-sarpras'); ?>">Kategori Sarpras</a></li>
                    <li><a class="nav-link" href="<?= base_url('sarpras'); ?>">Sarpras</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="<?= base_url('data-siswa-psb'); ?>"><i class="fas fa-history"></i> <span>Historis PSB</span></a></li>
            <!-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-history"></i><span>Histori PSB</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="">Manage</a></li>
                    <li><a class="nav-link" href="">Data</a></li>
                </ul>
            </li> -->
    </aside>
</div>