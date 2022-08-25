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
        <div class="row justify-content-end">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="scrol">
                    <thead style="background-color: #317af7; color: white">
                        <tr>
                            <td class="text-center">Bulan</td>
                            <td class="text-center">TAHUN</td>
                            <td class="text-center">PERIODE</td>
                            <td class="text-center">TERBIT</td>
                            <td class="text-center">TUTUP</td>
                            <td class="text-center">STATUS PERIODE</td>
                        </tr>
                    </thead>
                    <tbody>
                         <tr v-if="isProses">
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    <div class="spinner-border mr-3" role="status" aria-hidden="true"></div>
                                    <strong> Loading...</strong>
                                </div>
                            </td>
                        </tr>
                        <tr v-for="(dt, index) in periode.data">
                            <!-- <td>{{ index+1 }}</td> -->
                            <td>{{ dt.bulan }}</td>
                            <td>{{ dt.tahun }}</td>
                            <td>{{ dt.periode }}</td>
                            <td>{{ dt.waktu_terbit }}</td>
                            <td>{{ dt.waktu_penutupan }}</td>
                            <td v-if="dt.status == 1">
                                <!-- <div class="bg-success text-light p-1 rounded">Aktif</div> -->
                                <a  class="btn btn-success text-light p-1 rounded w-50" style=" font-weight: normal;" @click.prevent="nilai(dt.id)">
                                    Nilai
                                </a>
                            </td>
                            <td v-else-if="dt.status == 0">
                                <a  class="btn btn-danger text-light p-1 rounded w-50" style=" font-weight: normal;" @click.prevent="lihat(dt.id)">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>

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
            paginate: [],
            periode: {},
            url: "/api/auth/periode/penilaian?",
            isProses: false,
        };
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            this.isProses = true;
            let loader = this.loading();
            let token = ''
            this.token = localStorage.getItem('JWToken')
            const config = {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }
            axios.get(this.url, config).then((response) => {
                loader.hide();
                this.isProses = false;
                this.periode = response.data.data;
                this.paginate = response.data.data.links;
            });
        },
        setUrl(setter) {
            this.url = setter;
            this.getData();
        },
        nilai(id) {
            this.$router.push({
                name: "PegawaiVocs",
                params: {
                    id
                },
            });
        },
          loading() {
            let loader = this.$loading.show({
                // Optional parameters
                container: this.$refs.formContainer,
                canCancel: false,
                onCancel: this.onCancel,
            });
            return loader;
        },
    },
};
</script>