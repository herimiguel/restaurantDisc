<style >

.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 250px !important;
}
.widget-user .card-footer{
    padding: 0;
}

</style>
<template>
    <div>

        <div class="table">
            <thead>
                <tr>
                    <th>Restaurant Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Deal</th>
                    <th>Image</th>

                </tr>
            </thead>
            <tbody v-if= "allRestaurants" >
                <tr v-for="(restaurant, index) in restaurants">
                    <td>{{ restaurant.restaurantName }}</td>
                    <td>{{ restaurant.address }}</td>
                    <td>{{ restaurant.phone }}</td>
                    <td>{{ restaurant.deal }}</td>
                    <img class="circle" :src="`/img/profile/`+ restaurant.image" alt="Profile Picture" >
                    <td><button @click="showUpdateModal(index)" class="btn btn-info">Edit </button></td>
                    <td><button @click="deleteRestaurant(index)" class="btn btn-danger">Delete  </button></td>

                </tr>
            </tbody>
        </div>

        <!-- create modal -->
<button @click="showCreateModal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#s">Add a Restaurant</button>

<!-- Create Modal -->
 <div class="modal fade" id="addRestaurantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Add Restaurant</h5>
      
      </div>
      <div class="modal-body">
            <div class="form-group" >
                <label for="restaurantName" >Restaurant Name </label>
                <input v-model="rest.restaurantName" type="text"  class="from-control" >
            </div> 
            <div class="form-group" >
                <label for="address" >Adress </label>
                <input v-model="rest.address" type="text" id="address" class="from-control" >
            </div>
             <div class="form-group" >
                <label for="phone" >Phone </label>
                <input v-model="rest.phone" type="text" id="phone" class="from-control" >
            </div> 
            <div class="form-group" >
                <label for="deal" >Deal </label>
                <input v-model="rest.deal" type="text" id="deal" class="from-control" >
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button @click="createRestaurant" type="button" class="btn btn-primary">Add to Restaurant List</button>
      </div>
    </div>
  </div>
</div> 
<!-- update Modal -->
 <div class="modal fade" id="updateRestaurantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Update Restaurant</h5>
      
      </div>
      <div class="modal-body">
            <div class="form-group" >
                <label for="restaurantName" >Restaurant Name </label>
                <input v-model="updateRestaurant.restaurantName" type="text"  class="from-control" >
            </div> 
            <div class="form-group" >
                <label for="address" >Adress </label>
                <input v-model="updateRestaurant.address" type="text" id="address" class="from-control" >
            </div>
             <div class="form-group" >
                <label for="phone" >Phone </label>
                <input v-model="updateRestaurant.phone" type="text" id="phone" class="from-control" >
            </div> 
            <div class="form-group" >
                <label for="deal" >Deal </label>
                <input v-model="updateRestaurant.deal" type="text" id="deal" class="from-control" >
            </div>
             <div class="box">
               
                <label for="image" class="col-sm-2 control-label">Image</label>
                <div class="col-sm-12">
                    <input type="file" @change="updateProfile" name="image" class="form-input">
                </div>
            </div> 
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button @click="editRestaurant" type="button" class="btn btn-primary">Update Restaurant List</button>
      </div>
    </div>
  </div>
</div> 
        
    </div>
</template>

<script>
    export default {
        data(){
            return{
                rest:{
                    restaurantName: '',
                    address: '',
                    phone: '',
                    deal: '',
                    image: 'profile.png',
                    imageURL:[],
                },
                restaurants:[],
                uri: 'http://localhost:8000/api/restaurants/',
                errors:[],
                updateRestaurant:{},
                "allRestaurants": true
            }
        },
 
        methods:{
             showCreateModal(){
                $("#addRestaurantModal").modal("show");
            },
            showUpdateModal(index){
                this.errors=[];
                this.updateRestaurant = [];
                $("#updateRestaurantModal").modal("show");
                this.updateRestaurant = this.restaurants[index];
                console.log(this.updateRestaurant);
                return this.updateRestaurant;
            },

            editRestaurant(){
                console.log(this.updateRestaurant.id);
                axios.patch('http://localhost:8000/api/restaurants/' + this.updateRestaurant.id, {
                    restaurantName: this.updateRestaurant.restaurantName,
                    address: this.updateRestaurant.address,
                    phone: this.updateRestaurant.phone,
                    deal: this.updateRestaurant.deal,
                    image: this.updateRestaurant.image
                })
                .then(response => {
                $("#updateRestaurantModal").modal("hide");
                    this.loadRestaurants();


                })
                .catch(error=>{
                    if(error.response.data.errors.name){
                        this.errors.push(error.response.data.errors.name[0]);
                    }
                    if(error.response.data.errors.body){
                        this.errors.push(error.response.data.errors.body[0]);
                    }
                });
            },
            createRestaurant(){
                axios.post(this.uri, {restaurantName:this.rest.restaurantName, address:this.rest.address, phone:this.rest.phone, deal:this.rest.deal, image:this.rest.image})
                .then(response=>{
                    console.log(" created ..."+response.data);
                    this.restaurants.push(response.data);
                $("#addRestaurantModal").modal("hide");
                this.loadRestaurants();

                })
                .catch(error=>{
                     this.errors = [];
                    if(error.response.data.errors){
                        this.errors.push(error.response.data.errors.name[0]);
                    }
                    if(error.response.data.errors.body){
                        this.errors.push(errors.response.data.errors.body[0]);
                    }
                });
            },
            deleteRestaurant(index){
                axios.delete('http://localhost:8000/api/restaurants/'+ this.restaurants[index].id)
                .then(response => {
                    this.$delete(this.restaurants, index);
                })
                .catch();
            },

            loadRestaurants(){
                // make call to get all restaurants
                axios.get(this.uri).then((response) =>{
                    this.restaurants = response.data.restaurants;
                }).catch(error =>{
                    console.log(error);
                });
            }, 

             updateProfile(e) {
            let file = e.target.files[0];

            let reader = new FileReader();
            if(file['size'] < 2111775){

            reader.onloadend = (file) =>{
              this.updateRestaurant.image = reader.result;
            }
            reader.readAsDataURL(file);
            } else{
               swal({
                   type: 'error',
                   title: 'Oops...',
                   text: 'You are uploading a large file',
               }) 
            }
            },
        },
        mounted() {
            this.loadRestaurants();
            console.log('Component mounted.')
        }
    }
</script>
