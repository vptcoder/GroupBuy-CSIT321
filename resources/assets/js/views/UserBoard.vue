<template>
	<div class="page-content-wrapper">
		<!-- <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
			<h2 class="title">All your orders</h2>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<br>
					<div class="row">
						<div class="col-md-4 product-box" v-for="(order,index) in orders" :key="index">
							<img :src="order.product.image" :alt="order.product.name">
							<h5><span v-html="order.product.name"></span><br>
								<span class="small-text text-muted">$ {{order.product.price}}</span>
							</h5>
							<hr>
							<span class="small-text text-muted">Quantity: {{order.quantity}}
								<span class="float-right">{{order.is_delivered == 1? "shipped!" : "not shipped"}}</span>
							</span>
							<br><br>
							<p><strong>Delivery address:</strong> <br>{{order.address}}</p>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<div class="container">
			<!-- Profile Wrapper-->
			<div class="profile-wrapper-area py-3">
			<!-- User Information-->
			<!--  <div class="card user-info-card">
				  <div class="card-body p-4 d-flex align-items-center">  
				<div class="user-profile me-3"><img src="img/bg-img/10.jpg" alt=""></div>
				<div class="user-info">
					<p class="mb-0 text-white">{{user.email}}</p>
					<h5 class="mb-0">{{user.name}}</h5>
				</div>
				</div>
				-->
 
					<!-- Profile Details 
					<p data-v-1e5f2553="">This is product 1's description. Short text</p>  -->
			 
				<div class="card user-info-card container d-flex justify-content-between">
					<div class="card-body mx-auto p-4 d-flex align-items-center"> 
						<img data-v-17cbdf11="" src="/assets/img/bg-img/9.jpg" alt="" style="float:center; align:center;">
					</div>
				</div>

				<div class="card user-info-card container d-flex justify-content-between" style="background-color:white; text-align:center;">
					<div class="user-info" style="background-color:white; text-align:center; padding-top:5px; padding-bottom:5px;">
						<h5 class="mb-0 text-dark" style="text-transform: uppercase;">{{user.name}}</h5>
						<p class="mb-0 text-secondary ">{{user.email}}</p>
					</div>
				</div>
			</div>
			

			<!-- Orders Data-->
			<div class="row g-2">    
    			<div class="col-8"> 
					<h5>Orders</h5>
    			</div>
    			<div class="col-4"> 
					<a class="btn btn-info w-100" href="edit-profile.html">View History &gt;</a></div>
    			</div>
		 
				<div class="card user-data-card">
					<div class="row g-2">    
						<div class="col-3">
							<div class="card catagory-card">
								<div class="card-body">
									<a href="catagory.html" class="text-danger">
										<img src="https://img.icons8.com/windows/32/000000/bank-card-back-side--v1.png"/>
										<span>To Pay</span>
									</a>
								</div>
							</div>
						</div> 
						<div class="col-3">
							<div class="card catagory-card">
								<div class="card-body">
									<a href="catagory.html" class="text-danger">
										<img src="https://img.icons8.com/windows/32/000000/open-parcel.png"/> 
										<span>Processing</span>
									</a>
								</div>
							</div>
						</div> 
						<div class="col-3">
							<div class="card catagory-card">
								<div class="card-body">
									<a href="catagory.html" class="text-danger">
										<img src="https://img.icons8.com/windows/32/000000/truck.png"/> 
										<span>Shipping</span>
									</a>
								</div>
							</div>
						</div> 
						<div class="col-3">
							<div class="card catagory-card">
								<div class="card-body">
									<a href="catagory.html" class="text-danger">
										<img src="https://img.icons8.com/windows/32/000000/smartphone-tablet.png"> 
										<span>Cancelled</span>
									</a>
								</div>
							</div>
						</div> 
					</div>
				</div>
				<!-- User Meta Data-->
				<br><br>
				<div class="row g-2">    
					<div class="col-8"> 
						<h5>Profile</h5>
					</div>
					<div class="col-4"> 
						<a class="btn btn-info w-100" href="edit-profile.html">Edit Profile &gt;</a></div>
					</div>
				</div>
				<div class="card-body">
				<div class="single-profile-data d-flex align-items-center justify-content-between">
					<div class="title d-flex align-items-center">
						<i class="lni lni-user"></i><span>Username</span>
					</div>
					<div class="data-content">{{user.name}}</div>
				</div>
				<div>
					<div>
				<!-- <div class="single-profile-data d-flex align-items-center justify-content-between">
					<div class="title d-flex align-items-center"><i class="lni lni-user"></i><span>Full Name</span></div>
					<div class="data-content">SUHA JANNAT</div>
				</div> -->
				<!-- <div class="single-profile-data d-flex align-items-center justify-content-between">
					<div class="title d-flex align-items-center"><i class="lni lni-phone"></i><span>Phone</span></div>
					<div class="data-content">+880 000 111 222</div>
				</div> -->
				<div class="single-profile-data d-flex align-items-center justify-content-between">
					<div class="title d-flex align-items-center"><i class="lni lni-envelope"></i><span>Email Address</span></div>
					<div class="data-content">{{user.email}}</div>
				</div>
				<div class="single-profile-data d-flex align-items-center justify-content-between">
					<div class="title d-flex align-items-center"><i class="lni lni-map-marker"></i><span>Shipping</span></div>
					<div class="data-content">{{user.shipping_streetaddress}}, {{user.shipping_postalcode}}, {{user.shipping_city}}</div>
				</div>
				 
			</div>
		</div>
	</div>
</template>

<style scoped>
/* .small-text { font-size: 14px; }
.product-box { border: 1px solid #cccccc; padding: 10px 15px; }
.hero-section { background: #ababab; height: 20vh; align-items: center; margin-bottom: 20px; margin-top: -20px; }
.title { font-size: 60px; color: #ffffff; } */
</style>

<script>
export default {
	data() {
		return {
			user : null,
			orders : []
		}
	},
	beforeMount() {
		this.user = JSON.parse(localStorage.getItem('bigStore.user'))

		axios.defaults.headers.common['Content-Type'] = 'application/json'
		axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('bigStore.jwt')

		axios.get(`api/users/${this.user.id}/orders`)
				.then(response => this.orders = response.data)
	}
}
</script>
