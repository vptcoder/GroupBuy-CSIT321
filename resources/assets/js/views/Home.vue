<template>
    <div>

        <div class="container">
            <div class="row">
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png"><b>Food</b></div>
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png"><b>Shoes</b></div>
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png"><b>Garden</b></div>
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png"><b>Boy</b></div>
            </div>
            <div class="row">
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png"><b>pig</b></div>
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png"><b>Pets</b></div>
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png"><b>Fashion</b></div>
                 <div class="col-sm-3" ><img src="/assets/img/icons/shoes.png"><b>GG</b></div>
            </div>
        </div>
        <div style="text-align:center">
            <button type="button" style="background-color:#FADBD8;width:20px;height:10px"></button>
            <button type="button" style="width:20px;height:10px"></button>
        </div>
        <br>
        <div class="container">
            <row>
                <b>Popular Groupbuy</b>
                <input type="button" value="" style="margin-left:120px;width: 10px; height: 10px; background-color:#CCD1D1;border-radius:50%;border: none">
                <input type="button" value="" style="margin-left:10px;width: 10px; height: 10px; border-radius:50%;border: none">
                <input type="button" value="" style="margin-left:10px;width: 10px; height: 10px; border-radius:50%;border: none">
            </row>
            <div class="row" >
                 <div class="col-sm-4"><img src="/assets/img/products/nike.png"> </div>
                 <div class="col-sm-4"><img src="/assets/img/products/nike.png"></div>
                 <div class="col-sm-4"><img src="/assets/img/products/nike.png"></div>
            </div>
        </div>
        <br><br>
         <div class ="item prod" v-for="(product,index) in products" :key="index">
                  <router-link :to="{ path: '/products/'+product.id}">
                    <img :src="product.image" :alt="product.name">
                    <span class ="name" v-html="product.name"></span><br>
                    <div align="center"><span class="price">$ {{product.price}}</span></div>
                    <button class="col-md-4 btn btn-sm btn-primary float-right">Buy Now</button>
                  </router-link>
               
        </div>
    </div>
</template>

<div></div>

<script>
    export default {
        data(){
            return {
                products : []
            }
        },
        mounted(){
            axios.get("api/products/").then(response => this.products = response.data)      
        }
    }
</script>

<style scoped>

.col-sm-3{
  float: center;
  display: block;
  background-color: #f4f4f4;
  width: 22%;
  height: 15%;
  margin-left: 9px;
  margin-top: 5px;
  text-align:center;
}
.col-sm-3 img {
  min-height: 60%;
  max-height: 60%;
  min-width: 60%;
  max-width: 60%;
  text-align : center;
}
.col-sm-4 {
  margin-left:5%;
  width: 26%;
  height: 15%;
  background-color: #f4f4f4;
}

.col-sm-4 img {
  min-height: 70%;
  max-height: 70%;
  min-width: 100%;
  max-width: 100%;
}

.item.prod {
  float: left;
  display: block;
  background-color: #FBEEE6;
  width: 45%;
  height: 15%;
  margin-left:13px;
  margin-top:10px;
}

.item.prod img{
  min-height: 70%;
  max-height: 70%;
  min-width: 100%;
  max-width: 100%;
} 
.item.prod .name {
  font-size: 12px;
  color:red;
}

.item.prod .price {
  font-size: 14px;
  font-weight: bold;
  color:black;
}


</style>
