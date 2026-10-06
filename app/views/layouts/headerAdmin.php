<!-- Hoja de estilos de Bootstrap -->
<link rel="stylesheet" href="/panaderia-reservas/app/assets/css/bootstrap.min.css">

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" style="color: orange; font-size: 24px; font-weight: bold; " href="/panaderia-reservas/app/views/admin/PanelAdmin.php">Dulce y Salado</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/panaderia-reservas/app/controllers/AdminController.php?action=productos">Gestionar Productos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/panaderia-reservas/app/controllers/AdminController.php?action=reservas">Gestionar reservas</a>
        </li>
         <li class="nav-item">
            <a class="nav-link" href="/panaderia-reservas/app/controllers/AdminController.php?action=listarUsuarios">Gestionar usuarios</a>
        </li>
         <li class="nav-item">
            <a class="nav-link" href="/panaderia-reservas/app/controllers/AdminController.php?action=reservaPorFecha">Gestionar resumen diario</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/panaderia-reservas/app/controllers/cerrarSesion.php">Cerrar sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Script de Bootstrap para funcionalidades interactivas como el menú responsive -->
<script src="/panaderia-reservas/app/assets/js/bootstrap.bundle.min.js"></script>