<template>
    <div class="card">
        <div class="card-header">{{ title }} Data</div>
        <div class="card-body">
            <form @submit.prevent="loadingData()">
                <div class="mb-3">
                    <p class="form-label">Kode Upt *</p>
                    <input class="form-control" v-model="upt.kode" required />
                </div>
                <div class="mb-3">
                    <p class="form-label">Nama Upt *</p>
                    <input class="form-control" v-model="upt.nama" required />
                </div>
                <div class="mb-3">
                    <p class="form-label">Alamat upt *</p>
                    <input class="form-control" v-model="upt.alamat" required />
                </div>
                <div class="mb-3">
                    <p class="form-label">Kepala Kantor upt *</p>
                    <input class="form-control" v-model="upt.kapupt" required />
                </div>
                <div class="mb-3">
                    <p class="form-label">Email *</p>
                    <input class="form-control" v-model="upt.email" required />
                </div>
                <div class="mb-3">
                    <p class="form-label">WIlayah *</p>
                    <v-select label="nama" :options="arrayWilayah" :reduce="(arrayWilayah) => arrayWilayah.id"
                        v-model="upt.id_wil"></v-select>
                </div>
                <div class="mb-3">
                    <p class="form-label">No Telp *</p>
                    <input class="form-control" v-model="upt.no_telp" required />
                </div>
                <div class="mb-3">
                    <p class="form-label">Status upt *</p>
                    <select class="form-select" v-model="upt.status_upt" required>
                        <option :selected="upt.status_upt"></option>
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
            token: '',
            title: "",
            upt: {
                kode: "",
                nama: "",
                alamat: "",
                kapupt: "",
                email: "",
                no_telp: "",
                id_wil: "",
                status_upt: "",
            },
            arrayWilayah: [],
            errors: {},
        };
    },
    mounted() {
        this.getAutocomplete();
        if (this.id !== undefined) {
            this.title = "Edit";
            this.getData();
        } else {
            this.title = "Tambah";
        }
    },
    methods: {
        getAutocomplete() {
            let token = "";
            this.token = localStorage.getItem("JWToken");
            const config = {
                headers: {
                    Authorization: `Bearer ${this.token}`,
                },
            };
            axios.get("/api/auth/wilayah/list", config).then((response) => {
                this.arrayWilayah = response.data;
            });
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
                .get(
                    "/api/auth/upt/edit/" + this.id,
                    config
                )
                .then((response) => {
                    this.upt = {
                        kode: response.data.data.kode,
                        nama: response.data.data.nama,
                        alamat: response.data.data.alamat,
                        kapupt: response.data.data.kapupt,
                        email: response.data.data.email,
                        no_telp: response.data.data.no_telp,
                        id_wil: response.data.data.id_wil,
                        status_upt: response.data.data.status_upt,
                    };
                });
            this.getAutocomplete();
        },
        updateData() {
            let token = "";
            this.token = localStorage.getItem("JWToken");
            const config = {
                headers: {
                    Authorization: `Bearer ${this.token}`,
                },
            };
            if (typeof (this.upt.id_wil) === 'string') {
                var idJab = this.upt.id_wil
                var result = this.arrayJabatan.find(function (e) { return e.nama == idJab });
                this.upt.id_wil = result.id;
            };
            axios
                .post(
                    "/api/auth/upt/update/" + this.id,
                    this.upt,
                    config
                )
                .then((response) => {
                    console.log(response)
                    this.$router.push({
                        name: "TabelUpt",
                    });
                })
                .catch((error) => {
                    console.log(error);
                    if (error.response.data.data == 403) {
                        this.errors = error.response.data.message;
                    }
                });
        },
        storeData() {
            let token = "";
            this.token = localStorage.getItem("JWToken");
            const config = {
                headers: {
                    Authorization: `Bearer ${this.token}`,
                },
            };
            axios
                .post("/api/auth/upt/store", this.upt, config).then((response) => {
                    // console.log(response);
                    this.$router.push({
                        name: "TabelUpt",
                    });
                })
                .catch((error) => {
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