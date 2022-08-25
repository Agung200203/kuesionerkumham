<template>
    <div class="card p-4 shadow mb-5" style="text-align: center">
        <div class="rounded w-25 mt-1 mb-5 ps-3" style="
                margin-left: -50px;
                text-align: left;
                color: white;
                background-color: #317af7;
            ">
            <h3>Profile</h3>
        </div>
        <form @submit.prevent="updateData()">
            <div class="justify-content-center">
                <div class="row mb-5">
                    <div class="col-md-1"></div>
                    <div class="col-md">
                        <nav class="border navbar navbar-light bg-light rounded">
                            <div class="container">
                                <a class="navbar-brand" href="#">
                                    <h4>Data Pegawai</h4>
                                </a>
                            </div>
                        </nav>
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <div class="wr w-100 border rounded" style="height:220px; position: relative;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Mat_Solar.jpg"
                                class="rounded w-100 h-100" alt="..." />
                            <button class="editprofile w-100 h-100 fs-1 text-light" @click.prevent="input()"
                                type="button"><i class="bi bi-camera-fill"></i></button>
                            <input type="file" :disabled="validated == 1" ref="img" style="visibility:hidden;" />
                        </div>
                        <p style="margin-bottom:0px;">Klik gambar untuk ubah Photo</p>
                        <p><b>Upload Pas Photo 4x6 Hitam Putih dengan Background Warna Biru</b></p>
                    </div>
                    <div class="col-md">


                        <!-- form -->
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-3 text-start"><span><b>Nama</b></span></div>
                                    <div class="col input-group input-group-sm">
                                        :&nbsp <input type="text" v-model="profile.nama" :disabled="validated == 1"
                                            class="form-control" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-3 text-start"><span><b>NIP</b></span></div>
                                    <div class="col input-group input-group-sm">
                                        :&nbsp <input type="text" v-model="profile.nip" :disabled="validated == 1"
                                            class="form-control" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-3 text-start"><span><b>Jabatan</b></span></div>
                                    <div class="col input-group input-group-sm">
                                        :&nbsp <input type="text" v-model="profile.id_jabatan"
                                            :disabled="validated == 1" class="form-control"
                                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-3 text-start"><span><b>Nama UPT</b></span></div>
                                    <div class="col input-group input-group-sm">
                                        :&nbsp <input type="text" v-model="profile.id_upt" :disabled="validated == 1"
                                            class="form-control" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-3 text-start"><span><b>Nama Wilayah</b></span></div>
                                    <div class="col input-group input-group-sm">
                                        :&nbsp <input type="text" v-model="profile.id_wilayah"
                                            :disabled="validated == 1" class="form-control"
                                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-3 text-start"><span><b>Tgl Lahir</b></span></div>
                                    <div class="col input-group input-group-sm">
                                        :&nbsp <input type="date" v-model="profile.tgl_lahir" :disabled="validated == 1"
                                            class="form-control" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-3 text-start"><span><b>Pendidikan</b></span></div>
                                    <div class="col input-group input-group-sm">
                                        :&nbsp <input type="text" v-model="profile.pendidikan"
                                            :disabled="validated == 1" class="form-control"
                                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-3 text-start"><span><b>Gender</b></span></div>
                                    <div class="col input-group input-group-sm">
                                        :&nbsp <input type="text" v-model="profile.gender" :disabled="validated == 1"
                                            class="form-control" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-3 text-start"><span><b>Alamat</b></span></div>
                                    <div class="col input-group input-group-sm">
                                        :&nbsp <input type="text" v-model="profile.alamat" :disabled="validated == 1"
                                            class="form-control" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-3 text-start"><span><b>Email</b></span></div>
                                    <div class="col input-group input-group-sm">
                                        :&nbsp <input type="text" v-model="profile.email" :disabled="validated == 1"
                                            class="form-control" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-3 text-start"><span><b>No Telp</b></span></div>
                                    <div class="col input-group input-group-sm">
                                        :&nbsp <input type="text" v-model="profile.no_telp" :disabled="validated == 1"
                                            class="form-control" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-3 text-start"><span><b>Status Pegawai</b></span></div>
                                    <div class="col input-group input-group-sm">
                                        :&nbsp <input type="text" v-model="profile.statusPegawai"
                                            :disabled="validated == 1" class="form-control"
                                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-3 text-start"><span><b>Status User</b></span></div>
                                    <div class="col input-group input-group-sm">
                                        :&nbsp <input type="text" v-model="profile.statusUser"
                                            :disabled="validated == 1" class="form-control"
                                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>

                    </div>
                </div>

            </div>
            <button type="button" @click.prevent="editData()" class="btn btn-primary mt-5">Edit <i
                    class="bi bi-pencil"></i></button>
            <button type="button" @click.prevent="updateData()" class="btn btn-primary mt-5">Simpan <i
                    class="bi bi-pencil-square"></i></button>
        </form>

    </div>
</template>
<script>
export default {
    data() {
        return {
            //
            validated: 1,
            profile: {},
        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            let token = "";
            this.token = localStorage.getItem("JWToken");
            const config = {
                headers: {
                    Authorization: `Bearer ${this.token}`,
                },
            };
            axios.get("http://127.0.0.1:8000/api/auth/user-profile", config).then((response) => {
                this.profile = response.data[0];
                console.log(this.profile);
            });
        },
        updateData() {
            this.$noty.success('Data Berhasil Disimpan');
        },
        editData() {
            this.validated = (this.validated + 1) % 2
        },
        input() {
            this.$refs.img.click()
        },
    }
}
</script>
<style>
.editprofile {
    visibility: hidden;
}

.wr:hover .editprofile {
    width: 100%;
    border-width: 0;
    position: absolute;
    left: 0;
    background-color: Black;
    opacity: 0.5;
    visibility: visible;
}
</style>