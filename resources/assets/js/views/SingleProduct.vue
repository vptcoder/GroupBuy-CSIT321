<template>
	<div class="page-content-wrapper">
		<div v-if="!is_data_fetched">
			<!-- Preloader-->
			<div class="preloader" id="preloader">
				<div class="spinner-grow text-secondary" role="status">
					<div class="sr-only">Loading...</div>
				</div>
			</div>
		</div>

		<div v-else>
			<!-- Product Slides-->
			<carousel :items="1" :autoplay="false" :nav="false" :dots="true">
				<div>
					<img :src="product.image" :alt="product.name" />
				</div>
				<div>
					<img :src="product.image" :alt="product.name" />
				</div>
			</carousel>
			<div class="product-description pb-3">
				<!-- Product Title & Meta Data-->
				<div class="product-title-meta-data bg-white py-3">
					<div class="container d-flex justify-content-between" style="display:block!important;">
						<div class="p-title-price">
							<h6 class="mb-1 mx-4" style="text-align:center;">{{product.name}}</h6>
							<hr style="color:grey" />
							<p class="sale-price mb-0">${{parseFloat(product.price).toFixed(2)}}</p>
							<div>
								<label
									v-if="product.groupbuy_status === 'Processing' || product.groupbuy_status === 'Active' && product.groupbuy_id == null"
									style="color:red; "
								>{{product.groupbuy_max - product.groupbuy_orders_qty}} slots left</label>
								<label
									v-else-if="product.groupbuy_status === 'Pending'"
									style="color:red;"
								>{{product.max}} slots left</label>
								<label
									v-else
									style="color:red;"
								>{{product.groupbuy_max-product.groupbuy_orders_qty}} slots left</label>
							</div>
							<div v-if="product.groupbuy_status == 'Active'">
								<span style=" font-size:14px;">
									<img style="width:14px;" src="https://img.icons8.com/android/50/000000/timer.png" />
									{{timediff(timestamp, product.groupbuy_date_end)}} left
								</span>
							</div>
						</div>
					</div>
				</div>
				<!-- Product Specification-->
				<div class="p-specification bg-white mb-3 py-3">
					<div class="container">
						<h5>Description</h5>
						<p>{{product.description}}</p>
						<!-- Button -->
						<div
							class="container d-flex align-items-center justify-content-between"
							style="width: 100%;position: fixed; bottom:3.6rem; left:-0rem; background-color:#fff; display:block; height:50px; max-width: 100%;"
						>
							<router-link
								:to="{ path: '/join?pid='+product.id }"
								v-if="product.user_ordered"
								class="btn btn-sm btn-primary"
								v-bind:class="groupbuyStatus == 'Active' && user && user_tokens > 0 ? 'col-8': 'col-10'"
							>Joined (Click to view)</router-link>

							<button
								v-else-if="product.groupbuy_orders_qty >= product.groupbuy_max"
								class="col-10 btn btn-sm btn-primary"
								disabled
							>Full</button>
							<router-link
								:to="{ path: '/join?pid='+product.id }"
								v-else
								class="col-10 btn btn-sm btn-primary"
							>Join</router-link>

							<!-- Watchlist button -->
							<a
								class="col-2 wishlist-btn notwatching-btn"
								style="border:0px; 
									text-align:center; 
									margin-left: 1rem!important;"
								v-if="!user"
								v-on:click.prevent
								@click="promptlogin()"
							>
								<i class="lni lni-heart"></i>
							</a>
							<a
								class="col-2 wishlist-btn"
								style="border:0px; 
									text-align:center; 
									margin-left: 
									1rem!important;"
								v-else
								v-bind:class="!product.watchlists.some(w => w.user_id == user.id) ? 'notwatching-btn' : 'watching-btn'"
								v-on:click.prevent
								@click="watch(user.id)"
							>
								<i
									class="lni"
									v-bind:class="!product.watchlists.some(w => w.user_id == user.id) ? 'lni-heart' : 'lni-heart-filled'"
								></i>
							</a>

							<!-- Token button -->
							<a
								v-show="groupbuyStatus == 'Active' && user && user_tokens > 0"
								class="col-2"
								style="text-align:center;"
								v-bind:class="product.groupbuy_tokens && !product.groupbuy_tokens.some(t => t.user_id == user.id) ? 'notwatching-btn' : 'tokened-btn'"
								@click.prevent="usetoken(user.id)"
							>
								<!-- <img src="https://img.icons8.com/ios/19/000000/us-dollar--v1.png" /> -->
								<i class="lni lni-coin"></i>
							</a>
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
			user_tokens: 0,
			product: null,
			is_data_fetched: false,
			timestamp: ""
		};
	},
	created() {
		setInterval(this.getNow, 1000);
	},
	beforeMount() {
		this.user = JSON.parse(localStorage.getItem("bigStore.user"));

		let url = `/api/products/${this.$route.params.id}`;
		axios.get(url).then(response => {
			this.product = response.data;
			this.product.user_ordered = false;
			if (
				this.product.groupbuy_orders &&
				this.product.groupbuy_orders.length > 0
			) {
				if (
					this.user &&
					this.product.groupbuy_orders.some(
						o => o.user_id == this.user.id
					)
				) {
					this.product.user_ordered = true;
				}
			}
			this.is_data_fetched = true;
		});

		if (this.user) {
			this.availableToken();
		}
	},
	components: {
		carousel
	},
	mounted() {
		// this.$forceUpdate();
	},
	methods: {
		promptlogin() {
			alert("Please login or create account to continue :)");
		},
		availableToken() {
			axios.get(`/api/tokens/avail/${this.user.id}`).then(response => {
				console.log(response);
				this.user_tokens = response.data.length;
			});
		},
		watch(userid) {
			var found = false;
			var indexFound;
			var idFound;
			var product = this.product;
			for (var i = 0; i < product.watchlists.length; i++) {
				if (product.watchlists[i].user_id == userid) {
					found = true;
					indexFound = i;
					idFound = product.watchlists[i].id;
					break;
				}
			}
			console.log("product object - ", product);
			console.log("User exists in watchlist? - ", found);
			console.log("User at index - ", indexFound);

			if (!found) {
				var productid = product.id;
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
						console.log("watchlist added.");
					})
					.catch(function(error) {
						console.log("watchlist was not added.", error);
					});
			} else {
				product.watchlists.splice(indexFound, 1);
				axios
					.delete(`/api/watchlists/${idFound}`)
					.then(function(response) {
						console.log("watchlist removed.");
					})
					.catch(function(error) {
						console.log("watchlist was not removed.", error);
					});
			}
		},
		usetoken(userid) {
			if (this.product.groupbuy_tokens.some(t => t.user_id == user.id)) {
				alert(
					"You already spent a token on this groupbuy, only 1 token is allowed per groupbuy!"
				);
			}

			let groupbuyid = this.product.groupbuy_id;
			console.log("userid: ", userid);
			console.log("groupbuyid: ", groupbuyid);

			axios
				.post("/api/tokens/use", { groupbuyid, userid })
				.then(response => {
					if (response.data.status) {
						this.product.groupbuy_tokens.push({
							id: response.data.data.id.toString(),
							groupbuy_id: response.data.data.groupbuy_id.toString(),
							user_id: response.data.data.user_id.toString()
						});
						alert("Token used! Popularity of product has been boosted!");
						this.availableToken();
					} else {
						alert(response.data.message);
					}
				});
		},
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
					"m " +
					remainingSecs +
					"s";
			}
			return remaining;
		}
	},
	computed: {
		groupbuyStatus() {
			return this.product.groupbuy_status;
		}
	}
};
</script>

