<template>
	<div class="page-content-wrapper">
		<p>
			Double-click on item to open
		</p>
		<table class="table table-responsive table-striped">
			<thead>
				<tr>
					<td></td>
					<td>Product</td>
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
				<tr class="tr-data" v-for="(product,index) in products" :key="index" @dblclick="editingItem = product">
					<td>{{index+1}}</td>
					<td v-html="product.name"></td>
					<td>{{product.price}}</td>
					<td>{{product.description}}</td>
					<td>{{product.min}}</td>
					<td>{{product.max}}</td>
					<td>{{product.watchlists_count}}</td>
					<td v-if="!product.groupbuy_id">{{product.groupbuys_active_count}}</td>
					<td v-else> <router-link :to="{path: '/admin/groupbuys/'+product.groupbuy_id}">{{product.groupbuys_active_count}} <u>view</u></router-link></td>
					<td>{{product.groupbuys_closed_count}}</td>
				</tr>
			</tbody>
		</table>
		<modal @close="endEditing" :product="editingItem" v-show="editingItem != null"></modal>
		<modal @close="addProduct" :product="addingProduct" v-show="addingProduct != null"></modal>
		<br>
		<button class="btn btn-primary" @click="newProduct">Add New Product</button>
	</div>
</template>

<script>
import Modal from './ProductModal'

export default {
	data() {
		return {
			products: [],
			editingItem: null,
			addingProduct: null
		}
	},
	components: {Modal},
	beforeMount() {
		axios.get('/api/adminproducts/').then(response => this.products = response.data)
	},
	methods: {
		newProduct() {
			this.addingProduct = {
				name: null,
				min: null,
				max: null,
				price: null,
				image: null,
				description: null,
			}
		},
		endEditing(product) {
			this.editingItem = null

			let index = this.products.indexOf(product)
			let name = product.name
			let min = product.min
			let max = product.max
			let price = product.price
			let description = product.description

			axios.put(`/api/products/${product.id}`, {name, min, max, price, description})
					.then(response => this.products[index] = product)
		},
		addProduct(product) {
			this.addingProduct = null
			console.log("adding product");
			console.log(product);
			if (!(product.name != null 
				&& product.min != null 
				&& product.max != null 
				&& product.price != null
				&& product.description != null
				&& product.image != null)
			){
				console.log("product missing info");
				return;
			}

			let name = product.name
			let min = product.min
			let max = product.max
			let price = product.price
			let description = product.description
			let image = product.image 

			console.log("calling axios.post")

			axios.post("/api/products/", {name, min, max, price, description, image})
					.then(response => this.products.push(product))
		}
	}
}
</script>
<style scoped>
tr.tr-data {
	transition-duration: 100ms;
}

tr.tr-data:hover {
	background-color:rgb(238, 185, 185);
}
</style>