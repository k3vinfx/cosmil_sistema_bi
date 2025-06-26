<?php include 'header.php'; ?>

<main class="main-content">
    <style>
    /* Estilos para el contenido principal */
    .main-content {
        padding: 2rem 0;
    }
    
    /* Hero Section */
    .hero {
        position: relative;
        height: 500px;
        overflow: hidden;
        margin-bottom: 3rem;
    }
    
    .hero img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .hero-content {
        position: absolute;
        top: 50%;
        left: 10%;
        transform: translateY(-50%);
        color: white;
        max-width: 500px;
    }
    
    .hero-content span {
        display: inline-block;
        background-color: var(--secondary);
        color: var(--dark);
        padding: 0.25rem 1rem;
        border-radius: 2rem;
        margin-bottom: 1rem;
        font-weight: bold;
    }
    
    .hero-content h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
        line-height: 1.2;
    }
    
    /* Secciones */
    .section-title {
        font-size: 2rem;
        margin-bottom: 2rem;
        position: relative;
        padding-bottom: 0.5rem;
        text-align: center;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background-color: var(--primary);
    }
    
    /* Grid de categorías */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }
    
    .category-card {
        text-decoration: none;
        color: var(--dark);
        transition: transform 0.3s;
        text-align: center;
    }
    
    .category-card:hover {
        transform: translateY(-5px);
    }
    
    .category-card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 0.5rem;
        margin-bottom: 0.5rem;
    }
    
    .category-card h3 {
        font-size: 1.1rem;
    }
    
    /* Grid de productos */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }
    
    .product-card {
        background-color: white;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: transform 0.3s, box-shadow 0.3s;
        position: relative;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }
    
    .product-badges {
        position: absolute;
        top: 1rem;
        left: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        z-index: 1;
    }
    
    .badge {
        padding: 0.25rem 0.75rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: bold;
        color: white;
    }
    
    .badge.new {
        background-color: var(--success);
    }
    
    .badge.discount {
        background-color: var(--danger);
    }
    
    .product-image {
        display: block;
        height: 200px;
        overflow: hidden;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    
    .product-card:hover .product-image img {
        transform: scale(1.05);
    }
    
    .product-info {
        padding: 1rem;
    }
    
    .product-title {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        color: var(--dark);
    }
    
    .product-price {
        margin-bottom: 1rem;
    }
    
    .current-price {
        font-size: 1.25rem;
        font-weight: bold;
        color: var(--primary);
    }
    
    .old-price {
        font-size: 0.9rem;
        text-decoration: line-through;
        color: var(--gray);
        margin-left: 0.5rem;
    }
    
    .product-actions {
        display: flex;
        gap: 0.5rem;
    }
    
    .btn-wishlist {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--light);
        border: none;
        color: var(--dark);
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-wishlist:hover {
        color: var(--danger);
        background-color: #fee2e2;
    }
    
    .btn-add-cart {
        flex-grow: 1;
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 0.25rem;
        padding: 0 1rem;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    .btn-add-cart:hover {
        background-color: var(--primary-dark);
    }
    
    /* Banner promocional */
    .promo-banner {
        background-color: var(--primary);
        color: white;
        padding: 4rem 2rem;
        text-align: center;
        border-radius: 0.5rem;
        margin-bottom: 3rem;
        background-image: linear-gradient(to right, var(--primary), var(--primary-dark));
    }
    
    .promo-banner h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .promo-banner p {
        font-size: 1.25rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }
    
    .promo-banner .btn {
        background-color: white;
        color: var(--primary);
        font-weight: bold;
    }
    
    .promo-banner .btn:hover {
        background-color: var(--light);
        color: var(--primary-dark);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .hero {
            height: 400px;
        }
        
        .hero-content {
            left: 5%;
        }
        
        .hero-content h1 {
            font-size: 2rem;
        }
        
        .categories-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
        
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }
    </style>

    <!-- Hero Slider -->
    <section class="hero">
        <div class="hero-slider">
            <div class="slide active">
                <img src="https://images.unsplash.com/photo-1510557880182-3d4d3cba35a5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Smartphones en oferta" loading="lazy">
                <div class="hero-content">
                    <span>Hasta 50% OFF</span>
                    <h1>Nuevos Smartphones</h1>
                    <a href="category.php?cat=smartphones" class="btn">Comprar Ahora</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Categorías destacadas -->
    <section class="featured-categories container">
        <h2 class="section-title">Explora por Categoría</h2>
        <div class="categories-grid">
            <a href="category.php?cat=laptops" class="category-card">
                <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1632&q=80" alt="Laptops" loading="lazy">
                <h3>Laptops</h3>
            </a>
            <a href="category.php?cat=smartphones" class="category-card">
                <img src="https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1567&q=80" alt="Smartphones" loading="lazy">
                <h3>Smartphones</h3>
            </a>
            <a href="category.php?cat=tvs" class="category-card">
                <img src="https://images.unsplash.com/photo-1593784991095-a205069470b6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Televisores" loading="lazy">
                <h3>Televisores</h3>
            </a>
            <a href="category.php?cat=audio" class="category-card">
                <img src="https://images.unsplash.com/photo-1590658268037-6bf12165a8df?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1632&q=80" alt="Audio" loading="lazy">
                <h3>Audio</h3>
            </a>
        </div>
    </section>

    <!-- Productos destacados -->
    <section class="featured-products container">
        <div class="section-header flex" style="justify-content: space-between; align-items: center;">
            <h2 class="section-title">Productos Destacados</h2>
            <a href="shop.php" class="btn" style="background: transparent; color: var(--primary); border: 1px solid var(--primary);">Ver todos</a>
        </div>
        
        <div class="products-grid">
            <div class="product-card">
                <div class="product-badges">
                    <span class="badge new">Nuevo</span>
                    <span class="badge discount">-15%</span>
                </div>
                
                <a href="product.php?id=1" class="product-image">
                    <img src="https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="iPhone 13 Pro" loading="lazy">
                </a>
                
                <div class="product-info">
                    <h3 class="product-title">iPhone 13 Pro</h3>
                    <div class="product-price">
                        <span class="current-price">$999.00</span>
                        <span class="old-price">$1,149.00</span>
                    </div>
                    
                    <div class="product-actions">
                        <button class="btn-wishlist" aria-label="Añadir a lista de deseos">
                            <i class="far fa-heart"></i>
                        </button>
                        <button class="btn-add-cart">Añadir al carrito</button>
                    </div>
                </div>
            </div>
            
            <!-- Más productos... -->
        </div>
    </section>

    <!-- Banner promocional -->
    <section class="promo-banner container">
        <div class="banner-content">
            <h2>Envío Gratis</h2>
            <p>En compras mayores a $50</p>
            <a href="shop.php" class="btn">Comprar Ahora</a>
        </div>
    </section>
</main>

