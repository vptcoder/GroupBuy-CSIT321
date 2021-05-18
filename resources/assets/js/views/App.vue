<template>
	<!-- NOTES: This file is for navigation bar code. -->
	<div>
		<!-- <nav v-show="show" class="navbar navbar-expand-md navbar-light navbar-laravel">
			<div class="topnavcontainer">
				<router-link :to="{ name: 'home' }" class="navbar-brand">G-BUY</router-link>
				<input type="text" class="form-control navbar-search" name="Search" placeholder="Search" />
			</div>
		</nav>
		<nav v-show="show" class="navbarbot navbar-expand-md navbar-light navbar-laravel">
			<div class="botnavcontainer">
				<div class="botnav-button">
					<router-link :to="{ name: 'home' }" class="navbar-brand">
						<input type="submit" class="button-home" value />
					</router-link>
				</div>

				<div class="botnav-button">
					<router-link :to="{ name: 'watchlist' }" class="navbar-brand">
						<input type="submit" class="button-watch" value />
					</router-link>
				</div>

				<div class="botnav-button">
					<router-link :to="{ name: 'notifications' }" class="navbar-brand">
						<input type="submit" class="button-notification" value />
					</router-link>
				</div>

				<div class="botnav-button">
					<router-link :to="{ name: 'viewownaccount' }" class="navbar-brand">
						<input type="submit" class="button-account" value />
					</router-link>
				</div>
			</div>
		</nav>-->

		<!-- Preloader-->
		<div class="preloader" id="preloader">
			<div class="spinner-grow text-secondary" role="status">
				<div class="sr-only">Loading...</div>
			</div>
		</div>

		<!-- Header Area-->
		<div class="header-area" id="headerArea">
			<div class="container h-100 d-flex align-items-center justify-content-between">
				<!-- Logo Wrapper-->
				<div class="logo-wrapper">
					<router-link :to="{ name: 'home' }">
						<img class="brand-logo" src="/assets/img/core-img/brand-logo.png" alt />
					</router-link>
				</div>
				<!-- Search Form-->
				<div v-show="show" class="top-search-form" style="width:100%; padding-left:5px;">
					<form action method>
						<input class="form-control" type="search" placeholder="Search" />
						<button type="submit">
							<i class="fa fa-search"></i>
						</button>
					</form>
				</div>
				<div v-show="!show" class="top-search-form">
					<h2>Admin</h2>
				</div>
				<!-- Navbar Toggler-->
				  <div class="suha-navbar-toggler d-flex flex-wrap" id="suhaNavbarToggler">
					<span></span>
					<span></span>
					<span></span>
				</div>  
			</div>
		</div>

		<!-- Sidenav Black Overlay-->
		<div class="sidenav-black-overlay"></div>

		<!-- Side Nav Wrapper-->
		<div class="suha-sidenav-wrapper" id="sidenavWrapper">
			<!-- Sidenav Profile-->
			<div class="sidenav-profile">
				<div class="user-profile">
					<img src="/assets/img/bg-img/9.jpg" alt />
				</div>
				<div class="user-info">
					<h6 class="user-name mb-0" v-if="isLoggedIn">{{name}}</h6>
					<h6 class="user-name mb-0" v-else>Guest</h6>
				</div>
			</div>
			<!-- Sidenav Nav-->
			<ul class="sidenav-nav ps-0">
				<li>
					<router-link :to="{ name: 'userboard' }" class="navbar-brand">
						<i class="lni lni-user"></i>My Profile
					</router-link>
				</li>
				<li>
					<a href="notifications.html">
						<i class="lni lni-alarm lni-tada-effect"></i>Notifications
						<span class="ms-3 badge badge-warning">3</span>
					</a>
				</li>
				<li class="suha-dropdown-menu">
					<a href="#">
						<i class="lni lni-cart"></i>Shop Pages
					</a>
					<ul>
						<li>
							<a href="shop-grid.html">- Shop Grid</a>
						</li>
						<li>
							<a href="shop-list.html">- Shop List</a>
						</li>
						<li>
							<a href="single-product.html">- Product Details</a>
						</li>
						<li>
							<a href="featured-products.html">- Featured Products</a>
						</li>
						<li>
							<a href="flash-sale.html">- Flash Sale</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="pages.html">
						<i class="lni lni-empty-file"></i>All Pages
					</a>
				</li>
				<li class="suha-dropdown-menu">
					<a href="wishlist-grid.html">
						<i class="lni lni-heart"></i>My Wishlist
					</a>
					<ul>
						<li>
							<a href="wishlist-grid.html">- Wishlist Grid</a>
						</li>
						<li>
							<a href="wishlist-list.html">- Wishlist List</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="settings.html">
						<i class="lni lni-cog"></i>Settings
					</a>
				</li>
				<li>
					<router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">
						<i class="lni lni-power-switch"></i>Login
					</router-link>
				</li>

				<li>
					<router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">
						<i class="lni lni-power-switch"></i>Register
					</router-link>
				</li>
				<li class="nav-link" v-if="isLoggedIn" @click="logout">
					<i class="lni lni-power-switch"></i>Sign Out
				</li>
			</ul>
			<!-- Go Back Button-->
			<div class="go-home-btn" id="goHomeBtn">
				<i class="lni lni-arrow-left"></i>
			</div>
		</div>

		<main v-bind:class="!show ? 'admin-page-margin' : ''">
			<router-view @loggedIn="change"></router-view>
		</main>

		<!-- Internet Connection Status-->
		<div class="internet-connection-status" id="internetStatus"></div>
		<!-- Footer Nav-->
		<div class="footer-nav-area" id="footerNav" v-show="show">
			<div class="container h-100 px-0">
				<div class="suha-footer-nav h-100">
					<ul class="h-100 d-flex align-items-center justify-content-between ps-0">
						<li v-show="show">
							<router-link :to="{ name: 'home' }" class="navbar-brand">
								<img src="https://img.icons8.com/windows/32/000000/home.png"/>
								Home
							</router-link>
						</li>
						<li v-show="show">
							<router-link :to="{ name: 'watchlist' }" class="navbar-brand">
								<img src="https://img.icons8.com/windows/32/000000/like.png"/>
								Wishlist
							</router-link>
						</li>
						<li v-show="show">
							<router-link :to="{ name: 'notifications' }" class="navbar-brand">
								<img src="https://img.icons8.com/windows/32/000000/appointment-reminders.png"/>
								Notifications
							</router-link>
						</li>
						<li v-show="show">
							<router-link :to="{ name: 'userboard' }" class="navbar-brand">
								<img src="https://img.icons8.com/windows/32/000000/gender-neutral-user.png"/>
								Profile
							</router-link>
						</li>
						<!-- Admin controls-->
						<li class="active" v-show="!show">
							<router-link :to="{ name: 'home' }" class="navbar-brand">
								<i class="lni lni-home"></i>Back to Application
							</router-link>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			name: null,
			user_type: 0,
			isLoggedIn: localStorage.getItem("bigStore.jwt") != null
		};
	},
	mounted() {
		this.setDefaults();
	},
	methods: {
		setDefaults() {
			if (this.isLoggedIn) {
				let user = JSON.parse(localStorage.getItem("bigStore.user"));
				this.name = user.name;
				this.user_type = user.is_admin;
			}
		},
		change() {
			this.isLoggedIn = localStorage.getItem("bigStore.jwt") != null;
			this.setDefaults();
		},
		logout() {
			localStorage.removeItem("bigStore.jwt");
			localStorage.removeItem("bigStore.user");
			this.change();
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
/* .admin-page-margin {
	padding-top: 0px !important;
} */

.navbar-laravel {
	background-color: #fff;
	box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
}

/* .title,
.navbar-brand,
* {
	font-family: "Montserrat";
} */

.unun {
	background-color: darkgray;
	color: red !important;
	display: none;
}

.navbar {
	position: fixed;
	width: 100%;
	justify-content: center;
	z-index: 999;
	height: 6rem;
}

.navbarbot {
	position: fixed;
	width: 100%;
	justify-content: center;
	bottom: 0;
	z-index: 999;
	height: 4rem;
}

.topnavcontainer {
	display: grid;
	width: 100%;
	align-items: center;
	justify-content: space-between;
	grid-template-rows: 1fr 1fr;
	grid-auto-columns: 1fr 200px;
}

.navbar-brand {
	text-align: center;
}
.navbar-brand:active,
.navbar-brand:focus,
.navbar-brand:hover {
	color: #ea4c62;
	text-align: center;
}
.router-link-exact-active {
	color: #ea4c62;
	font-weight: 700;
}
input.navbar-search {
	height: 35px;
	font-size: 14px;
	background-image: url(../../../../public/assets/img/icons/search_icon.png);
	background-repeat: no-repeat;
	background-position: left center;
	background-size: 31px;
	padding-left: 40px;
	background-color: #fff;
	border: 1px solid #000;
	box-shadow: none;
	-webkit-appearance: none;
}

.botnavcontainer {
	display: grid;
	width: 100%;
	height: 100%;
	align-items: center;
	justify-content: space-between;
	grid-auto-rows: 1fr 1fr 1fr 1fr;
	grid-template-columns: 1fr 1fr 1fr 1fr;
}

.botnav-button {
	text-align: center;
}

.button-home {
	background: url(../../../../public/assets/img/icons/7f48b4add79db5fd3d49e886ea91d6b6.png)
		no-repeat;
	background-size: 100% 100%;
	width: 2rem;
	height: 2rem;
	border: none;
}

.button-watch {
	background: url(../../../../public/assets/img/icons/080a73537b80318a407a9468e9c0fea7.png)
		no-repeat;
	background-size: 100% 100%;
	width: 2rem;
	height: 2rem;
	border: none;
}

.button-notification {
	background: url(../../../../public/assets/img/icons/notification.jpeg)
		no-repeat;
	background-size: 100% 100%;
	width: 2rem;
	height: 2rem;
	border: none;
}

.button-account {
	background: url(../../../../public/assets/img/icons/0a2d61fc372a94c96be311c48383afa1.png)
		no-repeat;
	background-size: 100% 100%;
	width: 2rem;
	height: 2rem;
	border: none;
}

.brand-logo {
	width: 2rem;
	height: 2rem;
}
</style>