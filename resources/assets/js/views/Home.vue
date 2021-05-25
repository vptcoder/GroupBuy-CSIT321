<template>
	<div class="page-content-wrapper" style="background-color: #f4f3ee;">
		<!-- Product Catagories-->
		<div class="product-catagories-wrapper py-3">
			<div class="container">
				<div class="section-heading">
					<h6>Categories</h6>
				</div>

				<div class="product-catagory-wrap">
					<div class="row g-3">
						<!-- Single Catagory Card-->
						<div class="col-4">
							<div class="card catagory-card">
								<div class="card-body">
									<a class="text-danger" href="catagory.html">
										<img src="https://img.icons8.com/windows/32/000000/sofa.png" />
										<span>Furniture</span>
									</a>
								</div>
							</div>
						</div>
						<!-- Single Catagory Card-->
						<div class="col-4">
							<div class="card catagory-card">
								<div class="card-body">
									<a href="catagory.html">
										<img src="https://img.icons8.com/windows/32/000000/dining-room.png" />
										<span>Food</span>
									</a>
								</div>
							</div>
						</div>
						<!-- Single Catagory Card-->
						<div class="col-4">
							<div class="card catagory-card">
								<div class="card-body">
									<a class="text-warning" href="catagory.html">
										<!-- <i class = "lni lni-burger"></i>-->
										<img src="https://img.icons8.com/windows/32/000000/basketball.png" />
										<span>Sports</span>
									</a>
								</div>
							</div>
						</div>
						<!-- Single Catagory Card-->
						<div class="col-4">
							<div class="card catagory-card">
								<div class="card-body">
									<a class="text-success" href="catagory.html">
										<img src="https://img.icons8.com/windows/32/000000/red-felt-hat.png" />
										<span>Hats</span>
									</a>
								</div>
							</div>
						</div>
						<!-- Single Catagory Card-->
						<div class="col-4">
							<div class="card catagory-card">
								<div class="card-body">
									<a class="text-danger" href="catagory.html">
										<img src="https://img.icons8.com/windows/32/000000/smartphone-tablet.png" />
										<span>Gadgets</span>
									</a>
								</div>
							</div>
						</div>
						<!-- Single Catagory Card-->
						<div class="col-4">
							<div class="card catagory-card">
								<div class="card-body">
									<a class="text-info" href="catagory.html">
										<img src="https://img.icons8.com/windows/32/000000/hanger.png" />
										<span>Fashion</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- XR POP Product Slides-->
		<div class="flash-sale-wrapper">
			<div class="container">
				<div class="section-heading d-flex align-items-center justify-content-between">
					<h6 class="me-1 d-flex align-items-center">
 
						Popular Products
					</h6>
				</div>
			</div>
		</div>
			<carousel :items="1" :autoplay="false" :nav="false" :dots="true" >
				<div class = "neatifyCarousel">
					<div class="row g-3">
						<div class="col-4 col-md-2 col-lg" v-for="(product,index) in popularProducts.slice(0,3)" :key="index">
							<div class="card top-product-card">
								<router-link
									:to="{ path: '/products/'+product.id}"
									class="card-body align-items-center"
								>
									<span class="badge badge-pending">HOT</span>

									<a class="product-thumbnail d-block">
											<img class="mb-2" :src="product.product_image" :alt="product.product_name" />
									</a>
									<a class="product-title d-block" style="font-size:12px;">{{product.product_name}}</a>
									<p class="sale-price" style="font-size:16px;">
											${{parseFloat(product.product_price).toFixed(2)}}
									</p>
									<span class="progress-title" style="font-size:14px; color:#8a817c;">{{product.watchlists.length}} sold</span>
								</router-link>
							</div>
						</div>
					</div>
				</div>
				<div class="neaitfyCarousel">
					<div class="row g-3">
						<div class="col-4 col-md-2 col-lg" v-for="(product,index) in popularProducts.slice(3,6)" :key="index">
							<div class="card top-product-card">
								<router-link
									:to="{ path: '/products/'+product.id}"
									class="card-body align-items-center"
								>
									<span class="badge badge-pending">HOT</span>

									<a class="product-thumbnail d-block">
											<img class="mb-2" :src="product.product_image" :alt="product.product_name" />
									</a>
									<a class="product-title d-block">{{product.product_name}}</a>
									<p class="sale-price">
											${{parseFloat(product.product_price).toFixed(2)}}
									</p>
									<span class="progress-title" style="font-size:14px; color:#8a817c;">{{product.watchlists.length}} sold</span>
								</router-link>
							</div>
						</div>
					</div>
				</div>
				<div class="neaitfyCarousel">
					<div class="row g-3">
						<div class="col-4 col-md-2 col-lg" v-for="(product,index) in popularProducts.slice(6,9)" :key="index">
							<div class="card top-product-card">
								<router-link
									:to="{ path: '/products/'+product.id}"
									class="card-body align-items-center"
								>
									<span class="badge badge-pending">HOT</span>

									<a class="product-thumbnail d-block">
											<img class="mb-2" :src="product.product_image" :alt="product.product_name" />
									</a>
									<a class="product-title d-block">{{product.product_name}}</a>
									<p class="sale-price">
											${{parseFloat(product.product_price).toFixed(2)}}
									</p>
									<span class="progress-title" style="font-size:14px; color:#8a817c;">{{product.watchlists.length}} sold</span>
								</router-link>
							</div>
						</div>
					</div>
				</div>
			</carousel>
 
		<!-- All Products-->
		<div class="top-products-area clearfix py-3">
			<div class="container">
				<div class="section-heading d-flex align-items-center justify-content-between">
					<h6>All Products</h6>
					<!-- <a class="btn btn-danger btn-sm" href="shop-grid.html">View All</a> -->
				</div>
				<div class="row g-3">
					<!-- Single Top Product Card-->
					<div class="col-6 col-md-4 col-lg-3" v-for="(product,index) in products" :key="index">
						<div v-if="product.groupbuy_id == null" class="card top-product-card">
							<router-link class="card-body" :to="{ path: '/products/'+product.id}">
								<span class="badge badge-pending">{{product.groupbuy_status}}</span>
								<a
									class="wishlist-btn notwatching-btn"
									v-if="!user"
									v-on:click.prevent
									@click="promptlogin()"
								>
									<i class="lni lni-heart"></i>
								</a>
								<a
									class="wishlist-btn"
									v-else
									v-bind:class="!product.watchlists.some(w => w.user_id == user.id) ? 'notwatching-btn' : 'watching-btn'"
									v-on:click.prevent
									@click="watch(product, user.id)"
								>
									<i
										class="lni"
										v-bind:class="!product.watchlists.some(w => w.user_id == user.id) ? 'lni-heart' : 'lni-heart-filled'"
									></i>
									<!-- <span class="wishlist-btn wishlist-likes">{{product.watchlists.length}} watches</span> -->
								</a>
								<a class="product-thumbnail d-block">
									<img class="mb-2" :src="product.product_image" :alt="product.product_name" />
								</a>
								<a class="product-title d-block" v-html="product.product_name"></a>
								<p class="sale-price">${{parseFloat(product.product_price).toFixed(2)}}</p>
								<!--<span class="badge bottom-badge badge-watch-pending">{{product.watchlists.length}} watchers</span>
								-->
								<span class="badge badge-pending bottom-badge">Min required: {{product.product_min}}</span>
							</router-link>
						</div>
						<div v-else class="card top-product-card">
							<router-link class="card-body" :to="{ path: '/products/'+product.id}">
								<span class="badge badge-success">{{product.groupbuy_status}}</span>

								<span class="badge badge-success">{{timediff(timestamp, product.groupbuy_date_end)}}</span>

								<a
									class="wishlist-btn notwatching-btn"
									v-if="!user"
									v-on:click.prevent
									@click="promptlogin()"
								>
									<i class="lni lni-heart"></i>
								</a>
								<a
									class="wishlist-btn"
									v-else
									v-bind:class="!product.watchlists.some(w => w.user_id == user.id) ? 'notwatching-btn' : 'watching-btn'"
									v-on:click.prevent
									@click="watch(product, user.id)"
								>
									<i
										class="lni"
										v-bind:class="!product.watchlists.some(w => w.user_id == user.id) ? 'lni-heart' : 'lni-heart-filled'"
									></i>
								</a>
								<a class="product-thumbnail d-block">
									<img class="mb-2" :src="product.product_image" :alt="product.product_name" />
								</a>
								<a class="product-title d-block" v-html="product.product_name"></a>
								<p class="sale-price">${{parseFloat(product.product_price).toFixed(2)}}</p>

								<!--<span class="badge bottom-badge badge-success">{{product.groupbuy_orders}}/{{product.groupbuy_max}} purchased</span>
								-->
								<span
									v-if="product.groupbuy_orders === 0"
									class="badge badge-pending bottom-badge"
								>Min required: {{product.groupbuy_min}}</span>
								<span
									v-else-if="product.groupbuy_orders < product.groupbuy_min"
									class="badge badge-success bottom-badge"
								>+{{product.groupbuy_min - product.groupbuy_orders}} buyers needed</span>
								<span
									v-else-if="product.groupbuy_orders < product.groupbuy_max"
									class="badge badge-success bottom-badge"
								>+{{product.groupbuy_max - product.groupbuy_orders}} to finish</span>
								<span v-else class="badge badge-success bottom-badge">Full!</span>
							</router-link>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import carousel from "vue-owl-carousel";

