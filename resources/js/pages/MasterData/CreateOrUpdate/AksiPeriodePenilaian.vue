<template>
    <div class="card">
        <div class="card-header">{{ title }} Data</div>
        <div class="card-body">
            <form @submit.prevent="loadingData()">
                <div class="mb-3">
                    <p class="form-label">Bulan *</p>
                    <v-select label="key" :options="arrayBulan" :reduce="(arrayBulan) => arrayBulan.val"
                        v-model="periode.bulan"></v-select>
                </div>
                <div class="mb-3">
                    <p class="form-label">Tahun *</p>
                    <v-select label="val" :options="arrayTahun" :reduce="(arrayTahun) => arrayTahun.val"
                        v-model="periode.tahun"></v-select>
                    <!-- <input type="year" class="form-control" v-model="periode.tahun" required/> -->
                </div>
                <div class="mb-3">
                    <p class="form-label">Periode *</p>
                    <v-select label="key" :options="arrayPeriode" :reduce="(arrayPeriode) => arrayPeriode.val"
                        v-model="periode.periode"></v-select>
                </div>
                <div class="mb-3">
                    <p class="form-label">Terbit *</p>
                    <input type="date" class="form-control" v-model="periode.waktu_terbit" required />
                </div>
                <div class="mb-3">
                    <p class="form-label">Tutup *</p>
                    <input type="date" class="form-control" v-model="periode.waktu_penutupan" required />
                </div>
                <div class="mb-3">
                    <p class="form-label">Status *</p>
                    <select class="form-select" v-model="periode.status" required>
                        <option :selected="periode.status"></option>
                        <option :value="1">Aktif</option>
                        <option :value="0">Tidak Aktif</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    props: ["id"],
    data() {
        return {
            title: "",
            arrayBulan: [
                { key: 'Januari', val: 1 }, { key: 'Februari', val: 2 }, { key: 'Maret', val: 3 }, { key: 'April', val: 4 }, { key: 'Mei', val: 5 },
                { key: 'juni', val: 6 }, { key: 'Juli', val: 7 }, { key: 'Agustus', val: 8 }, { key: 'September', val: 9 }, { key: 'Oktober', val: 10 },
                { key: 'November', val: 11 }, { key: 'Desember', val: 12 },],
            arrayTahun: [],
            arrayPeriode: [{ key: 'Ganjil', val: 1 }, { key: 'Genap', val: 2 }],
            periode: {
                bulan: "",
                tahun: "",
                periode: "",
                waktu_terbit: "",
                waktu_penutupan: "",
                status: "",
            },
            errors: {},
        };
    },
    mounted() {
        this.getAutoComplete();
        if (this.id !== undefined) {
            this.title = "Edit";
            this.getData();
        } else {
            this.title = "Tambah";

        }
    },
    methods: {
        getAutoComplete() {
            const d = new Date();
            var result = d.getFullYear() - 10;
            for (let i = 0; i < 20; i++) {
                this.arrayTahun.push({ val: result });
                result++;
            };
        },
        getData() {
            let token = "";
            this.token = localStorage.getItem("JWToken");
            const config = {
                headers: {
                    Authorization: `Bearer ${this.token}`,
                },
            };
            axios
                .get("/api/auth/periode/penilaian/edit/" + this.id, config)
                .then((response) => {
                    this.periode = {
                        bulan: response.data.data.bulan,
                        tahun: response.data.data.tahun,
                        periode: response.data.data.periode,
                        waktu_terbit: response.data.data.waktu_terbit,
                        waktu_penutupan: response.data.data.waktu_penutupan,
                        status: response.data.data.status,
                    };
                });
        },
        updateData() {
            let token = ''
            this.token = localStorage.getItem('JWToken')
            const config = {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                },
            }
            axios.post('/api/auth/periode/penilaian/update/'+ this.id , this.periode,  config).then((response) => {
                this.$router.push({
                name : 'TabelPeriode'
                })
            }).catch((error)=>{
                this.errors = error.response.data.message
                // if(response.data.data == 403){
                // this.errors = error.response.data.message
                // }
            })
        },
        storeData() {
            let token = ''
            this.token = localStorage.getItem('JWToken')
            const config = {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                },
            }
            axios.post("/api/auth/periode/penilaian/store", this.periode, config).then((response) => {
                this.$router.push({
                    name: "TabelPeriode",
                });
            }).catch((error) => {
                if (error.response.status == 403) {
                    this.errors = error.response.data.message;
                }
            });
        },
        loadingData() {
            if (this.id !== undefined) {
                this.updateData();
            } else {
                this.storeData();
            }
        },

    },
};
</script>
