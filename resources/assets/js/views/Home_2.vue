<template>

<!-- NOTES: This file is for home page -->
    <div>
         
         <!--Segment One -- Category -->
              <ul id="category-selection" class="segment">
                <li class="item cat"><img src="/assets/img/icons/shoes.png"><i class="content">asd</i></li>
                <li class="item cat"><img src="/assets/img/icons/food.png"><i class="content">asd</i></li>
                <li class="item cat"><img src="/assets/img/icons/furniture.png"><i class="content">asd</i></li>
                <li class="item cat"><img src="/assets/img/icons/bags.png"><i class="content">asd</i></li>
                <li class="item cat"><img src="/assets/img/icons/bath.png"><i class="content">asd</i></li>
              </ul>
              <br>
              <br>
              <br>
        <!--Segment Two -- Popular -->
              <ul id="pop-selection" class="segment"  >
                <li class="item pop"><img src="/assets/img/products/nike.png">
                    <div class="content">
                      <div class="price">Asd </div>
                      <div class="price">123 </div>
                    </div>
                </li>
                <li class="item pop"><img src="/assets/img/products/fila.png">
                    <div class="content">
                      <div class="name">baba </div>
                      <div class="price">331 </div>
                      <div class="price">321 </div>
                    </div>
                </li>    
                <li class="item pop"><img src="/assets/img/products/fila.png">
                    <div class="content">
                      <div class="name">baba </div>
                      <div class="price">331 </div>
                      <div class="price">321 </div>
                    </div>
                </li>                           
              </ul>
              <br>
              <br>
              <br>
               <!--Segment Three -- Products -->
              <ul id="pop-selection" class="segment">
              <div class ="item prod" v-for="(product,index) in products" :key="index">
                  <router-link :to="{ path: '/products/'+product.id}">
                    <img :src="product.image" :alt="product.name">
                    <span class ="name" v-html="product.name"></span>
                    <span class="price">$ {{product.price}}</span>
                    <button class="col-md-4 btn btn-sm btn-primary float-right">Buy Now</button>
                  </router-link>
              </div>
              </ul>
              <br>
              <br>
              <br>
 
 
</template>

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
    //Vue.loadScript("C:/xampp/htdocs/GroupBuy-CSIT321/resources/assets/js/player-export.js")

</script>

<style>
 
.small-text {
    font-size: 14px;
}
.product-box {
    border: 1px solid #cccccc;
    padding: 10px 15px;
}
.hero-section {
    height: 30vh;
    /*background: #ababab;*/
    align-items: center;
    margin-bottom: 20px;
    margin-top: -20px;
}
.title {
    font-size: 60px;
    color: #ffffff;
}
.segment
{
       *zoom: 1;
}
.segment:after{
  content: "\0020";
  display: block;
  height: 0;
  clear: both;
  }


/* Item Content Inside Segment One _ Main*/
.item {
  float: left;
  display: block;
  background-color: #f4f4f4;
  width: 22%;
  height: 15%;
  margin: 2% 1%;
 

}
 
 
.item img {
  min-height: 100%;
  max-height: 100%;
  min-width: 100%;
  max-width: 100%;
  text-align : center;

}

.item.cat img {
  min-height: 100%;
  max-height: 100%;
  min-width: 50%;
  max-width: 50%;
  padding: 1% 30%;
  text-align : center;
}
.item .content {
  align-content: center;
  color:black;
  left: 50%;
  margin: 2% 30%;
  font-family: -apple-system, BlinkMacSystemFont, sans-serif;
 
}

/* Segment Two */
.item.pop {
  margin: 2% 3%;
  width: 26%;
  height: 15%;
}

.item.pop img {
  min-height: 70%;
  max-height: 70%;
  min-width: 100%;
  max-width: 100%;
}

.item .pop .content{
  font-size: 14px;
 
}

/* Segment Three */
.item.prod {
  margin: 2% 4%;
  width: 40%;
  height: 20%;
}

.item.prod img{
  min-height: 70%;
  max-height: 70%;
  min-width: 100%;
  max-width: 100%;
} 
.item.prod .name {
  font-size: 14px;
  color:red;

 
}

.item.prod .price {
  font-size: 14px;

}
.segment 
/** Outside **/{
  background-color: white;
}
  
 
 

body {
  background-color: #f7f7f7;
  font: 14px / 1.2 "Oxygen", Helvetica, Arial;
}

 
 
</style>
