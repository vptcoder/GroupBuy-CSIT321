<template>
	<div>
		<table class="table table-responsive table-striped">
			<thead>
				<tr>
					<td></td>
					<td>Product</td>
					<td>Status</td>
					<td>Quantity</td>
					<td>Cost</td>
					<td>Delivery Address</td>
					<td>is Delivered?</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(order,index) in orders" :key="index">
					<td>{{index+1}}</td>
					<td v-html="order.product.name"></td>
					<td>{{order.statustext}}</td>
					<td>{{order.quantity}}</td>
					<td>{{order.quantity * order.product.price}}</td>
					<td>{{order.address}}</td>
					<td>{{order.is_delivered == 1? "Yes" : "No"}}</td>
					<td v-if="order.status == 'o13'">
						<button class="btn btn-success" @click="ship(index)">Ship</button>
					</td>
					<td v-else-if="order.status == 'o13' & order.is_delivered == 0">
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
export default {
	data() {
		return {
			orders: []
		};
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
			axios.patch("/api/orders/deliver", { orderid }).then(response => {
				this.orders[index].is_delivered = 1;
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
