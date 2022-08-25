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
            <h3 class="ms-3">User </h3>
        </div>
        <form  @submit.prevent="searchData()">
         <div class="row">
         <div class="col">
            <v-select  placeholder="Pilih Status " label="name" :options="status"
                        :reduce="(status) => status.value" v-model="query.status"></v-select>
         </div>
         <div class="col">
            <v-select  placeholder="Pilih Level " label="name" :options="levelUser"
                        :reduce="(levelUser) => levelUser.value" v-model="query.level"></v-select>
         </div>
         </div>
        <v-select class="mt-2" placeholder="Pilih Email " label="email" :options="listEmail.data"
                        :reduce="(listEmail) => listEmail.email" v-model="query.nama"></v-select>



        <div class="d-flex justify-content-start">  <button type="submit" class="btn btn-primary w-25  mt-2">Cari</button> </div>
        </form>

        <div class="row justify-content-end">
            <div
                class="mb-1 d-flex justify-content-end"
                style="width: 310px"
            >
            <div>
                  <router-link
            type="button"
            class="btn btn-success"
            v-bind:to="{ name: 'AksiUsers' }"
            style="border-radius: 0px"
            >Tambah Data <i class="bi bi-file-earmark-plus"></i
          ></router-link>
            </div>
        </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="scrol">
                    <thead style="background-color: #317af7; color: white">
                        <tr>
                            <!-- <td class="text-center">NO</td> -->

                            <td class="text-center">NIP </td>
                            <td class="text-center">Nama Pegawai</td>
                            <td class="text-center">Email </td>
                            <td class="text-center">Level</td>
                            <td class="text-center">Status </td>
                            <td class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(dt, index) in user.data" >
                            <!-- <td>{{ index + 1 }}</td> -->
                            <td hidden>{{ dt.id }}</td>
                            <td>{{ dt.pegawai.nip }}</td>
                            <td>{{ dt.pegawai.nama }}</td>
                            <td>{{ dt.email }}</td>
                            <td>{{ dt.level_user }}</td>
                            <td v-if="dt.status == 1">
                <div class="bg-success text-light p-1 rounded">Aktif</div>
              </td>
              <td v-else-if="dt.status == 0">
                <div class="bg-danger text-light p-1 rounded">Tidak Aktif</div>
              </td>
                             <td>
                                 <div class="dropdown">
                                    <a class="btn btn-light dropdown-toggle" href="#" role="button"
                                        id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="btn dropdown-item" type="button" @click.prevent="detailData(dt.id)"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Detail</a></li>
                                        <li>
                                        <a class=" dropdown-item" href="#" @click.prevent="editData(dt.id) ">Edit</a>
                                        </li>
                                        <li>
                                        <a class=" dropdown-item" href="#" @click.prevent="resetPassword(dt.id) ">Reset Password</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" @click.prevent="deleteData(dt.id)">Hapus</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                 <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-3 text-start"><b>NIP</b></div>
                  <div class="col-md text-start">
                    : {{ detail.nip }}
                  </div>
                </div>
                <div class="row pt-3">
                  <div class="col-md-3 text-start"><b>Nama</b></div>
                  <div class="col-md text-start">
                    : {{ detail.nama }}
                  </div>
                </div>
                <div class="row pt-3">
                  <div class="col-md-3 text-start"><b>Email</b></div>
                  <div class="col-md text-start">
                    : {{ detail.email }}
                  </div>
                </div>
                <div class="row pt-3">
                  <div class="col-md-3 text-start"><b>Level</b></div>
                    <div class="col-md text-start" v-text="
                    ': ' +
                    (detail.lvl_user == 1
                      ? 'Admin'
                      : 'User')
                  "></div>
                </div>
                <div class="row pt-3">
                  <div class="col-md-3 text-start"><b>Status</b></div>
                  <div class="col-md text-start" v-text="
                    ': ' +
                    (detail.status_kategori == 1
                      ? 'Aktif'
                      : 'Tidak Aktif')
                  "></div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                  Tutup
                </button>
              </div>
            </div>
          </div>
        </div>
                 <nav
                    v-if="user.total > user.per_page"
                    aria-label="Page navigation example"
                >
                    <ul class="pagination">
                        <li class="page-item">
                            <button
                                class="page-link"
                                @click.prevent="setUrl(user.first_page_url)"
                            >
                                <i class="bi bi-chevron-double-left"></i>
                            </button>
                        </li>

                        <li class="page-item" v-for="pagin in paginate">
                            <button
                                class="page-link"
                                v-if="
                                    pagin.url &&
                                    pagin.label === '&laquo; Previous'
                                "
                                @click.prevent="setUrl(pagin.url)"
                            >
                                Previous
                            </button>
                            <button
                                class="page-link"
                                v-else-if="
                                    pagin.url && pagin.label === 'Next &raquo;'
                                "
                                @click.prevent="setUrl(pagin.url)"
                            >
                                Next
                            </button>
                            <button
                                class="page-link bg-primary text-light"
                                v-else-if="pagin.url&&pagin.active==true"
                                @click.prevent="setUrl(pagin.url)"

                            >
                                {{ pagin.label }}
                            </button>
                            <button
                                class="page-link "
                                v-else-if="pagin.url&&pagin.active==false"
                                @click.prevent="setUrl(pagin.url)"
                            >
                                {{ pagin.label }}
                            </button>
                        </li>
                        <li class="page-item">
                            <button
                                class="page-link"
                                @click.prevent="setUrl(user.last_page_url)"
                            >
                                <i class="bi bi-chevron-double-right"></i>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  data() {
    return {
      status: [{ name: 'Aktif', value:1 }, { name: 'Tidak Aktif', value:0 }],
      levelUser: [{ name: 'Admin', value:1 }, { name: 'User', value:0 }],
       query:{
                nama:null,
                level:null,
                status:null
            },
      listEmail:{},
      nama:'',
      user: [],
      paginate:[],
      detail: {},
      url:"api/auth/user",
    };
  },
  mounted() {
this.getuser();
this.list();
},
  methods: {

      getuser() {
      let token =''
      this.token = localStorage.getItem('JWToken')
      // console.log(this.token)
      const config={
        headers: {
          'Authorization': `Bearer ${this.token}`
        }
      }
      axios.get(this.url, config).then((response) => {
        console.log(response);
        this.user = response.data.data;
        this.paginate = response.data.data.links;
        // console.log(response)
      });
    },

    list(){
         let token =''
      this.token = localStorage.getItem('JWToken')
      const config={
        headers: {
          'Authorization': `Bearer ${this.token}`
        }
      }
      axios.get(this.url, config).then((response) => {
        this.listEmail = response.data.data;
      });

    },

        searchData() {
            this.url = "api/auth/user?";
       if (this.query.nama !== null) {
                this.url = this.url + "&email=" + this.query.nama;
            }
            if (this.query.level !== null) {
                this.url = this.url + "&lvl_user=" + this.query.level;
            }
            if (this.query.status !== null) {
                this.url = this.url + "&status=" + this.query.status;
            }
            this.getuser();
    },
    setUrl(setter) {
            this.url = setter;
            this.getuser();
    },

      editData(id) {
      this.$router.push({
        name: "AksiUsers",
        params: {
          id},
      });
    },
      resetPassword(id) {
      this.$router.push({
        name: "ResetPassword",
        params: {
          id},
      });
    },
   deleteData(id) {
  // console.log('http://localhost:8000/api/auth/user/delete/' + id);
      let token =''
      this.token = localStorage.getItem('JWToken')
      // console.log(this.token)
      const config={
        headers: {
          'Authorization': `Bearer ${this.token}`
        }
      }
      if (confirm("Apakah Anda Ingin Menghapus Data Tersebut ?")) {
        axios.get(`http://localhost:8000/api/auth/user/delete/`+ id ,config).then((response) => {
          console.log(response);
            this.$noty.success(response.data.data.msg.status);
            this.getuser();
          });
      }
      else {
        return false;
      }
    },
    detailData(id) {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      axios.get("api/auth/user/edit/" + id, config).then((response) => {
        this.detail={
            email: response.data.data.email,
            nip: response.data.data.pegawai.nip,
            nama: response.data.data.pegawai.nama
        }
      });
    },
  },
};
</script>

