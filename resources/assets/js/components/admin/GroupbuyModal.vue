<template>
	<div class="modal-mask">
		<div class="modal-wrapper">
			<div class="modal-container">
				<div class="modal-header">
					<slot name="header" v-html="data.name"></slot>
				</div>
				<div class="modal-body">
					<slot name="body">
						Name:
						<h6 class="mb-0">{{data.product_name}}</h6>
						 <input type="text" v-model="data.product_name">Status:
						<br />
						<input type="radio" v-model="data.status" :disabled="!data.to_g11" value="Active" /> Active
						<br />
						<input type="radio" v-model="data.status" :disabled="!data.to_g12" value="Pending payments" /> Pending Payments
						<br />
						<input type="radio" v-model="data.status" :disabled="!data.to_g13" value="Processing orders" /> Processing orders
						<br />
						<input type="radio" v-model="data.status" :disabled="!data.to_g21" value="Closed" /> Closed
					</slot>
				</div>
				<div class="modal-footer">
					<slot name="footer">
						<button class="modal-default-button" @click="finishEdit">Finish</button>
						<button class="modal-default-button" @click="cancelEdit">Cancel</button>
					</slot>
				</div>
			</div>
		</div>
	</div>
</template>

<style scoped>
.modal-mask {
	position: fixed;
	z-index: 9998;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: rgba(0, 0, 0, 0.5);
	display: table;
	transition: opacity 0.3s ease;
}
.modal-wrapper {
	display: table-cell;
	vertical-align: middle;
}
.modal-container {
	width: 300px;
	margin: 0px auto;
	padding: 20px 30px;
	background-color: #fff;
	border-radius: 2px;
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
	transition: all 0.3s ease;
	font-family: Helvetica, Arial, sans-serif;
}
.modal-header h3 {
	margin-top: 0;
	color: #42b983;
}
.modal-body {
	margin: 20px 0;
}
.modal-default-button {
	float: right;
}
.modal-enter {
	opacity: 0;
}
.modal-leave-active {
	opacity: 0;
}
.modal-enter .modal-container,
.modal-leave-active .modal-container {
	-webkit-transform: scale(1.1);
	transform: scale(1.1);
}
</style>

<script>
export default {
	props: ["groupbuy"],
	data() {
		return {
			olddata: null
		};
	},
	computed: {
		data: function() {
			if (this.groupbuy != null) {
				return this.groupbuy;
			}
			return {
				name: "",
				min: "",
				max: "",
				price: "",
				description: "",
				image: false
			};
		}
	},
	methods: {
		finishEdit(event) {
			this.$emit("close", true);
		},
		cancelEdit(event) {
			this.$emit("close", false);
		}
	}
};
</script>
