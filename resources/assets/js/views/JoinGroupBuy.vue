<template>
	<div class="page-content-wrapper">
		<div class="container d-flex justify-content-between">
			<router-link :to="{ path: '/products/'+this.pid}">
				<img class="mt-3" src="https://img.icons8.com/ios/32/000000/back--v1.png" />
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
					<h5>Description</h5>
					<p>{{product.description}}</p>
				</div>
			</carousel>
			<!-- Product Title & Meta Data-->
			<div class="product-title-meta-data bg-white mb-3 py-3">
				<div class="container justify-content-between"  style="margin-left: 10%!important;">
					<div class="p-title-price">
						<!-- <h5 class="mb-1">You are placing an order for:</h5> -->
						<h6 class="mb-3">{{product.name}}</h6>
						<div v-if="product.user_ordered" class="align-items-center">
							<br />
							<h6 class="mb-1">You have joined this groupbuy!</h6>
							<div class="container d-flex align-items-center justify-content-between"  style="width: 100%;position: fixed; bottom:3.6rem; left:-0rem; background-color:#fff; display:block; height:50px;"> 
 
								<a class="col-12 btn btn-sm " style="background-color: #a93226; color:#fff;" @click="deleteOrder">Leave</a>
 
							</div>
						</div>
						<div v-else>
							<div class ="row" > <!-- color: rgb(169, 50, 38);-->
								<p class="col-6 sale-price mb-0" style="font-size:21px; color: #463f3a; font-weight:500;">${{parseFloat(product.price).toFixed(2)}}</p>
								<div class="col-6">
								
										<div class="value-button" id="decrease" @click="decreaseValue()" value="Decrease Value"><i class="lni lni-circle-minus"></i></div>
										<input type="number" required autofocus id="number" v-model="quantity" />
										<div class="value-button" id="increase" @click="increaseValue()" value="Increase Value"><i class="lni lni-circle-plus"></i></div>
									
								</div>
							</div>

							<div class="container d-flex align-items-center justify-content-between"  style="width: 100%;position: fixed; bottom:3.6rem; left:-0rem; background-color:#fff; display:block; height:50px;"> 
								<h5 class="col-8 total-price mb-0">
									Total Price : $
									<span>{{confirmedPrice}}</span>
								</h5>
								<a class="col-4 btn btn-sm btn-primary" @click="confirmOrder_Start">Confirm</a>
							</div>
 
						</div>
						<modal @close="goHome" v-show="joinSuccess == true"></modal>
					</div>
				</div>
			</div>
 
 
	</div>
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
 
			return  this.quantity * this.product.price;
		}
	},
	beforeMount() {
		if (localStorage.getItem("bigStore.jwt") != null) {
			this.accessible = true;
			this.user = JSON.parse(localStorage.getItem("bigStore.user"));
			axios.get(`/api/products/${this.pid}`).then(response => {
				this.product = response.data;
				this.product.user_ordered = false;
				if (
					this.product.groupbuy_orders &&
					this.product.groupbuy_orders.length > 0
				) {
					if (
						this.product.groupbuy_orders.some(
							o => o.user_id == this.user.id
						)
					) {
						this.product.user_ordered = true;
					}
				}
				this.is_data_fetched = true;
			});
		}
	},
	components: {
		carousel,
		Modal
	},
 
	methods: {
		increaseValue() {
			var value = this.quantity;
			value = isNaN(value) ? 0 : value;
			value++;
			return this.quantity = value;
		},
		decreaseValue() {
			var value = this.quantity;
			value = isNaN(value) ? 0 : value;
			value < 1 ? value = 1 : 0;
			value--;
			return this.quantity = value;
		},
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

			var validation = Math.floor(Number(quantity)) !== Infinity  && Math.floor(Number(quantity)) > 0;
			if (!validation){
				alert("Please specify a valid order quantity!");
				return;
			}

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
		deleteOrder() {
			let groupbuyid = this.product.groupbuy_id;
			let userid = this.user.id;
			axios.post("/api/orders/leave", { groupbuyid, userid }).then(response => {
				this.$router.push({ path: "/" });
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
	font-weight: 500;
	color: rgb(169, 50, 38);
 	font-size: 22px;
}
 

 form {
  width: 300px;
  margin: 0 auto;
  text-align: center;
  padding-top: 50px;
}

.value-button {
  display: inline-block;
  margin: 0px;
  width: 50px;
  height: 20px;
  text-align: center;
  vertical-align: middle;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.value-button:hover {
  cursor: pointer;
}

form #decrease {
  margin-right: -4px;
  border-radius: 8px 0 0 8px;
}

form #increase {
  margin-left: -4px;
  border-radius: 0 8px 8px 0;
}

form #input-wrap {
  margin: 0px;
  padding: 0px;
}

input#number {
  text-align: center;
  border: none;
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  margin: 0px;
  width: 40px;
  height: 40px;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>