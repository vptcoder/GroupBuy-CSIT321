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
						<h6>Orders pending payment:</h6>
					</div>
					<div class="row g-3">
						<!-- Single Weekly Product Card-->
						<div class="col-12 col-md-6" v-for="(o,index) in orders" :key="index">
							<div class="card weekly-product-card">
								<router-link
									:to="{ path: '/payment'}"
									class="card-body d-flex align-items-center"
								>
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
										<span class="badge bottom-badge badge-success">Click to pay now!</span>

										<span class="badge bottom-badge badge-success">
											Due in: <i class="lni lni-timer"></i>
											{{timediff(timestamp, o.date_due)}}
										</span>
									</div>
								</router-link>
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
	created() {
		setInterval(this.getNow, 1000);
	},
	beforeMount() {
		this.user = JSON.parse(localStorage.getItem("bigStore.user"));
	},
	mounted() {
		console.log("user: ", this.user.id);

		axios
			.get("api/orders/topay/", { params: { userid: this.user.id } })
			.then(response => {
				this.orders = response.data;
				this.is_orders_fetched = true;
			});
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

			var remaining = "...";
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