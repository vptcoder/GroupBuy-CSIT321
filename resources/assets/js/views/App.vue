<template>
<!-- NOTES: This file is for navigation bar code. -->
	<div>
		<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
			<div class="newcontainer">
				<router-link :to="{name: 'home'}" class="navbar-brand">G-BUY</router-link>
				<input type="text" class="form-control navbar-search" name="Search" placeholder="Search">

			</div>
		</nav>
		<main class="py-4">
			<router-view @loggedIn="change"></router-view>
		</main>
	</div>
</template>

<script>
export default {
	data() {
		return {
			name: null,
			user_type: 0,
			isLoggedIn: localStorage.getItem('bigStore.jwt') != null
		}
	},
	mounted() {
		this.setDefaults()
	},
	methods : {
		setDefaults() {
			if (this.isLoggedIn) {
				let user = JSON.parse(localStorage.getItem('bigStore.user'))
				this.name = user.name
				this.user_type = user.is_admin
			}
		},
		change() {
			this.isLoggedIn = localStorage.getItem('bigStore.jwt') != null
			this.setDefaults()
		},
		logout(){
			localStorage.removeItem('bigStore.jwt')
			localStorage.removeItem('bigStore.user')
			this.change()
			this.$router.push('/')
		}
	}
}
</script>
