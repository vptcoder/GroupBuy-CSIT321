<template>
	<div class="page-content-wrapper">
		
		<div class="subheader-area">
			<button class="btn" @click="setComponent('main')">Dashboard</button>
			<div></div>
			<button class="btn" @click="setComponent('products')">Products</button>
			<button class="btn" @click="setComponent('groupbuys')">Groupbuys</button>
			<button class="btn" @click="setComponent('orders')">Orders</button>
			<button class="btn" @click="setComponent('payments')">Payments</button>
			<button class="btn" @click="setComponent('users')">Users</button>
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
		}
	},

}
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
	grid-template-columns: 1fr 3fr 1fr 1fr 1fr 1fr 1fr;
}
.subheader-area {
    transition-duration: 500ms;
    background-color:rgb(255, 229, 157);
    width: 100%;
    height: 50px;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    box-shadow: 0 0 8px rgba(15, 15, 15, 0.15);
	display: grid;
	grid-template-columns: 1fr 3fr 1fr 1fr 1fr 1fr 1fr;
}
.subheader-area .btn:hover,.subheader-area .btn:active, .subheader-area .btn:focus {
	color: #100DD1;
}
.admin-ul{
	float:left;
}
.hero-section { height: 20vh; background: #ababab; align-items: center; margin-bottom: 20px; margin-top: -20px; }
.title { font-size: 60px; color: #ffffff; }
</style>
