<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            ©
            <script>
            document.write(new Date().getFullYear());
            </script>
            made with ❤️ by
            <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Tim IT - Pengadilan Tinggi Banjarmasin</a>
        </div>
        <div>
            <!-- <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
            <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

            <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank"
                class="footer-link me-4">Documentation</a>

            <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
                class="footer-link me-4">Support</a> -->
        </div>
    </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- <div class="buy-now">
    <a href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/" target="_blank"
        class="btn btn-danger btn-buy-now">Upgrade to Pro</a>
</div> -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="<?=base_url()?>sneat/assets/vendor/libs/jquery/jquery.js"></script>
<script src="<?=base_url()?>sneat/assets/vendor/libs/popper/popper.js"></script>
<script src="<?=base_url()?>sneat/assets/vendor/js/bootstrap.js"></script>
<script src="<?=base_url()?>sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script>
    $(document).ready(function () {
    $('.datatables').DataTable();
});
</script>


<script src="<?=base_url()?>sneat/assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="<?=base_url()?>sneat/assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="<?=base_url()?>sneat/assets/js/main.js"></script>

<!-- Page JS -->
<script src="<?=base_url()?>sneat/assets/js/dashboards-analytics.js"></script>
<script src="<?=base_url()?>assets/jquery.dataTables.min.js"></script>


<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="<?=base_url()?>assets/buttons.js"></script>
<?php 
if(!empty($script)){
    $this->load->view($script);
}
?>
</body>

</html>