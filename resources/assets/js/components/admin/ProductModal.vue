<template>
	<div class="modal-mask">
		<div class="modal-wrapper">
		<div class="" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				<div class="modal-header border-bottom-0">
					<h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
					<button type="button" class="close" data-dismiss="modal"  @click="cancelFile" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form>
					<div class="modal-body">
						<div class="form-group">
							<label for="email1">Name</label>
							<input type="text" v-model="data.name" class="form-control" id="email1" aria-describedby="emailHelp" >
							<!-- <small id="emailHelp" class="form-text text-muted">Your information is safe with us.</small> -->
						</div>
						<div class="form-group">
							<label for="password1">Price</label>
							<input input type="text" v-model="data.price" class="form-control"  >
						</div>
						<div class="form-group">
							<label for="password1">Minimum Order</label>
							<input input type="text" v-model="data.min" class="form-control" placeholder="Min. 1">
						</div>
						<div class="form-group">
							<label for="password1">Maximum Order</label>
							<input type="text" v-model="data.max" class="form-control">
						</div>
						<div class="form-group">
							<label for="password1">Status </label>
								<br/><input type="radio" v-model="data.status"   value="p11" /> Available
								<br/><input type="radio" v-model="data.status"  value="p01" /> Hidden
						</div>
						<div class="form-group">
							<label for="password1">Description </label>
							<textarea v-model="data.description" class="form-control" length="10" placeholder="Please enter Product Details"></textarea>
						</div>
						<div class="form-group">
							<label for="password1">Image </label>
 									<input type="file" id="file" @change="attachFile" />
									<img :src="data.image" v-show="data.image != null" />
 							</div>
					</div>
					<div class="modal-footer border-top-0 d-flex justify-content-center">
					<button type="submit" class="btn btn-success" @click="uploadFile">Submit</button>
					</div>
				</form>
				</div>
			</div>
		</div>
</div>



<!-- 

		<div class="modal-wrapper">
			<div class="modal-container">
				<div class="modal-header">
					<slot name="header" v-html="data.name">Add a New Product</slot>
				</div>
				<div class="modal-body">
					<slot name="body">
						<div class = "row">
							<div class ="col-lg-6 label">
								Name:
							</div>
							<div class ="col-lg-6 inputField">
								<input type="text" v-model="data.name" />
							</div>
						</div>
						<div class = "row">
							<div class ="col-lg-6 label">
								Price:
							</div>
							<div class ="col-lg-6 inputField">
								<input type="text" v-model="data.price" />
							</div>
						</div>
						<div class = "row">
							<div class ="col-lg-6 label">
								Min:
							</div>
							<div class ="col-lg-6 inputField">
								<input type="text" v-model="data.min" />
							</div>
						</div>
						<div class = "row">
							<div class ="col-lg-6 label">
								Max:
							</div>
							<div class ="col-lg-6 inputField">
								<input type="text" v-model="data.max" />
							</div>
						</div>
						<div class = "row">
							<div class ="col-lg-6 label">
								Status:
							</div>
							<div class ="col-lg-6 inputField">
								<br/><input type="radio" v-model="data.status" value="p11" /> Available
								<br/><input type="radio" v-model="data.status" value="p01" /> Hidden
							</div>
						</div>
						<div class = "row">
							<div class ="col-lg-12 label">
								<textarea v-model="data.description" placeholder="description"></textarea>
							</div>
						</div>
						<div class = "row">
							<div class ="col-lg-12 label">
								<span>
									<img :src="data.image" v-show="data.image != null" />
									<input type="file" id="file" @change="attachFile" />
								</span>							
							</div>
						</div>
					</slot>
				</div>
				<div class="modal-footer">
					<slot name="footer">
						<button class="btn btn-primary" @click="uploadFile">Finish</button>
						<button class="btn btn-primary" @click="cancelFile">Cancel</button>
					</slot>
				</div>
			</div>
		</div> -->
	</div>
</template>

<style scoped>
label {
	margin-top: 20px;
	margin-bottom: 5px;
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
	props: ["product"],
	data() {
		return {
			attachment: null
		};
	},
	computed: {
		data: function() {
			if (this.product != null) {
				return this.product;
			}
			return {
				name: "",
				min: "",
				max: "",
				status: "p11",
				price: "",
				description: "",
				image: false
			};
		}
	},
	methods: {
		attachFile(event) {
			this.attachment = event.target.files[0];
		},
		uploadFile(event) {
			if (this.attachment != null) {
				var formData = new FormData();
				formData.append("image", this.attachment);
				let headers = { "Content-Type": "multipart/form-data" };
				axios
					.post("/api/upload-file", formData, { headers })
					.then(response => {
						this.product.image = response.data;
						this.$emit("close", true);
					});
			} else {
				this.$emit("close", 1);
			}
		},
		cancelFile(event) {
			this.$emit("close", false);
		}
	}
};
</script>
