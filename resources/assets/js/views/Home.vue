<template>
	<div class="page-content-wrapper">
		<!-- <div class="container" >
            <div class="row">
                 <div class="col-sm-3 category" ><img src="/assets/img/icons/food.png"><b>Food</b></div>
                 <div class="col-sm-3 category" ><img src="/assets/img/icons/shoes.png"><b>Shoes</b></div>
                 <div class="col-sm-3 category" ><img src="/assets/img/icons/3457faa612fcf6ce7e890f49d7668dde.png"><b>Garden</b></div>
                 <div class="col-sm-3 category" ><img src="/assets/img/icons/070d4f4883d6b15dfa907538ce1f8f4c.png"><b>Accessories</b></div>
            </div>
            <div class="row" >
                 <div class="col-sm-3 category" ><img src="/assets/img/icons/electronics.png"><b>Technology</b></div>
                 <div class="col-sm-3 category" ><img src="/assets/img/icons/9d2d346f4f5ec17dcfdd3140a50b7b52.png"><b>Pets</b></div>
                 <div class="col-sm-3 category" ><img src="/assets/img/icons/aa5208104f48d59db4619e59a3163a02.png"><b>Fashion</b></div>
                 <div class="col-sm-3 category" ><img src="/assets/img/icons/furniture.png"><b>Furniture</b></div>
            </div>
		</div>-->
		<!-- <div style="text-align:center display:none;">
            <button type="button" style="background-color:#FADBD8;width:20px;height:10px"></button>
            <button type="button" style="width:20px;height:10px"></button>
		</div>-->
		<!-- <br> -->
		<!-- <div class="container" >
            <div class="row" >
                <b>Popular Groupbuy</b>
                <input type="button" value="" style="margin-left:120px;width: 10px; height: 10px; background-color:#CCD1D1;border-radius:50%;border: none">
                <input type="button" value="" style="margin-left:10px;width: 10px; height: 10px; border-radius:50%;border: none">
                <input type="button" value="" style="margin-left:10px;width: 10px; height: 10px; border-radius:50%;border: none">
            </div>
            <div class="row" >
                 <div class="col-sm-4"><img src="/assets/img/products/nike.png"> </div>
                 <div class="col-sm-4"><img src="/assets/img/products/watch.png"></div>
                 <div class="col-sm-4"><img src="/assets/img/products/e8ba93ee039ff306039bf5c85a8627df.png"></div>
            </div>
		</div>-->
		<!-- <br><br> -->
		<!-- <div class ="item prod" v-for="(product,index) in products" :key="index">
                  <router-link :to="{ path: '/products/'+product.id}">
                    <img :src="product.image" :alt="product.name">
                    <span class ="name" v-html="product.name"></span><br>
                    <div align="center"><span class="price">$ {{product.price}}</span></div>
                    <button class="col-md-4 btn btn-sm btn-primary float-right">Buy Now</button>
                  </router-link>
               
		</div>-->

		<!-- Product Catagories-->
		<div class="product-catagories-wrapper py-3">
			<div class="container">
				<div class="section-heading">
					<h6>Product Categories</h6>
				</div>
				<div class="product-catagory-wrap">
					<div class="row g-3">
						<!-- Single Catagory Card-->
						<div class="col-4">
							<div class="card catagory-card">
								<div class="card-body">
									<a class="text-danger" href="catagory.html">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="28"
											height="28"
											fill="currentColor"
											class="bi bi-heart mb-2"
											viewBox="0 0 16 16"
										>
											<path
												fill-rule="evenodd"
												d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"
											/>
										</svg>
										<span>Women's</span>
									</a>
								</div>
							</div>
						</div>
						<!-- Single Catagory Card-->
						<div class="col-4">
							<div class="card catagory-card">
								<div class="card-body">
									<a href="catagory.html">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="28"
											height="28"
											fill="currentColor"
											class="bi bi-cup mb-2"
											viewBox="0 0 16 16"
										>
											<path
												fill-rule="evenodd"
												d="M1 2a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v1h.5A1.5 1.5 0 0 1 16 4.5v7a1.5 1.5 0 0 1-1.5 1.5h-.55a2.5 2.5 0 0 1-2.45 2h-8A2.5 2.5 0 0 1 1 12.5V2zm13 10h.5a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.5-.5H14v8zM13 2H2v10.5A1.5 1.5 0 0 0 3.5 14h8a1.5 1.5 0 0 0 1.5-1.5V2z"
											/>
										</svg>
										<span>Juice</span>
									</a>
								</div>
							</div>
						</div>
						<!-- Single Catagory Card-->
						<div class="col-4">
							<div class="card catagory-card">
								<div class="card-body">
									<a class="text-warning" href="catagory.html">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="28"
											height="28"
											fill="currentColor"
											class="bi bi-egg-fried mb-2"
											viewBox="0 0 16 16"
										>
											<path
												fill-rule="evenodd"
												d="M13.665 6.113a1 1 0 0 1-.667-.977L13 5a4 4 0 0 0-6.483-3.136 1 1 0 0 1-.8.2 4 4 0 0 0-3.693 6.61 1 1 0 0 1 .2 1 4 4 0 0 0 6.67 4.087 1 1 0 0 1 1.262-.152 2.5 2.5 0 0 0 3.715-2.905 1 1 0 0 1 .341-1.113 2.001 2.001 0 0 0-.547-3.478zM14 5c0 .057 0 .113-.003.17a3.001 3.001 0 0 1 .822 5.216 3.5 3.5 0 0 1-5.201 4.065 5 5 0 0 1-8.336-5.109A5 5 0 0 1 5.896 1.08 5 5 0 0 1 14 5z"
											/>
											<circle cx="8" cy="8" r="3" />
										</svg>
										<span>Foods</span>
									</a>
								</div>
							</div>
						</div>
						<!-- Single Catagory Card-->
						<div class="col-4">
							<div class="card catagory-card">
								<div class="card-body">
									<a class="text-success" href="catagory.html">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="28"
											height="28"
											fill="currentColor"
											class="bi bi-controller mb-2"
											viewBox="0 0 16 16"
										>
											<path
												fill-rule="evenodd"
												d="M11.119 2.693c.904.19 1.75.495 2.235.98.407.408.779 1.05 1.094 1.772.32.733.599 1.591.805 2.466.206.875.34 1.78.364 2.606.024.815-.059 1.602-.328 2.21a1.42 1.42 0 0 1-1.445.83c-.636-.067-1.115-.394-1.513-.773a11.307 11.307 0 0 1-.739-.809c-.126-.147-.25-.291-.368-.422-.728-.804-1.597-1.527-3.224-1.527-1.627 0-2.496.723-3.224 1.527-.119.131-.242.275-.368.422-.243.283-.494.576-.739.81-.398.378-.877.705-1.513.772a1.42 1.42 0 0 1-1.445-.83c-.27-.608-.352-1.395-.329-2.21.024-.826.16-1.73.365-2.606.206-.875.486-1.733.805-2.466.315-.722.687-1.364 1.094-1.772.486-.485 1.331-.79 2.235-.98.932-.196 2.03-.292 3.119-.292 1.089 0 2.187.096 3.119.292zm-6.032.979c-.877.185-1.469.443-1.733.708-.276.276-.587.783-.885 1.465a13.748 13.748 0 0 0-.748 2.295 12.351 12.351 0 0 0-.339 2.406c-.022.755.062 1.368.243 1.776a.42.42 0 0 0 .426.24c.327-.034.61-.199.929-.502.212-.202.4-.423.615-.674.133-.156.276-.323.44-.505C4.861 9.97 5.978 9.026 8 9.026s3.139.943 3.965 1.855c.164.182.307.35.44.505.214.25.403.472.615.674.318.303.601.468.929.503a.42.42 0 0 0 .426-.241c.18-.408.265-1.02.243-1.776a12.354 12.354 0 0 0-.339-2.406 13.753 13.753 0 0 0-.748-2.295c-.298-.682-.61-1.19-.885-1.465-.264-.265-.856-.523-1.733-.708-.85-.179-1.877-.27-2.913-.27-1.036 0-2.063.091-2.913.27z"
											/>
											<path
												d="M11.5 6.026a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-7-2.5h1v3h-1v-3z"
											/>
											<path
												d="M3.5 6.526h3v1h-3v-1zM3.051 3.26a.5.5 0 0 1 .354-.613l1.932-.518a.5.5 0 0 1 .258.966l-1.932.518a.5.5 0 0 1-.612-.354zm9.976 0a.5.5 0 0 0-.353-.613l-1.932-.518a.5.5 0 1 0-.259.966l1.932.518a.5.5 0 0 0 .612-.354z"
											/>
										</svg>
										<span>Sports</span>
									</a>
								</div>
							</div>
						</div>
						<!-- Single Catagory Card-->
						<div class="col-4">
							<div class="card catagory-card">
								<div class="card-body">
									<a class="text-danger" href="catagory.html">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="28"
											height="28"
											fill="currentColor"
											class="bi bi-earbuds mb-2"
											viewBox="0 0 16 16"
										>
											<path
												fill-rule="evenodd"
												d="M6.825 4.138c.596 2.141-.36 3.593-2.389 4.117a4.432 4.432 0 0 1-2.018.054c-.048-.01.9 2.778 1.522 4.61l.41 1.205a.52.52 0 0 1-.346.659l-.593.19a.548.548 0 0 1-.69-.34L.184 6.99c-.696-2.137.662-4.309 2.564-4.8 2.029-.523 3.402 0 4.076 1.948zm-.868 2.221c.43-.112.561-.993.292-1.969-.269-.975-.836-1.675-1.266-1.563-.43.112-.561.994-.292 1.969.269.975.836 1.675 1.266 1.563zm3.218-2.221c-.596 2.141.36 3.593 2.389 4.117a4.434 4.434 0 0 0 2.018.054c.048-.01-.9 2.778-1.522 4.61l-.41 1.205a.52.52 0 0 0 .346.659l.593.19c.289.092.6-.06.69-.34l2.536-7.643c.696-2.137-.662-4.309-2.564-4.8-2.029-.523-3.402 0-4.076 1.948zm.868 2.221c-.43-.112-.561-.993-.292-1.969.269-.975.836-1.675 1.266-1.563.43.112.561.994.292 1.969-.269.975-.836 1.675-1.266 1.563z"
											/>
										</svg>
										<span>Gadget</span>
									</a>
								</div>
							</div>
						</div>
						<!-- Single Catagory Card-->
						<div class="col-4">
							<div class="card catagory-card">
								<div class="card-body">
									<a class="text-info" href="catagory.html">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="28"
											height="28"
											fill="currentColor"
											class="bi bi-brightness-high mb-2"
											viewBox="0 0 16 16"
										>
											<path
												fill-rule="evenodd"
												d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"
											/>
										</svg>
										<span>Travel</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Top Products-->
		<div class="top-products-area clearfix py-3">
			<div class="container">
				<div class="section-heading d-flex align-items-center justify-content-between">
					<h6>Top Products</h6>
					<a class="btn btn-danger btn-sm" href="shop-grid.html">View All</a>
				</div>
				<div class="row g-3">
					<!-- Single Top Product Card-->
					<div class="col-6 col-md-4 col-lg-3" v-for="(product,index) in products" :key="index">
						<div class="card top-product-card">
							<router-link class="card-body" :to="{ path: '/products/'+product.id}">
								<span class="badge badge-success">Pending</span>
								<a class="wishlist-btn" href="#">
									<i class="lni lni-heart"></i>
								</a>
								<a class="product-thumbnail d-block" >
									<img class="mb-2" :src="product.image" :alt="product.name" />
								</a>
								<a class="product-title d-block" v-html="product.name">
									
								</a>
								<p class="sale-price">
									{{product.price}}
								</p>
							</router-link>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</template>

