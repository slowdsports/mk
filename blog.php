<?= (!isset($_GET['id']) ? '' : include('inc/post.php')); ?>
<div class="header-large-title">
    <h1 class="title">
        Blog Deportivo
    </h1>
    <h4 class="subtitle">
        Las mejores noticias solo aquí
    </h4>
</div>
<!-- Theme Toggle -->
<div class="section mt-2">
    <div class="row" id="posts">
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Obtener el elemento div con id "posts"
                const postsDiv = document.getElementById("posts");
                let articleId = 1;
                // Hacer una solicitud para obtener el archivo JSON desde la URL
                fetch("blog.json")
                    .then(response => response.json())
                    .then(blogDataArray => {
                        
                        // Iterar a través del arreglo de objetos en el JSON
                        blogDataArray.forEach(blogData => {
                            // Crear un div independiente con clase "col-6"
                            const colDiv = document.createElement("div");
                            colDiv.className = "col-6";
                            postsDiv.appendChild(colDiv);

                            // Crear un div con clase "card product-card"
                            const cardDiv = document.createElement("div");
                            cardDiv.className = "card product-card";
                            colDiv.appendChild(cardDiv);

                            // Crear un div con clase "card-body"
                            const cardBodyDiv = document.createElement("div");
                            cardBodyDiv.className = "card-body";
                            cardDiv.appendChild(cardBodyDiv);

                            // Crear un elemento img para la imagen del post
                            const imgElement = document.createElement("img");
                            imgElement.src = blogData.poster; // Cambia esto por la ruta de tu imagen
                            imgElement.className = "image";
                            imgElement.alt = "product image";
                            cardBodyDiv.appendChild(imgElement);

                            // Crear un elemento h2 para el título del producto
                            const titleElement = document.createElement("h2");
                            titleElement.className = "title";
                            titleElement.textContent = blogData.title;
                            cardBodyDiv.appendChild(titleElement);

                            // Crear un elemento p para la descripción del producto
                            const descriptionElement = document.createElement("p");
                            descriptionElement.className = "text";
                            descriptionElement.textContent = blogData.description;
                            cardBodyDiv.appendChild(descriptionElement);

                            // Crear un div para el precio del producto
                            const priceDiv = document.createElement("div");
                            priceDiv.className = "price";
                            priceDiv.textContent = "iRaffle TV";
                            cardBodyDiv.appendChild(priceDiv);

                            // Crear un enlace para agregar al carrito
                            const addToCartLink = document.createElement("a");
                            addToCartLink.href = "?p=blog&id="+articleId;
                            addToCartLink.className = "btn btn-sm btn-primary btn-block";
                            addToCartLink.textContent = "Leer Artículo";
                            cardBodyDiv.appendChild(addToCartLink);
                            articleId++;
                        });
                    })
                    .catch(error => {
                        console.error("Error al obtener el archivo JSON:", error);
                    });
            })
        </script>
    </div>
</div>