<template>
	<div class="page-content-wrapper">
		<!-- Top Products-->
		<div class="top-products-area py-3">
			<div class="container">
				<div class="row g-3 watchlist-views" >
					<!-- Single Catagory Card-->
					<div class="col-4">
						<div class="card catagory-card">
							<div class="card-body">
								<a class="text-danger" href="catagory.html">
									<span>Groupbuy</span>
								</a>
							</div>
						</div>
					</div>
					<!-- Single Catagory Card-->
					<div class="col-4">
						<div class="card catagory-card">
							<div class="card-body">
								<a href="catagory.html">
									<span>Watchlist</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="section-heading d-flex align-items-center justify-content-between">
					<h6>Your Wishlist (4)</h6>
					<!-- Layout Options-->
					<div class="layout-options">
						<a href="wishlist-grid.html">
							<i class="lni lni-grid-alt"></i>
						</a>
						<a class="active" href="wishlist-list.html">
							<i class="lni lni-radio-button"></i>
						</a>
					</div>
				</div>
				<div class="row g-3">
					<!-- Single Weekly Product Card-->
					<div class="col-12 col-md-6">
						<div class="card weekly-product-card">
							<div class="card-body d-flex align-items-center">
								<div class="product-thumbnail-side">
									<span class="badge badge-success">Sale</span>
									<a class="wishlist-btn" href="#">
										<i class="lni lni-heart"></i>
									</a>
									<a class="product-thumbnail d-block" href="single-product.html">
										<img src="img/product/10.png" alt />
									</a>
								</div>
								<div class="product-description">
									<a class="product-title d-block" href="single-product.html">Modern Red Sofa</a>
									<p class="sale-price">
										<i class="lni lni-dollar"></i>$64
										<span>$89</span>
									</p>
									<div class="product-rating">
										<i class="lni lni-star-filled"></i>4.88 (39)
									</div>
									<a class="btn btn-success btn-sm" href="#">
										<i class="me-1 lni lni-cart"></i>Buy Now
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- Single Weekly Product Card-->
					<div class="col-12 col-md-6">
						<div class="card weekly-product-card">
							<div class="card-body d-flex align-items-center">
								<div class="product-thumbnail-side">
									<span class="badge badge-primary">Sale</span>
									<a class="wishlist-btn" href="#">
										<i class="lni lni-heart"></i>
									</a>
									<a class="product-thumbnail d-block" href="single-product.html">
										<img src="img/product/7.png" alt />
									</a>
								</div>
								<div class="product-description">
									<a class="product-title d-block" href="single-product.html">Office Chair</a>
									<p class="sale-price">
										<i class="lni lni-dollar"></i>$100
										<span>$160</span>
									</p>
									<div class="product-rating">
										<i class="lni lni-star-filled"></i>4.82 (125)
									</div>
									<a class="btn btn-success btn-sm" href="#">
										<i class="me-1 lni lni-cart"></i>Buy Now
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- Single Weekly Product Card-->
					<div class="col-12 col-md-6">
						<div class="card weekly-product-card">
							<div class="card-body d-flex align-items-center">
								<div class="product-thumbnail-side">
									<span class="badge badge-danger">-10%</span>
									<a class="wishlist-btn" href="#">
										<i class="lni lni-heart"></i>
									</a>
									<a class="product-thumbnail d-block" href="single-product.html">
										<img src="img/product/12.png" alt />
									</a>
								</div>
								<div class="product-description">
									<a class="product-title d-block" href="single-product.html">Sun Glasses</a>
									<p class="sale-price">
										<i class="lni lni-dollar"></i>$24
										<span>$32</span>
									</p>
									<div class="product-rating">
										<i class="lni lni-star-filled"></i>4.79 (63)
									</div>
									<a class="btn btn-success btn-sm" href="#">
										<i class="me-1 lni lni-cart"></i>Buy Now
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- Single Weekly Product Card-->
					<div class="col-12 col-md-6">
						<div class="card weekly-product-card">
							<div class="card-body d-flex align-items-center">
								<div class="product-thumbnail-side">
									<span class="badge badge-warning">New</span>
									<a class="wishlist-btn" href="#">
										<i class="lni lni-heart"></i>
									</a>
									<a class="product-thumbnail d-block" href="single-product.html">
										<img src="img/product/13.png" alt />
									</a>
								</div>
								<div class="product-description">
									<a class="product-title d-block" href="single-product.html">Wall Clock</a>
									<p class="sale-price">
										<i class="lni lni-dollar"></i>$31
										<span>$47</span>
									</p>
									<div class="product-rating">
										<i class="lni lni-star-filled"></i>4.99 (7)
									</div>
									<a class="btn btn-success btn-sm" href="#">
										<i class="me-1 lni lni-cart"></i>Buy Now
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- Select All Products-->
					<div class="col-12">
						<div class="select-all-products-btn">
							<a class="btn btn-danger w-100" href="#">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="14"
									height="14"
									fill="currentColor"
									class="bi bi-cart-check me-1"
									viewBox="0 0 16 16"
								>
									<path
										d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"
									/>
									<path
										d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"
									/>
								</svg>Add All To Cart
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style scoped>
.watchlist-views {
    justify-content: center;
}
</style>