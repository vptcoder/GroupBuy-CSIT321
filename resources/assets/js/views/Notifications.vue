<template>
	<div class="page-content-wrapper">
		<div class="container">
			<!-- Section Heading-->
			<div class="section-heading d-flex align-items-center pt-3 justify-content-between">
				<h6>Notification(s)</h6>
				<a class="notification-clear-all text-secondary" href="#">Clear All</a>
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
					>
						<span class="noti-icon">
							<i class="lni lni-alarm"></i>
						</span>
						<div class="noti-info">
							<h5 class="mb-0">{{noti.title}}</h5>
							<h6 class="mb-0">{{noti.message}}</h6>
							<h6 v-show="noti.link" class="mb-0">{{noti.link}}</h6>
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
	}
};
</script>
