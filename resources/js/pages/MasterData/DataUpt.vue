<template>
    <div class="card p-4 shadow mb-5" style="text-align: center">
        <div class="rounded w-25 mt-1 mb-5 ps-3" style="
                margin-left: -50px;
                text-align: left;
                color: white;
                background-color: #317af7;
            ">
            <h3>UPT</h3>
        </div>
        <form @submit.prevent="searchData()">
            <div class="row">
                <div class="col-sm">
                    <v-select placeholder="Pilih Upt" label="nama" :options="arrayUpt"
                        :reduce="(arrayUpt) => arrayUpt.nama" v-model="query.namaUpt"></v-select>
                </div>
                <div class="col-sm">
                    <v-select placeholder="Pilih Wilayah" label="nama" :options="arrayWilayah"
                        :reduce="(arrayWilayah) => arrayWilayah.id" v-model="query.idWilayah"></v-select>
                </div>
            </div>
            <div class="d-flex justify-content-start mt-2">
                <button type="submit" class="btn btn-primary btn-sm" style="width: 100px">
                    Cari
                </button>
            </div>
        </form>
        <div class="row justify-content-end">
            <div class="mb-1 d-flex justify-content-end" style="width: 310px">
                <div>
                    <router-link class="btn btn-success rounded" v-bind:to="{ name: 'AksiUpt' }">Tambah Data <i
                            class="bi bi-file-earmark-plus"></i></router-link>
                    <!-- <b-button v-b-modal.modal-1  variant="success">Tambah Data <i class="bi bi-file-earmark-plus"></i></b-button>

                <b-modal id="modal-1" title="BootstrapVue">
                <p class="my-4">Hello from modal!</p>
                </b-modal> -->
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="scrol">
                    <thead style="background-color: #317af7; color: white">
                        <tr>
                            <!-- <td class="text-center">NO</td> -->
                            <td class="text-center">KODE</td>
                            <td class="text-center">NAMA</td>
                            <td class="text-center">ALAMAT</td>
                            <td class="text-center">KEPALA UPT</td>
                            <!-- <td class="text-center">EMAIL</td> -->
                            <!-- <td class="text-center">NO TELP</td> -->
                            <!-- <td class="text-center">ID WIL</td> -->
                            <td class="text-center" style="width:150px;">STATUS UPT</td>
                            <td class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(dt, index) in upt.data">
                            <!-- <td>{{ index+1 }}</td> -->
                            <td>{{ dt.kode }}</td>
                            <td>{{ dt.nama }}</td>
                            <td>{{ dt.alamat }}</td>
                            <td>{{ dt.kapupt }}</td>
                            <!-- <td>{{ dt.email }}</td> -->
                            <!-- <td>{{ dt.no_telp }}</td> -->
                            <!-- <td>{{ dt.id_wil }}</td> -->
                            <td v-if="dt.status_upt == 1">
                                <div class="bg-success text-light  rounded">Aktif</div>
                            </td>
                            <td v-else-if="dt.status_upt == 0">
                                <div class="bg-danger text-light rounded">Tidak Aktif</div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-light dropdown-toggle" href="#" role="button"
                                        id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" @click.prevent="detailData(dt.id)"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Detail</a>
                                        </li>
                                        <li>
                                            <a class=" dropdown-item" href="#" @click.prevent="editData(dt.id)">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                @click.prevent="deleteData(dt.id)">Hapus</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header card-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Kode upt</b></div>
                                    <div class="col-md text-start">
                                        : {{ detailUpt.kode }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Nama upt</b></div>
                                    <div class="col-md text-start">
                                        : {{ detailUpt.nama }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Alamat upt</b></div>
                                    <div class="col-md text-start">
                                        : {{ detailUpt.alamat }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Kepala Kantor upt</b></div>
                                    <div class="col-md text-start">
                                        : {{ detailUpt.kapupt }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Email </b></div>
                                    <div class="col-md text-start">
                                        : {{ detailUpt.email }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Wilayah </b></div>
                                    <div class="col-md text-start">
                                        : {{ detailUpt.namaWilayah }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>No Telp </b></div>
                                    <div class="col-md text-start">
                                        : {{ detailUpt.no_telp }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Alamat upt</b></div>
                                    <div class="col-md text-start">
                                        : {{ detailUpt.alamat }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Status Jabatan</b></div>
                                    <div class="col-md text-start" v-text="': ' + (detailUpt.status_upt == 1 ? 'Aktif' : 'Tidak Aktif')
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

                <nav class="d-flex justify-content-center pt-3" v-if="upt.total > upt.per_page"
                    aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <button class="page-link" @click.prevent="setUrl(upt.first_page_url)">
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
                            <button class="page-link bg-primary text-light"
                                v-else-if="pagin.url && pagin.active == true" @click.prevent="setUrl(pagin.url)">
                                {{ pagin.label }}
                            </button>
                            <button class="page-link " v-else-if="pagin.url && pagin.active == false"
                                @click.prevent="setUrl(pagin.url)">
                                {{ pagin.label }}
                            </button>
                        </li>
                        <li class="page-item">
                            <button class="page-link" @click.prevent="setUrl(upt.last_page_url)">
                                <i class="bi bi-chevron-double-right"></i>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>
<style>
</style>
<script>
export default {
    data() {
        return {
            token: '',
            query: {
                namaUpt: null,
                idWilayah: null
            },
            paginate: [],
            upt: {},
            arrayWilayah: [],
            arrayUpt: [],
            detailUpt: {},
            url: "/api/auth/upt?",
        };
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            let token = ''
            this.token = localStorage.getItem('JWToken')
            const config = {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }
            axios.get(this.url, config).then((response) => {
                this.upt = response.data.data;
                this.paginate = response.data.data.links;
            });
            axios.get("/api/auth/upt/list", config).then((response) => {
                this.arrayUpt = response.data;
            });
            axios.get("/api/auth/wilayah/list", config).then((response) => {
                this.arrayWilayah = response.data;
            });
        },
        setUrl(setter) {
            this.url = setter;
            this.getData();
        },
        editData(id) {
            this.$router.push({
                name: "AksiUpt",
                params: {
                    id
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
            axios.get("/api/auth/upt/edit/" + id, config).then((response) => {
                this.detailUpt = response.data.data;
                this.detailUpt = Object.assign(this.detailUpt, { namaWilayah: this.detailUpt.wilayah.nama })
            });
        },
        deleteData(id) {
            let token = ''
            this.token = localStorage.getItem('JWToken')
            const config = {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }
            if (confirm("Apakah Anda Ingin Menghapus Data Tersebut ?")) {
                axios.get(`/api/auth/upt/delete/` + id, config).then((response) => {
                    this.$noty.success(response.data.data.msg.status);
                    this.getData();
                });
            }
            else {
                return false;
            }
        },
        searchData() {
            if (this.query.namaUpt !== null) {
                this.url = this.url + "&query=" + this.query.namaUpt;
            }
            if (this.query.idWilayah !== null) {
                this.url = this.url + "&id_wil=" + this.query.idWilayah;
            }
            this.getData();
            this.url = "/api/auth/upt?";
        },
    },
};
</script>
