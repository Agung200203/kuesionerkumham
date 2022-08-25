<template>
    <div class="card p-4 shadow mb-5" style="text-align: center">
        <div class="rounded w-25 mt-1 mb-5 ps-3" style="
                margin-left: -50px;
                text-align: left;
                color: white;
                background-color: #317af7;
            ">
            <h3>Tabel kuesioner</h3>
        </div>
        <form @submit.prevent="searchData()">
            <div class="row ">
                <div class="col">
                    <v-select label="namkuesproacts" :options="arrayKuesioner" v-model="query.query"
                        placeholder="Pilih Kuesioner" :reduce="(arrayKuesioner) => arrayKuesioner.namkuesproacts">
                    </v-select>
                </div>

                <div class="col">
                    <v-select label="namkat_proact" :options="arrayKategori" v-model="query.id_katproact"
                        placeholder="Pilih Kategori" :reduce="(arrayKategori) => arrayKategori.id"></v-select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <v-select label="val" :options="arrayBobot" v-model="query.bobot" placeholder="Pilih bobot"
                        :reduce="(arrayBobot) => arrayBobot.val"></v-select>
                </div>

                <div class="col">
                    <v-select label="key" :options="arrayKpd_role" v-model="query.kpd_role"
                        placeholder="Pilih tujuan kuesioner" :reduce="(arrayKpd_role) => arrayKpd_role.val"></v-select>
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
                    <router-link class="btn btn-success rounded" v-bind:to="{ name: 'AksiKuesionerProact' }">Tambah Data <i
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
                        <tr class="justify-content-end">
                            <!-- <td class="text-center">NO</td> -->
                            <td class="text-center">KUESIONER</td>
                            <td class="text-center">BOBOT</td>
                            <td class="text-center " style="width:200px">TUJUAN</td>
                            <td class="text-center " style="width:200px">STATUS KUESIONER</td>
                            <td class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(dt, index) in kuesioner.data">
                            <!-- <td>{{ index+1 }}</td> -->
                            <td>{{ dt.namkuesproacts }}</td>
                            <td>{{ dt.bobot }}</td>
                            <td v-if="dt.kpd_role == 1">Atasan</td>
                            <td v-else-if="dt.kpd_role == 2">Sejawat</td>
                            <td v-else-if="dt.kpd_role == 3">Bawahan</td>
                            <td v-else-if="dt.kpd_role == 4">Diri Sendiri</td>
                            <td v-if="dt.status_kuesioner == 1">
                                <div class="d-flex justify-content-center ">
                                    <div class="bg-success text-light p-1 rounded w-75">Aktif</div>
                                </div>
                            </td>
                            <td v-else-if="dt.status_kuesioner == 0">
                                <div class="d-flex justify-content-center ">
                                    <div class="bg-danger text-light p-1 rounded w-75">Tidak Aktif</div>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-light dropdown-toggle" href="#" role="button"
                                        id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" @click.prevent="detailData(dt.id)"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"> Detail</a></li>
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
                                    <div class="col-md-3 text-start"><b>Kategori</b></div>
                                    <div class="col-md text-start">
                                        : {{ detailKuesioner.namkat_proacts }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Kuesioner</b></div>
                                    <div class="col-md text-start">
                                        : {{ detailKuesioner.namkuesproacts }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Bobot</b></div>
                                    <div class="col-md text-start">
                                        : {{ detailKuesioner.bobot }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Tujuan Kuesioner</b></div>
                                    <div class="col-md text-start">
                                        : {{ detailKuesioner.kpd_role }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Status Jabatan</b></div>
                                    <div class="col-md text-start">
                                        : {{ detailKuesioner.status_kuesioner }}
                                    </div>
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
                <nav class="d-flex justify-content-center pt-3" v-if="kuesioner.total > kuesioner.per_page"
                    aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <button class="page-link" @click.prevent="setUrl(kuesioner.first_page_url)">
                                <i class="bi bi-chevron-double-left"></i>
                            </button>
                        </li>

                        <li class="page-item" v-for="pagin in paginate">
                            <button class="page-link" v-if="pagin.url && pagin.label === '&laquo; Previous'"
                                @click.prevent="setUrl(pagin.url)">
                                Previous
                            </button>
                            <button class="page-link" v-else-if="
                            pagin.url && pagin.label === 'Next &raquo;'" @click.prevent="setUrl(pagin.url)">
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
                            <button class="page-link" @click.prevent="setUrl(kuesioner.last_page_url)">
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
            query: {
                query: null,
                id_katproact: null,
                bobot: null,
                kpd_role: null,
            },
            kuesioner:{},
            arrayKategori: [],
            arrayKuesioner: [],
            arrayBobot: [{ val: 1 }, { val: 2 }, { val: 3 }, { val: 4 }, { val: 5 }],
            arrayKpd_role: [{ key: 'Atasan', val: 1 }, { key: 'Sejawat', val: 2 }, { key: 'Bawahan', val: 3 }, { key: 'Diri Sendiri', val: 4 }],
            paginate: [],
            detailKuesioner: {},
            url: "/api/auth/kues/proact?",
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
                this.kuesioner = response.data.data;
                this.paginate = response.data.data.links;
                console.log(this.kuesioner);
            });
            axios.get("/api/auth/kues/proact/list/kategori", config).then((response) => {
                this.arrayKategori = response.data;
            });
            axios.get("/api/auth/kues/proact/list/kuesioner", config).then((response) => {
                this.arrayKuesioner = response.data;
            });
        },
        setUrl(setter) {
            this.url = setter;
            this.getData();
        },
        editData(id) {
            this.$router.push({
                name: "AksiKuesionerProact",
                params: {
                    id
                },
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
                axios.get(`/api/auth/kues/proact/delete/` + id, config).then((response) => {
                    this.$noty.success(response.data.data.msg.status);
                    this.getData();
                });
            }
            else {
                return false;
            }
        },
        searchData() {
            if (this.query.query !== null) {
                this.url = this.url + "&query=" + this.query.query;
            }
            if (this.query.id_katproact !== null) {
                this.url = this.url + "&id_katproact=" + this.query.id_katproact;
            }
            if (this.query.bobot !== null) {
                this.url = this.url + "&bobot=" + this.query.bobot;
            }
            if (this.query.kpd_role !== null) {
                this.url = this.url + "&kpd_role=" + this.query.kpd_role;
            }
            // console.log(this.url);
            this.getData();
            this.url = "/api/auth/kues/proact?";    
        },
        detailData(id) {
            let token = "";
            this.token = localStorage.getItem("JWToken");
            const config = {
                headers: {
                    Authorization: `Bearer ${this.token}`,
                },
            };
            axios.get("/api/auth/kues/proact/edit/" + id, config).then((response) => {
                this.detailKuesioner = response.data.data;
                this.detailKuesioner = Object.assign(this.detailKuesioner, { namkat_proact: this.detailKuesioner.kategori.namkat_proact });
                switch (this.detailKuesioner.kpd_role) {
                    case 1:
                        this.detailKuesioner.kpd_role = 'Atasan';
                        break;
                    case 2:
                        this.detailKuesioner.kpd_role = 'Sejawat';
                        break;
                    case 3:
                        this.detailKuesioner.kpd_role = 'Bawahan';
                        break;
                    case 4:
                        this.detailKuesioner.kpd_role = 'Diri Sendiri';
                        break;
                }
                switch (this.detailKuesioner.status_kuesioner) {
                    case 0:
                        this.detailKuesioner.status_kuesioner = 'Tidak Aktif';
                        break;
                    case 1:
                        this.detailKuesioner.status_kuesioner = 'Aktif';
                        break;
                }
                console.log(this.detailKuesioner);
            });
        },
    },
};
</script>
}
</script>
