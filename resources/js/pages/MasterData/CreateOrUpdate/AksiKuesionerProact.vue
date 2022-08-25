<template>
  <div class="card">
    <div class="card-header">{{ title }} Data</div>
    <div class="card-body">
      <form @submit.prevent="loadingData()">
        <div class="mb-3">
          <p class="form-label">Kategori *</p>
          <v-select label="namkat_proact" :options="arrayKategori" :reduce="(arrayKategori) => arrayKategori.id"
            v-model="kuesioner.id_katproacts"></v-select>
        </div>
        <div class="mb-3">
          <p class="form-label">Kuesioner *</p>
          <input class="form-control" v-model="kuesioner.namkuesproacts" required />
        </div>
        <div class="mb-3">
          <p class="form-label">Bobot *</p>
          <input type="number" class="form-control" v-model="kuesioner.bobot" required />
        </div>
        <div class="mb-3">
          <p class="form-label">Tujuan Kuesioner *</p>
          <v-select label="key" :options="arrayKpdRole" :reduce="(arrayKpdRole) => arrayKpdRole.val"
            v-model="kuesioner.kpd_role" required></v-select>
        </div>
        <div class="mb-3">
          <p class="form-label">Status kuesioner *</p>
          <select class="form-select" v-model="kuesioner.status_kuesioner" required>
            <option :selected="kuesioner.status_kuesioner"></option>
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
import 'vue-select/dist/vue-select.css';
export default {
  props: ["id"],
  data() {
    return {
      title: '',
      arrayKpdRole: [{ key: 'Atasan', val: 1 }, { key: 'Sejawat', val: 2 }, { key: 'Bawahan', val: 3 }, { key: 'Diri Sendiri', val: 4 }],
      arrayKategori: [],
      kuesioner: {
        id_katproacts: "",
        namkuesproacts: "",
        bobot: "",
        kpd_role: "",
        status_kuesioner: "",
      },
      errors: {},
    };
  },
  mounted() {
    this.getAutocomplete();
    if (this.id !== undefined) {
      this.title = "Edit";
      this.getData();
    } else {
      this.title = "Tambah";
    }
  },
  methods: {
    getAutocomplete() {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      axios.get("/api/auth/kues/proact/list/kategori", config)
      .then((response) => {
          this.arrayKategori = response.data
      });
    },
    getData() {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      axios.get("/api/auth/kues/proact/edit/" + this.id, config)
        .then((response) => {
          this.kuesioner = {
            id_katproacts: response.data.data.id_katproacts,
            namkuesproacts: response.data.data.namkuesproacts,
            bobot: response.data.data.bobot,
            kpd_role: response.data.data.kpd_role,
            status_kuesioner: response.data.data.status_kuesioner,
          };
        });
      this.getAutocomplete();
    },
    storeData() {
      let token = ''
      this.token = localStorage.getItem('JWToken')
      const config = {
        headers: {
          'Authorization': `Bearer ${this.token}`
        },
      }
      console.log(this.kuesioner);
      axios.post("/api/auth/kues/proact/store", this.kuesioner, config).then((response) => {
        this.$noty.success(response.data.message);
        this.$router.push({
          name: "TabelKuesionerProact",
        });
      }).catch((error) => {
        if (error.response.status == 403) {
          this.errors = error.response.data.message;
        }
      });
    },
    updateData() {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      if (typeof (this.kuesioner.id_katproact) === 'string') {
        var idKat = this.kuesioner.id_katproact
        var result = this.arrayKategori.find(function (e) { return e.namkat_proact == idKat });
        this.kuesioner.id_katproact = result.id;
      };
      axios.post("/api/auth/kues/proact/update/" + this.id, this.kuesioner, config)
        .then((response) => {
          this.$noty.success(response.data.data.message)
          this.$router.push({
            name: "TabelKuesionerProact"
          });
        }).catch((error) => {
          if (error.response.data.data == 403) {
            this.errors = error.response.data.message;
          }
        });
    },
    loadingData() {
      if (this.id !== undefined) {
        this.updateData();
      } else {
        this.storeData();
      }
    }
  },
};
</script>
