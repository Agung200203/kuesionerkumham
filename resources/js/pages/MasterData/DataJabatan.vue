<template>
  <div class="card p-4 shadow mb-5" style="text-align: center">
    <div class="rounded w-25 mt-1 mb-5 ps-3" style="
        margin-left: -50px;
        text-align: left;
        color: white;
        background-color: #317af7;
      ">
      <h3 class="ms-3">Jabatan</h3>
    </div>
    <div class="row">
      <!-- <div class="col-sm-1 text-start" for="nama">
        <p><b>Nama</b></p>
      </div> -->
      <form @submit.prevent="searchData()">
        <div class="col-sm-6">
          <v-select  placeholder="Pilih Jabatan" label="nama" :options="arrayJabatan"
            :reduce="(arrayJabatan) => arrayJabatan.nama" v-model="query"></v-select>
          <div class="d-flex justify-content-start mt-2">
            <button type="submit" class="btn btn-primary btn-sm" style="width: 100px">
              Cari
            </button>
          </div>
        </div>
      </form>
    </div>
    <div class="row justify-content-end">
      <div class="mb-1 d-flex justify-content-end" style="width: 310px">
        <div>
          <router-link type="button" class="btn btn-success" v-bind:to="{ name: 'AksiJabatan' }"
            style="border-radius: 0px">Tambah Data <i class="bi bi-file-earmark-plus"></i></router-link>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-hover" id="scrol">
          <thead style="background-color: #317af7; color: white">
            <tr>
              <!-- <td class="text-center">NO</td> -->
              <td class="text-center">Kode jabatan</td>
              <td class="text-center">nama</td>
              <td class="text-center w-25">Status Jabatan</td>
              <td class="text-center">Aksi</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(jab, index) in jabatan.data">
              <!-- <td>{{ index + 1 }}</td> -->
              <td hidden>{{ jab.id }}</td>
              <td>{{ jab.kode_jabatan }}</td>
              <td>{{ jab.nama }}</td>
              <td class="d-flex justify-content-center" v-if="jab.status_jabatan == 1">
                <div class="bg-success text-light p-1 rounded w-50">Aktif</div>
              </td>
              <td class="d-flex justify-content-center" v-else-if="jab.status_jabatan == 0">
                <div class="bg-danger text-light p-1 rounded w-50">
                  Tidak Aktif
                </div>
              </td>
              <td>
                <div class="dropdown">
                  <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-eye-fill"></i>
                  </a>

                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li>
                      <a class="btn dropdown-item" type="button" @click.prevent="detailData(jab.id)"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Detail</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#" @click.prevent="editData(jab.id)">Edit</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#" @click.prevent="deleteData(jab.id)">Hapus</a>
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
                  <div class="col-md-3 text-start"><b>Kode Jabatan</b></div>
                  <div class="col-md text-start">
                    : {{ detailJabatan.kode_jabatan }}
                  </div>
                </div>
                <div class="row pt-3">
                  <div class="col-md-3 text-start"><b>Nama Jabatan</b></div>
                  <div class="col-md text-start">
                    : {{ detailJabatan.nama }}
                  </div>
                </div>
                <div class="row pt-3">
                  <div class="col-md-3 text-start"><b>Status Jabatan</b></div>
                  <div class="col-md text-start" v-text="
                    ': ' +
                    (detailJabatan.status_jabatan == 1
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
        <nav class="d-flex justify-content-center pt-3" v-if="jabatan.total > jabatan.per_page"
          aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item">
              <button class="page-link" @click.prevent="setUrl(jabatan.first_page_url)">
                <i class="bi bi-chevron-double-left"></i>
              </button>
            </li>

            <li class="page-item" v-for="pagin in paginate">
              <button class="page-link" v-if="pagin.url && pagin.label === '&laquo; Previous'"
                @click.prevent="setUrl(pagin.url)">
                Previous
              </button>
              <button class="page-link" v-else-if="pagin.url && pagin.label === 'Next &raquo;'"
                @click.prevent="setUrl(pagin.url)">
                Next
              </button>
              <button class="page-link bg-primary text-light" v-else-if="pagin.url && pagin.active == true"
                @click.prevent="setUrl(pagin.url)">
                {{ pagin.label }}
              </button>
              <button class="page-link" v-else-if="pagin.url && pagin.active == false"
                @click.prevent="setUrl(pagin.url)">
                {{ pagin.label }}
              </button>
            </li>
            <li class="page-item">
              <button class="page-link" @click.prevent="setUrl(jabatan.last_page_url)">
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
import Vue from "vue";
export default {
  data() {
    return {
      query: "",
      paginate: [],
      jabatan: {},
      arrayJabatan: [],
      detailJabatan: {},
      url: "/api/auth/jabatan",
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      axios.get(this.url, config).then((response) => {
        this.jabatan = response.data.data;
        this.paginate = response.data.data.links;
      });
      axios
        .get("/api/auth/jabatan/list", config)
        .then((response) => {
          this.arrayJabatan = response.data;
        });
    },
    searchData() {
      if (this.query !== null) {
        this.url = "/api/auth/jabatan?query=" + this.query;
        this.getData();
      } else {
        this.url = "/api/auth/jabatan";
        this.getData();
      }
    },
    editData(id) {
      this.$router.push({
        name: "AksiJabatan",
        params: {
          id,
        },
      });
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
      axios.get("/api/auth/jabatan/edit/" + id, config).then((response) => {
        this.detailJabatan = response.data.data;
      });
    },
    deleteData(id) {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      // console.log(this.token)
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      if (confirm("Apakah Anda Ingin Menghapus Data Tersebut ?")) {
        axios.get(`/api/auth/jabatan/delete/` + id, config).then((response) => {
          if (response.data.data) {
            this.$noty.success(response.data.data.msg);
            this.$router.push({
              name: "TabelJabatan",
            });
            this.getjabatan();
          }
        });
      } else {
        return false;
      }
    },
    setUrl(setter) {
      this.url = setter;
      this.getData();
    },
  },
};
</script>
