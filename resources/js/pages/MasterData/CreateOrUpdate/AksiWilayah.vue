<template>
  <div class="card">
    <div class="card-header">{{ title }} Data</div>
    <div class="card-body">
        <form @submit.prevent="loadingData()">
            <div class="mb-3">
                <p class="form-label">Nama wilayah *</p>
                <input class="form-control" v-model="wilayah.nama" required/>
            </div>
            <div class="mb-3">
                <p class="form-label">Alamat wilayah *</p>
                <input class="form-control" v-model="wilayah.alamat" required/>
            </div>
            <div class="mb-3">
                <p class="form-label">Kepala Kantor wilayah *</p>
                <input class="form-control" v-model="wilayah.kakanwil" required/>
            </div>
            <div class="mb-3">
                <p class="form-label">Email *</p>
                <input class="form-control" v-model="wilayah.email" required/>
            </div>
            <div class="mb-3">
                <p class="form-label">No Telp *</p>
                <input class="form-control" v-model="wilayah.no_telp" required/>
            </div>
            <div class="mb-3">
                <p class="form-label">Status wilayah *</p>
                <select class="form-select" v-model="wilayah.status_wilayah" required>
                    <option  :selected="wilayah.status_wilayah" ></option>
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
      wilayah: {
                nama: "",
                alamat: "",
                kakanwil: "",
                email: "",
                no_telp: "",
                status_wilayah: "",
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
      //  console.log(this.token)
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      axios
        .get("/api/auth/wilayah/edit/" + this.id, config)
        .then((response) => {
            this.wilayah = {
                nama: response.data.data.nama,
                alamat: response.data.data.alamat,
                kakanwil: response.data.data.kakanwil,
                email: response.data.data.email,
                no_telp: response.data.data.no_telp,
                status_wilayah: response.data.data.status_wilayah,
            };
              console.log(this.wilayah);
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
        axios.post('/api/auth/wilayah/update/'+ this.id , this.wilayah,  config).then((response) => {
        // console.log(response)
            this.$router.push({
            name : 'TabelWilayah'
            })
        // if(response.data.data){
        //     // this.$noty.success(response.data.data.message)
        //     }
        }).catch((error)=>{
            if(error.response.data.data== 403){
            this.errors = error.response.data.message
            }

        //  this.$router.push({
        //     name : 'TabelWilayah'
        //  })
        })
    },
    storeData() {
        let token =''
        this.token = localStorage.getItem('JWToken')
        //  console.log(this.token)
        const config={
            headers: {
            'Authorization': `Bearer ${this.token}`
            },
        }
        axios.post("/api/auth/wilayah/store", this.wilayah,config).then((response) => {
            // console.log(response);
            if (response.data.data) {
            this.$router.push({
              name: "TabelWilayah",
            });
          }
        })
        .catch((error) => {
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