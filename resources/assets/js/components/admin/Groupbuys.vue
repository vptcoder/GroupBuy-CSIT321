<template>
	<div class="page-content-wrapper">
		<p>Double-click on item to open</p>
		<table class="table table-responsive table-striped">
			<thead>
				<tr>
					<td>ID</td>
					<td>Product Name</td>
					<td>Status</td>
					<td>Start Date</td>
					<td>End Date</td>
					<td>Min Required</td>
					<td>Stock</td>
					<td>Current orders</td>
					<td>Started By</td>
					<td>Date Success</td>
				</tr>
			</thead>
			<tbody>
				<tr
					class="tr-data"
					v-for="(groupbuy,index) in groupbuys"
					:key="index"
					@dblclick="startEditing(groupbuy)"
				>
					<!-- <td>{{index+1}}</td> -->
					<td>
						<h6 class="mb-0" v-html="groupbuy.id"></h6>
					</td>
					<td>
						<h6 class="mb-0">{{groupbuy.product_name}}</h6>
					</td>
					<td>
						<h6 class="mb-0">
							<i v-if="groupbuy.nextStepAdmin" class="lni lni-bolt"></i>
							<i v-else class="lni lni-minus"></i>
							{{groupbuy.status}}
						</h6>
					</td>
					<td>
						<h6 class="mb-0">{{groupbuy.date_start}}</h6>
					</td>
					<td>
						<h6 class="mb-0">{{groupbuy.date_end}}</h6>
					</td>
					<td>
						<h6 class="mb-0">{{groupbuy.min_required}}</h6>
					</td>
					<td>
						<h6 class="mb-0">{{groupbuy.max_available}}</h6>
					</td>
					<td>
						<h6 class="mb-0">{{groupbuy.orders_count}}</h6>
					</td>
					<td>
						<h6 class="mb-0">{{groupbuy.started_by}}</h6>
					</td>
					<td>
						<h6 class="mb-0">{{groupbuy.date_success}}</h6>
					</td>
				</tr>
			</tbody>
		</table>
		<p>
			<i class="lni lni-timer"></i>
			{{timestamp}}
		</p>
		<modal @close="endEditing" :groupbuy="editingItem" v-show="editingItem != null"></modal>
	</div>
</template>

<script>
import Modal from "./GroupbuyModal";

export default {
	data() {
		return {
			groupbuys: [],
			editingItem: null,
			editingGroupbuy: null,
			timestamp: "",
			showModal: false
		};
	},
	components: { Modal },
	beforeMount() {
		axios
			.get("/api/admingroupbuys/")
			.then(response => (this.groupbuys = response.data));
	},
	created() {
		setInterval(this.getNow, 1000);
	},
	methods: {
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
		startEditing(groupbuy) {
			this.editingItem = Object.assign({}, groupbuy);
		},
		endEditing(status) {
			console.log(status);
			if (status == true) {
				var g = this.groupbuys.find(g => g.id == this.editingItem.id);
				g.status = this.editingItem.status;

				let id = g.id;
				let status = g.status;

				axios
					.put(`/api/groupbuys/${g.id}/updateStatus/`, {
						id, status
					})
					.then(response => {
						console.log(response);
						// this.products[index] = product;
					});
			}
			this.editingItem = null;

			// let index = this.products.indexOf(product)
			// let name = product.name
			// let min = product.min
			// let max = product.max
			// let price = product.price
			// let description = product.description

			// axios.put(`/api/products/${product.id}`, {name, min, max, price, description})
			// 		.then(response => this.products[index] = product)
		}
	}
};
</script>

<style scoped>
h6 {
	font-size: 14px;
}
tr.tr-data {
	transition-duration: 100ms;
}
tr.tr-data:hover {
	background-color: rgb(238, 185, 185);
}
</style>