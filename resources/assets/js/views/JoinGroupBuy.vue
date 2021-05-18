<template>
	<div class="page-content-wrapper">
		<div class="container d-flex justify-content-between">
			<router-link :to="{ path: '/products/'+this.pid}" >
				<img class="mt-3" src="https://img.icons8.com/ios/32/000000/back--v1.png"/>
			</router-link>
		</div>
		<div v-if="!accessible">
			<!-- Preloader-->
			
			<label class="error-message">Please login or create account to continue :)</label>
		</div>
		<div v-else-if="accessible && !is_data_fetched">
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
				<div>
					<img :src="product.image" :alt="product.name" />
				</div>
			</carousel>
			<!-- Product Title & Meta Data-->
			<div class="product-title-meta-data bg-white mb-3 py-3">
				<div class="container d-flex justify-content-between">
					<div class="p-title-price">
						<h5 class="mb-1">You are placing an order for:</h5>
						<h6 class="mb-1">{{product.name}}</h6>
						<p class="sale-price mb-0">${{product.price}}</p>
						<table class="table mb-0">
							<tbody>
								<tr>
									<td>
										<img src="img/product/11.png" alt />
									</td>
									<td>
										<p>Amount</p>
									</td>
									<td>
										<div class="quantity">
											<input class="qty-text" type="text" v-model="quantity" required autofocus />
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Cart Amount Area-->
			<div class="card cart-amount-area">
				<div class="card-body d-flex align-items-center justify-content-between">
					<h5 class="total-price mb-0" > 
						Total Price : $
						<span>{{confirmedPrice}}</span>
					</h5>
					<a class="btn btn-warning" @click="confirmOrder_Start">Confirm Order</a>
				</div>
			</div>
		</div>
		<modal @close="goHome" v-show="joinSuccess == true"></modal>
	</div>
</template>

<script>
import carousel from "vue-owl-carousel";
import Modal from "./ModalConfirm";

export default {
	props: ["pid"],
	data() {
		return {
			user: null,
			product: null,
			accessible: false,
			is_data_fetched: false,
			quantity: 1,
			joinSuccess: false
		};
	},
	computed: {
		confirmedPrice: function() {
			return this.quantity * this.product.price;
		}
	},
	beforeMount() {
		if (localStorage.getItem("bigStore.jwt") != null) {
			this.accessible = true;
			this.user = JSON.parse(localStorage.getItem("bigStore.user"));
			axios.get(`/api/products/${this.pid}`).then(response => {
				this.product = response.data;
				this.is_data_fetched = true;
			});
		}

		// let url = `/api/products/${this.$route.params.id}`;
		// axios.get(url).then(response => {this.product = response.data; this.is_data_fetched = true;});
	},
	components: {
		carousel,
		Modal
	},
	methods: {
		confirmOrder_Start() {
			var groupbuyid =
				this.product.groupbuy_id == null
					? ""
					: this.product.groupbuy_id;
			console.log(groupbuyid);
			var productid = this.product.id;
			var userid = this.user.id;
			var quantity = this.quantity;
			var confirmedPrice = this.confirmedPrice;
			var shipping_streetaddress = this.user.shipping_streetaddress;
			var shipping_city = this.user.shipping_city;
			var shipping_postalcode = this.user.shipping_postalcode;

			axios
				.post(`/api/groupbuys/join`, {
					groupbuyid,
					productid,
					userid,
					quantity,
					confirmedPrice,
					shipping_streetaddress,
					shipping_city,
					shipping_postalcode
				})
				.then(response => {
					console.log(response.data);
					if (response.data.status == true) {
						this.joinSuccess = true;
					} else {
						alert(response.data.message);
					}
				})
				.catch(error => {
					console.log("groupbuy is not created.", error);
				});
		},
		goHome() {
			console.log("modal closed");
			this.$router.push({ path: "/" });
		}
	}
};
</script>
<style scoped>
.error-message {
	position: fixed;
	height: 100%;
	width: 100%;
	z-index: 9999999;
	top: 0;
	left: 0;
	display: flex;
	align-items: center;
	justify-content: center;
}

.total-price {
	font-weight:500;
	color:red; 
	font-size: 18px;
}
</style>