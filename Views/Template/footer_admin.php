<!-- ======= Footer ======= -->


<!-- Vendor JS Files -->

<script>
  let base_url = '<?= BASE_URL ?>'
</script>

<script src="<?= media() ?>/vendor/jquery/jquery-3.7.1.min.js"></script>
<!-- Library Bundle Script -->
<script src="<?= media() ?>/js/core/libs.min.js"></script>

<!-- External Library Bundle Script -->
<script src="<?= media() ?>/js/core/external.min.js"></script>

<!-- Widgetchart Script -->
<script src="<?= media() ?>/js/charts/widgetcharts.js"></script>

<!-- mapchart Script -->
<script src="<?= media() ?>/js/charts/vectore-chart.js"></script>

<script src="<?= media() ?>/js/charts/dashboard.js"></script>

<!-- fslightbox Script -->
<script src="<?= media() ?>/js/plugins/fslightbox.js"></script>

<!-- Settings Script -->
<script src="<?= media() ?>/js/plugins/setting.js"></script>

<!-- Slider-tab Script -->
<script src="<?= media() ?>/js/plugins/slider-tabs.js"></script>

<!-- Form Wizard Script -->
<script src="<?= media() ?>/js/plugins/form-wizard.js"></script>

<!-- AOS Animation Plugin-->
<script src="<?= media() ?>/vendor/aos/dist/aos.js"></script>

<script src="<?= media() ?>/vendor/sweetalert/sweetalert2.all.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="<?= media() ?>/vendor/jquery/jquery-ui.js"></script>
<!-- App Script -->

<script src="<?= media() ?>/js/hope-ui.js"></script>
<?php if (isset($data['script'])): ?>
  <script src="<?= media() ?>/js/<?= $data['script'] ?>.js"></script>
<?php endif; ?>
</body>

</html>