export default {
	data() {
		return {
			user: null,
			products: [],
			popularProducts: [],
			countPopularLimit: 3,
			products2: [],
			limitationList:2,
			timestamp: ""
		};
	},

	created() {
		setInterval(this.getNow, 1000);
	},
	beforeMount() {
		this.user = JSON.parse(localStorage.getItem("bigStore.user"));
	},
	mounted() {
		axios
			.get("api/products/")
			.then(response => (this.products2 = response.data));

		axios
			.get("api/availableProducts/")
			.then(response => {
				this.products = response.data;

				let countPopularLimit = this.countPopularLimit;
				for (var key in this.products) {
					if (this.products.hasOwnProperty(key)) {
						let p = this.products[key];
						if (p.watchlists.length > 0) {
							if (p.groupbuy_orders == null) {
								p.groupbuy_orders = 0;
							}
							this.popularProducts.push(p);
						}
					}
				}

				this.popularProducts.sort((a, b) =>
					a.watchlists.length < b.watchlists.length ? 1 : -1
				);

				this.popularProducts.forEach((element, index) => {
					countPopularLimit--;
					if (countPopularLimit == 0) {
						this.popularProducts.splice(index, 1);
					}
				});
			})
			.catch(error => {
				alert(error);
			});
	},
	components: {
		carousel
	},
	methods: {
		getNow: function() {
			const today = new Date();
			const date =
				today.getFullYear() +
				"-" +
				(today.getMonth() + 1) +
				"-" +
				today.getDate();
			const time =
				today.getHours() +
				":" +
				today.getMinutes() +
				":" +
				today.getSeconds();
			const dateTime = date + " " + time;
			this.timestamp = dateTime;
		},
		watch(product, userid) {
			var found = false;
			var indexFound;
			var idFound;
			for (var i = 0; i < product.watchlists.length; i++) {
				if (product.watchlists[i].user_id == userid) {
					found = true;
					indexFound = i;
					idFound = product.watchlists[i].id;
					break;
				}
			}
			console.log("User exists in watchlist? - ", found);
			console.log("User at index - ", indexFound);

			if (!found) {
				var productid = product.id;
				var res;
				console.log("userid: ", userid);
				console.log("productid: ", productid);

				axios
					.post("/api/watchlists", { productid, userid })
					.then(function(response) {
						product.watchlists.push({
							id: response.data.data.id.toString(),
							product_id: response.data.data.product_id.toString(),
							user_id: response.data.data.user_id.toString()
						});
						console.log("userid added.");
					})
					.catch(function(error) {
						console.log("userid not added.", error);
					});
			} else {
				product.watchlists.splice(indexFound, 1);
				axios
					.delete(`/api/watchlists/${idFound}`)
					.then(function(response) {
						console.log("userid removed.");
					})
					.catch(function(error) {
						console.log("userid not removed.", error);
					});
			}
		},
		promptlogin() {
			alert("Please login or create account to continue :)");
		},
		timediff(currentTime, productTime) {
			var bucketMili = new Date(productTime) - new Date(currentTime);
			var mili_per_day = 1000 * 60 * 60 * 24;
			var mili_per_hour = 1000 * 60 * 60;
			var mili_per_min = 1000 * 60;
			var mili_per_sec = 1000;

			var remainingDays = Math.floor(bucketMili / mili_per_day);
			var bucketMili = bucketMili - mili_per_day * remainingDays;

			var remainintHours = Math.floor(bucketMili / mili_per_hour);
			var bucketMili = bucketMili - mili_per_hour * remainintHours;

			var remainingMins = Math.floor(bucketMili / mili_per_min);
			var bucketMili = bucketMili - mili_per_min * remainingMins;

			var remainingSecs = Math.floor(bucketMili / mili_per_sec);

			var remaining = "";
			if (
				!isNaN(remainingDays) &&
				!isNaN(remainintHours) &&
				!isNaN(remainingMins) &&
				!isNaN(remainingSecs)
			) {
				remaining =
					remainingDays +
					"d " +
					remainintHours +
					"h " +
					remainingMins +
					"m";
			}
			return remaining;
		}
	},
	computed: {}
};
</script>

<style scoped>
/* external css: flickity.css */

* {
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
}

.gallery {
	background: #eee;
}

.gallery-cell {
	width: 66%;
	height: 200px;
	margin-right: 10px;
	background: #8c8;
	counter-increment: gallery-cell;
}

/* cell number */
.gallery-cell:before {
	display: block;
	text-align: center;
	content: counter(gallery-cell);
	line-height: 200px;
	font-size: 80px;
	color: white;
}
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

.top-product-card .bottom-badge {
	position: initial;
}
.top-product-card .badge-watch-pending {
	background-color: grey;
}
.top-product-card .badge-pending {
	background-color: #fff;
	border: 1px solid;
}

.watching-btn {
	color: #a93226;
}

.notwatching-btn {
	color: grey;
}

.owl-carousel .owl-item img {
	min-height:150px;
	max-height:150px;
}

.neatifyCarousel {
	padding-left: var(--bs-gutter-x, .75rem);
    padding-right: var(--bs-gutter-x, .75rem);
}

</style>
