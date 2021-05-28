<template>
	<div class="page-content-wrapper">
		<div class="container">
			<!-- Section Heading-->
			<div class="section-heading d-flex align-items-center pt-3 justify-content-between">
				<h6>Notification(s)</h6>
				<!-- <a class="notification-clear-all text-secondary" href="#">Clear All</a> -->
			</div>
			<!-- Notifications Area-->
			<div class="notification-area pb-2">
				<div class="list-group">
					<!-- Single Notification-->
					<div
						v-for="(noti, index) in notis"
						:key="index"
						class="list-group-item d-flex align-items-center"
						v-bind:class="noti.status != 'n01' ? 'readed' : ''"
						@click="readNoti(noti)"
					>
						<span class="noti-icon">
							<i class="lni lni-alarm"></i>
						</span>
						<div class="noti-info">
							<h5 class="mb-0" style="font-weight:400; ">{{noti.title}}</h5>
							<h6 class="mb-0">{{noti.message}}</h6>
							<small v-show="noti.link" class="mb-0">{{noti.link}}</small>
							<span>12 min ago</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			user: null,
			notis: []
		};
	},
	beforeMount() {
		this.user = JSON.parse(localStorage.getItem("bigStore.user"));

		axios
			.get(`api/noti/yours/`, { params: { userid: this.user.id } })
			.then(response => (this.notis = response.data));
	},
	methods: {
		readNoti(noti) {
			console.log(noti);
			var id = noti.id;

			axios.post(`api/noti/read`, { id }).then(response => {
				console.log(response);
				if (noti.link) {
					this.$router.push({ path: noti.link });
				} else {
					axios
						.get(`api/noti/yours/`, {
							params: { userid: this.user.id }
						})
						.then(response => (this.notis = response.data));
				}
			});
		}
	}
};
</script>
