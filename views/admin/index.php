<aside class="sidebar" style="margin-top: 97px;">
    <nav class="nav flex-column">
        <a class="nav-link px-3 py-2" href="#" id="orders-menu" data-bs-toggle="collapse" data-bs-target="#submenuPedidos" aria-expanded="false">
            Pedidos
        </a>
        <div class="collapse submenu" id="submenuPedidos">
            <a class="nav-link" href="#" id="create-pedido-option">Crear</a>
            <a class="nav-link" href="#" id="delete-pedidos-option">Eliminar</a>
            <a class="nav-link" href="#" id="edit-orders-option">Editar</a>
        </div>

        <a class="nav-link px-3 py-2" href="#" id="products-menu" data-bs-toggle="collapse" data-bs-target="#submenuProductos" aria-expanded="false">
            Productos
        </a>
        <div class="collapse submenu" id="submenuProductos">
            <a class="nav-link" href="#" id="create-product-option">Crear</a>
            <a class="nav-link" href="#" id="delete-productos-option">Eliminar</a>
            <a class="nav-link" href="#" id="edit-products-option">Editar</a>
        </div>

        <!-- Menú Usuarios -->
        <a class="nav-link px-3 py-2" href="#" id="users-menu" data-bs-toggle="collapse" data-bs-target="#submenuUsuarios" aria-expanded="false">
            Usuarios
        </a>
        <div class="collapse submenu" id="submenuUsuarios">
            <a class="nav-link" href="#" id="create-user-option">Crear</a>
            <a class="nav-link" href="#" id="delete-users-option">Eliminar</a>
            <a class="nav-link" href="#" id="edit-users-option">Editar</a>
        </div>
    </nav>
</aside>

<section class="main-content">
    <h1>Bienvenido al Panel de Administración</h1>
    <p>Selecciona una opción del menú para empezar.</p>

    <!-- Contenedor de Usuarios -->
    <div id="user-list" style="display:none; margin-top: 20px;">
        <h2>Lista de Usuarios</h2>
        <button>Create User</button>
        <table id="users-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Correo Electrónico</th>
                    <th>Rol</th>
                    <th>Creado el</th>
                    <th>Imagen de Perfil</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Las filas se agregarán dinámicamente aquí -->
            </tbody>
            <tfoot>
                <!-- Fila para agregar un nuevo usuario -->
                <tr id="new-user-row" style="display: none;">
                    <td></td>
                    <td><input type="text" id="new-name" class="form-control" placeholder="Nombre"></td>
                    <td><input type="text" id="new-surnames" class="form-control" placeholder="Apellidos"></td>
                    <td><input type="text" id="new-username" class="form-control" placeholder="Usuario"></td>
                    <td><input type="email" id="new-email" class="form-control" placeholder="Correo"></td>
                    <td>
                        <select id="new-role" class="form-control">
                            <option value="admin">admin</option>
                            <option value="user">user</option>
                        </select>
                    </td>
                    <td><input type="password" id="new-password" class="form-control" placeholder="Contraseña"></td>
                    <td><input type="text" id="new-img-profile" class="form-control" placeholder="URL Imagen de Perfil"></td>
                    <td class="d-flex">
                        <button class="btn btn-success" id="create-user-btn">Crear</button>
                        <button class="btn btn-outline-danger" id="cancel-create-user-btn">Cancelar</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Contenedor de Productos -->
    <div id="product-list" style="display:none; margin-top: 20px;">
        <h2>Lista de Productos</h2>
        <table id="products-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Las filas se agregarán dinámicamente aquí -->
            </tbody>
            <tfoot>
                <!-- Fila para agregar un nuevo producto -->
                <tr id="new-product-row" style="display: none;">
                    <td></td>
                    <td><input type="text" id="new-product-name" class="form-control" placeholder="Nombre"></td>
                    <td><input type="number" id="new-product-price" class="form-control" placeholder="Precio"></td>
                    <td><input type="text" id="new-product-description" class="form-control" placeholder="Descripción"></td>
                    <td><input type="text" id="new-product-category" class="form-control" placeholder="Categoría"></td>
                    <td><input type="text" id="new-product-img" class="form-control" placeholder="URL Imagen"></td>
                    <td class="d-flex">
                        <button class="btn btn-success" id="create-product-btn">Crear</button>
                        <button class="btn btn-outline-danger" id="cancel-create-product-btn">Cancelar</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Contenedor de Pedidos -->
    <div id="pedido-list" style="display:none; margin-top: 20px;">
        <h2>Lista de Pedidos</h2>
        <table id="pedidos-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Productos</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Targeta de pago</th>
                    <th>Direccion</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Las filas se agregarán dinámicamente aquí -->
            </tbody>
            <tfoot>
                <!-- Fila para agregar un nuevo pedido -->
                <tr id="new-pedido-row" style="display: none;">
                    <td></td>
                    <td><input type="text" id="new-pedido-client" class="form-control" placeholder="Cliente"></td>
                    <td><input type="text" id="new-pedido-product" class="form-control" placeholder="Producto"></td>
                    <td><input type="number" id="new-pedido-quantity" class="form-control" placeholder="Cantidad"></td>
                    <td><input type="number" id="new-pedido-total" class="form-control" placeholder="Total"></td>
                    <td><input type="date" id="new-pedido-date" class="form-control" placeholder="Fecha"></td>
                    <td><input type="text" id="new-pedido-status" class="form-control" placeholder="Estado"></td>
                    <td class="d-flex">
                        <button class="btn btn-success" id="create-pedido-btn">Crear</button>
                        <button class="btn btn-cancel" id="cancel-create-pedido-btn">Cancelar</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</section>

