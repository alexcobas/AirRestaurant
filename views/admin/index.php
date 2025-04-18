<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestión Dinámica: Usuarios, Productos y Pedidos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #ffffff;
      color: #000;
      font-family: 'Helvetica Neue', sans-serif;
    }
    .container {
      margin-top: 30px;
    }
    h1 {
      color: #ff5a5f;
      font-weight: 700;
      text-align: center;
      margin-bottom: 20px;
    }
    .section {
      margin-top: 20px;
    }
    table {
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    th {
      background-color: #ff5a5f;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    td, th {
      vertical-align: middle;
    }
    .btn-warning {
      background-color: #ffc2c5;
      color: #000;
      border: none;
    }
    .btn-danger, .btn-primary {
      border: none;
    }
    .btn-primary {
      background-color: #ff5a5f;
    }
    .btn:hover {
      opacity: 0.85;
    }
    img {
      object-fit: cover;
    }
    .modal-header {
      background-color: #ff5a5f;
      color: #fff;
    }
    .form-label {
      font-weight: bold;
    }
    /* Estilo para la navegación de secciones */
    .nav-section {
      margin-bottom: 20px;
      text-align: center;
    }
    .nav-section button {
      margin: 0 5px;
    }
  </style>
</head>
<body>
  <!-- Navegación entre secciones -->
  <div class="container">
    <div class="nav-section">
      <button class="btn btn-primary" onclick="switchSection('users')">Usuarios</button>
      <button class="btn btn-primary" onclick="switchSection('products')">Productos</button>
      <button class="btn btn-primary" onclick="switchSection('orders')">Pedidos</button>
    </div>
  </div>

  <div class="container">
    <!-- Sección de Usuarios -->
    <div id="usersSection" class="section">
      <h1>Gestión de Usuarios</h1>
      <div class="mb-3 text-end">
        <button class="btn btn-primary" onclick="openUserModal('create')">Crear Usuario</button>
      </div>
      <div id="users-list" style="display: none;">
        <table class="table table-bordered" id="users-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Usuario</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Creado</th>
              <th>Imagen</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div id="users-error" class="alert alert-danger" style="display: none;">
        No se pudo cargar la lista de usuarios.
      </div>
    </div>

    <!-- Sección de Productos -->
    <div id="productsSection" class="section" style="display: none;">
      <h1>Gestión de Productos</h1>
      <div class="mb-3 text-end">
        <button class="btn btn-primary" onclick="openProductModal('create')">Crear Producto</button>
      </div>
      <div id="products-list" style="display: none;">
        <table class="table table-bordered" id="products-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Imagen</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div id="products-error" class="alert alert-danger" style="display: none;">
        No se pudieron cargar los productos.
      </div>
    </div>

    <!-- Sección de Pedidos -->
    <div id="ordersSection" class="section" style="display: none;">
      <h1>Gestión de Pedidos</h1>
      <div class="mb-3 text-end">
        <button class="btn btn-primary" onclick="openOrderModal('create')">Crear Pedido</button>
      </div>
      <div id="orders-list" style="display: none;">
        <table class="table table-bordered" id="orders-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>ID Usuario</th>
              <th>ID Productos</th>
              <th>Precio</th>
              <th>Total</th>
              <th>Categoria</th>
              <th>Creado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div id="orders-error" class="alert alert-danger" style="display: none;">
        No se pudieron cargar los pedidos.
      </div>
    </div>
  </div>

  <!-- MODAL USUARIO -->
  <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="userForm" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalTitle">Nuevo Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="userId">
          <div class="mb-3">
            <label for="userName" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="userName" name="userName" required>
          </div>
          <div class="mb-3">
            <label for="userSurnames" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="userSurnames" name="userSurnames" required>
          </div>
          <div class="mb-3">
            <label for="userUsername" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="userUsername" name="userUsername" required>
          </div>
          <div class="mb-3">
            <label for="userEmail" class="form-label">Correo</label>
            <input type="email" class="form-control" id="userEmail" name="userEmail" required>
          </div>
          <div class="mb-3">
            <label for="userRole" class="form-label">Rol</label>
            <select class="form-control" id="userRole" required>
              <option value="admin">Administrador</option>
              <option value="user">Usuario</option>
            </select>
          </div>
          <div id="user-password-fields" style="display: none;">
            <div class="mb-3">
              <label for="userPassword" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="userPassword">
            </div>
            <div class="mb-3">
              <label for="userConfirmPassword" class="form-label">Confirmar Contraseña</label>
              <input type="password" class="form-control" id="userConfirmPassword">
              <div id="userPasswordError" class="text-danger mt-1" style="display: none;">
                Las contraseñas no coinciden.
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar Usuario</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL PRODUCTO -->
  <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="productForm" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalTitle">Nuevo Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="productId">
          <div class="mb-3">
            <label for="productName" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="productName" name="productName" required>
          </div>
          <div class="mb-3">
            <label for="productDescription" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="productDescription" name="productDescription" required>
          </div>
          <div class="mb-3">
            <label for="productPrice" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="productPrice" name="productPrice" required>
          </div>
          <div class="mb-3">
            <label for="productImg" class="form-label">Imagen (Name of achive)</label>
            <input type="text" class="form-control" id="productImg" name="productImg">
          </div>
          <input type="hidden" name="imageId" id="imageId" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar Producto</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL PEDIDO -->
  <div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="orderForm" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="orderModalTitle">Nuevo Pedido</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="orderId">
          <div class="mb-3">
            <label for="orderUserId" class="form-label">ID Usuario</label>
            <input type="number" class="form-control" id="orderUserId" name="orderUserId" required>
          </div>
          <div class="mb-3">
            <label for="orderProductIds" class="form-label">IDs Productos (separados por coma)</label>
            <input type="text" class="form-control" id="orderProductIds" name="orderProductIds" required>
          </div>
          <div class="mb-3">
            <label for="orderTotal" class="form-label">Total</label>
            <input type="number" step="0.01" class="form-control" id="orderTotal" name="orderTotal" required>
          </div>
          <div class="mb-3">
            <label for="orderStatus" class="form-label">Estatus</label>
            <select class="form-control" id="orderStatus" required>
              <option value="pending">Pendiente</option>
              <option value="completed">Completado</option>
              <option value="cancelled">Cancelado</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar Pedido</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Variables para los modales
    const userModalInstance = new bootstrap.Modal(document.getElementById('userModal'));
    const productModalInstance = new bootstrap.Modal(document.getElementById('productModal'));
    const orderModalInstance = new bootstrap.Modal(document.getElementById('orderModal'));

    // Al cargar la página, se cargan los usuarios por defecto.
    document.addEventListener('DOMContentLoaded', () => {
      switchSection('users');
      fetchUsers();
    });

    // Función para cambiar entre secciones
    function switchSection(section) {
      document.getElementById('usersSection').style.display = section === 'users' ? '' : 'none';
      document.getElementById('productsSection').style.display = section === 'products' ? '' : 'none';
      document.getElementById('ordersSection').style.display = section === 'orders' ? '' : 'none';

      // Se cargan los datos correspondientes a cada sección si es necesario
      if (section === 'users') fetchUsers();
      if (section === 'products') fetchProducts();
      if (section === 'orders') fetchOrders();
    }

    // =================== USUARIOS ========================
    function fetchUsers() {
      fetch('http://localhost/airrestaurant/api/api.php?modal=user')
        .then(res => res.json())
        .then(data => {
          const tbody = document.querySelector('#users-table tbody');
          tbody.innerHTML = '';
          if (data.status === 'Success') {
            data.data.forEach(user => {
              const row = document.createElement('tr');
              const img = user.img_profile ?
                `<img src="http://localhost/airrestaurant/img/${user.img_profile}" style="width: 50px; height: 50px; border-radius: 50%;">` :
                'No image';
              row.innerHTML = `
                <td>${user.id}</td>
                <td>${user.name}</td>
                <td>${user.surnames}</td>
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td>${user.role}</td>
                <td>${user.created_at || ''}</td>
                <td>${img}</td>
                <td>
                  <button class="btn btn-warning btn-sm" onclick='editUser(${JSON.stringify(user)})'>Editar</button>
                  <button class="btn btn-danger btn-sm" onclick="deleteUser(${user.id})">Eliminar</button>
                </td>
              `;
              tbody.appendChild(row);
            });
            document.getElementById('users-list').style.display = '';
            document.getElementById('users-error').style.display = 'none';
          } else {
            document.getElementById('users-error').style.display = '';
          }
        })
        .catch(() => {
          document.getElementById('users-error').style.display = '';
        });
    }

    function openUserModal(mode = "create", userData = null) {
      const passwordFields = document.getElementById("user-password-fields");
      if (mode === "create") {
        passwordFields.style.display = "block";
        document.getElementById("userPassword").required = true;
        document.getElementById("userConfirmPassword").required = true;
        document.getElementById("userModalTitle").innerText = "Crear Usuario";
        document.getElementById("userId").value = "";
        document.getElementById("userName").value = "";
        document.getElementById("userSurnames").value = "";
        document.getElementById("userUsername").value = "";
        document.getElementById("userEmail").value = "";
        document.getElementById("userRole").value = "user";
        document.getElementById("userPassword").value = "";
        document.getElementById("userConfirmPassword").value = "";
      } else if (mode === "edit") {
        passwordFields.style.display = "none";
        document.getElementById("userPassword").required = false;
        document.getElementById("userConfirmPassword").required = false;
        document.getElementById("userModalTitle").innerText = "Editar Usuario";
        if (userData) {
          document.getElementById("userId").value = userData.id;
          document.getElementById("userName").value = userData.name;
          document.getElementById("userSurnames").value = userData.surnames;
          document.getElementById("userUsername").value = userData.username;
          document.getElementById("userEmail").value = userData.email;
          document.getElementById("userRole").value = userData.role;
        }
      }
      userModalInstance.show();
    }

    function editUser(user) {
      openUserModal('edit', user);
    }

    function saveUser(e) {
      e.preventDefault();
      const id = document.getElementById('userId').value;
      const url = id
        ? `http://localhost/airrestaurant/api/api.php?modal=user&id=${id}`
        : 'http://localhost/airrestaurant/api/api.php?modal=user';
      const method = id ? 'PUT' : 'POST';
      const body = {
        id,
        name: document.getElementById('userName').value,
        surnames: document.getElementById('userSurnames').value,
        username: document.getElementById('userUsername').value,
        email: document.getElementById('userEmail').value,
        role: document.getElementById('userRole').value
      };
      if (!id) {
        const password = document.getElementById('userPassword').value;
        const confirmPassword = document.getElementById('userConfirmPassword').value;
        if (password !== confirmPassword) {
          document.getElementById('userPasswordError').style.display = 'block';
          return;
        } else {
          document.getElementById('userPasswordError').style.display = 'none';
        }
        body.password = password;
      }
      fetch(url, {
        method,
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(body)
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'Success') {
          userModalInstance.hide();
          fetchUsers();
        } else {
          alert('Ocurrió un error al guardar el usuario.');
        }
      });
    }

    function deleteUser(id) {
      if (confirm('¿Estás seguro de eliminar este usuario?')) {
        fetch(`http://localhost/airrestaurant/api/api.php?modal=user&id=${id}`, { method: 'DELETE' })
          .then(res => res.json())
          .then(data => {
            if (data.status === 'Success') fetchUsers();
            else alert('No se pudo eliminar el usuario.');
          });
      }
    }

    document.getElementById('userForm').addEventListener('submit', saveUser);

    // =================== PRODUCTOS ========================
    function fetchProducts() {
      fetch('http://localhost/airrestaurant/api/api.php?modal=product')
        .then(res => res.json())
        .then(data => {
          const tbody = document.querySelector('#products-table tbody');
          tbody.innerHTML = '';
          if (data.status === 'Success') {
            data.data.forEach(product => {
              const row = document.createElement('tr');
              // Suponiendo que product.img es la ruta o URL de la imagen
              const img = product.images ?
                `<img src="http://localhost/airrestaurant/img/${product.images[0].photo_archive_name}" style="width: 50px; height: 50px; border-radius: 5px;">`
                : 'Sin imagen';
              row.innerHTML = `
                <td>${product.id}</td>
                <td>${product.name}</td>
                <td>${product.description}</td>
                <td>${product.base_price}</td>
                <td>${img}</td>
                <td>
                  <button class="btn btn-warning btn-sm" onclick='editProduct(${JSON.stringify(product)})'>Editar</button>
                  <button class="btn btn-danger btn-sm" onclick="deleteProduct(${product.id})">Eliminar</button>
                </td>
              `;
              tbody.appendChild(row);
            });
            document.getElementById('products-list').style.display = '';
            document.getElementById('products-error').style.display = 'none';
          } else {
            document.getElementById('products-error').style.display = '';
          }
        })
        .catch(() => {
          document.getElementById('products-error').style.display = '';
        });
    }

    function openProductModal(mode = "create", productData = null) {
      if (mode === "create") {
        document.getElementById("productModalTitle").innerText = "Crear Producto";
        document.getElementById("productId").value = "";
        document.getElementById("productName").value = "";
        document.getElementById("productDescription").value = "";
        document.getElementById("productPrice").value = "";
        document.getElementById("productImg").value = "";
      } else if (mode === "edit") {
        document.getElementById("productModalTitle").innerText = "Editar Producto";
        if (productData) {
          document.getElementById("productId").value = productData.id;
          document.getElementById("productName").value = productData.name;
          document.getElementById("productDescription").value = productData.description;
          document.getElementById("productPrice").value = productData.base_price;
          document.getElementById("productImg").value = productData.images[0].photo_archive_name || "";
          document.getElementById("imageId").value = productData.images[0].id || "";
        }
      }
      productModalInstance.show();
    }

    function editProduct(product) {
      openProductModal('edit', product);
    }

    function saveProduct(e) {
      e.preventDefault();
      const id = document.getElementById('productId').value;
      const url = id
        ? `http://localhost/airrestaurant/api/api.php?modal=product&id=${id}`
        : 'http://localhost/airrestaurant/api/api.php?modal=product';
      const method = id ? 'PUT' : 'POST';
      const body = {
        id,
        name: document.getElementById('productName').value,
        description: document.getElementById('productDescription').value,
        base_price: document.getElementById('productPrice').value,
        img: document.getElementById('productImg').value,
        imageId: document.getElementById('imageId').value
      };
      fetch(url, {
        method,
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(body)
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'Success') {
          productModalInstance.hide();
          fetchProducts();
        } else {
          alert('Ocurrió un error al guardar el producto.');
        }
      });
    }

    function deleteProduct(id) {
        console.log(id);
      if (confirm('¿Estás seguro de eliminar este producto?')) {
        fetch(`http://localhost/airrestaurant/api/api.php?modal=product&id=${id}`, { method: 'DELETE' })
          .then(res => res.json())
          .then(data => {
            if (data.status === 'Success') fetchProducts();
            else alert('No se pudo eliminar el producto.');
          });
      }
    }

    document.getElementById('productForm').addEventListener('submit', saveProduct);

    // =================== PEDIDOS ========================
    function fetchOrders() {
      fetch('http://localhost/airrestaurant/api/api.php?modal=order')
        .then(res => res.json())
        .then(data => {
          const tbody = document.querySelector('#orders-table tbody');
          tbody.innerHTML = '';
          if (data.status === 'Success') {
            data.data.forEach(order => {
              const row = document.createElement('tr');
              row.innerHTML = `
                <td>${order.id}</td>
                <td>${order.user_id}</td>
                <td>${order.product_ids}</td>
                <td>${order.order_price}</td>
                <td>${order.order_price_total}</td>
                <td>${order.offer_id}</td>
                <td>${order.created_at || ''}</td>
                <td>
                  <button class="btn btn-warning btn-sm" onclick='editOrder(${JSON.stringify(order)})'>Editar</button>
                  <button class="btn btn-danger btn-sm" onclick="deleteOrder(${order.id})">Eliminar</button>
                </td>
              `;
              tbody.appendChild(row);
            });
            document.getElementById('orders-list').style.display = '';
            document.getElementById('orders-error').style.display = 'none';
          } else {
            document.getElementById('orders-error').style.display = '';
          }
        })
        .catch(() => {
          document.getElementById('orders-error').style.display = '';
        });
    }

    function openOrderModal(mode = "create", orderData = null) {
      if (mode === "create") {
        document.getElementById("orderModalTitle").innerText = "Crear Pedido";
        document.getElementById("orderId").value = "";
        document.getElementById("orderUserId").value = "";
        document.getElementById("orderProductIds").value = "";
        document.getElementById("orderTotal").value = "";
        document.getElementById("orderStatus").value = "pending";
      } else if (mode === "edit") {
        document.getElementById("orderModalTitle").innerText = "Editar Pedido";
        if (orderData) {
          document.getElementById("orderId").value = orderData.id;
          document.getElementById("orderUserId").value = orderData.user_id;
          document.getElementById("orderProductIds").value = orderData.product_ids;
          document.getElementById("orderTotal").value = orderData.total;
          document.getElementById("orderStatus").value = orderData.status;
        }
      }
      orderModalInstance.show();
    }

    function editOrder(order) {
      openOrderModal('edit', order);
    }

    function saveOrder(e) {
      e.preventDefault();
      const id = document.getElementById('orderId').value;
      const url = id
        ? `http://localhost/airrestaurant/api/api.php?modal=order&id=${id}`
        : 'http://localhost/airrestaurant/api/api.php?modal=order';
      const method = id ? 'PUT' : 'POST';
      const body = {
        id,
        user_id: document.getElementById('orderUserId').value,
        product_ids: document.getElementById('orderProductIds').value,
        total: document.getElementById('orderTotal').value,
        status: document.getElementById('orderStatus').value
      };
      fetch(url, {
        method,
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(body)
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'Success') {
          orderModalInstance.hide();
          fetchOrders();
        } else {
          alert('Ocurrió un error al guardar el pedido.');
        }
      });
    }

    function deleteOrder(id) {
      if (confirm('¿Estás seguro de eliminar este pedido?')) {
        fetch(`http://localhost/airrestaurant/api/api.php?modal=order&id=${id}`, { method: 'DELETE' })
          .then(res => res.json())
          .then(data => {
            if (data.status === 'Success') fetchOrders();
            else alert('No se pudo eliminar el pedido.');
          });
      }
    }

    document.getElementById('orderForm').addEventListener('submit', saveOrder);
  </script>
</body>
</html>
