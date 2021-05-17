<template>
	<div class="page-content-wrapper">
		<div v-if="!(is_watchlist_fetched && is_groupbuys_fetched)">
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
					<div class="row g-3 watchlist-views">
						<!-- Single Catagory Card-->
						<div class="col-5">
							<div @click="tab = 1" class="card catagory-card">
								<div class="card-body">
									<a>
										<span v-bind:class="tab == 1 ? 'card-selected' : ''">Pending Groupbuy</span>
									</a>
								</div>
							</div>
						</div>
						<!-- Single Catagory Card-->
						<div class="col-5">
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
						<div class="col-12 col-md-6" v-for="(g,index) in groupbuys" :key="index">
							<div class="card weekly-product-card">
								<router-link
									:to="{ path: '/products/'+g.product_id}"
									class="card-body d-flex align-items-center"
								>
									<div class="product-thumbnail-side">
										<!-- <a class="wishlist-btn" href="#">
											<i class="lni lni-heart"></i>
										</a>-->
										<a class="product-thumbnail d-block">
											<img class="mb-2" :src="g.product_image" :alt="g.product_name" />
										</a>
									</div>
									<div class="product-description">
										<a class="product-title d-block">{{g.product_name}}</a>
										<p class="sale-price">
											<i class="lni lni-dollar"></i>
											${{g.product_price}}
										</p>
										<span class="badge bottom-badge badge-success">{{g.groupbuy_orders}} ordered</span>

										<span
											v-if="g.groupbuy_orders === 0"
											class="badge badge-pending bottom-badge"
										>minimum required: {{g.min_required}}</span>
										<span
											v-else-if="g.groupbuy_orders < g.min_required"
											class="badge badge-success bottom-badge"
										>+{{g.min_required - g.groupbuy_orders}} buyers needed</span>
										<span
											v-else-if="g.groupbuy_orders < g.max_available"
											class="badge badge-success bottom-badge"
										>+{{g.max_available - g.groupbuy_orders}} to finish</span>
										<span v-else class="badge badge-success bottom-badge">Full!</span>

										<span class="badge bottom-badge badge-success">
											<i class="lni lni-timer"></i>
											{{timediff(timestamp, g.date_end)}}
										</span>
									</div>
								</router-link>
							</div>
						</div>
					</div>
					<div v-else class="row g-3">
						<!-- Single Weekly Product Card-->
						<div class="col-12 col-md-6" v-for="(product,index) in watchlist" :key="index">
							<div class="card weekly-product-card">
								<router-link
									:to="{ path: '/products/'+product.product_id}"
									class="card-body d-flex align-items-center"
								>
									<div class="product-thumbnail-side">
										<!-- <a class="wishlist-btn" href="#">
											<i class="lni lni-heart"></i>
										</a>-->
										<a class="product-thumbnail d-block">
											<img class="mb-2" :src="product.image" :alt="product.name" />
										</a>
									</div>
									<div class="product-description">
										<a class="product-title d-block">{{product.name}}</a>
										<p class="sale-price">
											<i class="lni lni-dollar"></i>
											${{product.price}}
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
	</div>
</template>

<script>
export default {
	data() {
		return {
			user: null,
			watchlist: [],
			groupbuys: [],
			tab: 1,
			is_watchlist_fetched: false,
			is_groupbuys_fetched: false,
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
			.get("api/watchlists/", { params: { userid: this.user.id } })
			.then(response => {
				this.watchlist = response.data;
				this.is_watchlist_fetched = true;
			});

		axios
			.get("api/groupbuys/joined/", { params: { userid: this.user.id } })
			.then(response => {
				this.groupbuys = response.data;
				this.is_groupbuys_fetched = true; 
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

			var remaining = "remaining time...";
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
	// promptlogin(){
	// 	alert("Please login!")
	// },
	// watch(userid) {
	// 	var found = false;
	// 	var indexFound;
	// 	var idFound;
	// 	var product = this.product;
	// 	for (var i = 0; i < product.watchlists.length; i++){
	// 		if (product.watchlists[i].user_id == userid){
	// 			found = true;
	// 			indexFound = i;
	// 			idFound = product.watchlists[i].id;
	// 			break;
	// 		}
	// 	}
	// 	console.log("product object - ", product);
	// 	console.log("User exists in watchlist? - ", found);
	// 	console.log("User at index - ", indexFound);
	// 	if(!found){
	// 		var productid = product.id;
	// 		var res;
	// 		console.log("userid: ", userid);
	// 		console.log("productid: ", productid);
	// 		axios.post("/api/watchlists", {productid, userid})
	// 		.then(function (response) {
	// 			product.watchlists.push({
	// 				'id': response.data.data.id.toString()
	// 				, 'product_id': response.data.data.product_id.toString()
	// 				, 'user_id': response.data.data.user_id.toString()
	// 			});
	// 			console.log("userid added.");
	// 		})
	// 		.catch(function (error){
	// 			console.log("userid not added.", error);
	// 		})
	// 	} else {
	// 		product.watchlists.splice(indexFound, 1);
	// 		axios.delete(`/api/watchlists/${idFound}`)
	// 		.then(function (response){
	// 			console.log("userid removed.");
	// 		})
	// 		.catch(function (error){
	// 			console.log("userid not removed.", error);
	// 		})
	// 	}
	// }
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