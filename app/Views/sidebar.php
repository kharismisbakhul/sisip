<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile dropdown m-t-20">
                        <div class="gambar2 rounded-circle user-pic">
                            <img src="<?= ($user['foto_profil']) ?  base_url($user['foto_profil']) : '/assets/images/users/default.jpg'  ?>" class="portrait2" />
                        </div>
                        <div class="user-content hide-menu m-t-10">
                            <h5 class="m-b-10 user-name font-medium"><?= $user['nama'] ?></h5>
                            <a class="btn btn-circle btn-sm m-r-5" role="button">
                                <i class="ti-calendar"></i>
                            </a>
                            <span><?= date('d-m-Y') ?></span>

                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                <!-- User Profile-->
                <?php foreach ($kategori_menu as $km) : ?>
                    <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu"><?= $km['nama_kategori_menu'] ?></span>
                    </li>
                    <?php foreach ($menu as $m) :
                        if ($m['id_kategori_menu'] == $km['id_kategori_menu']) { ?>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= base_url($m['link']) ?>" aria-expanded="false">
                                    <i class="<?= $m['icon'] ?>"></i>
                                    <span class="hide-menu"><?= $m['nama_menu'] ?></span>
                                </a>
                            </li>
                    <?php }
                    endforeach ?>
                <?php endforeach ?>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->