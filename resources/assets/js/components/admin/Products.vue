<template>
	<div>
		<table class="table table-responsive table-striped">
			<thead>
				<tr>
					<td></td>
					<td>Product</td>
					<td>Price</td>
					<td>Description</td>
					<td>Minimum orders</td>
					<td>Maximum orders</td>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(product,index) in products" :key="index" @dblclick="editingItem = product">
					<td>{{index+1}}</td>
					<td v-html="product.name"></td>
					<td>{{product.price}}</td>
					<td>{{product.description}}</td>
					<td>{{product.min}}</td>
					<td>{{product.max}}</td>
				</tr>
			</tbody>
		</table>
		<modal @close="endEditing" :product="editingItem" v-show="editingItem != null"></modal>
		<modal @close="addProduct"  :product="addingProduct" v-show="addingProduct != null"></modal>
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
		axios.get('/api/products/').then(response => this.products = response.data)
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

			axios.post("/api/products/", {name, min, max, price, description, image})
					.then(response => this.products.push(product))
		}
	}
}
</script>
