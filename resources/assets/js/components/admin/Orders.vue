<template>
	<div class="page-content-wrapper">
		
	<div class="mt-4 md-form">
		<input  type="text" value="" placeholder="Search by product name" class="form-control">  
	</div>
 
		<table class="table table-responsive">
			<thead>
				<tr>
					<td></td>
					<td>Product</td>
					<td>Status</td>
					<td>Quantity</td>
					<td>Cost</td>
					<td>Buyer Name</td>
					<td>Delivery Address</td>
					<td>is Delivered?</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(order,index) in orders" :key="index">
					<td>{{index+1}}</td>
					<td v-html="order.product.name"></td>
					<td v-if="order.status === 'o11'">Order Pending</td>
					<td v-else-if="order.status === 'o12'">Payment pending</td>
					<td v-else-if="order.status === 'o13'">Paid</td>
					<td v-else-if="order.status === 'o14'">Shipping</td>
					<td v-else-if="order.status === 'o15'">Order complete</td>
					<td v-else-if="order.status === 'o21'">Cancelled</td>
					<td v-else-if="order.status === 'o22'">Refunded</td>
					<td v-else>Status Error!</td>
					<td>{{order.quantity}}</td>
					<td>{{(order.quantity * order.product.price).toFixed(2)}}</td>
					<td>{{order.username}}</td>
					<td>{{order.shipping_streetaddress}}, {{order.shipping_city}} {{order.shipping_postalcode}}</td>
					<td>{{order.is_delivered == 1? "Yes" : "No"}}</td>
					<td v-if="order.status == 'o13' & order.groupbuy_status == 'g13'">
						<button class="btn btn-success" @click="ship(index)">Ship</button>
					</td>
					<td v-else-if="order.status == 'o14' & order.is_delivered == 0 & order.groupbuy_status == 'g13'">
						<button class="btn btn-success" @click="deliver(index)">Deliver</button>
					</td>
					<td v-else>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
import { mdbDatatable2, mdbInput } from "mdbvue";

export default {
	
	data() {
		return {
			search: "",
			orders: []
		};
	},
	componenets: {
		mdbInput, mdbDatatable2
	},
	beforeMount() {
		axios
			.get("/api/orders/")
			.then(response => (this.orders = response.data));
	},
	methods: {
		deliver(index) {
			let order = this.orders[index];
			let orderid = order.id;
			axios.post("/api/orders/deliver", { orderid }).then(response => {
				this.orders[index].is_delivered = 1;
				this.orders[index].status = "o15";
				this.$forceUpdate();
			});
		},
		ship(index) {
			let order = this.orders[index];
			let orderid = order.id;
			axios.post("/api/orders/ship", { orderid }).then(response => {
				this.orders[index].status = "o14";
				this.$forceUpdate();
			});
		}
	}
};
</script>
