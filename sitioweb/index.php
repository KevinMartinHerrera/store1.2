<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id,name, price FROM product Where active=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

?>



<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link rel="stylesheet" href="main.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>

<body>
    <!--Barra de navegación-->
    
    <header>
    <div class="container-hero">
        <div class="container hero">
            <div class="customer-support">
                <i class="fa-solid fa-headset"></i>
                <div class="content-customer-support">
                    <span class="text">Soporte al cliente</span>
                    <span class="number">123-456-7890</span>
                </div>
            </div>

            <div class="container-logo">
                <i class="fa-solid fa-mug-hot"></i>
                <h1 class="logo"><a href="index.php">MiBerriozábal</a></h1>
            </div>

            
            <div>
            <a href="checkout.php" class="btn btn-primary">
                 Carrito<span id="num_cart" class="badbge bg-secondary"><?php echo $num_cart; ?></span></a>
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if(!isset($_SESSION['user'])){
                    echo '<a href="login/index.php" class="btn btn-primary">Iniciar sesión</a>';
            }else{
                echo '<a href="index.php" class="btn btn-primary" >Salir</a>';
                session_destroy();
            }
            ?>
            <script>
              // Detecta el clic en el botón de inicio de sesión y cambia la URL del botón
                document.getElementById("login-button").addEventListener("click", function() {
                this.href = "login/index.php";
                } );
            </script>
            </div>
              
            </div>
        </div>
    </div>

    <div class="container-navbar" id ="i">
        <nav class="navbar container">
            <i class="fa-solid fa-bars"></i>
            <ul class="menu">
                <li><a href="#i">Inicio</a></li>
                <li><a href="#c">Categorias</a></li>
                <li><a href="#p">Mejores Productos</a></li>
                <li><a href="#o">Opiniones</a></li>
                <li><a href="#f">Acerca De Nosotros</a></li>
            </ul>

            <form class="search-form">
                <input type="search" placeholder="Buscar..." />
                <button class="btn-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </nav>
    </div>
</header>

<section class="banner">
  <div class="content-banner">
    <img src="images/miBerriozabal.png" alt="">
    <p>Productos que desees</p>
    <h2>100% Chiapaneco <br />Berriozabal y sus alrededores</h2>
    <a href="#">Comprar ahora</a>
  </div>
