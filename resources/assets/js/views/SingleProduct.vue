<template>
	<div class="page-content-wrapper">
		<!-- Product Slides-->
		<div class="product-slides owl-carousel">
			<!-- Single Hero Slide-->
			<div class="single-product-slide" >
				<img :src="product.image" :alt="product.name" >
			</div>
		</div>
		<div class="product-description pb-3">
			<!-- Product Title & Meta Data-->
			<div class="product-title-meta-data bg-white mb-3 py-3">
				<div class="container d-flex justify-content-between">
				<div class="p-title-price">
					<h6 class="mb-1">{{product.name}}</h6>
					<p class="sale-price mb-0">${{product.price}}</p>
				</div>
				<div class="p-wishlist-share"><a href="wishlist-grid.html"><i class="lni lni-heart"></i></a></div>
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
			<row>
				Color: <b>{{product.name}}</b>
				<br>
				Style: <b>1012345</b> 
				<br>
				<b style="color:#A93226;font-size:25px;margin-left:10px;">${{product.price}}</b>
				<img src="/assets/img/icons/Oval 9.png" style="margin-left:150px">
				<b style="margin-left:10px">1</b>
				<img src="/assets/img/icons/Oval 8.png" style="margin-left:10px">
			</row>
			<br>
			<row>
				<b style="color:#A93226;font-size:15px;">SGD</b><b style="color:black;font-size:15px;margin-left:5px;text-decoration:line-through;">$ 280</b>
				<lable style="margin-left:160px;color:red;">9 slots left</lable>
			</row>
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
</template>

<script>
export default {
	data(){
		return {
			product : []
		}
	},
	beforeMount(){
		let url = `/api/products/${this.$route.params.id}`
		axios.get(url).then(response => this.product = response.data)      
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
</style>
