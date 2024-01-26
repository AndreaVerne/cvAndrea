<section class="compras">

  <?php
// Aquí deberías incluir la lógica para obtener los datos de la tabla "compras"
// y almacenarlos en un array llamado $compras o de alguna otra forma.
// Por simplicidad, aquí proporciono un ejemplo estático.
$compras = [
    ['id' => 1, 'nombre' => 'Producto A', 'cantidad' => 5, 'precio' => 10.99],
    ['id' => 2, 'nombre' => 'Producto B', 'cantidad' => 3, 'precio' => 20.50],
    // ... más datos ...
];
?>
<div class="container mt-5">
    <h2>Tabla de Compras</h2>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Precio</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($compras as $compra): ?>
            <tr>
                <td><?= $compra['id']; ?></td>
                <td><?= $compra['nombre']; ?></td>
                <td><?= $compra['cantidad']; ?></td>
                <td><?= $compra['precio']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
  </section>