<script>
    // Funciones para Usuarios
    document.getElementById('users-menu').addEventListener('click', function() {
        if (document.getElementById('users-menu').getAttribute('aria-expanded') === "true") {
            fetchUsers();
        } else {
            document.getElementById('user-list').style.display = 'none';
        }
    });

    document.getElementById("edit-users-option").addEventListener('click', function() {
        const tdElements = document.getElementsByClassName('actionColumnUser');
        Array.from(tdElements).forEach(element => {
            let editBtn = element.querySelector(".edit-btn");
            let deleteBtn = element.querySelector(".delete-btn");
            // Ocultar ambos botones
            editBtn.style.display = 'none';
            deleteBtn.style.display = 'none';
            // Mostrar solo el botón de editar
            editBtn.style.display = 'inline-block';
        });
    });

    document.getElementById("delete-users-option").addEventListener('click', function() {
        const tdElements = document.getElementsByClassName('actionColumnUser');
        Array.from(tdElements).forEach(element => {
            let editBtn = element.querySelector(".edit-btn");
            let deleteBtn = element.querySelector(".delete-btn");
            // Ocultar ambos botones
            editBtn.style.display = 'none';
            deleteBtn.style.display = 'none';
            // Mostrar solo el botón de eliminar
            deleteBtn.style.display = 'inline-block';
        });
    });

    // Funciones para Productos
    document.getElementById('products-menu').addEventListener('click', function() {
        if (document.getElementById('products-menu').getAttribute('aria-expanded') === "true") {
            fetchProducts();
        } else {
            document.getElementById('user-list').style.display = 'none';
        }
    });
    document.getElementById('create-product-option').addEventListener('click', function() {
        document.getElementById('new-product-row').style.display = 'table-row';
    });

    document.getElementById('cancel-create-product-btn').addEventListener('click', function() {
        document.getElementById('new-product-row').style.display = 'none';
    });

    document.getElementById('create-product-btn').addEventListener('click', createProduct);
    document.getElementById('products-table').addEventListener('click', deleteProduct);

    document.getElementById("edit-products-option").addEventListener('click', function() {
        const tdElements = document.getElementsByClassName('actionColumnProduct');
        Array.from(tdElements).forEach(element => {
            let editBtn = element.querySelector(".edit-btn");
            let deleteBtn = element.querySelector(".delete-btn");
            // Ocultar ambos botones
            editBtn.style.display = 'none';
            deleteBtn.style.display = 'none';
            // Mostrar solo el botón de editar
            editBtn.style.display = 'inline-block';
        });
    });

    document.getElementById("delete-productos-option").addEventListener('click', function() {
        const tdElements = document.getElementsByClassName('actionColumnProduct');
        Array.from(tdElements).forEach(element => {
            let editBtn = element.querySelector(".edit-btn");
            let deleteBtn = element.querySelector(".delete-btn");
            // Ocultar ambos botones
            editBtn.style.display = 'none';
            deleteBtn.style.display = 'none';
            // Mostrar solo el botón de eliminar
            deleteBtn.style.display = 'inline-block';
        });
    });

    // Funciones para Pedidos
    document.getElementById('orders-menu').addEventListener('click', function() {
        if (document.getElementById('orders-menu').getAttribute('aria-expanded') === "true") {
            fetchOrders();
        } else {
            document.getElementById('user-list').style.display = 'none';
        }
    });
    document.getElementById('create-pedido-option').addEventListener('click', function() {
        document.getElementById('new-pedido-row').style.display = 'table-row';
    });

    document.getElementById('cancel-create-pedido-option').addEventListener('click', function() {
        document.getElementById('new-pedido-row').style.display = 'none';
    });

    document.getElementById('create-pedido-btn').addEventListener('click', createPedido);
    document.getElementById('pedidos-table').addEventListener('click', deletePedido);

    document.getElementById("edit-orders-option").addEventListener('click', function() {
        const tdElements = document.getElementsByClassName('actionColumnOrder');
        Array.from(tdElements).forEach(element => {
            let editBtn = element.querySelector(".edit-btn");
            let deleteBtn = element.querySelector(".delete-btn");
            // Ocultar ambos botones
            editBtn.style.display = 'none';
            deleteBtn.style.display = 'none';
            // Mostrar solo el botón de editar
            editBtn.style.display = 'inline-block';
        });
    });

    document.getElementById("delete-orders-option").addEventListener('click', function() {
        const tdElements = document.getElementsByClassName('actionColumnOrder');
        Array.from(tdElements).forEach(element => {
            let editBtn = element.querySelector(".edit-btn");
            let deleteBtn = element.querySelector(".delete-btn");
            // Ocultar ambos botones
            editBtn.style.display = 'none';
            deleteBtn.style.display = 'none';
            // Mostrar solo el botón de eliminar
            deleteBtn.style.display = 'inline-block';
        });
    });

    // Fetch Usuarios
    function fetchUsers() {
        fetch('http://localhost/airrestaurant/api/api.php?modal=user', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status === 'Success') {
                    const usersTable = document.getElementById('users-table').querySelector('tbody');
                    usersTable.innerHTML = ''; // Limpiar filas

                    data.data.forEach(user => {
                        const row = document.createElement('tr');
                        let imageColumn = ''; // Variable para la columna de la imagen

                        // Si el usuario no tiene imagen de perfil, mostrar "No image"
                        if (user.img_profile == null) {
                            imageColumn = '<td>No image</td>';
                        } else {
                            // Si tiene imagen, mostrarla
                            imageColumn = `<td><img src="${user.img_profile}" alt="Profile" style="width: 50px; height: 50px; border-radius: 50%;"></td>`;
                        }
                        row.innerHTML = `
                        <td>${user.id}</td>
                        <td>${user.name}</td>
                        <td>${user.surnames}</td>
                        <td>${user.username}</td>
                        <td>${user.email}</td>
                        <td>${user.role}</td>
                        <td>${user.created_at}</td>
                        ${imageColumn}
                        <td class="actionColumnUser">
                            <button class="delete-btn btn btn-danger" style="display:none;" data-id="${user.id}">Eliminar</button>
                            <button class="edit-btn btn btn-warning" style="display:none;" data-id="${user.id}">Editar</button>
                        </td>
                    `;
                        usersTable.appendChild(row);
                    });
                    document.getElementById('user-list').style.display = 'block';
                }
            });
    }

    // Crear Usuario
    function createUser() {
        const name = document.getElementById('new-name').value;
        const surnames = document.getElementById('new-surnames').value;
        const username = document.getElementById('new-username').value;
        const email = document.getElementById('new-email').value;
        const role = document.getElementById('new-role').value;
        const password = document.getElementById('new-password').value;
        const imgProfile = document.getElementById('new-img-profile').value;

        if (!name || !surnames || !username || !email || !role || !password) {
            alert('Por favor complete todos los campos');
            return;
        }

        const userData = {
            username,
            name,
            surnames,
            email,
            role,
            password_hash: password,
            img_profile: imgProfile
        };

        fetch('http://localhost/airrestaurant/api/createUser', {
                method: 'POST',
                body: JSON.stringify(userData),
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(responseData => {
                if (responseData.status === 'success') {
                    alert('Usuario creado correctamente');
                    fetchUsers(); // Volver a cargar los usuarios
                } else {
                    alert('Error al crear el usuario');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al crear el usuario');
            });
    }

    // Eliminar Usuario
    function deleteUser(event) {
        if (event.target && event.target.classList.contains('delete-btn')) {
            const userId = event.target.getAttribute('data-id');
            if (confirm(`¿Seguro que quieres eliminar al usuario con ID ${userId}?`)) {
                fetch(`http://localhost/airrestaurant/api/deleteUser?id=${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(deleteResponse => {
                        if (deleteResponse.status === 'success') {
                            alert('Usuario eliminado correctamente');
                            event.target.closest('tr').remove();
                        } else {
                            alert('Error al eliminar el usuario');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error al eliminar el usuario');
                    });
            }
        }
    }

    // Funciones para Productos
    function fetchProducts() {
        fetch('http://localhost/airrestaurant/api/getProducts', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const productsTable = document.getElementById('products-table').querySelector('tbody');
                    productsTable.innerHTML = '';

                    data.data.forEach(product => {
                        const category = Array.isArray(product.category) && product.category.length > 0 ?
                            product.category.name :
                            "Sin categoría";

                        const imageSrc = product.images.length > 0 ?
                            product.images[0].photo_archive_name :
                            "placeholder.jpg"; // Imagen por defecto

                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.base_price}</td>
                    <td>${product.description}</td>
                    <td>${product.category.name}</td>
                    <td><img src="<?= url ?>/img/${imageSrc}" alt="Image" style="width: 50px; height: 50px;"></td>
                    <td class="actionColumnProduct">
                        <button class="delete-btn btn btn-danger" style="display:none;" data-id="${product.id}">Eliminar</button>
                        <button class="edit-btn btn btn-warning" style="display:none;" data-id="${product.id}">Editar</button>
                    </td>
                `;
                        productsTable.appendChild(row);
                    });
                    document.getElementById('product-list').style.display = 'block';
                }
            })
            .catch(error => {
                console.error("Error al obtener productos:", error);
                alert("Error al cargar los productos.");
            });
    }


    // Crear Producto
    function createProduct() {
        const name = document.getElementById('new-product-name').value;
        const price = document.getElementById('new-product-price').value;
        const description = document.getElementById('new-product-description').value;
        const category = document.getElementById('new-product-category').value;
        const img = document.getElementById('new-product-img').value;

        if (!name || !price || !description || !category || !img) {
            alert('Por favor complete todos los campos');
            return;
        }

        const productData = {
            name,
            price,
            description,
            category,
            img
        };

        fetch('http://localhost/airrestaurant/api/createProduct', {
                method: 'POST',
                body: JSON.stringify(productData),
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(responseData => {
                if (responseData.status === 'success') {
                    alert('Producto creado correctamente');
                    fetchProducts(); // Volver a cargar los productos
                } else {
                    alert('Error al crear el producto');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al crear el producto');
            });
    }

    // Eliminar Producto
    function deleteProduct(event) {
        if (event.target && event.target.classList.contains('delete-btn')) {
            const productId = event.target.getAttribute('data-id');
            if (confirm(`¿Seguro que quieres eliminar el producto con ID ${productId}?`)) {
                fetch(`http://localhost/airrestaurant/api/deleteProduct?id=${productId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(deleteResponse => {
                        if (deleteResponse.status === 'success') {
                            alert('Producto eliminado correctamente');
                            event.target.closest('tr').remove();
                        } else {
                            alert('Error al eliminar el producto');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error al eliminar el producto');
                    });
            }
        }
    }

    // Funciones para Pedidos
    function fetchOrders() {
        fetch('http://localhost/airrestaurant/api/getOrders', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const pedidosTable = document.getElementById('pedidos-table').querySelector('tbody');
                    pedidosTable.innerHTML = ''; // Limpiar filas

                    // Iterar sobre los pedidos
                    data.data.forEach(pedido => {
                        // Obtener el nombre del cliente
                        const client = pedido.user ? `${pedido.user.name} ${pedido.user.surnames}` : 'Cliente desconocido';

                        // Mostrar productos y cantidades
                        let productsHTML = '';
                        let totalQuantity = 0;
                        if (pedido.products && pedido.products.length > 0) {
                            pedido.products.forEach(product => {
                                // Agregar cada producto con su cantidad y precio
                                productsHTML += `<div>Producto: ${product.product.name}, Precio: ${product.custom_price}€, Cantidad: ${product.quantity}</div>`;
                                totalQuantity += product.quantity; // Calcular la cantidad total de productos
                            });
                        } else {
                            productsHTML = 'Sin productos';
                        }

                        // Obtener la tarjeta de pago (mostramos los últimos 4 dígitos)
                        const cardNumber = pedido.card ? pedido.card.cardNumber : 'N/A';

                        // Obtener la dirección (puede ser nula)
                        const address = pedido.address ? pedido.address.city + "," + pedido.address.address : 'Dirección no disponible';

                        // Crear la fila de la tabla
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${pedido.id}</td>
                            <td>${client}</td>
                            <td>${productsHTML}</td>
                            <td>${totalQuantity}</td>
                            <td>${pedido.order_price}€</td>
                            <td>${cardNumber}</td>
                            <td>${address}</td>
                            <td>${pedido.created_at}</td>
                            <td class="actionColumnOrder">
                                <button class="delete-btn btn btn-danger" data-id="${pedido.id}">Eliminar</button>
                                <button class="edit-btn btn btn-warning" data-id="${pedido.id}">Editar</button>
                            </td>
                        `;
                        pedidosTable.appendChild(row);
                    });

                    document.getElementById('pedido-list').style.display = 'block';
                }


            });
    }

    // Crear Pedido
    function createPedido() {
        const client = document.getElementById('new-pedido-client').value;
        const product = document.getElementById('new-pedido-product').value;
        const quantity = document.getElementById('new-pedido-quantity').value;
        const total = document.getElementById('new-pedido-total').value;
        const date = document.getElementById('new-pedido-date').value;
        const status = document.getElementById('new-pedido-status').value;

        if (!client || !product || !quantity || !total || !date || !status) {
            alert('Por favor complete todos los campos');
            return;
        }

        const pedidoData = {
            client,
            product,
            quantity,
            total,
            date,
            status
        };

        fetch('http://localhost/airrestaurant/api/createPedido', {
                method: 'POST',
                body: JSON.stringify(pedidoData),
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(responseData => {
                if (responseData.status === 'success') {
                    alert('Pedido creado correctamente');
                    fetchPedidos(); // Volver a cargar los pedidos
                } else {
                    alert('Error al crear el pedido');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al crear el pedido');
            });
    }

    // Eliminar Pedido
    function deletePedido(event) {
        if (event.target && event.target.classList.contains('delete-btn')) {
            const pedidoId = event.target.getAttribute('data-id');
            if (confirm(`¿Seguro que quieres eliminar el pedido con ID ${pedidoId}?`)) {
                fetch(`http://localhost/airrestaurant/api/deletePedido?id=${pedidoId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(deleteResponse => {
                        if (deleteResponse.status === 'success') {
                            alert('Pedido eliminado correctamente');
                            event.target.closest('tr').remove();
                        } else {
                            alert('Error al eliminar el pedido');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error al eliminar el pedido');
                    });
            }
        }
    }
</script>