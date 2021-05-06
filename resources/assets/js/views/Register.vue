<template>
	<div class="page-content-wrapper"> 
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="card card-default">
						<div class="card-header">Register</div>
						<div class="card-body">
							<form>
								<div class="form-group row">
									<label for="name" class="col-md-4 col-form-label text-md-right">Username</label>
									<div class="col-md-6">
										<input id="name" type="text" class="form-control" v-model="username" required autofocus>
									</div>
								</div>
								<div class="form-group row">
									<label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
									<div class="col-md-6">
										<input id="name" type="text" class="form-control" v-model="name" required autofocus>
									</div>
								</div>
								<div class="form-group row">
									<label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
									<div class="col-md-6">
										<input id="email" type="email" class="form-control" v-model="email" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="name" class="col-md-4 col-form-label text-md-right">Shipping Street Address</label>
									<div class="col-md-6">
										<input id="name" type="text" class="form-control" v-model="shipping_streetaddress" required autofocus>
									</div>
								</div>
								<div class="form-group row">
									<label for="name" class="col-md-4 col-form-label text-md-right">Shipping City</label>
									<div class="col-md-6">
										<input id="name" type="text" class="form-control" v-model="shipping_city" required autofocus>
									</div>
								</div>
								<div class="form-group row">
									<label for="name" class="col-md-4 col-form-label text-md-right">Shipping Postal Code</label>
									<div class="col-md-6">
										<input id="name" type="text" class="form-control" v-model="shipping_postalcode" required autofocus>
									</div>
								</div>

								<div class="form-group row">
									<label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
									<div class="col-md-6">
										<input id="password" type="password" class="form-control" v-model="password" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
									<div class="col-md-6">
										<input id="password-confirm" type="password" class="form-control" v-model="password_confirmation" required>
									</div>
								</div>
								<div class="form-group row mb-0">
									<div class="col-md-6 offset-md-4">
										<button type="submit" class="btn btn-primary" @click="handleSubmit">
											Register
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props : ['nextUrl'],
	data(){
		return {
			username : "",
			name : "",
			email : "",
			shipping_streetaddress : "",
			shipping_city : "",
			shipping_postalcode : "",
			password : "",
			password_confirmation : ""
		}
	},
	methods : {
		handleSubmit(e) {
			e.preventDefault()
			if (this.password !== this.password_confirmation || this.password.length <= 0) {
				this.password = ""
				this.password_confirmation = ""
				return alert('Passwords do not match')
			}

			let username = this.username
			let name = this.name
			let email = this.email
			let shipping_streetaddress = this.shipping_streetaddress
			let shipping_city = this.shipping_city
			let shipping_postalcode = this.shipping_postalcode
			let password = this.password
			let c_password = this.password_confirmation

			//See UserController.php > register function for parameters order and rules 
			axios.
				post('api/register', {username, name, email, shipping_streetaddress, shipping_city, shipping_postalcode, password, c_password}).
				then(response => {
					let data = response.data
					localStorage.setItem('bigStore.user', JSON.stringify(data.user))
					localStorage.setItem('bigStore.jwt', data.token)
					if (localStorage.getItem('bigStore.jwt') != null) {
						this.$emit('loggedIn')
						let nextUrl = this.$route.params.nextUrl
						this.$router.push((nextUrl != null ? nextUrl : '/'))
					}
				})
			console.log("Registration handled.");
		}
	}
}
</script>
