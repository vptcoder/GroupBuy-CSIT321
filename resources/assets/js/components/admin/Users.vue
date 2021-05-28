<template>
	<div class="page-content-wrapper">
		<div class="mt-4 md-form">
			<input  type="text" value="" placeholder="Search by user" class="form-control">  
		</div>
		<table class="table table-responsive ">
			<thead>
				<tr>
					<td></td>
					<td>Name</td>
					<td>Email</td>
					<td>Joined</td>
					<td>Total Orders</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(user,index) in users" :key="index">
					<td>{{index+1}}</td>
					<td>{{user.name}}</td>
					<td>{{user.email}}</td>
					<td>{{user.joined}}</td>
					<td>{{user.orders.length}}</td>
					<td v-if="user.status == 'u11'">
						<button class="btn btn-warning" @click="deactivate(index)">Deactivate</button>
					</td>
					<td v-else-if="user.status == 'u01'">
						<button class="btn btn-warning" @click="activate(index)">Activate</button>
					</td>
					<td v-else>
					</td>				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
export default {
	data() {
		return {
			users : []
		}
	},
	beforeMount() {
		axios.get('/api/users/').then(response => this.users = response.data)
	},
	methods: {
		deactivate(index) {
			let user = this.users[index];
			let userid = user.id;
			axios.post("/api/users/deactivate", { userid }).then(response => {
				this.users[index].status = "u01";
				this.$forceUpdate();
			});
		},
		activate(index) {
			let user = this.users[index];
			let userid = user.id;
			axios.post("/api/users/activate", { userid }).then(response => {
				this.users[index].status = "u11";
				this.$forceUpdate();
			});
		}
	}
}
</script>
