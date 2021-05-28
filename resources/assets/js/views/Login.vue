<template>
	<div class="page-content-wrapper">
		<div class="container">
			<div class="row justify-content-center">
					<div class="logo" style="float:center;     padding-top: 13%;
    padding-left: 15%;
    padding-right: 15%;
    padding-bottom: 5%;">
						<img src="/assets/img/core-img/brand-logo.png" alt="" style="
						    min-width: 50%;
    height: auto;
 
float:center; align:center;padding: 30px; min-width: 50%; height: auto;">	
					</div>
					<div class="card-body">
							<form>
								<div class="form-group row">
									<label for="email" style= "color: black;" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>
									<div class="col-md-6">
										<input id="email" type="email" style= "border: 2px solid #ebebeb;" class="form-control" v-model="email" required autofocus>
									</div>
								</div>
								<div class="form-group row">
									<label for="password" style= "color: black;" class="col-md-4 col-form-label text-md-right">Password</label>
									<div class="col-md-6">
										<input id="password" style= "border: 2px solid #ebebeb;" type="password" class="form-control" v-model="password" required>
									</div>
								</div>
								<div class="form-group row" style= "padding-top: 5%;">
									<div class="col-4">
										<div class="my-3" style="font-size:14px; color:black; text-decoration: underline;">
											<router-link :to="{ name: 'register' }" >
												<div class="btn btn-primary">
													Register
												</div>
											</router-link>
										</div>
									</div>

									<div class="col-8">
										<button type="submit" class="btn btn-primary float-end my-3" @click="handleSubmit">
											Login
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	
	
</template>

<script>
	export default {
		data() {
			return {
				email: "",
				password: ""
			}
		},
		methods: {
			handleSubmit(e) {
				e.preventDefault()
				if (this.password.length > 0) {
					let email = this.email
					let password = this.password

					axios.post('api/login', {email, password}).then(response => {
						let user = response.data.user
						let is_admin = user.is_admin

						localStorage.setItem('bigStore.user', JSON.stringify(user))
						localStorage.setItem('bigStore.jwt', response.data.token)

						if (localStorage.getItem('bigStore.jwt') != null) {
							this.$emit('loggedIn')
							if (this.$route.params.nextUrl != null) {
								this.$router.push(this.$route.params.nextUrl)
							} else {
								this.$router.push((is_admin == 1 ? 'admin' : '/'))
							}
						}
					})
					.catch(error => {
						alert(error.response.data.error);
					});
				}
			}
		}
	}
</script>
<style>
body, html {
	background-color:white!important;
}
</style>