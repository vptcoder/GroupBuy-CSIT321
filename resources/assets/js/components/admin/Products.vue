<template>
	<div class="page-content-wrapper">
		<p>Double-click on item to open</p>
		<table class="table table-responsive table-striped">
			<thead>
				<tr>
					<td></td>
					<td>Product</td>
					<td>Status</td>
					<td>Price</td>
					<td>Description</td>
					<td>Minimum orders</td>
					<td>Maximum orders</td>
					<td>Popularity</td>
					<td>Active Groupbuy</td>
					<td>Closed Groupbuy</td>
				</tr>
			</thead>
			<tbody>
				<tr
					class="tr-data"
					v-for="(product,index) in products"
					:key="index"
					@dblclick="startEditing(product)"
				>
					<td>{{index+1}}</td>
					<td>{{product.name}}</td>
					<td v-if="product.status === 'p11'">Available</td>
					<td v-else>Hidden</td>
					<td>{{product.price}}</td>
					<td>{{product.description}}</td>
					<td>{{product.min}}</td>
					<td>{{product.max}}</td>
					<td>{{product.watchlists_count}}</td>
					<td v-if="!product.groupbuy_id">{{product.groupbuys_active_count}}</td>
					<td v-else>
						<router-link :to="{path: '/admin/groupbuys/'+product.groupbuy_id}">
							{{product.groupbuys_active_count}}
							<u>view</u>
						</router-link>
					</td>
					<td>{{product.groupbuys_closed_count}}</td>
				</tr>
			</tbody>
		</table>
		<modal @close="endEditing" :product="editingItem" v-show="editingItem != null"></modal>
		<modal @close="addProduct" :product="addingProduct" v-show="addingProduct != null"></modal>
		<br />
		<button class="btn btn-primary" @click="newProduct">Add New Product</button>
	</div>
</template>

<script>
import Modal from "./ProductModal";

export default {
	data() {
		return {
			products: [],
			editingItem: null,
			addingProduct: null
		};
	},
	components: { Modal },
	beforeMount() {
		axios
			.get("/api/adminproducts/")
			.then(response => (this.products = response.data));
	},
	methods: {
		newProduct() {
			this.addingProduct = {
				name: null,
				min: null,
				max: null,
				status: "p11",
				price: null,
				image: null,
				description: null
			};
		},
		startEditing(product) {
			this.editingItem = Object.assign({}, product);
		},
		endEditing(editstatus) {
			if (editstatus != true) {
				this.editingItem = null;
				if (editstatus == 1) {
					console.log("image missing!");
				}
				return;
			}

			let product = this.products.find(p => p.id == this.editingItem.id);
			product.name = this.editingItem.name;
			product.min = this.editingItem.min;
			product.max = this.editingItem.max;
			product.status = this.editingItem.status;
			product.price = this.editingItem.price;
			product.description = this.editingItem.description;
			product.image = this.editingItem.image;

			let index = this.products.indexOf(product);
			let name = product.name;
			let min = product.min;
			let max = product.max;
			let status = product.status;
			let price = product.price;
			let description = product.description;
			let image = product.image;

			axios
				.put(`/api/products/${product.id}`, {
					name,
					description,
					price,
					image,
					min,
					max,
					status
				})
				.then(response => (this.products[index] = product));
			this.editingItem = null;
		},
		addProduct(addstatus) {
			if (addstatus != true) {
				this.addingProduct = null;
				if (addstatus == 1) {
					console.log("image missing!");
				}
				return;
			}

			console.log("adding product");
			// console.log(this.addingProduct);
			if (
				!(
					this.addingProduct.name != null &&
					this.addingProduct.min != null &&
					this.addingProduct.max != null &&
					this.addingProduct.status != null &&
					this.addingProduct.price != null &&
					this.addingProduct.description != null &&
					this.addingProduct.image != null
				)
			) {
				console.log("product missing info");
				return;
			}
			let product = this.addingProduct;
			let name = product.name;
			let min = product.min;
			let max = product.max;
			let status = product.status;
			let price = product.price;
			let description = product.description;
			let image = product.image;

			// console.log("calling axios.post");

			axios
				.post("/api/products/", {
					name,
					min,
					max,
					status,
					price,
					description,
					image
				})
				.then(response => this.products.push(product));
			this.addingProduct = null;
		}
	}
};
</script>
<style scoped>
tr.tr-data {
	transition-duration: 100ms;
}

tr.tr-data:hover {
	background-color: rgb(238, 185, 185);
}
</style>