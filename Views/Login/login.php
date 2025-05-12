<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link rel="shortcut icon" href="<?= media() ?>/images/favicon.ico" />

  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>

  <link href="<?= media() ?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <!-- stylo indx -->
  <link href="<?= media() ?>/css/style.css" rel="stylesheet">

  <link href="<?= media() ?>/vendor/simple-datatables/style.css" rel="stylesheet">
  <!-- Library / Plugin Css Build -->
  <link rel="stylesheet" href="<?= media() ?>/css/core/libs.min.css" />

  <!-- Aos Animation Css -->
  <link rel="stylesheet" href="<?= media() ?>/vendor/aos/dist/aos.css" />

  <!-- Hope Ui Design System Css -->
  <link rel="stylesheet" href="<?= media() ?>/css/hope-ui.min.css?v=2.0.0" />

  <!-- Custom Css -->
  <link rel="stylesheet" href="<?= media() ?>/css/custom.min.css?v=2.0.0" />

  <!-- Dark Css -->
  <link rel="stylesheet" href="<?= media() ?>/css/dark.min.css" />

  <!-- Customizer Css -->
  <link rel="stylesheet" href="<?= media() ?>/css/customizer.min.css" />

  <!-- Template Main CSS File -->
  <link href="<?= media() ?>/css/styleLogin.css" rel="stylesheet">
</head>

<body>
  <div class="main">
    <input type="checkbox" id="chk" aria-hidden="true">
    <div class="signup">
      <label for="chk" aria-hidden="true">SyntheSports</label>
      <div style="justify-content: center;">
        <div style="text-align:justify; padding: 15px;">
          <p>SyntheSports es un sistema integral diseñado para la gestión eficiente de canchas sintéticas, orientado a optimizar tanto la administración como la experiencia del usuario.</p>
        </div>
      </div>
    </div>

    <div class="login">
      <form id="formLogin" id="formLogin" method="POST" novalidate>
        <label for="chk" aria-hidden="true">Login</label>
        <input type="text" name="txtUser" placeholder="User name" id="txtUser" required="">
        <input type="password" name="txtPassword" placeholder="Password" id="txtPassword" required="">
        <button type="submit">Login</button>
      </form>
    </div>
  </div>

  <?php footer_admin($data); ?>