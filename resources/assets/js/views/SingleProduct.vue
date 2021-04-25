<template>
	<div class="page-content-wrapper">
		<div v-if="!is_data_fetched" >
			<!-- Preloader-->
			<div class="preloader" id="preloader">
				<div class="spinner-grow text-secondary" role="status">
					<div class="sr-only">Loading...</div>
				</div>
			</div>
		</div>
		<div v-else >
			<!-- Product Slides-->
			<carousel :items="1" :autoplay="false" :nav="true" :dots="true" >
				<div >
					<img :src="product.image" :alt="product.name" >
				</div>
				<div >
					<img :src="product.image" :alt="product.name" >
				</div>
				<div >
					<img :src="product.image" :alt="product.name" >
				</div>
			</carousel>
			<div class="product-description pb-3">
				<!-- Product Title & Meta Data-->
				<div class="product-title-meta-data bg-white mb-3 py-3">
					<div class="container d-flex justify-content-between">
					<div class="p-title-price">
						<h6 class="mb-1">{{product.name}}</h6>
						<p class="sale-price mb-0">${{product.price}}</p>
					</div>
					<div class="p-wishlist-share">
						<a class="wishlist-btn notwatching-btn" v-if="!user" v-on:click.prevent @click="promptlogin()">
							<i class="lni lni-heart"></i>
						</a>
						<a class="wishlist-btn " v-else v-bind:class="!product.watchlists.some(w => w.user_id == user.id) ? 'notwatching-btn' : 'watching-btn'" v-on:click.prevent @click="watch(user.id)">
							<i class="lni lni-heart"></i>
						</a>
					</div>
					</div>
					<!-- Ratings-->
					<div class="product-ratings">
					<div class="container d-flex align-items-center justify-content-between">
						<div class="ratings"><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><span class="ps-1">3 ratings</span></div>
						<div class="total-result-of-ratings"><span>5.0</span><span>Very Good                                </span></div>
					</div>
					</div>
				</div>			
				<!-- Product Specification-->
				<div class="p-specification bg-white mb-3 py-3">
					<div class="container">
						<h6>Specifications</h6>
						<p>{{product.description}}</p>
					</div>
				</div>
			</div>

			<hr>
			<hr>
			<hr>

			<div style="margin-left:30px">
				<div>
					Color: <b>{{product.name}}</b>
					<br>
					Style: <b>1012345</b> 
					<br>
					<b style="color:#A93226;font-size:25px;margin-left:10px;">${{product.price}}</b>
					<img src="/assets/img/icons/Oval 9.png" style="margin-left:150px">
					<b style="margin-left:10px">1</b>
					<img src="/assets/img/icons/Oval 8.png" style="margin-left:10px">
				</div>
				<br>
				<div>
					<b style="color:#A93226;font-size:15px;">SGD</b><b style="color:black;font-size:15px;margin-left:5px;text-decoration:line-through;">$ 280</b>
					<label style="margin-left:160px;color:red;">9 slots left</label>
				</div>
			</div>
			<hr>
			<div>
				<img src="/assets/img/icons/bb.png"  style="margin-left:30px;"> <b>15 days return</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<img src="/assets/img/icons/gg.png"> <b>100% Authentic</b>
				<br>
				<img src="/assets/img/icons/car.png"  style="margin-left:30px;"><b> Free Shipping</b>
			</div>
			<hr>
			<div>
				<b style="Front-size:20px;margin-left:30px;">Description:</b>
				<br>
				<p style="margin-left:30px;">{{product.description}}</p>			
			</div>
			<router-link :to="{ path: '/checkout?pid='+product.id }" class="col-md-4 btn btn-sm btn-primary float-right">Buy Now</router-link>
		</div>
	</div>	
</template>

<script>
import carousel from 'vue-owl-carousel';

export default {

	data(){
		return {
			user: null,
			product : null,
			is_data_fetched: false
		}
	},
	beforeMount(){
		this.user = JSON.parse(localStorage.getItem('bigStore.user'));

		let url = `/api/products/${this.$route.params.id}`;
		axios.get(url).then(response => {this.product = response.data; this.is_data_fetched = true;});

	},components: {
		carousel
	}, mounted(){
		// this.$forceUpdate();
	},
	methods: {
		promptlogin(){
			alert("Please login!")
		},
		watch(userid) {
			var found = false;
			var indexFound;
			var idFound;
			var product = this.product;
			for (var i = 0; i < product.watchlists.length; i++){
				if (product.watchlists[i].user_id == userid){
					found = true;
					indexFound = i;
					idFound = product.watchlists[i].id;
					break;
				}
			}
			console.log("product object - ", product);
			console.log("User exists in watchlist? - ", found);
			console.log("User at index - ", indexFound);

			if(!found){
				var productid = product.id;
				var res;
				console.log("userid: ", userid);
				console.log("productid: ", productid);
				
				axios.post("/api/watchlists", {productid, userid})
				.then(function (response) {
					product.watchlists.push({
						'id': response.data.data.id.toString()
						, 'product_id': response.data.data.product_id.toString()
						, 'user_id': response.data.data.user_id.toString()
					});
					console.log("userid added.");
				})
				.catch(function (error){
					console.log("userid not added.", error);
				})
				
			} else {
				product.watchlists.splice(indexFound, 1);
				axios.delete(`/api/watchlists/${idFound}`)
				.then(function (response){
					console.log("userid removed.");
				})
				.catch(function (error){
					console.log("userid not removed.", error);
				})
			}
		}

	}
}
</script>

<style scoped>
.sale{
	height: 30px;
	width: 30px;
	position: relative;
	left: 300px;
	top:20px;
}


.img{
	background-color:#f4f4f4;
	width:300px;
	height:170px;
	margin-left:40px;
}
.img img{
  min-height: 100%;
  max-height: 100%;
  min-width: 100%;
  max-width: 100%;

} 
.name {
  font-size: 12px;
  color:black;
  margin-left:70px;
}

.watching-btn {
	color: #ea4c62;
}

.notwatching-btn {
	color: grey;
}

.owl-carousel .nav-btn{
  height: 47px;
  position: absolute;
  width: 26px;
  cursor: pointer;
  top: 100px !important;
}

.owl-carousel .owl-prev.disabled,
.owl-carousel .owl-next.disabled{
pointer-events: none;
opacity: 0.2;
}

.owl-carousel .prev-slide{
  background: url(nav-icon.png) no-repeat scroll 0 0;
  left: -33px;
}
.owl-carousel .next-slide{
  background: url(nav-icon.png) no-repeat scroll -24px 0px;
  right: -33px;
}
.owl-carousel .prev-slide:hover{
 background-position: 0px -53px;
}
.owl-carousel .next-slide:hover{
background-position: -24px -53px;
}   
</style>
