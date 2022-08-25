<template>
  <div class="card">
    <div class="card-header">{{ title }} Data</div>
    <div class="card-body">
        <form @submit.prevent="loadingData()">
            <div class="mb-3">
                <p class="form-label">Nama *</p>
                <input class="form-control" v-model="kategori.namkat_speed" required/>
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
  props: ["id"],
  data() {
    return {
      title: "",
      kategori: {
        namkat_speed: "",
        status_kategori: ""
      },
      errors: {},
    };
  },
  mounted() {
    if (this.id !== undefined) {
      this.title = "Edit";
      this.getData();
    } else {
      this.title = "Tambah";
    }
  },
  methods: {
    getData() {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      axios
        .get("/api/auth/kategori/speed/edit/" + this.id, config)
        .then((response) => {
          this.kategori = {
            namkat_speed: response.data.data.namkat_speed,
            status_kategori: response.data.data.status_kategori,
          };
        });
    },
    updateData(){
        let token =''
        this.token = localStorage.getItem('JWToken')
        const config={
            headers: {
                'Authorization': `Bearer ${this.token}`
            },
        }
        axios.post('/api/auth/kategori/speed/update/'+ this.id , this.kategori,  config).then((response) => {
            console.log(response);
            this.$router.push({
            name : 'TabelKategoriSpeedec'
            })
        }).catch((error)=>{
        })
    },
    storeData() {
        let token =''
        this.token = localStorage.getItem('JWToken')
        const config={
            headers: {
            'Authorization': `Bearer ${this.token}`
            },
        }
        axios.post("/api/auth/kategori/speed/store", this.kategori,config).then((response) => {
            console.log(response);
          this.$router.push({
            name: "TabelKategoriSpeedec",
          });
        }).catch((error) => {
          if (error.response.status == 403) {
            this.errors = error.response.data.message;
          }
        });
    },
    loadingData(){
        if (this.id !== undefined){
            this.updateData();
        } else {
            this.storeData();
        }
    },

  },
};
</script>
