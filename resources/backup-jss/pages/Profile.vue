<template>
<div>
    <section v-if="id">
        <h1> Hello {{detailuser.name}} </h1> 
        <p>Email : {{detailuser.email}}</p>
  
        <!-- <bootstrap-component></bootstrap-component>     -->
        <router-link v-bind:to="{name: 'User'}">Kembali</router-link>

        <router-link v-bind:to="{name: 'Edit'}">Edit</router-link>
        <footer-component></footer-component>
    </section>
</div>
</template>

<script>
    export default{
    props: [ 'id' ],
    data(){
        return{
            detailuser: {}
        }
    },

    mounted(){
     this.getUser()
    },

    methods:{
        getUser(){
            axios.get('/api/users/' +this.id).then((response)=>{
            this.detailuser = response.data
        })
        },
        handlingDelete(){
          if(confirm('Apakah Anda Ingin Menghapus Data Tersebut ?')){
                axios.delete('/api/users/' +this.id).then((response)=>{
                if(response.data.status){
                    this.$noty.success(response.data.message)
                    this.$router.push({
                    name : 'User'
                 })
                }
            })
          }else{
              return false
          }
        },
        Edit(){
              this.$router.push({
                name: 'Edit',
                params: {
                    id: this.id
                }
            })
        }
    }
}
</script>
