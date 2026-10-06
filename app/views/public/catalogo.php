<?php
include __DIR__ . '/../layouts/header.php';// Incluimos el header con la navbar de Bootstrap 

//catalogo de productos para visualizar por el cliente

// Se obtiene el listado de productos para mostrar en el catálogo
$productos = $objetoProducto->getAllProducto(); 

 echo '<div class="container mt-4">';  // Contenedor Bootstrap para centrar el contenido ,añadir márgenes y dejar margen superior
 echo '<div class="row g-3">';    // Fila del grid de Bootstrap para mostrar las cards en horizontal
foreach($productos as $producto) {

   echo '<div class="col-md-4">';  // Columna de 4 para mostrar 3 cards por fila

  echo '<div class="card" style="width: 18rem;">
  <img src="../assets/images/' . $producto->getImagen() . '" class="card-img-top" alt="producto">
  <div class="card-body">
    <h5 class="card-title">' . $producto->getNombre() . '</h5>
    <p class="card-text">' .$producto->getDescripcion() . '</p>
    <p class="card-text">' . $producto->getPrecio() . ' €</p>
    <a href="../views/reservas/reservar.php?id_producto=' . $producto->getId() . '" class="btn btn-primary">Reservar</a>
  </div>
</div>
</div>';

    
}   

echo '</div>';  // cierre row
echo '</div>';  // cierre container

include '../views/layouts/footer.php'; //aplicar estilos Bootstrap ccs del footer 
?> 
