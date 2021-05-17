<template>
	<div>
		<table class="table table-responsive table-striped">
			<thead>
				<tr>
					<td></td>
					<td>Order</td>
					<td>User</td>
					<td>Status</td>
					<td>Amount</td>
					<td>Date Due</td>
					<td>Date Paid</td>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(p,index) in payments" :key="index">
					<td>{{index+1}}</td>
					<td>{{p.order_id}}</td>
					<td>{{p.user_id}}</td>
					<td>{{p.status}}</td>
					<td>{{p.amount}}</td>
					<td>{{p.date_due}}</td>
					<td>{{p.date_paid}}</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
export default {
	data() {
		return {
			payments: []
		}
	},
	beforeMount() {
		axios
			.get("/api/pay/get/")
			.then(response => (this.payments = response.data));
	}
}
</script>
