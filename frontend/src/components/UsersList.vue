<template>
    <div>
        <div class="heading">
            <p class="user-list-heading">Users List</p>
        </div>
        <div class="users-list">
            <el-row class="user-row" v-for="item in usersList" :key="item.id" @click="weatherUpdate(item)">
            <el-col :xs="18" :sm="18" :lg="18" :xl="18">
                <div class="user">
                    <img src="@/assets/images/avatar.jpg" class="avatar">
                    <small class="user-email">{{ item.email }}</small>
                    <p class="user-name">{{ item.name }}</p>
                </div>
            </el-col>
            <el-col :xs="6" :sm="6" :lg="6" :xl="6">
                <p class="user-weather"> Weather</p>
                <small class="user-weather" v-if="item.weather">{{item.weather ?item.weather.temp:''}}<span>&#8451;</span></small>  
                <small class="user-weather" v-else>click here to see weather details</small>  
            </el-col>
            </el-row>
        </div>

        
        <el-dialog class="weather-modal" v-model="weatherModal"  width="22%" center>
            <span>
                <el-row :gutter="10">
                <el-col :xs="24" :sm="24" :lg="24" :xl="24">
                    <p class="weather-title">Weather</p>
                    <hr class="lines">
                    <p class="temp" ><span class="data">{{temp}}<span>&#8451;</span></span></p>
                    <hr class="lines">
                    <p class="temp" >Feels Like &nbsp; <span class="data">{{feelsLike}}<span>&#8451;</span></span></p>
                    <hr class="lines">
                    <p class="temp" ><span class="data">{{ description}}</span></p>
                    <hr class="lines">
                </el-col>
                </el-row>
            </span>
            <template #footer>
            <span class="dialog-footer">
            </span>
            </template>
        </el-dialog>

    </div>
</template>

<script  lang="ts">
import axios from 'axios';
import {ref} from 'vue';


export default{
async mounted(){
    await this.getUsers();
},
computed:{
    temp(){
        return this.weatherData ?
        this.weatherData.temp   :"Not Found";
    },
    feelsLike(){
        return this.weatherData ?
        this.weatherData.feels_like :"Not Found"
    },
    description(){
        return this.weatherData ?
        this.weatherData.description : "Not Found" ;
    }
},
data(){
    return{
        usersList:ref([]),
        weatherModal:false,
        weatherData:ref([]),
        weatherExternalData:ref([]),
    }
},    
methods: {
    //---------------------GET USERS DATA---------------------
    async getUsers(){
        await axios.get('http://127.0.0.1:8000/').then((response) => {
            this.usersList=response.data ? response.data.users :'';
        })
    },
    //---------------------GET WEATHER DATA---------------------
   async weatherUpdate(item){

        let today = new Date();
        let hourago = new Date(today.getTime() - (1000*60*60));

        const key='6d981144031ccf44e58f95910147e8fa';
        let endPoint=`https://api.openweathermap.org/data/2.5/weather?lat=${item.latitude}&lon=${item.longitude}&units=metric&appid=${key}`;
        
        if(item.weather==null){
            //-------------GET WEATHER DATA-----------------------
            await axios.get(endPoint).then((response) => {
                this.weatherExternalData=response.data;
             })
            //-------------STORE IN LOCAL DB-----------------------
             await this.store(item);

        }else if(item.weather){

            if(item.weather.updated_at <hourago ){
            //-------------UPDATE IN LOCAL DB -----------------------
                await this.update(item);
            }else{
                this.weatherData=await item.weather;
            }
        }
        await this.getUsers();
        this.weatherModal=true;
    },

    //------------STORE IN LOCAL DB----------------------
    async store(item){
        await axios.post(`http://127.0.0.1:8000/store/${item.id}`,this.weatherExternalData).then((response)=>{
            this.weatherData= response.data.weather;
        })
    },

    //------------UPDATE DATA IF ITS OLDER THEN 1 HOUR----------------------
    async update(item){
        await axios.post(`http://127.0.0.1:8000/update/${item.id}`,this.weatherExternalData).then((response)=>{
            this.weatherData= response.data.weather;
        })
    },
},

}

</script>
