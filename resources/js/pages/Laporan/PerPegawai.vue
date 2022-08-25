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
            <h3>Laporan per-Pegawai</h3>
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
            <div class="mb-1 pe-0" style="width: 310px">
                <button type="button" class="btn btn-success">
                    EXPORT EXCEL <i class="bi bi-file-earmark-excel"></i>
                </button>
                <button type="button" class="btn btn-danger">
                    EXPORT PDF <i class="bi bi-file-earmark-pdf"></i>
                </button>
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
                            <td class="text-center">11</td>
                            <td class="text-center">12</td>
                            <td class="text-center">13</td>
                            <td class="text-center">14</td>
                            <td class="text-center">15</td>
                            <td class="text-center">16</td>
                            <td class="text-center">17</td>
                            <td class="text-center">18</td>
                            <td class="text-center">19</td>
                            <td class="text-center">20</td>
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
                            <td>sebelas</td>
                            <td>dua belas</td>
                            <td>tiga belas</td>
                            <td>empat belas</td>
                            <td>lima belas</td>
                            <td>enam belas</td>
                            <td>tujuh belas</td>
                            <td>delapan belas</td>
                            <td>sembilan belas</td>
                            <td>dua puluh</td>
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
                            <td>sebelas</td>
                            <td>dua belas</td>
                            <td>tiga belas</td>
                            <td>empat belas</td>
                            <td>lima belas</td>
                            <td>enam belas</td>
                            <td>tujuh belas</td>
                            <td>delapan belas</td>
                            <td>sembilan belas</td>
                            <td>dua puluh</td>
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
                            <td>sebelas</td>
                            <td>dua belas</td>
                            <td>tiga belas</td>
                            <td>empat belas</td>
                            <td>lima belas</td>
                            <td>enam belas</td>
                            <td>tujuh belas</td>
                            <td>delapan belas</td>
                            <td>sembilan belas</td>
                            <td>dua puluh</td>
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
                            <td>sebelas</td>
                            <td>dua belas</td>
                            <td>tiga belas</td>
                            <td>empat belas</td>
                            <td>lima belas</td>
                            <td>enam belas</td>
                            <td>tujuh belas</td>
                            <td>delapan belas</td>
                            <td>sembilan belas</td>
                            <td>dua puluh</td>
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
                            <td>sebelas</td>
                            <td>dua belas</td>
                            <td>tiga belas</td>
                            <td>empat belas</td>
                            <td>lima belas</td>
                            <td>enam belas</td>
                            <td>tujuh belas</td>
                            <td>delapan belas</td>
                            <td>sembilan belas</td>
                            <td>dua puluh</td>
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
                            <td>sebelas</td>
                            <td>dua belas</td>
                            <td>tiga belas</td>
                            <td>empat belas</td>
                            <td>lima belas</td>
                            <td>enam belas</td>
                            <td>tujuh belas</td>
                            <td>delapan belas</td>
                            <td>sembilan belas</td>
                            <td>dua puluh</td>
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
                            <td>sebelas</td>
                            <td>dua belas</td>
                            <td>tiga belas</td>
                            <td>empat belas</td>
                            <td>lima belas</td>
                            <td>enam belas</td>
                            <td>tujuh belas</td>
                            <td>delapan belas</td>
                            <td>sembilan belas</td>
                            <td>dua puluh</td>
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
                            <td>sebelas</td>
                            <td>dua belas</td>
                            <td>tiga belas</td>
                            <td>empat belas</td>
                            <td>lima belas</td>
                            <td>enam belas</td>
                            <td>tujuh belas</td>
                            <td>delapan belas</td>
                            <td>sembilan belas</td>
                            <td>dua puluh</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<style></style>
