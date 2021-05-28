<template>
	<div class="page-content-wrapper">
		<div v-if="orders.length == 0" class="container" >
			<!-- Section Heading-->
			<div class="section-heading d-flex align-items-center pt-3 justify-content-between">
				<h6>You have no pending payment!</h6>
			</div>
		</div>


		<div class="container">
			<!-- Section Heading-->
			<div class="section-heading d-flex align-items-center pt-3 justify-content-between">
				<h6>Confirm and Pay for your purchase:</h6>
			</div>

			<!-- Select order to pay -->
			 
				<div class="credit-card-info-wrapper">
					<div class ="row g-3" style="margin-right:0; margin-left:0;">
						<div class="col-7 mb-3">
							<label>Make payment for: </label>
							 
						</div>
						<div class="col-5">
							<select style="width:100%;" v-model="selectedOrder">
								<option></option>
								<option
									v-for="(option,index) in orders"
									:key="index"
									v-bind:value="option"
								>{{option.selection}}</option>
							</select>
						</div>
					</div>
				</div>
			<div v-show="selectedOrder" class="credit-card-info-wrapper">
				<div class ="card">
					<div class="mx-2 mb-3 mt-2">
							<label for="cardholder" style="font-size:14px; font-weight:500;">Cardholder Name</label>
							<input
								class="form-control"
								type="text"
								id="cardholder"
								v-model="customer.name"
								placeholder="SUHA JANNAT"
								value
							/>
					</div>
					<div class="mx-2 mb-3 mt-2">
						<label for="cardDetail" style="font-size:14px; font-weight:500;">Card Details</label>
					</div>
						<div id="card-element"></div>
					
						<!-- <button
							id="card-button"
							class="btn btn-primary btn-lg w-100"
							type="submit"
							@click="processPayment"
							:disabled="paymentProcessing"
							v-text="paymentProcessing ? 'Processing' : 'Pay Now'"
						>Pay Now</button> -->
				</div>
					<small class="ms-1">
						<i class="fa fa-lock me-1"></i>Your payment info is stored securely.
						<a class="ms-1" href="#">Learn More</a>
					</small>
					<div  class="container d-flex align-items-center justify-content-between" 
					style="width: 100%; position: fixed; bottom: 3.6rem; left: 0rem; background-color: rgb(255, 255, 255); display: block; height: 50px; max-width: 100%;">
							<a  class="btn btn-sm btn-primary col-12" @click="processPayment"
								:disabled="paymentProcessing"
								v-text="paymentProcessing ? 'Processing' : 'Pay Now'"
							>Pay Now</a>
					</div>
			</div>
		</div>
	</div>
</template>

<script>
import { loadStripe } from "@stripe/stripe-js";
export default {
	data() {
		return {
			selectedOrder: null,
			user: null,
			orders: [],
			stripe: {},
			cardElement: {},
			customer: {
				name: "",
				email: ""
			},
			paymentProcessing: false,
			test: false
		};
	},
	beforeMount() {
		this.user = JSON.parse(localStorage.getItem("bigStore.user"));
		this.customer.email = this.user.email;
		this.customer.user = this.user;
	},
	async mounted() {
		this.stripe = await loadStripe(process.env.MIX_STRIPE_KEY);

		axios
			.get("api/orders/topay/", { params: { userid: this.user.id } })
			.then(response => {
				this.orders = response.data;
			});
		const elements = this.stripe.elements();
		this.cardElement = elements.create("card", {
			hidePostalCode: true,
			classes: {
				base:
					"mx-2 mb-3 bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out"
			}
		});

		this.cardElement.mount("#card-element");
	},
	methods: {
		async processPayment() {
			//send the paymnent information to laravel + Stripe
			this.paymentProcessing = true;

			const {
				paymentMethod,
				error
			} = await this.stripe.createPaymentMethod(
				"card",
				this.cardElement,
				{
					billing_details: {
						name: this.customer.name,
						email: this.customer.email
					}
				}
			);

			if (error) {
				this.paymentProcessing = false;
				console.log(error);
				alert(error);
			} else {
				console.log(paymentMethod);

				this.customer.payment_method_id = paymentMethod.id;
				this.customer.amount = this.selectedOrder.confirmedPrice;
				this.customer.order = this.selectedOrder

				axios
					.post("/api/pay/transaction", this.customer)
					.then(response => {
						this.paymentProcessing = false;
						console.log(response);
						this.$router.push({ path: "/" });
					})
					.catch(error => {
						this.paymentProcessing = false;
						console.error(error);
					});
			}
		}
	},
	computed: {
	}
};
</script>

<style scoped>
#card-element {
	transition-duration: 500ms;
	border-color: #ebebeb;
	height: 50px;
	padding: 0.375rem 1rem;
	font-size: 14px;
	display: block;
 	font-weight: 400;
	line-height: 1.5;
	color: #212529;
	background-color: #fff;
	background-clip: padding-box;
	border: 1px solid #ced4da;
	appearance: none;
	border-radius: 0.25rem;
	transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
small.ms-1 {
	font-size: 11px;
}
</style>