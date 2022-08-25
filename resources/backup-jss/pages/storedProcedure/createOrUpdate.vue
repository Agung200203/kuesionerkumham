<template>
    <div>
        <div v-if="id">
            <form @submit.prevent="handleUpdate()">
                <b-card-group deck>
                    <b-card header>
                        <template #header>
                            <h3 class="mb-0">Edit Data</h3>
                        </template>
                        <b-card-text
                            ><b-container fluid="sm">
                                <b-row>
                                    <b-col>Nama * </b-col>
                                </b-row>
                                <b-row class="pt-2">
                                    <b-col>
                                        <input
                                            class="form-control"
                                            v-model="results.nama"
                                            type="text"
                                            placeholder=""
                                            aria-label="default input example"
                                        />
                                    </b-col>
                                   
                                </b-row>
                                <b-row class="pt-2">
                                    <b-col>NBI *</b-col>
                                </b-row>
                                <b-row class="pt-2">
                                    <b-col
                                        ><input
                                            class="form-control"
                                            v-model="results.nbi"
                                            type="text"
                                            placeholder=""
                                            aria-label="default input example"
                                        />
                                    </b-col>
                                    
                                </b-row>
                                <div class="pt-2">
                                    <button type="submit" class="button" style="background-color:blue;">
                                        Simpan
                                    </button>
                                </div>
                            </b-container></b-card-text
                        >
                    </b-card>
                </b-card-group>
            </form>
        </div>
        <div v-else>
            <form @submit.prevent="handleCreateData()">
                <b-card-group deck>
                    <b-card header>
                        <template #header>
                            <h3 class="mb-0">Tambah Data</h3>
                        </template>
                        <b-card-text
                            ><b-container fluid="sm">
                                <b-row>
                                    <b-col>Nama * </b-col>
                                </b-row>
                                <b-row class="pt-2">
                                    <b-col>
                                        <input
                                            class="form-control"
                                            v-model="results.nama"
                                            type="text"
                                            placeholder=""
                                            aria-label="default input example"
                                        />
                                    </b-col>
                                   
                                </b-row>
                                <b-row class="pt-2">
                                    <b-col>NBI *</b-col>
                                </b-row>
                                <b-row class="pt-2">
                                    <b-col
                                        ><input
                                            class="form-control"
                                            v-model="results.nbi"
                                            type="text"
                                            placeholder=""
                                            aria-label="default input example"
                                        />
                                    </b-col>
                                    
                                </b-row>
                                <div class="pt-2">
                                    <button type="submit" class="button" style="background-color:blue;">
                                        Simpan
                                    </button>
                                </div>
                            </b-container></b-card-text
                        >
                    </b-card>
                </b-card-group>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    props: ["id"],
    data() {
        return {
            results:{
                id:0,
                nama:"",
                nbi:"",
            }
        };
    },
    mounted() {
        this.getDataById();
    },
    methods: {
        getDataById() {
            axios
                .get("/api/coba", {
                    params: {
                        operation: 0,
                        id: this.id,
                        nama: null,
                        nbi: null,
                    },
                })
                .then((response) => {                 
                    this.results.id = response.data[0].id;
                    this.results.nama = response.data[0].nama;
                    this.results.nbi = response.data[0].nbi;
                });
        },
        handleUpdate(){
            axios
                .get("/api/coba", {
                    params: {
                        operation: 3,
                        id: this.id,
                        nama: this.results.nama,
                        nbi: this.results.nbi,
                    },
                })
                .then((response) => {                 
                    this.$noty.success(response.data[0].message);
                        this.$router.push({
                            name: "dataTampil",
                        });
                });
        },
        handleCreateData(){
            axios
                .get("/api/coba", {
                    params: {
                        operation: 2,
                        id: null,
                        nama: this.results.nama,
                        nbi: this.results.nbi,
                    },
                })
                .then((response) => {                 
                    this.$noty.success(response.data[0].message);
                        this.$router.push({
                            name: "dataTampil",
                        });
                });
        }
    },
};
</script>
