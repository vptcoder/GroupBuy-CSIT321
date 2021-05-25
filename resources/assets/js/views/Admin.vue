<template>
	<div class="page-content-wrapper">
		
		<div class="subheader-area">
			<!-- <div style="background-color:#fff; float:center; width:auto;"> <img data-v-50e73d1e="" style="top:-100px; position: absolute; min-width:150px; min-height:150px; float:center;" src="/assets/img/core-img/brand-logo.png" alt="" class="brand-logo"> </div> -->
			<!-- <button class="btn nav-menu" @click="setComponent('main')">Dashboard</button> -->
			<button class="btn nav-menu" @click="setComponent('products')">Products</button>
			<button class="btn nav-menu" @click="setComponent('groupbuys')">Groupbuys</button>
			<button class="btn nav-menu" @click="setComponent('orders')">Orders</button>
			<button class="btn nav-menu" @click="setComponent('payments')">Payments</button>
			<button class="btn nav-menu" @click="setComponent('users')">Users</button>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<component :is="activeComponent"></component>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import Main from '../components/admin/Main'
import Users from '../components/admin/Users'
import Payments from '../components/admin/Payments'
import Products from '../components/admin/Products'
import Orders from '../components/admin/Orders'
import Groupbuys from '../components/admin/Groupbuys'

export default {
	data() {
		return {
			user: null,
			activeComponent: null
		}
	},
	components: {
		Main, Users, Products, Orders, Payments, Groupbuys
	},
	beforeMount() {
		this.setComponent(this.$route.params.page)
		this.user = JSON.parse(localStorage.getItem('bigStore.  d fuser'))
		axios.defaults.headers.common['Content-Type'] = 'application/json'
		axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('bigStore.jwt')
	},
	methods: {
		setComponent(value) {
			switch(value) {
				case "users":
					this.activeComponent = Users
					this.$router.push({name: 'admin-pages', params: {page: 'users'}})
					break;
				case "payments":
					this.activeComponent = Payments
					this.$router.push({name: 'admin-pages', params: {page: 'payments'}})
					break;
				case "orders":
					this.activeComponent = Orders
					this.$router.push({name: 'admin-pages', params: {page: 'orders'}})
					break;
				case "products":
					this.activeComponent = Products
					this.$router.push({name: 'admin-pages', params: {page: 'products'}})
					break;
				case "groupbuys":
					this.activeComponent = Groupbuys
					this.$router.push({name: 'admin-pages', params: {page: 'groupbuys'}})
					break;
				default:
					this.activeComponent = Main
					this.$router.push({name: 'admin'})
					break;
			}
		},
	}
};
</script>

<style scoped>
 
.container {
	max-width: 95%;
}
.topnavcontainer-admin{
	display: grid;
	width: 100%;
	align-items: center;
	justify-content: right;
	grid-template-columns: 2.5fr 2.5fr 2.5fr 2.5fr 2.5fr;
}
.subheader-area {
    transition-duration: 500ms;
    background-color:rgb(54, 69, 59);
    width: 100%;
    height: 50px;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    box-shadow: 0 0 8px rgba(15, 15, 15, 0.15);
	display: grid;
	grid-template-columns: 2fr 2fr 2fr 2fr 2fr 2fr 2fr;
}
.subheader-area .btn:hover,.subheader-area .btn:active, .subheader-area .btn:focus {
	border-bottom-style: solid;
  	border-bottom-color: rgb(245, 249, 233);
	border-bottom-width: thick;
}
.admin-ul{
	float:left;
}
.hero-section { height: 20vh; background: #ababab; align-items: center; margin-bottom: 20px; margin-top: -20px; }
.title { font-size: 60px; color: #ffffff; }

.nav-menu {
	color:white;
	font-size: large;
}
 
</style>
