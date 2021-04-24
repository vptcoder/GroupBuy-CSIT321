<template>
	<div class="page-content-wrapper">
		<div class="container">
			<!-- Section Heading-->
			<div class="section-heading d-flex align-items-center pt-3 justify-content-between">
				<h6>Notification(s)</h6><a class="notification-clear-all text-secondary" href="#">Clear All</a>
			</div>
			<!-- Notifications Area-->
			<div class="notification-area pb-2">
				<div class="list-group">
				<!-- Single Notification--><a class="list-group-item d-flex align-items-center" href="notification-details.html"><span class="noti-icon"><i class="lni lni-alarm"></i></span>
					<div class="noti-info">
					<h6 class="mb-0">Suha just uploaded a new product!</h6><span>12 min ago</span>
					</div></a>
				<!-- Single Notification--><a class="list-group-item d-flex align-items-center" href="notification-details.html"><span class="noti-icon"><i class="lni lni-dropbox"></i></span>
					<div class="noti-info">
					<h6 class="mb-0">Black Friday Deals in One Place</h6><span>49 min ago</span>
					</div></a>
				<!-- Single Notification--><a class="list-group-item d-flex align-items-center" href="notification-details.html"><span class="noti-icon"><i class="lni lni-reply"></i></span>
					<div class="noti-info">
					<h6 class="mb-0">Share your experience, it's matters!</h6><span>58 min ago</span>
					</div></a>
				<!-- Single Notification--><a class="list-group-item readed d-flex align-items-center" href="notification-details.html"><span class="noti-icon"><i class="lni lni-ship"></i></span>
					<div class="noti-info">
					<h6 class="mb-0">Your order has been delivered.</h6><span>Yesterday</span>
					</div></a>
				<!-- Single Notification--><a class="list-group-item readed d-flex align-items-center" href="notification-details.html"><span class="noti-icon"><i class="lni lni-heart-filled"></i></span>
					<div class="noti-info">
					<h6 class="mb-0">Your wishlist is updated.</h6><span>2 days ago</span>
					</div></a>
				<!-- Single Notification--><a class="list-group-item readed d-flex align-items-center" href="notification-details.html"><span class="noti-icon"><i class="lni lni-thunder"></i></span>
					<div class="noti-info">
					<h6 class="mb-0">11% Price drop! Hurry up.</h6><span>2 days ago</span>
					</div></a>
				<!-- Single Notification--><a class="list-group-item readed d-flex align-items-center" href="notification-details.html"><span class="noti-icon"><i class="lni lni-offer"></i></span>
					<div class="noti-info">
					<h6 class="mb-0">Use 30% Discount Code</h6><span>3 days ago</span>
					</div></a>
				<!-- Single Notification--><a class="list-group-item readed d-flex align-items-center" href="notification-details.html"><span class="noti-icon"><i class="lni lni-ship"></i></span>
					<div class="noti-info">
					<h6 class="mb-0">Your order has been delivered.</h6><span>Yesterday</span>
					</div></a>
				<!-- Single Notification--><a class="list-group-item readed d-flex align-items-center" href="notification-details.html"><span class="noti-icon"><i class="lni lni-heart-filled"></i></span>
					<div class="noti-info">
					<h6 class="mb-0">Your wishlist is updated.</h6><span>2 days ago</span>
					</div></a>
				<!-- Single Notification--><a class="list-group-item readed d-flex align-items-center" href="notification-details.html"><span class="noti-icon"><i class="lni lni-thunder"></i></span>
					<div class="noti-info">
					<h6 class="mb-0">11% Price drop! Hurry up.</h6><span>2 days ago</span>
					</div></a>
				<!-- Single Notification--><a class="list-group-item readed d-flex align-items-center" href="notification-details.html"><span class="noti-icon"><i class="lni lni-offer"></i></span>
					<div class="noti-info">
					<h6 class="mb-0">Use 30% Discount Code</h6><span>3 days ago</span>
					</div></a>
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
			orders: []
		};
	},
	beforeMount() {
		this.user = JSON.parse(localStorage.getItem("bigStore.user"));

		axios.defaults.headers.common["Content-Type"] = "application/json";
		axios.defaults.headers.common["Authorization"] =
			"Bearer " + localStorage.getItem("bigStore.jwt");

		axios
			.get(`api/users/${this.user.id}/orders`)
			.then(response => (this.orders = response.data));
	}
};
</script>
