<template>
	<div class="page-content-wrapper">
		<!-- Top Products-->
		<div class="top-products-area py-3">
			<div class="container">
				<div class="row g-3 watchlist-views" >
					<!-- Single Catagory Card-->
					<div class="col-4">
						<div @click="tab = 1" class="card catagory-card">
							<div class="card-body">
								<a>
									<span v-bind:class="tab == 1 ? 'card-selected' : ''">Groupbuy</span>
								</a>
							</div>
						</div>
					</div>
					<!-- Single Catagory Card-->
					<div class="col-4">
						<div @click="tab = 2" class="card catagory-card">
							<div class="card-body">
								<a>
									<span v-bind:class="tab == 2 ? 'card-selected' : ''">Watchlist</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div v-if="tab == 1" class="row g-3">
					<!-- Single Weekly Product Card-->
					<div class="col-12 col-md-6" v-for="(product,index) in groupbuys" :key="index">
						<div class="card weekly-product-card">
							<router-link :to="{ path: '/products/'+product.product_id}"  class="card-body d-flex align-items-center">
								<div class="product-thumbnail-side">
									<!-- <a class="wishlist-btn" href="#">
										<i class="lni lni-heart"></i>
									</a> -->
									<a class="product-thumbnail d-block" >
										<img class="mb-2" :src="product.image" :alt="product.name" />
									</a>
								</div>
								<div class="product-description">
									<a class="product-title d-block" >{{product.name}}</a>
									<p class="sale-price">
										<i class="lni lni-dollar"></i>${{product.price}}
									</p>
									<a class="btn btn-success btn-sm" href="#">
										<i class="me-1 lni lni-cart"></i>Join Now
									</a>
								</div>
							</router-link>
						</div>
					</div>
				</div>
				<div v-else class="row g-3">
					<!-- Single Weekly Product Card-->
					<div class="col-12 col-md-6" v-for="(product,index) in watchlist" :key="index">
						<div class="card weekly-product-card">
							<router-link :to="{ path: '/products/'+product.product_id}" class="card-body d-flex align-items-center">
								<div class="product-thumbnail-side">
									<!-- <a class="wishlist-btn" href="#">
										<i class="lni lni-heart"></i>
									</a> -->
									<a class="product-thumbnail d-block" >
										<img class="mb-2" :src="product.image" :alt="product.name" />
									</a>
								</div>
								<div class="product-description">
									<a class="product-title d-block" >{{product.name}}</a>
									<p class="sale-price">
										<i class="lni lni-dollar"></i>${{product.price}}
									</p>
									<a class="btn btn-success btn-sm" href="#">
										<i class="me-1 lni lni-cart"></i>Join Now
									</a>
								</div>
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
			user: null,
			watchlist: [],
			groupbuys: [],
			tab: 1
		};
	},
	beforeMount() {
		this.user = JSON.parse(localStorage.getItem('bigStore.user'))
	},
	mounted() {
		console.log("user: ", this.user.id)
		axios
			.get("api/watchlists/", {params: {userid: this.user.id}})
			.then(response => (this.watchlist = response.data));
	},
	methods: {
	},	
};
</script>

<style scoped>
.watchlist-views {
    justify-content: center;
	margin-bottom: 1rem;
}

.card-selected {
	color: #ea4c62;
}
</style>