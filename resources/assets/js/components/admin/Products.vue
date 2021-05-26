<template>

	<div class="page-content-wrapper"> 
 
		<p>Single-click on item to open</p>
		<button class="btn btn-primary" @click="newProduct">Add New Product</button>

		 <mdb-input class="mt-0" v-model="search" label="Search by product name" />
		<mdb-datatable-2 v-model="data" :searching="{value: search, field: 'name'}" striped 
		bordered @selected="startEditing(data.product)"

				 
       />

				 
       />
 		<!-- <table class="table table-responsive table-hover">
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
					<td>{{parseFloat(product.price).toFixed(2)}}</td>
					<td>{{product.description}}</td>
					<td>{{product.min}}</td>
					<td>{{product.max}}</td>
					<td>{{product.watchlists_count}}</td>
					<td>{{product.groupbuys_closed_count}}</td>
				</tr>
			</tbody>
		</table> -->
		<modal @close="endEditing" :product="editingItem" v-show="editingItem != null"></modal>
		<modal @close="addProduct" :product="addingProduct" v-show="addingProduct != null"></modal>
		<br />
 	</div>
</template>

<script>
import Modal from "./ProductModal";
 

import { mdbDatatable2, mdbIcon  ,mdbInput  } from 'mdbvue';


export default {
	data() {
		return {
		search: '',
	 
		data: {
          rows: [],
         columns: [] 
           
		},
		
       
			products: [],
			editingItem: null,
			addingProduct: null
		};
 	},
 
	components: { 
		Modal,
	mdbDatatable2, mdbIcon , mdbInput
	},
	beforeMount() {
		axios
			.get("/api/adminproducts/")
			.then(response => (this.products = response.data));
	},
	
	mounted(){
    		axios.get(`/api/adminproducts/`).then(response => {
			this.products = response.data;
        let keys = ["id","name", "status", "min","max","description","price","watchlists_count","groupbuys_closed_count"];

        let entries = this.filterData(this.products, keys);
			//columns
			this.data = {
			columns: [
			{
              label: '',
              field: 'id',
              sort: true
            },
            {
              label: 'Product',
              field: 'name',
              sort: true
            },
            {
              label: 'Status',
              field: 'status',
              sort: true
            },
            {
              label: 'Price',
              field: 'price',
              sort: false,
              format: value => '$' + value
            },
            {
              label: 'Description',
              field: 'description',
              sort: true
            },
            {
              label: 'Minimum Orders',
              field: 'min',
              sort: true
            },
            {
              label: 'Maximum Orders',
              field: 'max',
 			  sort: true
            },
			{
              label: 'Popularity',
              field: 'watchlists_count',
              sort: true
            },
			{
              label: 'Closed Groupbuys',
              field: 'groupbuys_closed_count',
              sort: true
            }
          ],
		// rows
			rows: entries,

            clickEvent: () => this.startEditing(id)
			}
		})
			.catch(error => {
				alert(error);
			})
			
 
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
  @import "mdb.min.css";  

tr.tr-data {
	transition-duration: 100ms;
}
 
</style>