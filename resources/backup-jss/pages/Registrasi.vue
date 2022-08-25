<template>
    <div>
        <h1>Registrasi</h1>
        <form @submit.prevent="handleSubmit">
            <div class="input">
                <label> Nama </label>
                <input type="text" v-model="form.name">
                <div class="error" v-if="errors.name">
                    {{errors.name[0]}}
                </div>
            </div>
            <div class="input">
                <label> Email </label>
                <input type="text" v-model="form.email">
                <div class="error" v-if="errors.email">
                    {{errors.email[0]}}
                </div>
            </div>
            <div class="input">
                <label> Password </label>
                <input type="text" v-model="form.password">
                <div class="error" v-if="errors.password">
                    {{errors.password[0]}}
                </div>
            </div>

            <button type="submit"> Registrasi</button>
        </form>
    </div>
</template>

<script>
 export default{
     data() {
         return{
          form:{
              name:'',
              email:'',
              password:''
          },
          errors: {}    
         }
     },
     methods:{
         handleSubmit(){
             console.log(this.form)
             axios.post('/api/users', this.form).then((response) => {
                 if(response.data.status){
                    console.log(response)
                    
                    this.$noty.success(response.data.message)
                    this.$router.push({
                    name : 'User'
                 })
                 }
             }).catch((error)=>{
                 if(error.response.status == 403){
                    this.errors = error.response.data.message
                 }
               
             })
         }
     }
 }
</script>

<style>
 .input{
    margin-bottom: 5px
}
</style>