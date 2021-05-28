<template>
	<div class="page-content-wrapper">
		<div class="container">
			<!-- Profile Wrapper-->
			<div class="profile-wrapper-area py-3">
				<!-- User Information-->
				<div class="card user-info-card container d-flex justify-content-between">
					<div class="card-body mx-auto p-4 d-flex align-items-center">
						<img
							src="/assets/img/bg-img/9.jpg"
							alt
							style="float:center; align:center; border-radius:50%; min-width:200px; max-width:200px; min-height:200px; max-height:200px;"
						/>
					</div>
				</div>

				<div
					class="card user-info-card container d-flex justify-content-between"
					style="background-color:white; text-align:center;"
				>
					<div
						class="user-info"
						style="background-color:white; text-align:center; padding-top:5px; padding-bottom:5px;"
					>
						<h5 class="mb-0 text-dark" style="text-transform: uppercase;">{{user.name}}</h5>
						<p class="mb-0 text-secondary">{{user.email}}</p>
					</div>
				</div>
			</div>

			<!-- Orders Data-->
			<div class="row g-2">
				<div class="col-7">
					<h5>Orders</h5>
				</div>
				<!-- <div class="col-4" style="padding:0px!important;text-align:right; float:right;">
					<a
						class="btn btn-info w-100"
						href="edit-profile.html"
						style="float:right!important; text-align:right; padding: .325rem .2rem!important;"
					>View History</a>
				</div> -->

				<!-- <div class="col-1" style="padding-top:4px; float:left;align-content:left;">
					<img src="https://img.icons8.com/windows/12/000000/forward.png" />
				</div> -->
			</div>
			<div class="row g-2">
				<div class="col-3">
					<div class="card catagory-card">
						<div class="card-body">
							<router-link :to="{ path: '/userpay' }" class="text-danger">
								<img src="https://img.icons8.com/windows/32/000000/bank-card-back-side--v1.png" />
								<span>To Pay</span>
							</router-link>
						</div>
					</div>
				</div>
				<div class="col-3">
					<div class="card catagory-card">
						<div class="card-body">
							<router-link :to="{ path: '/userorderprocessing'}" class="text-danger">
								<img src="https://img.icons8.com/windows/32/000000/open-parcel.png" />
								<span>Processing</span>
							</router-link>
						</div>
					</div>
				</div>
				<div class="col-3">
					<div class="card catagory-card">
						<div class="card-body">
							<router-link :to="{path: '/userordershipping'}" class="text-danger">
								<img src="https://img.icons8.com/windows/32/000000/truck.png" />
								<span>Shipping</span>
							</router-link>
						</div>
					</div>
				</div>
				<div class="col-3">
					<div class="card catagory-card">
						<div class="card-body">
							<router-link :to="{path: '/userordercancelled'}" href="catagory.html" class="text-danger">
								<img src="https://img.icons8.com/windows/32/000000/smartphone-tablet.png" />
								<span>Cancelled</span>
							</router-link>
						</div>
					</div>
				</div>
			</div>
			<!-- Orders Data-->
			<br />
			<br />
			<div class="row g-2">
				<div class="col-7">
					<h5>Reward Tokens</h5>
				</div>
				<div
					class="card user-info-card container d-flex justify-content-between"
					style="background-color:white; text-align:center;"
				>
					<div
						class="user-info"
						style="background-color:white; text-align:center; padding-top:5px; padding-bottom:5px;"
					>
						<strong v-if="tokenCount == 1">You have {{tokenCount}} token!</strong>
						<strong v-else-if="tokenCount == 0">No token available :(</strong>
						<strong v-else>You have {{tokenCount}} tokens!</strong>
						<p v-if="tokenCount > 0">Spend on your favourite products to attract more interest!</p>
						<p
							v-else
						>Every time you make a new purchase, a token will be awarded! These tokens can be used to raise the popularity of you favourite products!</p>
					</div>
				</div>
			</div>

			<!-- User Meta Data-->
			<br />
			<br />
			<div class="row g-2">
				<div class="col-7">
					<h5>Profile</h5>
				</div>
				<div class="col-4" style="padding:0px!important;text-align:right; float:right;">
					<a
						class="btn btn-info w-100"
						href="edit-profile.html"
						style="float:right!important; text-align:right; padding: .325rem .2rem!important;"
					>Edit Profile</a>
				</div>

				<div class="col-1" style="padding-top:4px; float:left;align-content:left;">
					<img src="https://img.icons8.com/windows/12/000000/forward.png" />
				</div>
			</div>

			<div class="card-body">
				<div class="single-profile-data d-flex align-items-center justify-content-between">
					<div class="title d-flex align-items-center">
						<i class="lni lni-user"></i>
						<span>Username</span>
					</div>
					<div class="data-content">{{user.name}}</div>
				</div>
				<div>
					<div class="single-profile-data d-flex align-items-center justify-content-between">
						<div class="title d-flex align-items-center">
							<i class="lni lni-envelope"></i>
							<span>Email Address</span>
						</div>
						<div class="data-content">{{user.email}}</div>
					</div>

					<div class="single-profile-data d-flex align-items-center justify-content-between">
						<div class="title d-flex align-items-center">
							<i class="lni lni-map-marker"></i>
							<span>Shipping</span>
						</div>
						<div
							class="data-content"
						>{{user.shipping_streetaddress}}, {{user.shipping_postalcode}}, {{user.shipping_city}}</div>
					</div>

					<div class="single-profile-data d-flex align-items-center justify-content-between">
						<div class="title d-flex align-items-center">
							<router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">
								<i class="lni lni-power-switch"></i>
								<span>Login</span>
							</router-link>
						</div>
					</div>

					<div class="single-profile-data d-flex align-items-center justify-content-between">
						<div class="title d-flex align-items-center">
							<router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">
								<i class="lni lni-power-switch"></i>
								<span>Register</span>
							</router-link>
						</div>
					</div>

					<div class="row g-2 single-profile-data d-flex align-items-center justify-content-between">
						<div class="col-12 signout" v-if="isLoggedIn" @click="logout">
							<span>Log Out</span>
						</div>
					</div>
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
.catagory-card {
	height: 87px;
}
</style>

<script>
export default {
	data() {
		return {
			user: null,
			orders: [],
			name: null,
			user_type: 0,
			tokenCount: 0,
			isLoggedIn: localStorage.getItem("bigStore.jwt") != null
		};
	},
	beforeMount() {
		this.user = JSON.parse(localStorage.getItem("bigStore.user"));

		axios.defaults.headers.common["Content-Type"] = "application/json";
		axios.defaults.headers.common["Authorization"] =
			"Bearer " + localStorage.getItem("bigStore.jwt");

		axios
			.get(`api/users/${this.user.id}/orders`)
			.then(response => (this.orders = response.data));

		axios.get(`api/tokens/avail/${this.user.id}`).then(response => {
			let tokens = response.data;
			this.tokenCount = 0;
			if (!(Object.keys(tokens).length === 0)) {
				this.tokenCount = tokens.length;
			}
		});
	},
	methods: {
		logout() {
			localStorage.removeItem("bigStore.jwt");
			localStorage.removeItem("bigStore.user");
			this.$emit("loggedOut");
			this.$router.push("/");
		}
	},
	computed: {
		show: function() {
			return this.$store.state.navigation.show;
		}
	}
};
</script>

<style scoped>
.signout {
	background-color: #a93226;
	color: white;
	font-size: 12px;
	height: 25px;
	border-radius: 5px;
	float: center;
	text-align: center;
	padding: 4px;
}
</style>