<style scoped>
.product-contents {
	padding-left: 20px;
	padding-right: 20px;
}
.sale {
	height: 30px;
	width: 30px;
	position: relative;
	left: 300px;
	top: 20px;
}

.img {
	background-color: #f4f4f4;
	width: 300px;
	height: 170px;
	margin-left: 40px;
}
.img img {
	min-height: 100%;
	max-height: 100%;
	min-width: 100%;
	max-width: 100%;
}
.name {
	font-size: 12px;
	color: black;
	margin-left: 70px;
}

.watching-btn {
	color: #ea4c62;
	text-align: center;
}

.tokened-btn {
	color: green;
	text-align: center;
}

.notwatching-btn {
	color: grey;
	text-align: center;
}

.owl-carousel .nav-btn {
	height: 47px;
	position: absolute;
	width: 26px;
	cursor: pointer;
	top: 100px !important;
}

.owl-carousel .owl-prev.disabled,
.owl-carousel .owl-next.disabled {
	pointer-events: none;
	opacity: 0.2;
}

.owl-carousel .prev-slide {
	background: url(nav-icon.png) no-repeat scroll 0 0;
	left: -33px;
}
.owl-carousel .next-slide {
	background: url(nav-icon.png) no-repeat scroll -24px 0px;
	right: -33px;
}
.owl-carousel .prev-slide:hover {
	background-position: 0px -53px;
}
.owl-carousel .next-slide:hover {
	background-position: -24px -53px;
}

.full-width {
	width: 100%;
}
</style>
