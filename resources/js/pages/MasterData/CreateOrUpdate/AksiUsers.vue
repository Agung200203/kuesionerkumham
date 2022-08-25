<template>
  <div class="card">
    <div class="card-header">{{ title }} Data</div>
    <div class="card-body">
      <form @submit.prevent="loadingData()">
    <div v-if="id">
        <div class="mb-3">
          <p class="form-label">Email *</p>
          <input class="form-control" v-model="user.email" type="text" placeholder=""
            aria-label="default input example" />
        </div>
        <div class="mb-3">
          <p class="form-label">Pegawai *</p>
          <v-select label="nama" :options="listPegawai" v-model="user.id_pegawai" placeholder="Pilih Pegawai"
            :reduce="(listpegawai) => listpegawai.id"></v-select>
        </div>
    </div>
    <div v-else>
        <div class="mb-3">
          <p class="form-label">NIP *</p>
          <input class="form-control" v-model="user.nip" type="text" placeholder=""
            aria-label="default input example"  />
        </div>
        <div class="mb-3">
          <p class="form-label">Nama User*</p>
          <input class="form-control" v-model="user.name" type="text" placeholder=""
            aria-label="default input example" />
        </div>
      <div class="mb-3">
          <p class="form-label">Pegawai *</p>
          <v-select label="nama" :options="listPegawai" v-model="user.id_pegawai"
            :reduce="(listpegawai) => listpegawai.id">
            <template #search="{attributes, events}">
                    <input
                    class="vs__search"
                    :required="!user.id_pegawai"
                     v-bind="attributes"
                     v-on="events"
                    />
            </template>
           </v-select>
        </div>
        <div class="mb-3">
          <p class="form-label">Email *</p>
          <input class="form-control" v-model="user.email" type="text" placeholder=""
            aria-label="default input example" />
        </div>
        <div class="mb-3">
          <p class="form-label">password *</p>
          <input class="form-control" v-model="user.password" type="text" placeholder=""
            aria-label="default input example" />
        </div>
        <div class="mb-3">
          <p class="form-label">Konfirmasi password  *</p>
          <input class="form-control" v-model="user.password_confirmation" type="text" placeholder=""
            aria-label="default input example" />
        </div>
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
      listPegawai: [],
      title:'',
      user: {
        nip: "",
        nama: "",
        email:"",
        password:"",
        password_confirmation: "",
        id_pegawai:""
      },
      errors: {},
    };
  },
  mounted() {
    this.list();
    if (this.id !== undefined) {
      this.title = "Edit";
      this.getuser();
    } else {
      this.title = "Tambah";
    }
  },

  methods: {
    list(){
      let token = "";
      this.token = localStorage.getItem("JWToken");
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
        axios.get("http://komputasi.ptumdi.com/api/auth/pegawai/listpeg", config).then((response) => {
            console.log(response);
        this.listPegawai = response.data;
        
      });
    },
    handleCreateData() {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      //  console.log(this.token)
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      axios
        .post(
          "api/auth/registerUser",
          this.user,
          config
        )
        .then((response) => {
          console.log(response);
          if (response.data) {
            this.$noty.success(response.data.message);
            this.$router.push({
              name: "User",
            });
          }
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },

    handleUpdate() {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      //  console.log(this.token)
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      if (typeof( this.user.id_pegawai) === 'string'){
      var idpeg = this.user.id_pegawai
      var resultpeg = this.listPegawai.find(function(e){return e.nama == idpeg});
      this.user.id_pegawai = resultpeg.id;
      }
      axios
        .post(
          "api/auth/user/update/" + this.id,
          this.user, config
        )
        .then((response) => {
          console.log(response);
            this.$router.push({
              name: "User",
            });

        })
        .catch(() => { });
    },

    getuser() {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      //  console.log(this.token)
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
    //   console.log(this.id);
      axios
        .get("http://komputasi.ptumdi.com/api/auth/user/edit/" + this.id, config)
        .then((response) => {
          console.log(response)
          this.user = {
            email: response.data.data.email,
            id_pegawai: response.data.data.pegawai.nama,
          };
        });
    },

    loadingData() {
      if (this.id !== undefined) {
        this.handleUpdate()
      } else {
        this.handleCreateData();
      }
    },
  },
};
</script>
