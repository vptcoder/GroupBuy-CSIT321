<template>
	<div class="page-content-wrapper">
		<div v-if="!(is_orders_fetched)">
			<!-- Preloader-->
			<div class="preloader" id="preloader">
				<div class="spinner-grow text-secondary" role="status">
					<div class="sr-only">Loading...</div>
				</div>
			</div>
		</div>
		<div v-else>
			<!-- Top Products-->
			<div class="top-products-area py-3">
				<div class="container">
					<!-- Section Heading-->
					<div class="section-heading d-flex align-items-center pt-3 justify-content-between">
						<h6>Orders processing:</h6>
					</div>
					<div class="row g-3">
						<!-- Single Weekly Product Card-->
						<div class="col-12 col-md-6" v-for="(o,index) in orders" :key="index">
							<div class="card weekly-product-card">
								<div class="card-body d-flex align-items-center">
									<div class="product-thumbnail-side">
										<a class="product-thumbnail d-block">
											<img class="mb-2" :src="o.product_image" :alt="o.product_name" />
										</a>
									</div>
									<div class="product-description">
										<a class="product-title d-block">{{o.product_name}}</a>
										<p class="sale-price">
											<i class="lni lni-dollar"></i>
											Total: ${{o.confirmedPrice}}
										</p>
										<span class="badge bottom-badge badge-success">Paid on: {{(new Date(o.date_paid)).toISOString().split('T')[0]}}</span>
									</div>
								</div>
							</div>
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
			orders: [],
			is_orders_fetched: false,
			timestamp: ""
		};
	},
	beforeMount() {
		this.user = JSON.parse(localStorage.getItem("bigStore.user"));
	},
	mounted() {
		console.log("user: ", this.user.id);

		axios
			.get("api/orders/toprocess/", { params: { userid: this.user.id } })
			.then(response => {
				this.orders = response.data;
				this.is_orders_fetched = true;
			});
	},
	methods: {
	}
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