<template>
  <div class="card p-4 shadow mb-5" style="text-align: center">
    <div
      class="rounded w-25 mt-1 mb-5 ps-3"
      style="
        margin-left: -50px;
        text-align: left;
        color: white;
        background-color: #317af7;
      "
    >
      <h3>Tabel User</h3>
    </div>
    <div class="row">
      <div class="col-sm-1 text-start" for="nama">
        <p><b>Nama</b></p>
      </div>
      <div class="col-sm-4">
        <input
          class="form-control form-control-sm"
          id="nama"
          type="text"
          placeholder="Nama..."
          aria-label=".form-control-sm example"
        />
        <div class="d-flex justify-content-start mt-2">
          <button
            type="button"
            class="btn btn-primary btn-sm"
            style="width: 100px"
          >
            Cari
          </button>
        </div>
      </div>
    </div>
    <div class="row justify-content-end">
      <div class="mb-1 d-flex justify-content-end" style="width: 310px">
        <div>
          <router-link
            type="button"
            class="btn btn-success"
            v-bind:to="{ name: 'Edit' }"
            style="border-radius: 0px"
            >Tambah Data <i class="bi bi-file-earmark-plus"></i
          ></router-link>

          <b-modal id="modal-1" title="BootstrapVue">
            <p class="my-4">Hello from modal!</p>
          </b-modal>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-hover" id="scrol">
          <thead style="background-color: #317af7; color: white">
            <tr>
              <td class="text-center">NO</td>
              <td class="text-center">Nama</td>
              <td class="text-center">Email</td>
              <td class="text-center">Aksi</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user, index) in users">
              <td>{{ index + 1 }}</td>
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>
                <b-dropdown
                  id="dropdown-right"
                  right
                  text="Aksi"
                  variant="success"
                  class="m-2"
                  size="sm"
                >
                  <b-dropdown-item href="#">Detail</b-dropdown-item>

                  
                  <b-dropdown-item @click.prevent="EditUSer(user.id)"
                    >Edit</b-dropdown-item
                  >

                  <b-dropdown-item @click.prevent="DeleteUser(user.id)"
                    >Hapus</b-dropdown-item
                  >
                </b-dropdown>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: [],
    };
  },
  mounted() {
    this.getUsers();
  },

  methods: {
    getUsers() {
      axios.get("/api/users").then((response) => {
        // console.log(response);
        this.users = response.data;
      });
    },
    EditUSer(id) {
      // this.$router.push('/user/' + nama.toLowerCase())
      this.$router.push({
        name: "Edit",
        params: { id },
      });
    },
    DeleteUser(id) {
      if (confirm("Apakah Anda Ingin Menghapus Data Tersebut ?")) {
        axios.delete(`/api/users/`+{id}+``).then((response) => {

          if (response.data.status) {
            this.$noty.success(response.data.message);
            this.$router.push({
              name: "User",
            });
            this.getUsers();
          }
        });
      } else {
        return false;
      }
    },
  },
};
</script>
