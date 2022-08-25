<template>
    <div class="card p-4 shadow mb-5 border-1" style="text-align: center; border-color:#919090">
        <div
            class="rounded w-25 mt-1 mb-5 ps-3"
            style="
                margin-left: -50px;
                text-align: left;
                color: white;
                background-color: #317af7;
            "
        >
            <h3>Tabel Pegawai</h3>
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
            <div
                class="mb-1 d-flex justify-content-end"
                style="width: 310px"
            >
            <div>
                <b-button v-b-modal.modal-1  variant="success">Tambah Data <i class="bi bi-file-earmark-plus"></i></b-button>

                <b-modal id="modal-1" title="BootstrapVue">
                <p class="my-4">Hello from modal!</p>
                </b-modal>
            </div>
        </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="scrol">
                    <thead style="background-color: #317af7; color: white">
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">2</td>
                            <td class="text-center">3</td>
                            <td class="text-center">4</td>
                            <td class="text-center">5</td>
                            <td class="text-center">6</td>
                            <td class="text-center">7</td>
                            <td class="text-center">8</td>
                            <td class="text-center">9</td>
                            <td class="text-center">10</td>
                            <td class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>satu</td>
                            <td>dua</td>
                            <td>tiga</td>
                            <td>empat</td>
                            <td>lima</td>
                            <td>enam</td>
                            <td>tujuh</td>
                            <td>delapan</td>
                            <td>sembilan</td>
                            <td>sepuluh</td>
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
                                    <b-dropdown-item href="#"
                                        >Edit</b-dropdown-item
                                    >
                                    <b-dropdown-item href="#"
                                        >Hapus</b-dropdown-item
                                    >
                                </b-dropdown>
                            </td>
                        </tr>
                        <tr>
                            <td>satu</td>
                            <td>dua</td>
                            <td>tiga</td>
                            <td>empat</td>
                            <td>lima</td>
                            <td>enam</td>
                            <td>tujuh</td>
                            <td>delapan</td>
                            <td>sembilan</td>
                            <td>sepuluh</td>
                            <td>
                                <b-dropdown
                                    id="dropdown-right"
                                    right
                                    text="Aksi" icon="pencil-square" 
                                    variant="success"
                                    class="m-2"
                                    size="sm"
                                >
                                    <b-dropdown-item href="#"
                                        >Detail</b-dropdown-item
                                    >
                                    <b-dropdown-item href="#"
                                        >Edit</b-dropdown-item
                                    >
                                    <b-dropdown-item href="#"
                                        >Hapus</b-dropdown-item
                                    >
                                </b-dropdown>
                            </td>
                        </tr>
                        <tr>
                            <td>satu</td>
                            <td>dua</td>
                            <td>tiga</td>
                            <td>empat</td>
                            <td>lima</td>
                            <td>enam</td>
                            <td>tujuh</td>
                            <td>delapan</td>
                            <td>sembilan</td>
                            <td>sepuluh</td>
                            <td>
                                <b-dropdown
                                    id="dropdown-right"
                                    right
                                    text="Aksi" icon="pencil-square" 
                                    variant="success"
                                    class="m-2"
                                    size="sm"
                                >
                                    <b-dropdown-item href="#"
                                        >Detail</b-dropdown-item
                                    >
                                    <b-dropdown-item href="#"
                                        >Edit</b-dropdown-item
                                    >
                                    <b-dropdown-item href="#"
                                        >Hapus</b-dropdown-item
                                    >
                                </b-dropdown>
                            </td>
                        </tr>
                        <tr>
                            <td>satu</td>
                            <td>dua</td>
                            <td>tiga</td>
                            <td>empat</td>
                            <td>lima</td>
                            <td>enam</td>
                            <td>tujuh</td>
                            <td>delapan</td>
                            <td>sembilan</td>
                            <td>sepuluh</td>
                            <td>
                                <b-dropdown
                                    id="dropdown-right"
                                    right
                                    text="Aksi" icon="pencil-square" 
                                    variant="success"
                                    class="m-2"
                                    size="sm"
                                >
                                    <b-dropdown-item href="#"
                                        >Detail</b-dropdown-item
                                    >
                                    <b-dropdown-item href="#"
                                        >Edit</b-dropdown-item
                                    >
                                    <b-dropdown-item href="#"
                                        >Hapus</b-dropdown-item
                                    >
                                </b-dropdown>
                            </td>
                        </tr>
                        <tr>
                            <td>satu</td>
                            <td>dua</td>
                            <td>tiga</td>
                            <td>empat</td>
                            <td>lima</td>
                            <td>enam</td>
                            <td>tujuh</td>
                            <td>delapan</td>
                            <td>sembilan</td>
                            <td>sepuluh</td>
                            <td>
                                <b-dropdown
                                    id="dropdown-right"
                                    right
                                    text="Aksi" icon="pencil-square" 
                                    variant="success"
                                    class="m-2"
                                    size="sm"
                                >
                                    <b-dropdown-item href="#"
                                        >Detail</b-dropdown-item
                                    >
                                    <b-dropdown-item href="#"
                                        >Edit</b-dropdown-item
                                    >
                                    <b-dropdown-item href="#"
                                        >Hapus</b-dropdown-item
                                    >
                                </b-dropdown>
                            </td>
                        </tr>
                        <tr>
                            <td>satu</td>
                            <td>dua</td>
                            <td>tiga</td>
                            <td>empat</td>
                            <td>lima</td>
                            <td>enam</td>
                            <td>tujuh</td>
                            <td>delapan</td>
                            <td>sembilan</td>
                            <td>sepuluh</td>
                            <td>
                                <b-dropdown
                                    id="dropdown-right"
                                    right
                                    text="Aksi" icon="pencil-square" 
                                    variant="success"
                                    class="m-2"
                                    size="sm"
                                >
                                    <b-dropdown-item href="#"
                                        >Detail</b-dropdown-item
                                    >
                                    <b-dropdown-item href="#"
                                        >Edit</b-dropdown-item
                                    >
                                    <b-dropdown-item href="#"
                                        >Hapus</b-dropdown-item
                                    >
                                </b-dropdown>
                            </td>
                        </tr>
                        <tr>
                            <td>satu</td>
                            <td>dua</td>
                            <td>tiga</td>
                            <td>empat</td>
                            <td>lima</td>
                            <td>enam</td>
                            <td>tujuh</td>
                            <td>delapan</td>
                            <td>sembilan</td>
                            <td>sepuluh</td>
                            <td>
                                <b-dropdown
                                    id="dropdown-right"
                                    right
                                    text="Aksi" icon="pencil-square" 
                                    variant="success"
                                    class="m-2"
                                    size="sm"
                                >
                                    <b-dropdown-item href="#"
                                        >Detail</b-dropdown-item
                                    >
                                    <b-dropdown-item href="#"
                                        >Edit</b-dropdown-item
                                    >
                                    <b-dropdown-item href="#"
                                        >Hapus</b-dropdown-item
                                    >
                                </b-dropdown>
                            </td>
                        </tr>
                        <tr>
                            <td>satu</td>
                            <td>dua</td>
                            <td>tiga</td>
                            <td>empat</td>
                            <td>lima</td>
                            <td>enam</td>
                            <td>tujuh</td>
                            <td>delapan</td>
                            <td>sembilan</td>
                            <td>sepuluh</td>
                            <td>
                                <b-dropdown
                                    id="dropdown-right"
                                    right
                                    text="Aksi" icon="pencil-square" 
                                    variant="success"
                                    class="m-2"
                                    size="sm"
                                >
                                    <b-dropdown-item href="#"
                                        >Detail</b-dropdown-item
                                    >
                                    <b-dropdown-item href="#"
                                        >Edit</b-dropdown-item
                                    >
                                    <b-dropdown-item href="#"
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
<style></style>
