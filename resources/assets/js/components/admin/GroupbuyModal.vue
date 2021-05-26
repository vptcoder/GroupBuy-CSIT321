<template>
	<div class="modal-mask">
		<div class="modal-wrapper">
			<div class="" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document" style="margin:4.5rem auto;">
					<div class="modal-content">
					<div class="modal-header border-bottom-0">
						<h5 class="modal-title" id="exampleModalLabel">Modify Groupbuy Item</h5>
					</div>
						<form>
							<div class="modal-body">
									<div class="form-group">
										<label for="name">Name</label>
										<h6 class="mb-0">{{data.product_name}}</h6>
									</div>	

									<div class="form-group">
										<label for="name">Status</label>
										<br />
										<input type="radio"   v-model="data.status" :disabled="!data.to_g11" value="Active" /> Active
										<br />
										<input type="radio" v-model="data.status" :disabled="!data.to_g12" value="Pending payments" /> Pending Payments
										<br />
										<input type="radio"  v-model="data.status" :disabled="!data.to_g13" value="Processing orders" /> Processing orders
										<br />
										<input type="radio"   v-model="data.status" :disabled="!data.to_g21" value="Closed" /> Closed
									</div>
							</div>
							<div class="modal-footer border-top-0 d-flex justify-content-center">
								<button class="btn btn-primary" @click="finishEdit">Finish</button>
								<button class="btn btn-primary" @click="cancelEdit">Cancel</button>
 							</div>
						</form>
					</div>
					 
				</div>
			</div>
		<!-- <div class="modal-wrapper">
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
			</div> -->
 		</div>
	</div>
</template>

<style scoped>

button.close {
    padding: 0;
    background-color: transparent;
    border: 0;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
.close {
    float: right;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .5;
}
label {
	margin-top: 20px;
	margin-bottom: 5px;
	font-weight:500;
}
.container {
  padding: 2rem 0rem;
}

h4 {
  margin: 2rem 0rem;
}

.panel {
  border-radius: 4px;
  padding: 1rem;
  margin-top: 0.2rem;
  background-color: #F5F5F5;
  color: #323B40;
}
.panel.panel-blue {
  background-color: #E0F5FF;
  color: #00A5FA;
}
.panel.panel-big-height {
  min-height: 150px;
}

.item {
  border-radius: 4px;
  padding: 0.5rem;
  margin: 0.2rem;
}
.item.item-blue {
  background-color: #B9E5FE;
  color: #00A5FA;
}
.item.item-green {
  background-color: #B7E0DC;
  color: #019888;
}
.item.item-lime {
  background-color: #C7E8C8;
  color: #42B045;
}
.item.item-yellow {
  background-color: #FFEEBA;
  color: #FF9901;
}
.item.item-pink {
  background-color: #FABAD0;
  color: #EF075F;
}
.item.item-red {
  background-color: #FEC9C6;
  color: #FD3D08;
}
.item.item-big-width {
  min-width: 380px;
}
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
	width: 50%;
	margin: 0px auto;
	padding: 20px 30px;
	background-color: #fff;
	border-radius: 2px;
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
	transition: all 0.3s ease;
	font-family: Helvetica, Arial, sans-serif;
	text-align:center;
}
.modal-header h3 {
	margin-top: 0;
	color: #42b983;
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
