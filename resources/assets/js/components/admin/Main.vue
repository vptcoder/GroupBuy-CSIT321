<template>
	<div class="page-content-wrapper">
		<div class="row">
			<div
				class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text"
			>
				<a href="/admin/products">Products ({{products.length}})</a>
			</div>
			<hr />
			<div
				class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text"
			>
				<a href="/admin/groupbuys">Groupbuys ({{orders.length}})</a>
			</div>
			<hr />
			<div
				class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text"
			>
				<a href="/admin/orders">Orders ({{orders.length}})</a>
			</div>
			<hr />
			<div
				class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text"
			>
				<a href="/admin/payments">Payments ({{payments.length}})</a>
			</div>
			<hr />
			<div
				class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text"
			>
				<a href="/admin/users">Users ({{users.length}})</a>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			user: null,
			products: [],
			groupbuys: [],
			orders: [],
			users: [],
			payments: []
		};
	},
	mounted() {
		axios
			.get("/api/products/")
			.then(response => (this.products = response.data));
		axios
			.get("/api/admingroupbuys/")
			.then(response => (this.groupbuys = response.data));
		axios
			.get("/api/orders/")
			.then(response => (this.orders = response.data));
		axios.get("/api/users/").then(response => (this.users = response.data));
		axios
			.get("/api/pay/get/")
			.then(response => (this.payments = response.data));
	}
};
</script>

<style scoped>
.big-text {
	font-size: 28px;
}
.product-box {
	border: 1px solid #cccccc;
	padding: 10px 15px;
	height: 10vh;
}
</style>
