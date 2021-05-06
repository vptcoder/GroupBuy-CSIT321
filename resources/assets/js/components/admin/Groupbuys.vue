<template>
	<div class="page-content-wrapper">
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
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(groupbuy,index) in groupbuys" :key="index" @dblclick="editingItem = groupbuy">
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
					<td>
						<p>
							<i class="lni lni-magnifier"></i>Open
						</p>
					</td>
				</tr>
			</tbody>
		</table>
		<p>
			<i class="lni lni-timer"></i>
			{{timestamp}}
		</p>
	</div>
</template>

<script>
export default {
	data() {
		return {
			groupbuys: [],
			editingItem: null,
			addingProduct: null,
			timestamp: ""
		};
	},
	// components: {Modal},
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
		}
	}
};
</script>

<style scoped>
h6 {
	font-size: 14px;
}
</style>