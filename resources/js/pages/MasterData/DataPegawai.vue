<template>
  <div class="card p-4 shadow mb-5 border-1" style="text-align: center; border-color: #919090">
    <div class="rounded w-25 mt-1 mb-5 ps-3" style="
        margin-left: -50px;
        text-align: left;
        color: white;
        background-color: #317af7;
      ">
      <h3 class="ms-3">Pegawai</h3>
    </div>


    <form @submit.prevent="searchData()">
      <div class="row ">
        <div class="col">
          <v-select label="nama" :options="listPegawai" v-model="query.query" placeholder="Pilih Pegawai"
            :reduce="(listpegawai) => listpegawai.nama"></v-select>
        </div>

        <div class="col">
          <v-select label="nama" :options="listJabatan" v-model="query.jabatan" placeholder="Pilih Jabatan"
            :reduce="(listJabatan) => listJabatan.id"></v-select>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col">
          <v-select label="nama" :options="listUPT" v-model="query.upt" placeholder="Pilih UPT"
            :reduce="(listUPT) => listUPT.id"></v-select>
        </div>

        <div class="col">
          <v-select label="nama" :options="listWilayah" v-model="query.wilayah" placeholder="Pilih Wilayah"
            :reduce="(listWilayah) => listWilayah.id"></v-select>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col">
          <v-select label="val" :options="vselect_gender" v-model="query.gender" placeholder="Pilih Jenis Kelamin"
            :reduce="(vselect_gender) => vselect_gender.val"></v-select>
        </div>
        <div class="col">
          <v-select label="val" :options="vselect_pendidikan" v-model="query.pendidikan" placeholder="Pilih Pendidikan"
            :reduce="(vselect_pendidikan) => vselect_pendidikan.val"></v-select>
        </div>
      </div>
      <div class="d-flex justify-content-start mt-2">
        <button type="submit" class="btn btn-primary w-25">Cari</button>
        <!-- <button onclick="window.print()">Print this page</button> -->
      </div>
    </form>
    <div class="row justify-content-end">
      <div class="mb-1 d-flex justify-content-end" style="width: 310px">
        <div>
          <router-link type="button" class="btn btn-success" v-bind:to="{ name: 'AksiPegawai' }"
            style="border-radius: 0px">Tambah Data <i class="bi bi-file-earmark-plus"></i></router-link>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-hover" id="scrol">
          <thead style="background-color: #317af7; color: white">
            <tr>
              <td class="text-center">NIP</td>
              <td class="text-center">Nama</td>
              <td class="text-center">Jabatan</td>
              <td class="text-center">UPT</td>
              <td class="text-center">Wilayah</td>
              <td class="text-center">Atasan</td>
              <td class="text-center">Status Pegawai</td>
              <td class="text-center">Aksi</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="dt in pegawai.data">
              <td>{{ dt.nip }}</td>
              <td>{{ dt.nama }}</td>
              <td>{{ dt.jabatan.nama }}</td>
              <td>{{ dt.upt.nama }}</td>
              <td>{{ dt.wilayah.nama }}</td>
              <td v-if="dt.id_atasan != null">{{ dt.atasan.nama }}</td>
              <td v-else-if="dt.id_atasan == null">-</td>
              <td v-if="dt.status_pegawai == 1">
                <div class="bg-success text-light p-1 rounded">Aktif</div>
              </td>
              <td v-else-if="dt.status_pegawai == 0">
                <div class="bg-danger text-light p-1 rounded">Tidak Aktif</div>
              </td>
              <td>
                <div class="dropdown">
                  <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-eye-fill"></i>
                  </a>

                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" @click.prevent="detailData(dt.id)" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Detail</a>
                    </li>
                    <li>
                      <a class=" dropdown-item" href="#" @click.prevent="editData(dt.id)">Edit</a>
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
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-start">
                <div class="row d-flex justify-content-center pb-2">
                  <div class="col-md-3 border border-primary rounded shadow" style="height:225px">
                    <!-- <img src="" alt=""> -->
                  </div>

                </div>
                <hr>
                <div class="row pt-3">
                  <div class="col-md-3">
                    <b>NIP</b>
                  </div>
                  <div class="col">
                    : {{ detailPegawai.nip }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <b>Nama</b>
                  </div>
                  <div class="col">
                    : {{ detailPegawai.nama }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <b>Tanggal Lahir</b>
                  </div>
                  <div class="col-md-3">
                    : {{ detailPegawai.tgl_lahir }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <b>Pendidikan</b>
                  </div>
                  <div class="col-md-3">
                    : {{ detailPegawai.pendidikan }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <b>Jenis Kelamin</b>
                  </div>
                  <div class="col">
                    : {{ detailPegawai.gender }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <b>Jabatan</b>
                  </div>
                  <div class="col-md-3">
                    : {{ detailPegawai.namaJabatan }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <b>UPT</b>
                  </div>
                  <div class="col-md-3">
                    : {{ detailPegawai.namaUpt }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <b>Wilayah</b>
                  </div>
                  <div class="col">
                    : {{ detailPegawai.namaWilayah }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <b>Atasan</b>
                  </div>
                  <div class="col-md-3">
                    : {{ detailPegawai.namaAtasan }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <b>No Telp</b>
                  </div>
                  <div class="col">
                    : {{ detailPegawai.no_telp }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <b>Alamat</b>
                  </div>
                  <div class="col">
                    : {{ detailPegawai.alamat }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <b>Foto</b>
                  </div>
                  <div class="col">
                    : {{ detailPegawai.foto }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <b>Status</b>
                  </div>
                  <div class="col">
                    : {{ detailPegawai.status_pegawai }}
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>
        <nav v-if="pegawai.total > pegawai.per_page" aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item">
              <button class="page-link" @click.prevent="setUrl(pegawai.first_page_url)">
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
              <button class="page-link" @click.prevent="setUrl(pegawai.last_page_url)">
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
      vselect_gender: [{ val: 'L' }, { val: 'P' }],
      vselect_pendidikan: [{ val: 'SMA' }, { val: 'SMK' }, { val: 'MA' }, { val: 'D1' }, { val: 'D2' }, { val: 'D3' }, { val: 'S1' }, { val: 'S2' }, { val: 'S3' }],
      listJabatan: [],
      listPegawai: [],
      listUPT: [],
      listWilayah: [],
      query: {
        query: null,
        pendidikan: null,
        gender: null,
        jabatan: null,
        upt: null,
        wilayah: null,
      },
      paginate: [],
      pegawai: {},
      detailPegawai: {},
      url: "/api/auth/pegawai?",
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
        this.pegawai = response.data.data;
        this.paginate = response.data.data.links;
      });
      axios.get("/api/auth/pegawai/listjab", config).then((response) => {
        this.listJabatan = response.data;
      });
      axios.get("/api/auth/pegawai/listpeg", config).then((response) => {
        this.listPegawai = response.data;
      });
      axios.get("/api/auth/pegawai/listwil", config).then((response) => {
        this.listWilayah = response.data;
      });
      axios.get("/api/auth/pegawai/listupt", config).then((response) => {
        this.listUPT = response.data;
      });
      // axios.get("/api/auth/pegawai/listatas", config).then((response) => {
      //   this.listAtasan = response.data;
      // });
    },
    searchData() {
      if (this.query.query !== null) {
        this.url = this.url + "&query=" + this.query.query;
      }
      if (this.query.pendidikan !== null) {
        this.url = this.url + "&pendidikan=" + this.query.pendidikan;
      }
      if (this.query.gender !== null) {
        this.url = this.url + "&gender=" + this.query.gender;
      }
      if (this.query.jabatan !== null) {
        this.url = this.url + "&id_jabatan=" + this.query.jabatan;
      }
      if (this.query.upt !== null) {
        this.url = this.url + "&id_upt=" + this.query.upt;
      }
      if (this.query.wilayah !== null) {
        this.url = this.url + "&id_wilayah=" + this.query.wilayah;
      }
      this.getData();
      this.url = "/api/auth/pegawai?";
    },
    setUrl(setter) {
      this.url = setter;
      this.getData();
    },
    editData(id) {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      this.$router.push({
        name: "AksiPegawai",
        params: {
          id,
        },
      });
    },
    detailData(id) {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      axios.get("/api/auth/pegawai/edit/" + id, config).then((response) => {
        this.detailPegawai = response.data.data;
        this.detailPegawai = Object.assign(this.detailPegawai, { namaWilayah: this.detailPegawai.wilayah.nama })
        this.detailPegawai = Object.assign(this.detailPegawai, { namaUpt: this.detailPegawai.upt.nama })
        this.detailPegawai = Object.assign(this.detailPegawai, { namaJabatan: this.detailPegawai.jabatan.nama })
        this.detailPegawai = Object.assign(this.detailPegawai, { namaAtasan: this.detailPegawai.atasan.nama })
      });
    },
    deleteData(id) {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      if (confirm("Apakah Anda Ingin Menghapus Data Tersebut ?")) {
        axios
          .get(`/api/auth/pegawai/delete/` + id, config)
          .then((response) => {
            this.$noty.success(response.data.data.msg.status);
            this.getData();
          });
      } else {
        return false;
      }
    },
  },
};
</script>
