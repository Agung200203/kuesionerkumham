<template>
<section style="width: 100%;height:100vh;  position: fixed; background-image: linear-gradient(to right, #0072FF, #00C6FF) ; background-repeat:no-repeat; background-size:100%; ">
  <div class="container" style="margin-top:110px">
  <div class="card rounded">
<h2 class="shadow-sm p-3 border rounded mt-4 me-4 ms-4" style="text-align: center; color:#706f6f;"> Registrasi User </h2>
    <div class="card-body">
      <form @submit.prevent="handleCreateData()">
      
        <div class="row">
            <div class="col">
                 <div class="mb-3">
          <p class="form-label">NIP *</p>
          <input class="form-control" v-model="user.nip" type="text" placeholder=""
            aria-label="default input example"  />
        </div>
            </div>
            <div class="col">
                <div class="mb-3">
          <p class="form-label">Nama User*</p>
          <input class="form-control" v-model="user.nama" type="text" placeholder=""
            aria-label="default input example" />
        </div>
            </div>
        </div>

        <div hidden class="row">
            <div class="col">
                 <div class="mb-3">
          <p class="form-label">Nama Pegawai *</p>
            <input class="form-control" v-model="user.id_pegawai" type="text" placeholder=""
              aria-label="default input example"  />
        </div>
            </div>
            <div class="col">
                <div class="mb-3">
          <p class="form-label">Email *</p>
          <input class="form-control" v-model="user.email" type="text" placeholder=""
            aria-label="default input example" />
        </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                 <div class="mb-3">
          <p class="form-label">password *</p>
          <input class="form-control" v-model="user.password" type="text" placeholder=""
            aria-label="default input example" />
        </div>
            </div>
           <div class="mb-3">
          <p class="form-label">Konfirmasi password  *</p>
          <input class="form-control" v-model="user.password_confirmation" type="text" placeholder=""
            aria-label="default input example" />
        </div>
        </div>
        <button type="submit" class="btn btn-primary" style="width:130px">Simpan</button>
      </form>
    </div>
  </div>
  </div>
  </section>
  </template>

</template>
<script>
export default {
  data() {
    return {
      user: {
        nip: "",
        nama: "",
        email:"",
        password:"",
        password_confirmation: "",
        id_pegawai: localStorage.getItem("idPegawai"),
      },
      errors: {},
    };
  },
  mounted() {

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
          "http://localhost:8000/api/auth/registerUser",
          this.user,
          config
        )
        .then((response) => {
          console.log(response);
          if (response.data) {
            this.$noty.success(response.data.message);
            localStorage.removeItem("idPegawai");
            this.$router.push({
              name: "Login",
            });
          }
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },
  },
};
</script>
