<template>
	<div class="page-content-wrapper">
		<div v-if="orders" class="container" >
			<!-- Section Heading-->
			<div class="section-heading d-flex align-items-center pt-3 justify-content-between">
				<h6>You have no pending payment!</h6>
			</div>
		</div>
		<div v-else class="container">
			<!-- Section Heading-->
			<div class="section-heading d-flex align-items-center pt-3 justify-content-between">
				<h6>Confirm and Pay for your purchase:</h6>
			</div>

			<!-- Select order to pay -->
			<div class="credit-card-info-wrapper">
				<div class="mb-3">
					<label>Make payment for: </label>
					<select v-model="selectedOrder">
						<option></option>
						<option
							v-for="(option,index) in orders"
							:key="index"
							v-bind:value="option"
						>{{option.selection}}</option>
					</select>
				</div>
			</div>

			<!-- Credit Card Info-->
			<div v-show="test" class="credit-card-info-wrapper">
				<img class="d-block mb-4" src="img/bg-img/credit-card.png" alt />
				<div class="pay-credit-card-form">
					<form action="payment-success.html" method>
						<div class="mb-3">
							<label for="cardNumber">Credit Card Number</label>
							<input
								class="form-control"
								type="text"
								id="cardNumber"
								placeholder="1234 ×××× ×××× ××××"
								value
							/>
							<small class="ms-1">
								<i class="fa fa-lock me-1"></i>Your payment info is stored securely.
								<a class="ms-1" href="#">Learn More</a>
							</small>
						</div>
						<div class="mb-3">
							<label for="cardholder">Cardholder Name</label>
							<input class="form-control" type="text" id="cardholder" placeholder="SUHA JANNAT" value />
						</div>
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label for="expiration">Exp. Date</label>
									<input class="form-control" type="text" id="expiration" placeholder="12/20" value />
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label for="cvvcode">CVV Code</label>
									<input class="form-control" type="text" id="cvvcode" placeholder="××××" value />
								</div>
							</div>
						</div>
						<button
							class="btn btn-warning btn-lg w-100"
							type="submit"
							@click="processPayment"
							:disabled="paymentProcessing"
							v-text="paymentProcessing ? 'Processing' : 'Pay Now'"
						>Pay Now</button>
					</form>
				</div>
			</div>

			<div v-show="selectedOrder" class="credit-card-info-wrapper">
				<div id="card-element"></div>
				<small class="ms-1">
					<i class="fa fa-lock me-1"></i>Your payment info is stored securely.
					<a class="ms-1" href="#">Learn More</a>
				</small>
				<div class="mb-3">
					<label for="cardholder">Cardholder Name</label>
					<input
						class="form-control"
						type="text"
						id="cardholder"
						v-model="customer.name"
						placeholder="SUHA JANNAT"
						value
					/>
				</div>
				<button
					id="card-button"
					class="btn btn-warning btn-lg w-100"
					type="submit"
					@click="processPayment"
					:disabled="paymentProcessing"
					v-text="paymentProcessing ? 'Processing' : 'Pay Now'"
				>Pay Now</button>
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
					"mb-3 bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out"
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
	width: 100%;
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