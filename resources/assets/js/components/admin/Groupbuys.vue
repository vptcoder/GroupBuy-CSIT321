<template>
	<div class="page-content-wrapper">
  		<p>
			<i class="lni lni-timer"></i>
			{{timestamp}}
		</p>
 	 
		<mdb-input class="mt-4" v-model="search" label="Search by product name" />
		
 		<mdb-datatable-2
			v-model="data"
			:searching="{value: search, field: 'product_name'}"
 			hover
			bordered
			responsive focus
			@selected="editingItem = $event"
			 
		/>
 
		<br />
	 	<modal @close="endEditing" :groupbuy="editingItem" v-show="editingItem != null"></modal>
<!-- 
		<table class="table table-responsive ">
			<thead>
				<tr>
					<td></td>
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
		<modal @close="endEditing" :groupbuy="editingItem" v-show="editingItem != null"></modal> -->
	</div>  
</template>

<script>
import Modal from "./GroupbuyModal";
import { mdbDatatable2, mdbIcon, mdbInput } from "mdbvue";

export default {
	data() {
		return {
			search: '',
			groupbuys: [],
			editingItem: null,
			editingGroupbuy: null,
			timestamp: "",
			showModal: false,
		    data: {
				rows: [],
				columns: []
			},
		};
	},
	components: {
		 Modal,		mdbDatatable2,
		mdbIcon,
		mdbInput },

	beforeMount() {
		axios
			.get("/api/admingroupbuys/")
			.then(response => (this.groupbuys = response.data));
	},
	created() {
		setInterval(this.getNow, 1000);
	},
	mounted() {
		axios
			.get(`/api/admingroupbuys/`)
			.then(response => {
				this.groupbuys = response.data;
				let keys = [
					"id",
					"product_name",
					"status",
					"date_start",
					"date_end",
					"min_required",
					"max_available",
					"orders_count",
					"started_by",
					"date_success"
				];

				let entries = this.filterData(this.groupbuys, keys);
				//columns
				this.data = {
					columns: [
						{
							label: "",
							field: "id",
							sort: true
						},
						{
							label: "Product  Name",
							field: "product_name",
							sort: true
						},
						{
							label: "Status",
							field: "status",
							sort: true 
							// format: value =>
							// 	value == "p11" ? "Available" : "Hidden"
						},
						{
							label: "Start Date",
							field: "date_start",
							sort: true
						},
						{
							label: "End Date",
							field: "date_end",
							sort: true
						},
						{
							label: "Minimum Orders",
							field: "min_required",
							sort: true
						},
						{
							label: "Stocks Available",
							field: "max_available",
							sort: true
						},
						{
							label: "Current Orders",
							field: "orders_count",
							sort: true
						},
						{
							label: "Started By",
							field: "started_by",
							sort: true
						},
						{
							label: "Completed Date",
							field: "date_success",
							sort: true
						},						
					],
					// rows
					rows: entries

 				};
			})
			.catch(error => {
				alert(error);
			});
	},
	methods: {
		filterData(dataArr, keys) {
			let data = dataArr.map(entry => {
				let filteredEntry = {};

				keys.forEach(key => {
					if (key in entry) {
						filteredEntry[key] = entry[key];
 					}
				});

				return filteredEntry;
			});

			return data;
		},
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
		}
	}
};
</script>

<style scoped>

h6 {
	font-size:large;
}
tr.tr-data {
	transition-duration: 100ms;
}
 
 
 
</style>