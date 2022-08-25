<template>
    <div class="card p-4 shadow mb-5" style="text-align: center">
        <div class="rounded w-25 mt-1 mb-5 ps-3" style="
                margin-left: -50px;
                text-align: left;
                color: white;
                background-color: #317af7;
            ">
            <h3>Periode Penilaian</h3>
        </div>
        <form @submit.prevent="searchData()">
            <div class="row">
                <div class="col">
                    <v-select placeholder="Pilih Bulan" label="bulan" :options="arrayPeriode"
                        :reduce="(arrayPeriode) => arrayPeriode.bulan" v-model="query.bulan"></v-select>
                    <div class="d-flex justify-content-start mt-2">
                    </div>
                </div>
                <div class="col">
                    <v-select placeholder="Pilih Tahun" label="tahun" :options="arrayPeriode"
                        :reduce="(arrayPeriode) => arrayPeriode.tahun" v-model="query.tahun"></v-select>
                    <div class="d-flex justify-content-start mt-2">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <v-select placeholder="Pilih Periode" label="periode" :options="arrayPeriode"
                        :reduce="(arrayPeriode) => arrayPeriode.periode" v-model="query.periode"></v-select>
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
                    <router-link class="btn btn-success rounded" v-bind:to="{ name: 'AksiPeriodePenilaian' }">Tambah
                        Data <i class="bi bi-file-earmark-plus"></i></router-link>
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
                            <td class="text-center">Bulan</td>
                            <td class="text-center">TAHUN</td>
                            <td class="text-center">PERIODE</td>
                            <td class="text-center">TERBIT</td>
                            <td class="text-center">TUTUP</td>
                            <td class="text-center">STATUS PERIODE</td>
                            <td class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(dt, index) in periode.data">
                            <!-- <td>{{ index+1 }}</td> -->
                            <td>{{ dt.bulan }}</td>
                            <td>{{ dt.tahun }}</td>
                            <td>{{ dt.periode }}</td>
                            <td>{{ dt.waktu_terbit }}</td>
                            <td>{{ dt.waktu_penutupan }}</td>
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
                                        <li><a class="dropdown-item" @click.prevent="detailData(dt.id)"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Detail</a></li>
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
                                    <div class="col-md-3 text-start"><b>Bulan</b></div>
                                    <div class="col-md text-start">
                                        : {{ detailPeriode.bulan }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Tahun</b></div>
                                    <div class="col-md text-start">
                                        : {{ detailPeriode.tahun }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Periode</b></div>
                                    <div class="col-md text-start">
                                        : {{ detailPeriode.periode }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Terbit </b></div>
                                    <div class="col-md text-start">
                                        : {{ detailPeriode.waktu_terbit }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Tutup </b></div>
                                    <div class="col-md text-start">
                                        : {{ detailPeriode.waktu_penutupan }}
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-3 text-start"><b>Status </b></div>
                                    <div class="col-md text-start" v-text="': ' + (detailPeriode.status == 1 ? 'Aktif' : 'Tidak Aktif')
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

                <nav class="d-flex justify-content-center pt-3" v-if="periode.total > periode.per_page"
                    aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <button class="page-link" @click.prevent="setUrl(periode.first_page_url)">
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
                            <button class="page-link" @click.prevent="setUrl(periode.last_page_url)">
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
                bulan: null,
                tahun: null,
                periode: null
            },
            paginate: [],
            periode: {},
            arrayPeriode: [],
            detailPeriode: {},
            url: "/api/auth/periode/penilaian?",
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
                this.periode = response.data.data;
                this.paginate = response.data.data.links;
            });
            axios.get("/api/auth/periode/penilaian/list", config).then((response) => {
                this.arrayPeriode = response.data;
            });
        },
        setUrl(setter) {
            this.url = setter;
            this.getData();
        },
        searchData() {
            if (this.query.bulan !== null) {
                this.url = this.url + "&bulan=" + this.query.bulan;
            }
            if (this.query.tahun !== null) {
                this.url = this.url + "&tahun=" + this.query.tahun;
            }
            if (this.query.periode !== null) {
                this.url = this.url + "&periode=" + this.query.periode;
            }
            console.log(this.url);
            this.getData(); z
            this.url = "/api/auth/periode/penilaian?";
        },
        editData(id) {
            this.$router.push({
                name: "AksiPeriodePenilaian",
                params: {
                    id
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
            axios.get("/api/auth/periode/penilaian/edit/" + id, config).then((response) => {
                this.detailPeriode = response.data.data;
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
                axios.get(`/api/auth/periode/penilaian/delete/` + id, config).then((response) => {
                    this.getData();
                    this.$noty.success(response.data.data.msg.status);
                });
            }
            else {
                return false;
            }
        },
    },
};
</script>
}
</script>
