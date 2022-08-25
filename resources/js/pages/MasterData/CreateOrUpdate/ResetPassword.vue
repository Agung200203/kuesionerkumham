<template>
  <div class="card">
    <div class="card-header">Reset Password</div>
    <div class="card-body">
      <form @submit.prevent="handleUpdate()">
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
      user: {
        password:"",
        password_confirmation: "",
      },
      errors: {},
    };
  },
  mounted() {
    // 
  },

  methods: {
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
          "api/auth/user/reset/" + this.id,
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
  },
};
</script>
