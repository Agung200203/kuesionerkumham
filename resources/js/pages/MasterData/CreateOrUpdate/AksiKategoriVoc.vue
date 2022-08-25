<template>
  <div class="card">
    <div class="card-header">{{ title }} Data</div>
    <div class="card-body">
        <form @submit.prevent="loadingData()">
            <div class="mb-3">
                <p class="form-label">Nama *</p>
                <input class="form-control" v-model="kategori.namkat_vocs" required/>
            </div>
            <div class="mb-3">
                <p class="form-label">Status *</p>
                <select class="form-select" v-model="kategori.status_kategori" required>
                    <option :value="1">Aktif</option>
                    <option :value="0">Tidak Aktif</option>
                    </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
  </div>
</template>

<script>
export default {
     props:['id'],
     data() {
         return{
            title:"",
          kategori:{
              namkat_vocs:'',
              status_kategori:''
          },
          errors: {}
         }
     },
       mounted() {
    if (this.id !== undefined) {
      this.title = "Edit";
      this.getData();
    } else {
      this.title = "Tambah";
    }
  },
     methods:{
         storeData() {
              let token =''
             this.token = localStorage.getItem('JWToken')
            //  console.log(this.token)
             const config={
                headers: {
                 'Authorization': `Bearer ${this.token}`
                },
            }
         axios.post("/api/auth/kategori/voc/store", this.kategori,config).then((response) => {
            // console.log(response);
            if (response.data.data) {
            // console.log(response);
            // this.$noty.success(response.data.message);
            this.$router.push({
              name: "TabelKategoriVoc",
            });
          }
        })
        .catch((error) => {
          if (error.response.status == 403) {
            this.errors = error.response.data.message;
          }
        });
    },

         updateData(){
             let token =''
             this.token = localStorage.getItem('JWToken')
            //  console.log(this.token)
             const config={
                headers: {
                 'Authorization': `Bearer ${this.token}`
                },
            }
             axios.post('/api/auth/kategori/voc/update/'+ this.id , this.kategori,  config).then((response) => {
                    // this.$noty.success(response.data.data.message)
                    this.$router.push({
                    name : 'TabelKategoriVoc'
                 })
             }).catch((error)=>{
                 if(error.response.data.data== 403){
                    this.errors = error.response.data.message
                 }
             })
         },


           getData(){
             let token =''
             this.token = localStorage.getItem('JWToken')
            //  console.log(this.token)
             const config={
                headers: {
                 'Authorization': `Bearer ${this.token}`
                }
            }
            axios.get( '/api/auth/kategori/voc/edit/'  + this.id, config).then((response)=>{
            // console.log(response)
            this.kategori = {
                namkat_vocs : response.data.data.namkat_vocs,
                status_kategori : response.data.data.status_kategori
            }
            })
             },
              loadingData(){
        if (this.id !== undefined){
            this.updateData();
        } else {
            this.storeData();
        }
    },
         },
     }
</script>
