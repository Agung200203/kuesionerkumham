<template>
    <div class="card p-4 shadow mb-5" style="text-align: center">
        <div
            class="rounded w-25 mt-1 mb-5 ps-3"
            style="
                margin-left: -50px;
                text-align: left;
                color: white;
                background-color: #317af7;
            "
        >
            <h3>Export</h3>
        </div>
        <form @submit.prevent="exportData()">
            <v-select
                multiple
                label="nama"
                :options="ListExport"
                v-model="Export"
                placeholder="Pilih Export"
                :reduce="(ListExport) => ListExport.val"
            ></v-select>
            <div class="d-flex justify-content-start mt-2 btn-toolbar gap-2">
                <button
                    type="submit"
                    class="btn btn-primary"
                    style="width: 150px"
                >
                    Export
                </button>
                <button
                    type="button"
                    class="btn btn-danger font-1"
                    style="width: 150px"
                    v-on:click="back()"
                >
                    BATAL
                </button>
            </div>
            <p v-if="isProses">
                <br />
                <span class="red-text lighten-2"
                    >Proses ini membutuhkan waktu, mohon bersabar</span
                >
            </p>
        </form>
    </div>
</template>
<script>
import { unAuthorize } from '../unauthorized'
export default {
    data: function () {
        return {
            // isLoading: false,
            // isSuccess: false,
            isProses: false,
            url: "/api/download/",
            Export: [],
            data: [],
            ListExport: [
                // { val: 'semua', nama:'-- Semua Data --' },
                { val: "jabatan", nama: "Jabatan" },
                { val: "pegawai", nama: "Pegawai" },
                { val: "upt", nama: "UPT" },
                { val: "users", nama: "Users" },
                { val: "wilayah", nama: "Wilayah" },
                { val: "katvocs", nama: "Kategori VOCs" },
                { val: "katproact", nama: "Kategori ProActs" },
                { val: "katxrole", nama: "Kategori XRoles" },
                { val: "katspeed", nama: "Kategori SpeeDecs" },
                { val: "kuesvocs", nama: "Kuesioner VOCs" },
                { val: "periodepenilaian", nama: "Periode Penilaian VOCs" },
            ],
        };
    },
    methods: {
        exportData() {
            this.isProses = true;
            let loader = this.loading();
            let token = "";
            this.token = localStorage.getItem("JWToken");
            // const config = {
            //     headers: {
            //         Authorization: `Bearer ${this.token}`,
            //         "Access-Control-Allow-Origin": `*`,
            //         "Content-Type": "x-www-form-urlencoded",
            //     },
            // };
            let data = new FormData();
            let text = "";
            for (var i = 0; i < this.Export.length; i++) {
                data.append("data[]", this.Export[i]);
            }
            // console.log(...data);
            axios
                .post(
                    "/api/export/" + this.token + "/",
                    data
                )
                .then((response) => {
                    // console.log(response.data);
                    loader.hide();
                    this.isProses = false;
                    this.$noty.success(response.data.data.msg);
                    window.location = this.url + this.token + "/";
                })
                .catch((e) => {
                    if(e.response.status == 422){
                        this.$noty.error(e.response.data.errors.data[0]);
                        this.isProses = false;
                        loader.hide();
                    }
                    // unAuthorize(e)

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
        back() {
            this.$router.go(-1);
        },
    },
};
</script>
