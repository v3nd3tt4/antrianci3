<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?=base_url()?>" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="<?=base_url()?>sneat/logo.ico" width="30">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Antrian</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <!-- <li class="menu-item <?=empty($link)=='meja'?'active':''?>">
            <a href="<?=base_url()?>welcome" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Display antrian</div>
            </a>
        </li>
        <li class="menu-item <?=$link=='ambil_antrian'?'active':''?>">
            <a href="<?=base_url()?>ambil_antrian" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-alt"></i>
                <div data-i18n="Analytics">Ambil Antrian</div>
            </a>
        </li> -->

        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Menu</span></li>
        <?php if(!$this->session->userdata('login')){?>
        <li class="menu-item <?=$link=='meja'?'active':''?>">
            <a href="<?=base_url()?>login" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Basic">Login</div>
            </a>
        </li>
        <?php }?>
        <?php if($this->session->userdata('level')=='admin'){?>
        <!-- Cards -->
        <li class="menu-item <?=$link=='meja'?'active':''?>">
            <a href="<?=base_url()?>admin/meja" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Setting Meja</div>
            </a>
        </li>
        <li class="menu-item <?=$link=='operator'?'active':''?>">
            <a href="<?=base_url()?>admin/operator" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Basic">Operator</div>
            </a>
        </li>
        <?php }?>
        <?php if($this->session->userdata('level')=='operator'){?>
        <li class="menu-item <?=$link=='panggilan'?'active':''?>">
            <a href="<?=base_url()?>operator/panggilan" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-voice"></i>
                <div data-i18n="Basic">Panggilan</div>
            </a>
        </li>
        <?php }?>
    </ul>
</aside>
<!-- / Menu -->