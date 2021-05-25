<template>
	<div class="page-content-wrapper">
		<table class="table table-responsive ">
			<thead>
				<tr>
					<td></td>
					<td>Order ID</td>
					<td>Buyer Name</td>
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
					<td>{{p.user_name}}</td>
					<td>{{p.statustext}}</td>
					<td>{{parseFloat(p.amount).toFixed(2)}}</td>
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
