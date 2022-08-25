<template>
    <div class="card p-4 shadow mb-5" style="text-align: center">
        <div
            class="rounded w-25 mt-1 mb-5 ps-3"
            style="
                margin-left: -50px;
                text-align: left;
                color: white;
                background-color: #317af7;
            ">
            <h3>Kategori Xrole</h3>
        </div>
        <form  @submit.prevent="searchData()">
         <v-select placeholder="Pilih Kategori " label="namkat_xrole" :options="listkategori.data"
                        :reduce="(listkategori) => listkategori.namkat_xrole" v-model="query.nama"></v-select>
        <div class="row mt-2">
            <v-select placeholder="Pilih Status " label="name" :options="status"
                        :reduce="(status) => status.value" v-model="query.statusKategori"></v-select>
        </div>

        <div class="d-flex justify-content-start">  <button type="submit" class="btn btn-primary w-25  mt-2">Cari</button> </div>
        </form>
        <div class="row justify-content-end">
            <div
                class="mb-1 d-flex justify-content-end"
                style="width: 310px"
            >
            <div>
                <router-link class="btn btn-success rounded"  v-bind:to="{ name: 'AksiKategoriXrole' }" >Tambah Data <i class="bi bi-file-earmark-plus"></i></router-link>
            </div>
        </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="scrol">
                    <thead style="background-color: #317af7; color: white">
                        <tr>
                            <td class="text-center">NAMA</td>
                            <td class="text-center w-25">STATUS</td>
                            <td class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(dt, index) in kategori.data">
                            <td>{{ dt.namkat_xrole }}</td>
                            <td v-if="dt.status_kategori == 1">
                                <div class="d-flex justify-content-center "><div class="bg-success text-light p-1 rounded w-100">Aktif</div> </div>
                            </td>
                            <td v-else-if="dt.status_kategori == 0">
                                <div class="d-flex justify-content-center "><div class="bg-danger text-light p-1 rounded w-100">Tidak Aktif</div> </div>
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
                  <div class="col-md-3 text-start"><b>Nama</b></div>
                  <div class="col-md text-start">
                    : {{ detail.namkat_xrole }}
                  </div>
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
                <nav class="d-flex justify-content-center pt-3"
                    v-if="kategori.total > kategori.per_page"
                    aria-label="Page navigation example"
                >
                    <ul class="pagination">
                        <li class="page-item">
                            <button
                                class="page-link"
                                @click.prevent="setUrl(kategori.first_page_url)"
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
                                @click.prevent="setUrl(kategori.last_page_url)"
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
<style></style>
<script>
export default {
    data(){
        return {
             status: [{ name: 'Aktif', value:1 }, { name: 'Tidak Aktif', value:0 }],
            listkategori:{},
            query:{
                nama:null,
                statusKategori:null,
            },
            nama: "",
            paginate:[],
            kategori:{},
            detail: {},
            url: "/api/auth/kategori/xrole",
        };
    },
    mounted(){
        this.getKategori();
        this.list();
    },
    methods: { 
        list(){
            let token =''
        this.token = localStorage.getItem('JWToken')
        const config={
            headers: {
            'Authorization': `Bearer ${this.token}`
            }
        }
            axios.get(this.url, config).then((response) => {
            this.listkategori = response.data.data;
        });
        },
         searchData() {
            this.url = "/api/auth/kategori/xrole?";
       if (this.query.nama !== null) {
                this.url = this.url + "&query=" + this.query.nama;
            }
            if (this.query.statusKategori !== null) {
                this.url = this.url + "&status_kategori=" + this.query.statusKategori;
            }
            this.getKategori();
    },
        getKategori() {
        let token =''
        this.token = localStorage.getItem('JWToken')
        const config={
            headers: {
            'Authorization': `Bearer ${this.token}`
            }
        }
        axios.get(this.url, config).then((response) => {
            
            this.kategori = response.data.data;
            this.paginate = response.data.data.links;
        });
    },
    setUrl(setter) {
            this.url = setter;
            this.getKategori();
    },
    editData(id){
        this.$router.push({
        name: "AksiKategoriXrole",
        params: {
          id},
      });
    },
   deleteData(id) {
      let token =''
      this.token = localStorage.getItem('JWToken')
      const config={
        headers: {
          'Authorization': `Bearer ${this.token}`
        }
      }
      if (confirm("Apakah Anda Ingin Menghapus Data Tersebut ?")) {
        axios.get(`/api/auth/kategori/xrole/delete/`+ id ,config).then((response) => {
            this.$noty.success(response.data.data.msg.status);
            this.getKategori();
        });
      }
      else {
        return false;
      }
    },
    detailData(id) {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      //  console.log(this.token)
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      axios.get("/api/auth/kategori/xrole/edit/" + id, config).then((response) => {
        this.detail = response.data.data;
      });
    },
  },
};
</script>
