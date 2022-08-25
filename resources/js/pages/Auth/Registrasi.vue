<template>
  <div
    style="
      width: 100%;
      height: 100vh;
      position: absolute;
      background-image: linear-gradient(to right, #0072ff, #00c6ff);
      background-repeat: no-repeat;
      background-size: 100%;
    "
  >
    <div class="container mt-3">
      <div class="card rounded">
        <h2
          class="shadow-sm p-3 border rounded mt-4 me-4 ms-4"
          style="text-align: center; color: #706f6f"
        >
          Registrasi Pegawai
        </h2>
        <div class="card-body mt-2">
          <form @submit.prevent="handleCreateData()">
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <p class="form-label">NIP *</p>
                  <input
                    class="form-control"
                    v-model="pegawai.nip"
                    type="text"
                    placeholder=""
                    aria-label="default input example"
                  />
                </div>
                 <div v-if="validation.nip" class="mt-2 alert alert-danger">
                                {{ validation.nip[0] }}
                            </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <p class="form-label">Nama *</p>
                  <input
                    class="form-control"
                    v-model="pegawai.nama"
                    type="text"
                    placeholder=""
                    aria-label="default input example"
                  />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <p class="form-label">Tanggal Lahir *</p>
                  <input
                    class="form-control"
                    v-model="pegawai.tgl_lahir"
                    type="date"
                    placeholder=""
                    aria-label="default input example"
                  />
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <p class="form-label">Tanggal Masuk *</p>
                  <input
                    class="form-control"
                    v-model="pegawai.tgl_masuk"
                    type="date"
                    placeholder=""
                    aria-label="default input example"
                  />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <p class="form-label">Pendidikan *</p>
                  <select
                    class="form-select"
                    aria-label="Default select example"
                    v-model="pegawai.pendidikan"
                  >
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
              </div>
               <div class="col">
                  <div class="mb-3">
                    <p class="form-label">Gender *</p>
                    <select
                      class="form-select"
                      aria-label="Default select example"
                      v-model="pegawai.gender"
                    >
                      <option value="L">L</option>
                      <option value="P">P</option>
                    </select>
                  </div>
                </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <p class="form-label">Jabatan *</p>
                  <v-select
                    label="nama"
                    :options="arrayJabatan"
                    :reduce="(arrayJabatan) => arrayJabatan.id"
                    v-model="pegawai.id_jabatan"
                  ></v-select>
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <p class="form-label">UPT *</p>
                  <v-select
                    label="nama"
                    :options="arrayUPT"
                    :reduce="(arrayUPT) => arrayUPT.id"
                    v-model="pegawai.id_upt"
                  >
                  </v-select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <p class="form-label">Wilayah *</p>
                  <v-select
                    label="nama"
                    :options="arrayWilayah"
                    :reduce="(arrayWilayah) => arrayWilayah.id"
                    v-model="pegawai.id_wilayah"
                  ></v-select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <p class="form-label">Atasan *</p>
                  <v-select
                    label="nama"
                    :options="arrayAtasan"
                    :reduce="(arrayAtasan) => arrayAtasan.id"
                    v-model="pegawai.id_atasan"
                  ></v-select>
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <p class="form-label">Nomer Telepon *</p>
                  <input
                    class="form-control"
                    v-model="pegawai.no_telp"
                    type="text"
                    placeholder=""
                    aria-label="default input example"
                  />
                </div>
              </div>
            </div>

            <div class="mb-3">
              <p class="form-label">Alamat *</p>
              <input
                class="form-control"
                v-model="pegawai.alamat"
                type="text"
                placeholder=""
                aria-label="default input example"
              />
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
            <button type="submit" class="btn btn-primary" style="width: 130px">
              Simpan
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      // idJabatan:0,
      title: "",
      pegawai: {
        nip: "",
        nama: "",
        tgl_lahir: "",
        tgl_masuk: "",
        pendidikan: "",
        gender: "",
        id_jabatan: "",
        id_upt: "",
        id_wilayah: "",
        id_jab_upt: "",
        id_atasan: "",
        no_telp: "",
        alamat: "",
        // foto: "",
      },
      arrayJabatan: [],
      arrayUPT: [],
      arrayWilayah: [],
      arrayAtasan: [],
      errors: {},
      validation:[],
    };
  },

  mounted() {
    this.list();
  },

  methods: {
    handleCreateData() {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      axios
        .post(
          "http://localhost:8000/api/auth/registerPegawai",
          this.pegawai,
          config
        )
        .then((response) => {
          console.log(response);
          if (response.data) {
            this.$noty.success(response.data.message);
            localStorage.setItem("idPegawai", response.data.pegawai.id);
            this.$router.push({
              name: "RegistrasiUser",
            });
          }
        })
        .catch((error) => {
        console.log(error);
        });
    },

    list() {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      //  console.log(this.token)
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      axios
        .get("http://localhost:8000/api/auth/pegawai/listjab", config)
        .then((response) => {
          this.arrayJabatan = response.data;
        });
      axios
        .get("http://localhost:8000/api/auth/pegawai/listupt", config)
        .then((response) => {
          this.arrayUPT = response.data;
        });
      axios
        .get("http://localhost:8000/api/auth/pegawai/listwil", config)
        .then((response) => {
          this.arrayWilayah = response.data;
          console.log(this.arrayWilayah);
        });
      axios
        .get("http://localhost:8000/api/auth/pegawai/listatas", config)
        .then((response) => {
          console.log(response);
          this.arrayAtasan = response.data;
        });
    },
  },
};
</script>