<script>
export default {
	data() {
		return {
			products: []
		};
	},
	mounted() {
		axios
			.get("api/products/")
			.then(response => (this.products = response.data));
	}
};
</script>

<style scoped>
.col-sm-3 {
	float: center;
	display: block;
	background-color: #f4f4f4;
	width: 22%;
	height: 15%;
	margin-left: 9px;
	margin-top: 5px;
	text-align: center;
}
.col-sm-3 img {
	min-height: 60%;
	max-height: 60%;
	min-width: 60%;
	max-width: 60%;
	text-align: center;
}
.col-sm-4 {
	margin-left: 5%;
	width: 26%;
	height: 15%;
	background-color: #f4f4f4;
}

.col-sm-4 img {
	min-height: 70%;
	max-height: 70%;
	min-width: 100%;
	max-width: 100%;
}

.item.prod {
	float: left;
	display: block;
	background-color: #fbeee6;
	width: 45%;
	height: 15%;
	margin-left: 13px;
	margin-top: 10px;
}

.item.prod img {
	min-height: 70%;
	max-height: 70%;
	min-width: 100%;
	max-width: 100%;
}
.item.prod .name {
	font-size: 12px;
	color: red;
}

.item.prod .price {
	font-size: 14px;
	font-weight: bold;
	color: black;
}

.category b {
	font-size: 10px;
}
</style>
