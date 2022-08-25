<template>
    <!-- <h1>{{ id_periode }}</h1> -->
    <div class="container-sm mt-3 mb-5 pt-3 pb-3">
        <div class="d-flex justify-content-center">
            <div class="card mt-3 mb-5 w-75 p-5 border-1 shadow">
                <ol class="breadcrumb mb-4 justify-content-center bg-primary rounded text-white ">
                    <h2>Pilih Pegawai</h2>
                </ol>
                <form @submit.prevent="penilaian()">
                    <div class="row mb-3 ">
                        <div class="col-sm-3">
                            <h5>Periode</h5>
                        </div>
                        <div class="col-sm input-group ">
                            <input disabled :value="strPeriode" type="text" class="form-control"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                            <input type="hidden" v-model="masterDt.id_periode" />
                        </div>
                    </div>
                    <div class="row mb-3 ">
                        <div class="col-sm-3">
                            <h5>Pegawai Penilai</h5>
                        </div>
                        <div class="col-sm input-group ">
                            <input disabled :value="strPenilai" type="text" class="form-control"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                            <input type="hidden" v-model="masterDt.id_user_penilai" />
                        </div>
                    </div>
                    <div class="row mb-3 ">
                        <div class="col-sm-3">
                            <h5>Pegawai Dinilai</h5>
                        </div>
                        <div class="col-sm input-group ">
                             <v-select class="w-100" :options="arrayPegawai" label="strDinilai" v-model="masterDt.id_user_pegawai" :reduce="(arrayPegawai) => arrayPegawai.id">
                                <template #search="{ attributes, events }">
                                    <input class="vs__search" :required="!masterDt.id_user_pegawai" v-bind="attributes" v-on="events" />
                                </template>
                            </v-select>
                            <!-- <v-select class="w-100" label="strDinilai" :options="arrayPegawai"
                                v-model="masterDt.id_user_pegawai" placeholder="Pilih Pegawai"
                                :reduce="(arrayPegawai) => arrayPegawai.id"
                                :required="masterDt.id_user_pegawai != null"></v-select> -->
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary"
                            style="justify-content:right; float:right; width: 150px;">
                            <b>Mulai <i class="bi bi-arrow-right"></i></b>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["id"],
    data() {
        return {
            strPeriode: '',
            strPenilai: '',
            masterDt: {
                id_periode: null,
                id_user_penilai: null,
                id_user_pegawai: null,
            },
            arrayPegawai: []
        };
    },
    mounted() {
        this.masterDt.id_periode = this.id;
        this.masterDt.id_user_penilai = parseInt(localStorage.getItem('idPegawai'));
        if (this.id === undefined) {
            this.$router.push({
                name: "PeriodeVocs",
            });
        } else {
            this.getAutocomplete();
            this.getData();
        }

    },
    methods: {
        getAutocomplete() {
            let token = ''
            this.token = localStorage.getItem('JWToken')
            const config = {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }
            axios.get("/api/auth/vocs/dinilai", config)
                .then((response) => {
                    this.arrayPegawai = response.data;
                    for (let i = 0; i < this.arrayPegawai.length; i++) {
                        Object.assign(this.arrayPegawai[i], { strDinilai: this.arrayPegawai[i].nip + ' - ' + this.arrayPegawai[i].nama })
                    }
                    console.log(this.arrayPegawai);
                });
        },
        getData() {
            let token = ''
            this.token = localStorage.getItem('JWToken')
            const config = {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }

            axios.get("/api/auth/periode/penilaian/edit/" + this.id, config)
                .then((response) => {
                    this.strPeriode = (response.data.data.periode % 2 == 1 ? 'ganjil' : 'genap') + ' / ' + response.data.data.tahun;
                    console.log(this.strPeriode);
                });
            this.strPenilai = localStorage.getItem('nip') + ' - ' + localStorage.getItem('name');

        },
        penilaian() {
            this.$router.push({
                name: "PenilaianVocs",
                params: {
                    id_periode: this.masterDt.id_periode,
                    id_user_penilai: this.masterDt.id_user_penilai,
                    id_user_pegawai: this.masterDt.id_user_pegawai,
                },
            });
        }
    }
}
</script>