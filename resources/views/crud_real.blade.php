<!DOCTYPE html>
<html>
<head>
    <title>CRUD REAL - Productos API</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        header {
            background: #2c3e50;
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        header h1 {
            font-size: 2.8rem;
            margin-bottom: 10px;
        }
        
        .subtitle {
            color: #bdc3c7;
            font-size: 1.2rem;
        }
        
        .content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
            padding: 30px;
        }
        
        @media (max-width: 900px) {
            .content {
                grid-template-columns: 1fr;
            }
        }
        
        .form-section, .list-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
            font-size: 1.5rem;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #34495e;
            font-weight: 600;
        }
        
        input, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        input:focus, textarea:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        .btn {
            display: inline-block;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            text-align: center;
        }
        
        .btn-primary {
            background: #3498db;
            color: white;
        }
        
        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background: #e74c3c;
            color: white;
        }
        
        .btn-danger:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }
        
        .btn-success {
            background: #2ecc71;
            color: white;
        }
        
        .btn-success:hover {
            background: #27ae60;
            transform: translateY(-2px);
        }
        
        .btn-warning {
            background: #f39c12;
            color: white;
        }
        
        .btn-warning:hover {
            background: #d35400;
        }
        
        .producto-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            border-left: 5px solid #3498db;
            transition: transform 0.3s;
        }
        
        .producto-card:hover {
            transform: translateX(5px);
        }
        
        .producto-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .producto-title {
            font-size: 1.3rem;
            color: #2c3e50;
            font-weight: 600;
        }
        
        .producto-precio {
            font-size: 1.5rem;
            color: #2ecc71;
            font-weight: bold;
        }
        
        .producto-desc {
            color: #7f8c8d;
            margin-bottom: 15px;
            line-height: 1.5;
        }
        
        .producto-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .message {
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
            text-align: center;
            font-weight: 600;
            animation: fadeIn 0.5s;
        }
        
        .success-message {
            background: #d5f4e6;
            color: #27ae60;
            border: 1px solid #2ecc71;
        }
        
        .error-message {
            background: #fadbd8;
            color: #c0392b;
            border: 1px solid #e74c3c;
        }
        
        .loading {
            text-align: center;
            padding: 30px;
            color: #7f8c8d;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #7f8c8d;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }
        
        .api-info {
            background: #34495e;
            color: white;
            padding: 20px;
            margin-top: 30px;
            border-radius: 8px;
        }
        
        .endpoint {
            font-family: 'Courier New', monospace;
            background: #2c3e50;
            padding: 10px 15px;
            border-radius: 4px;
            margin: 8px 0;
            font-size: 0.9rem;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        
        .modal h3 {
            margin-bottom: 20px;
            color: #2c3e50;
        }
        
        .close-modal {
            float: right;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🛒 CRUD COMPLETO - API Productos</h1>
            <p class="subtitle">Interfaz real para Create, Read, Update, Delete - Conectada a API Laravel</p>
        </header>
        
        <div class="content">
            <!-- SECCIÓN FORMULARIO -->
            <div class="form-section">
                <h2>➕ Crear Nuevo Producto</h2>
                
                <div id="form-message" class="message" style="display:none;"></div>
                
                <form id="form-crear">
                    <div class="form-group">
                        <label for="nombre">Nombre del Producto:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Ej: Laptop Gamer" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="precio">Precio ($):</label>
                        <input type="number" id="precio" name="precio" placeholder="Ej: 1500.00" step="0.01" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" rows="4" placeholder="Describa el producto..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-success" style="width:100%;">
                        ✨ Crear Producto
                    </button>
                </form>
                
                <div class="api-info">
                    <h3>📡 Endpoint API:</h3>
                    <div class="endpoint">POST /api/productos</div>
                    <p>Formulario envía JSON a la API RESTful de Laravel</p>
                </div>
            </div>
            
            <!-- SECCIÓN LISTA -->
            <div class="list-section">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                    <h2>📦 Productos en Base de Datos</h2>
                    <button class="btn btn-primary" onclick="cargarProductos()">🔄 Actualizar</button>
                </div>
                
                <div id="loading" class="loading">
                    <div style="margin-bottom:10px;">⏳ Cargando productos...</div>
                    <div style="width:100%; height:4px; background:#ecf0f1; border-radius:2px;">
                        <div id="progress-bar" style="width:0%; height:100%; background:#3498db; border-radius:2px; transition:width 0.3s;"></div>
                    </div>
                </div>
                
                <div id="productos-lista"></div>
                
                <div id="empty-state" class="empty-state" style="display:none;">
                    <div style="font-size:4rem; margin-bottom:15px;">📭</div>
                    <h3>No hay productos</h3>
                    <p>Crea el primer producto usando el formulario</p>
                </div>
            </div>
        </div>
        
        <!-- MODAL PARA EDITAR -->
        <div id="modal-editar" class="modal">
            <div class="modal-content">
                <button class="close-modal" onclick="cerrarModal()">×</button>
                <h3>✏️ Editar Producto</h3>
                <form id="form-editar">
                    <input type="hidden" id="edit-id">
                    
                    <div class="form-group">
                        <label for="edit-nombre">Nombre:</label>
                        <input type="text" id="edit-nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit-precio">Precio ($):</label>
                        <input type="number" id="edit-precio" step="0.01" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit-descripcion">Descripción:</label>
                        <textarea id="edit-descripcion" rows="3"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-success">💾 Guardar Cambios</button>
                </form>
            </div>
        </div>
        
        <div class="api-info" style="margin:0 30px 30px;">
            <h3>🔧 Endpoints CRUD Implementados:</h3>
            <div class="endpoint">GET    /api/productos     → Listar todos (Funciona ✓)</div>
            <div class="endpoint">POST   /api/productos     → Crear nuevo</div>
            <div class="endpoint">GET    /api/productos/{id} → Ver detalle</div>
            <div class="endpoint">PUT    /api/productos/{id} → Actualizar</div>
            <div class="endpoint">DELETE /api/productos/{id} → Eliminar</div>
            <p><strong>Base de datos:</strong> MySQL con XAMPP | <strong>Productos actuales:</strong> <span id="contador-productos">0</span></p>
        </div>
    </div>

    <script>
        // URL base de la API
        const API_URL = 'http://localhost:8000/api';
        
        // Elementos DOM
        const elementos = {
            lista: document.getElementById('productos-lista'),
            loading: document.getElementById('loading'),
            emptyState: document.getElementById('empty-state'),
            formMessage: document.getElementById('form-message'),
            contador: document.getElementById('contador-productos'),
            modal: document.getElementById('modal-editar'),
            progressBar: document.getElementById('progress-bar')
        };
        
        // ============================================
        // 1. CARGAR PRODUCTOS AL INICIAR
        // ============================================
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🔄 Iniciando aplicación CRUD...');
            cargarProductos();
        });
        
        // Función principal para cargar productos
        async function cargarProductos() {
            try {
                elementos.lista.innerHTML = '';
                elementos.loading.style.display = 'block';
                elementos.emptyState.style.display = 'none';
                
                // Simular progreso
                elementos.progressBar.style.width = '30%';
                
                console.log('📡 Solicitando productos a:', `${API_URL}/productos`);
                
                const response = await fetch(`${API_URL}/productos`);
                
                elementos.progressBar.style.width = '70%';
                
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status} - ${response.statusText}`);
                }
                
                const productos = await response.json();
                
                elementos.progressBar.style.width = '100%';
                
                console.log('✅ Productos recibidos:', productos);
                
                setTimeout(() => {
                    elementos.loading.style.display = 'none';
                    mostrarProductos(productos);
                }, 300);
                
            } catch (error) {
                console.error('❌ Error cargando productos:', error);
                elementos.loading.style.display = 'none';
                elementos.lista.innerHTML = `
                    <div class="error-message">
                        <strong>Error al cargar productos:</strong><br>
                        ${error.message}<br>
                        <small>Verifica que el servidor Laravel esté corriendo en puerto 8000</small>
                    </div>
                `;
            }
        }
        
        // Mostrar productos en la lista
        function mostrarProductos(productos) {
            elementos.contador.textContent = productos.length;
            
            if (productos.length === 0) {
                elementos.emptyState.style.display = 'block';
                return;
            }
            
            let html = '';
            
            productos.forEach(producto => {
                const precioFormateado = parseFloat(producto.precio).toLocaleString('es-CL', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                
                html += `
                    <div class="producto-card" id="producto-${producto.id}">
                        <div class="producto-header">
                            <div class="producto-title">${producto.nombre}</div>
                            <div class="producto-precio">$${precioFormateado}</div>
                        </div>
                        <div class="producto-desc">${producto.descripcion || '<em>Sin descripción</em>'}</div>
                        <div class="producto-actions">
                            <button class="btn btn-warning" onclick="abrirModalEditar(${producto.id})">
                                ✏️ Editar
                            </button>
                            <button class="btn btn-danger" onclick="eliminarProducto(${producto.id}, '${producto.nombre}')">
                                🗑️ Eliminar
                            </button>
                            <button class="btn btn-primary" onclick="verDetalle(${producto.id})">
                                👁️ Ver
                            </button>
                        </div>
                        <div style="margin-top:10px; font-size:0.8rem; color:#95a5a6;">
                            ID: ${producto.id} | Creado: ${producto.created_at ? new Date(producto.created_at).toLocaleDateString() : 'N/A'}
                        </div>
                    </div>
                `;
            });
            
            elementos.lista.innerHTML = html;
        }
        
        // ============================================
        // 2. CREAR PRODUCTO
        // ============================================
        document.getElementById('form-crear').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = {
                nombre: formData.get('nombre'),
                precio: parseFloat(formData.get('precio')),
                descripcion: formData.get('descripcion') || ''
            };
            
            // Validación básica
            if (!data.nombre.trim() || isNaN(data.precio) || data.precio < 0) {
                mostrarMensaje('Por favor completa todos los campos correctamente', 'error');
                return;
            }
            
            console.log('📤 Enviando nuevo producto:', data);
            
            try {
                const response = await fetch(`${API_URL}/productos`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                
                const resultado = await response.json();
                
                if (response.ok) {
                    console.log('✅ Producto creado:', resultado);
                    mostrarMensaje(`Producto "${resultado.nombre}" creado exitosamente con ID: ${resultado.id}`, 'success');
                    this.reset();
                    
                    // Recargar lista después de 1 segundo
                    setTimeout(cargarProductos, 1000);
                    
                } else {
                    throw new Error(resultado.message || resultado.error || 'Error desconocido');
                }
                
            } catch (error) {
                console.error('❌ Error creando producto:', error);
                mostrarMensaje(`Error al crear producto: ${error.message}`, 'error');
            }
        });
        
        // ============================================
        // 3. ELIMINAR PRODUCTO
        // ============================================
        async function eliminarProducto(id, nombre) {
            if (!confirm(`¿Estás seguro de eliminar el producto "${nombre}"?`)) {
                return;
            }
            
            console.log(`🗑️ Eliminando producto ID: ${id}`);
            
            try {
                const response = await fetch(`${API_URL}/productos/${id}`, {
                    method: 'DELETE'
                });
                
                if (response.ok) {
                    mostrarMensaje(`Producto "${nombre}" eliminado exitosamente`, 'success');
                    cargarProductos();
                } else {
                    const error = await response.json();
                    throw new Error(error.message || error.error || 'Error al eliminar');
                }
                
            } catch (error) {
                console.error('❌ Error eliminando producto:', error);
                mostrarMensaje(`Error al eliminar: ${error.message}`, 'error');
            }
        }
        
        // ============================================
        // 4. EDITAR PRODUCTO
        // ============================================
        function abrirModalEditar(id) {
            console.log(`✏️ Abriendo modal para editar ID: ${id}`);
            
            // Buscar producto en la lista actual
            const productos = document.querySelectorAll('.producto-card');
            let producto = null;
            
            productos.forEach(p => {
                if (p.id === `producto-${id}`) {
                    const nombre = p.querySelector('.producto-title').textContent;
                    const precio = p.querySelector('.producto-precio').textContent.replace('$', '').replace(/\./g, '').replace(',', '.');
                    const descripcion = p.querySelector('.producto-desc').innerHTML;
                    
                    producto = {
                        id: id,
                        nombre: nombre,
                        precio: parseFloat(precio),
                        descripcion: descripcion.includes('<em>') ? '' : descripcion
                    };
                }
            });
            
            if (producto) {
                document.getElementById('edit-id').value = producto.id;
                document.getElementById('edit-nombre').value = producto.nombre;
                document.getElementById('edit-precio').value = producto.precio;
                document.getElementById('edit-descripcion').value = producto.descripcion;
                
                elementos.modal.style.display = 'flex';
            }
        }
        
        function cerrarModal() {
            elementos.modal.style.display = 'none';
        }
        
        document.getElementById('form-editar').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const id = document.getElementById('edit-id').value;
            const data = {
                nombre: document.getElementById('edit-nombre').value,
                precio: parseFloat(document.getElementById('edit-precio').value),
                descripcion: document.getElementById('edit-descripcion').value
            };
            
            console.log(`💾 Guardando cambios para ID: ${id}`, data);
            
            try {
                const response = await fetch(`${API_URL}/productos/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                
                const resultado = await response.json();
                
                if (response.ok) {
                    mostrarMensaje(`Producto "${data.nombre}" actualizado exitosamente`, 'success');
                    cerrarModal();
                    cargarProductos();
                } else {
                    throw new Error(resultado.message || resultado.error || 'Error al actualizar');
                }
                
            } catch (error) {
                console.error('❌ Error actualizando producto:', error);
                mostrarMensaje(`Error al actualizar: ${error.message}`, 'error');
            }
        });
        
        // ============================================
        // 5. VER DETALLE
        // ============================================
        async function verDetalle(id) {
            console.log(`👁️ Solicitando detalle para ID: ${id}`);
            
            try {
                const response = await fetch(`${API_URL}/productos/${id}`);
                const producto = await response.json();
                
                if (response.ok) {
                    const precioFormateado = parseFloat(producto.precio).toLocaleString('es-CL', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    
                    alert(`📋 Detalle del Producto:\n\n` +
                          `ID: ${producto.id}\n` +
                          `Nombre: ${producto.nombre}\n` +
                          `Precio: $${precioFormateado}\n` +
                          `Descripción: ${producto.descripcion || 'N/A'}\n` +
                          `Creado: ${producto.created_at ? new Date(producto.created_at).toLocaleString() : 'N/A'}\n` +
                          `Actualizado: ${producto.updated_at ? new Date(producto.updated_at).toLocaleString() : 'N/A'}`);
                } else {
                    throw new Error(producto.error || 'Producto no encontrado');
                }
                
            } catch (error) {
                console.error('❌ Error obteniendo detalle:', error);
                alert(`Error: ${error.message}`);
            }
        }
        
        // ============================================
        // FUNCIONES AUXILIARES
        // ============================================
        function mostrarMensaje(texto, tipo) {
            elementos.formMessage.textContent = texto;
            elementos.formMessage.className = `message ${tipo}-message`;
            elementos.formMessage.style.display = 'block';
            
            // Ocultar después de 5 segundos
            setTimeout(() => {
                elementos.formMessage.style.display = 'none';
            }, 5000);
        }
        
        // Cerrar modal haciendo clic fuera
        window.addEventListener('click', function(e) {
            if (e.target === elementos.modal) {
                cerrarModal();
            }
        });
        
        // Manejar errores no capturados
        window.addEventListener('error', function(e) {
            console.error('Error global:', e.error);
            mostrarMensaje('Error en la aplicación. Revisa la consola.', 'error');
        });
        
        console.log('✅ Aplicación CRUD cargada y lista');
    </script>
</body>
</html>