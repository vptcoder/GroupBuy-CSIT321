<template>
	<div>
		<div class="topnavcontainer-admin">
			<button class="btn" @click="setComponent('main')">Dashboard</button>
			<div></div>
			<button class="btn" @click="setComponent('products')">Products</button>
			<button class="btn" @click="setComponent('orders')">Orders</button>
			<button class="btn" @click="setComponent('payments')">Payments</button>
			<button class="btn" @click="setComponent('users')">Users</button>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-9">
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

export default {
	data() {
		return {
			user: null,
			activeComponent: null
		}
	},
	components: {
		Main, Users, Products, Orders, Payments
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
				case "paymentss":
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
.topnavcontainer-admin{
	display: grid;
	width: 100%;
	align-items: center;
	justify-content: right;
	grid-template-columns: 1fr 3fr 1fr 1fr 1fr 1fr;
}

.admin-ul{
	float:left;
}
.hero-section { height: 20vh; background: #ababab; align-items: center; margin-bottom: 20px; margin-top: -20px; }
.title { font-size: 60px; color: #ffffff; }
</style>