</section>


    <!--Contenido-->
    <main class="main-content">
    <section class="container container-features">
				<div class="card-feature">
					<i class="fa-solid fa-plane-up"></i>
					<div class="feature-content">
						<span>Envío gratuito a Tuxtla y sus alrededores</span>
						<p>En pedido superior a $150</p>
					</div>
				</div>
				<div class="card-feature">
					<i class="fa-solid fa-wallet"></i>
					<div class="feature-content">
						<span>Contrareembolso</span>
						<p>100% garantía de devolución de dinero</p>
					</div>
				</div>
				<div class="card-feature">
					<i class="fa-solid fa-gift"></i>
					<div class="feature-content">
						<span>Tarjeta regalo especial</span>
						<p>Ofrece bonos especiales con regalo</p>
					</div>
				</div>
				<div class="card-feature">
					<i class="fa-solid fa-headset"></i>
					<div class="feature-content">
						<span>Servicio al cliente 24/7</span>
						<p>LLámenos 24/7 al 123-456-7890</p>
					</div>
				</div>
			</section>

			<section class="container top-categories" id= "c">
				<h1 class="heading-1">Mejores Categorías</h1>
				<div class="container-categories">
					<div class="card-category category-moca">
						<p>JUGUETES</p>
						<span>Ver más</span>
					</div>
					<div class="card-category category-expreso">
						<p>ELECTRODOMESTICOS</p>
						<span>Ver más</span>
					</div>
					<div class="card-category category-capuchino">
						<p>ELECTRONICOS</p>
						<span>Ver más</span>aa
					</div>
				</div>
			</section>
            <section class="container top-products">
				<h1 class="heading-1">Mejores Productos</h1>

				<div class="container-options">
					<span class="active">Destacados</span>
					<span>Más recientes</span>
					<span>Mejores Vendidos</span>
				</div>

 

        <div class="container" id ="p">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($resultado as $row) { ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <?php
                            $id = $row['id'];
                            $imagen = "images/products/" . $id . "/principal.jpg";
                            if (!file_exists($imagen)) {
                                $imagen = "images/nophoto.jpg";
                            }
                            ?>
                            <img src="<?php echo $imagen; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text"><?php echo number_format($row['price'], 2, '.', ','); ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="details.php?id=<?php echo $row['id']; ?>&token=<?php echo
                                                                                                hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>" class="btn 
                                        btn-primary">Detalles</a>
                                    </div>
                                    <?php
                                        if(isset($_SESSION['user'])){
                                            echo '<button class="btn btn-outline-success" type="button" onclick="addProducto(' . $row['id'] . ', \'' . hash_hmac('sha1', $row['id'], KEY_TOKEN) . '\')"> Agregar al carrito </button>';
                                        } else {
                                            echo '<a href="login/index.php" class="btn btn-success">Agregar</a>';
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <section class="container blogs">
				<h1 class="heading-1" id = "o">Opiniones</h1>

				<div class="container-blogs">
					<div class="card-blog">
						<div class="container-img">
						
							<div class="button-group-blog">
								<span>
									<i class="fa-solid fa-magnifying-glass"></i>
								</span>
								<span>
									<i class="fa-solid fa-link"></i>
								</span>
							</div>
						</div>
						<div class="content-blog">
							<h3>Marty Hernan Lopez Ramirez </h3>
							<span>22 Noviembre 2022</span>
							<p>
								es una tienda donde encuentras lo que deseas, tiene precios muy accesibles
                                y lo mejor es que hacem envios gratis desde un monto 
                                muy bajo 
							</p>
							<div class="btn-read-more">Leer más</div>
						</div>
					</div>
					<div class="card-blog">
						<div class="container-img">
							
							<div class="button-group-blog">
								<span>
									<i class="fa-solid fa-magnifying-glass"></i>
								</span>
								<span>
									<i class="fa-solid fa-link"></i>
								</span>
							</div>
						</div>
						<div class="content-blog">
							<h3>Kevin Martin Morales Herrera</h3>
							<span>203 de abril del 2023</span>
							<p>
								la calidad de los prductos muy buenos,
                                estaba buscando el producto y solo en esta tienda encontre los productos indicados
                                gran servicio
							</p>
							<div class="btn-read-more">Leer más</div>
						</div>
					</div>
					<div class="card-blog">
						<div class="container-img">
							
							<div class="button-group-blog">
								<span>
									<i class="fa-solid fa-magnifying-glass"></i>
								</span>
								<span>
									<i class="fa-solid fa-link"></i>
								</span>
							</div>
						</div>
						<div class="content-blog">
							<h3>Lorena Ballines</h3>
							<span>03 de octubre 2022</span>
							<p>
								la tienda en linea me gusto mucho, es una tienda muy completa
                                y el dueño es muy guapo, saludos a mijito ERICK|
							</p>
							<div class="btn-read-more">Leer más</div>
						</div>
					</div>
				</div>
			</section>
		</main>

		<footer class="footer" id = "f">
			<div class="container container-footer">
				<div class="menu-footer">
					<div class="contact-info">
						<p class="title-footer">Información de Contacto</p>
						<ul>
							<li>
								Dirección: 71 Pennington Lane Vernon Rockville, CT
								06066
							</li>
							<li>Teléfono: 123-456-7890</li>
							<li>Fax: 55555300</li>
							<li>EmaiL: ejempo@support.com</li>
						</ul>
						<div class="social-icons">
							<span class="facebook">
								<i class="fa-brands fa-facebook-f"></i>
							</span>
							<span class="twitter">
								<i class="fa-brands fa-twitter"></i>
							</span>
							<span class="youtube">
								<i class="fa-brands fa-youtube"></i>
							</span>
							<span class="pinterest">
								<i class="fa-brands fa-pinterest-p"></i>
							</span>
							<span class="instagram">
								<i class="fa-brands fa-instagram"></i>
							</span>
						</div>
					</div>

					<div class="information">
						<p class="title-footer">Información</p>
						<ul>
							<li><a href="#">Acerca de Nosotros</a></li>
							<li><a href="#">Información Delivery</a></li>
							<li><a href="#">Politicas de Privacidad</a></li>
							<li><a href="#">Términos y condiciones</a></li>
							<li><a href="#">Contactános</a></li>
						</ul>
					</div>

					<div class="my-account">
						<p class="title-footer">Mi cuenta</p>

						<ul>
							<li><a href="#">Mi cuenta</a></li>
							<li><a href="#">Historial de ordenes</a></li>
							<li><a href="#">Lista de deseos</a></li>
							<li><a href="#">Boletín</a></li>
							<li><a href="#">Reembolsos</a></li>
						</ul>
					</div>

					<div class="newsletter">
						<p class="title-footer">Boletín informativo</p>

						<div class="content">
							<p>
								Suscríbete a nuestros boletines ahora y mantente al
								día con nuevas colecciones y ofertas exclusivas.
							</p>
							<input type="email" placeholder="Ingresa el correo aquí...">
							<button>Suscríbete</button>
						</div>
					</div>
				</div>

				<div class="copyright">
					<p>
						Miberriozabal &copy; 2022
					</p>

					<img src="img/payment.png" alt="Pagos">
				</div>
			</div>
		</footer>

		<script
			src="https://kit.fontawesome.com/81581fb069.js"
			crossorigin="anonymous"
		></script>
	</body>
    <script>
        function addProducto(id, token) {
            let url = 'clases/carrito.php'
            let formData = new FormData()
            formData.append('id', id)
            formData.append('token', token)

            fetch(url, {
                    method: 'POST',
                    body: formData,
                    mode: 'cors'
                }).then(response => response.json())
                .then(data => {
                    if (data.ok) {
                        let elemento = document.getElementById("num_cart")
                        elemento.innerHTML = data.numero
                    }
                })
        }
    </script>

</body>

</html>