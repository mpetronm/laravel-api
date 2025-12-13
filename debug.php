<?php
// Mostrar todos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

use Illuminate\Database\Capsule\Manager as DB;

echo "<h3>Probando conexión a BD</h3>";

try {
    // Probar conexión
    $pdo = DB::connection()->getPdo();
    echo "✅ Conexión a MySQL OK<br>";
    
    // Ver estructura de la tabla
    echo "<h3>Estructura de tabla 'productos':</h3>";
    $columns = DB::select('DESCRIBE productos');
    foreach ($columns as $col) {
        echo "{$col->Field} ({$col->Type})<br>";
    }
    
    // Intentar insertar
    echo "<h3>Intentando insertar:</h3>";
    $id = DB::table('productos')->insertGetId([
        'nombre' => 'Test Debug',
        'precio' => 99.99,
        'descripcion' => 'Desde debug.php',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);
    
    echo "✅ Insertado con ID: $id";
    
} catch (Exception $e) {
    echo "<div style='color:red;'><h3>❌ ERROR:</h3>";
    echo "<strong>Mensaje:</strong> " . $e->getMessage() . "<br>";
    echo "<strong>Archivo:</strong> " . $e->getFile() . "<br>";
    echo "<strong>Línea:</strong> " . $e->getLine() . "<br>";
    echo "<strong>Trace:</strong><pre>" . $e->getTraceAsString() . "</pre>";
    echo "</div>";
}