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
        <br><br>
        <li class="menu-item <?=$link=='ambil_antrian'?'active':''?>">
            <a href="<?=base_url()?>ambil_antrian" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-alt"></i>
                <div data-i18n="Analytics">Ambil Antrian</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->