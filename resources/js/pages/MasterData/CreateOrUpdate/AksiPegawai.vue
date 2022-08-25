<template>
  <div class="card">
    <div class="card-header">{{ title }} Data</div>
    <div class="card-body">
      <form @submit.prevent="loadingData()">
        <div class="mb-3">
          <p class="form-label">NIP *</p>
          <input class="form-control" v-model="pegawai.nip" type="text" placeholder=""
            aria-label="default input example" required />
        </div>
        <div class="mb-3">
          <p class="form-label">Nama *</p>
          <input class="form-control" v-model="pegawai.nama" type="text" placeholder=""
            aria-label="default input example" required />
        </div>
        <div class="mb-3">
          <p class="form-label">Tanggal Lahir *</p>
          <input class="form-control" v-model="pegawai.tgl_lahir" type="text" placeholder=""
            aria-label="default input example" />
        </div>
        <div class="mb-3">
          <p class="form-label">Pendidikan *</p>
          <select class="form-select" aria-label="Default select example" v-model="pegawai.pendidikan">
            <option selected>{{ pegawai.pendidikan }}</option>
            <option value="SMA">SMA</option>
            <option value="SMK">SMK</option>
            <option value="MA">MA</option>
            <option value="D1">D1</option>
            <option value="D2">D2</option>
            <option value="D3">D3</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
            <option value="S3">S3</option>
          </select>
        </div>
        <div class="mb-3">
          <p class="form-label">Gender *</p>
          <select class="form-select" aria-label="Default select example" v-model="pegawai.gender">
            <option selected>{{ pegawai.gender }}</option>
            <option value="L">L</option>
            <option value="P">P</option>
          </select>
        </div>
        <div class="mb-3">
          <p class="form-label">Jabatan *</p>
          <v-select label="nama" :options="arrayJabatan" :reduce="(arrayJabatan)=>arrayJabatan.id" 
            v-model="pegawai.id_jabatan"></v-select>
        </div>
        <div class="mb-3">
          <p class="form-label">UPT *</p>
          <v-select label="nama" :options="arrayUPT" :reduce="(arrayUPT)=>arrayUPT.id" 
            v-model="pegawai.id_upt"></v-select>
        </div>
        <div class="mb-3">
          <p class="form-label">Wilayah *</p>
               <v-select label="nama" :options="arrayWilayah" :reduce="(arrayWilayah)=>arrayWilayah.id" 
            v-model="pegawai.id_wilayah"></v-select>
        </div>
        <div class="mb-3">
          <p class="form-label">Atasan *</p>
            <v-select label="nama" :options="arrayAtasan" :reduce="(arrayAtasan)=>arrayAtasan.id" 
            v-model="pegawai.id_atasan"></v-select>
        </div>
        <div class="mb-3">
          <p class="form-label">Nomer Telepon *</p>
          <input class="form-control" v-model="pegawai.no_telp" type="text" placeholder=""
            aria-label="default input example" />
        </div>
        <div class="mb-3">
          <p class="form-label">Alamat *</p>
          <input class="form-control" v-model="pegawai.alamat" type="text" placeholder=""
            aria-label="default input example" />
        </div>
        <!-- <div class="mb-3">
          <p class="form-label">Foto *</p>
          <input
            class="form-control"
            v-model="pegawai.foto"
            type="text"
            placeholder=""
            aria-label="default input example"
          />
        </div> -->
        <div v-if="id" class="mb-3">
          <p class="form-label">Status *</p>
          <select class="form-select" v-model="pegawai.status_pegawai">
            <option :selected="pegawai.status_pegawai"></option>
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
      // idJabatan:0,
      title:'',
      pegawai: {
        nip: "",
        nama: "",
        tgl_lahir: "",
        pendidikan: "",
        gender: "",
        id_jabatan: "",
        id_upt: "",
        id_wilayah: "",
        id_atasan: "",
        no_telp: "",
        alamat: "",
        status_pegawai: ''
        // foto: "",
      },
      arrayJabatan:[],
      arrayUPT:[],
      arrayWilayah:[],
      arrayAtasan:[],
      errors: {},
    };
  },
  mounted() {
    this.list();
    if (this.id !== undefined) {
      this.title = "Edit";
      this.getpegawai();
    } else {
      this.title = "Tambah";
    }
  },

  methods: {
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
          "/api/auth/registerPegawai",
          this.pegawai,
          config
        )
        .then((response) => {
          console.log(response);
          if (response.data) {
            this.$noty.success(response.data.message);
            this.$router.push({
              name: "TabelPegawai",
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

      if(typeof( this.pegawai.id_jabatan) === 'string'){
      var idJab = this.pegawai.id_jabatan
      var resultJab = this.arrayJabatan.find(function(e){return e.nama == idJab});
      this.pegawai.id_jabatan = resultJab.id;
      }
      if(typeof( this.pegawai.id_upt) === 'string'){
      var idUPT = this.pegawai.id_upt
      var resultUPT = this.arrayUPT.find(function(e){return e.nama == idUPT});
      this.pegawai.id_upt = resultUPT.id;
      }
      if (typeof( this.pegawai.id_wilayah) === 'string'){
      var idWil = this.pegawai.id_wilayah
      var resultWil = this.arrayWilayah.find(function(e){return e.nama == idWil});
      this.pegawai.id_wilayah = resultWil.id;
      }
      if (typeof( this.pegawai.id_atasan) === 'string'){
      var idatas = this.pegawai.id_atasan
      var resultAtas = this.arrayAtasan.find(function(e){return e.nama == idatas});
      this.pegawai.id_atasan = resultAtas.id;
      }
      axios
        .post(
          "/api/auth/pegawai/update/" + this.id,
          this.pegawai, config
        )
        .then((response) => {
          console.log(response);
            this.$router.push({
              name: "TabelPegawai",
            });
          
        })
        .catch(() => { });
    },

    getpegawai() {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      //  console.log(this.token)
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      axios
        .get("/api/auth/pegawai/edit/" + this.id, config)
        .then((response) => {
          // console.log(response)
          this.pegawai = {
            nip: response.data.data.nip,
            nama: response.data.data.nama,
            tgl_lahir: response.data.data.tgl_lahir,
            pendidikan: response.data.data.pendidikan,
            gender: response.data.data.gender,
            id_jabatan: response.data.data.id_jabatan,
            id_upt: response.data.data.id_upt,
            id_wilayah: response.data.data.id_wilayah,
            id_atasan: response.data.data.id_atasan,
            no_telp: response.data.data.no_telp,
            alamat: response.data.data.alamat,
            status_pegawai: response.data.data.status_pegawai,
          };
        });   
    },
    list(){
       let token = "";
      this.token = localStorage.getItem("JWToken");
      //  console.log(this.token)
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
       axios
        .get("/api/auth/pegawai/listjab", config)
        .then((response) => {
          this.arrayJabatan = response.data  ;
        });
         axios
        .get("/api/auth/pegawai/listupt", config)
        .then((response) => {
          this.arrayUPT = response.data  ;
        });
        axios
        .get("/api/auth/pegawai/listwil", config)
        .then((response) => {
          this.arrayWilayah = response.data  ;
        });
        axios
        .get("/api/auth/pegawai/listatas", config)
        .then((response) => {
          this.arrayAtasan = response.data  ;
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
