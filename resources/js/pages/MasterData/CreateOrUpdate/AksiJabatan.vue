<template>
  <div class="card">
    <div class="card-header">{{ title }} Data</div>
    <div class="card-body">
        <form @submit.prevent="loadingData()">
            <div class="mb-3">
                <p class="form-label">Kode Jabatan *</p>
                <input class="form-control" v-model="jabatan.kode_jabatan" required/>
            </div>
            <div class="mb-3">
                <p class="form-label">Nama Jabatan *</p>
                <input class="form-control" v-model="jabatan.nama" required/>
            </div>
            <div class="mb-3">
                <p class="form-label">Status Jabatan *</p>
                <select class="form-select" v-model="jabatan.status_jabatan" required>
                    <option :selected="jabatan.status_jabatan" ></option>
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
      jabatan: {
        kode_jabatan: "",
        nama: "",
        status_jabatan: "",
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
        .get("/api/auth/jabatan/edit/" + this.id, config)
        .then((response) => {
          this.jabatan = {
            kode_jabatan: response.data.data.kode_jabatan,
            nama: response.data.data.nama,
            status_jabatan: response.data.data.status_jabatan,
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
        axios.post('/api/auth/jabatan/update/'+ this.id , this.jabatan,  config).then((response) => {
            this.$router.push({
            name : 'TabelJabatan'
            })
        }).catch((error)=>{
            console.log(error.response.data.data);
            if(response.data.data == 403){
            this.errors = error.response.data.message
            }
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
        axios.post("/api/auth/jabatan/store", this.jabatan,config).then((response) => {
          this.$router.push({
            name: "TabelJabatan",
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
