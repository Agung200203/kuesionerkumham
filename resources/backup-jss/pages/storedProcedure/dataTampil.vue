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
            <h3>Tabel Coba-Coba</h3>
        </div>
        <div class="row">
            <div class="col-sm-1 text-start" for="nama">
                <p><b>Nama</b></p>
            </div>
            <div class="col-sm-4">
                <input
                    class="form-control form-control-sm"
                    id="nama"
                    type="text"
                    placeholder="Nama..."
                    aria-label=".form-control-sm example"
                />
                <div class="d-flex justify-content-start mt-2">
                    <button
                        type="button"
                        class="btn btn-primary btn-sm"
                        style="width: 100px"
                    >
                        Cari
                    </button>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="mb-1 d-flex justify-content-end" style="width: 310px">
                <div>
                    <router-link
                        type="button"
                        class="btn btn-success"
                        v-bind:to="{ name: 'editDataTampil' }"
                        style="border-radius: 0px"
                        >Tambah Data <i class="bi bi-file-earmark-plus"></i
                    ></router-link>

                    <b-modal id="modal-1" title="BootstrapVue">
                        <p class="my-4">Hello from modal!</p>
                    </b-modal>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="scrol">
                    <thead style="background-color: #317af7; color: white">
                        <tr>
                            <td class="text-center">NO</td>
                            <td class="text-center">Nama</td>
                            <td class="text-center">NBI</td>
                            <td class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(dt, index) in results">
                            <td>{{ index + 1 }}</td>
                            <td>{{ dt.nama }}</td>
                            <td>{{ dt.nbi }}</td>
                            <td>
                                <b-dropdown
                                    id="dropdown-right"
                                    right
                                    text="Aksi"
                                    variant="success"
                                    class="m-2"
                                    size="sm"
                                >
                                    <b-dropdown-item href="#"
                                        >Detail</b-dropdown-item
                                    >

                                    <b-dropdown-item
                                        @click.prevent="editData(dt.id)"
                                        >Edit</b-dropdown-item
                                    >

                                    <b-dropdown-item
                                        @click.prevent="deleteData(dt.id)"
                                        >Hapus</b-dropdown-item
                                    >
                                </b-dropdown>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            results: [],
        };
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            axios
                .get("/api/coba", {
                    params: {
                        operation: 1,
                        id: null,
                        nama: null,
                        nbi: null,
                    },
                })
                .then((response) => {
                    // console.log(response.data);
                    this.results = response.data;
                    // console.log(results);
                });
        },
        deleteData(_id) {
            if (confirm("Apakah Anda Ingin Menghapus Data Tersebut ?")) {
                axios
                    .get("/api/coba", {
                        params: {
                            operation: 4,
                            id: _id,
                            nama: null,
                            nbi: null,
                        },
                    })
                    .then((response) => {
                        // console.log(response.data[0].message);
                        this.$noty.success(response.data[0].message);
                        this.$router.push({
                            name: "dataTampil",
                        });
                        this.getData();
                    });
            }
        },
        editData(id) {
            // this.$router.push('/user/' + nama.toLowerCase())
            this.$router.push({
                name: "editDataTampil",
                params: { id },
            });
        },
    },
};
</script>
