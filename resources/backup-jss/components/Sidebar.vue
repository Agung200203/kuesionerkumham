<template>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav
                class="sb-sidenav accordion sb-sidenav shadow"
                id="sidenavAccordion"
            >
                <div class="sb-sidenav-menu text" style="background-color:#317af7">
                    <div class="nav p-3 mt-3">
                        <!-- <ul class="list-group list-group-flush bg-none">
                            <li class="list-group-item">An item</li>
                            <li class="list-group-item">A second item</li>
                            <li class="list-group-item">A third item</li>
                            <li class="list-group-item">A fourth item</li>
                            <li class="list-group-item">And a fifth one</li>
                        </ul> -->
                        <ul class="ps-0 ms-0" style="list-style-type: none">
                            <li class="mb-3">
                                <!-- <h4 class="border-bottom">Dashboard</h4> -->
                                <router-link to="/home" class="link">
                                    <i class="bi bi-house-door-fill ms-2 pe-2 fs-4"></i>
                                    Dashboard 
                                </router-link>
                            </li>
                            <li>
                                <!-- MASTER DATA -->
                                <h4 class="border-bottom">Master Data</h4>
                                <router-link to="/tabel/pegawai" class="link">
                                    <i class="bi bi-file-person ms-2 pe-2 fs-4"></i>
                                    Data Pegawai
                                </router-link>
                                <router-link to="/tabel/jabatan" class="link">
                                    <i class="bi bi-bar-chart-line ms-2 pe-2 fs-4"></i>
                                    Data Jabatan
                                </router-link>
                                <router-link to="/tabel/wilayah" class="link">
                                    <i class="bi bi-pin-map ms-2 pe-2 fs-4"></i>
                                    Data Wilayah
                                </router-link>
                                <router-link to="/tabel/upt" class="link">
                                    <i class="bi bi-card-checklist ms-2 pe-2 fs-4"></i>
                                    Data UPT
                                </router-link>
                                <router-link to="/tabel/kategori" class="link">
                                    <i class="bi bi-folder-check ms-2 pe-2 fs-4"></i>
                                    Data Kategori
                                </router-link>
                                <router-link to="/tabel/kuesioner" class="link">
                                    <i class="bi bi-window-plus ms-2 pe-2 fs-4"></i>
                                    Data Kuesioner
                                </router-link>
                                <router-link to="/tabel/periode-penilain" class="link">
                                    <i class="bi bi-calendar3 ms-2 pe-2 fs-4"></i>
                                    Data Periode Penilaian
                                </router-link>
                                <router-link to="/user" class="link">
                                    <i class="bi bi-people ms-2 pe-2 fs-4"></i>
                                    Data User
                                </router-link>
                            </li>

                            <li>
                                <!-- PENILAIAN -->
                                <h4 class="border-bottom">PENILAIAN</h4>
                                <router-link to="/penialain-vocs" class="link">
                                    <i class="bi bi-journal-check ms-2 pe-2 fs-4"></i>
                                    Penilaian VOCS
                                </router-link>
                                <router-link to="/proses-akhir-periode" class="link">
                                    <i class="bi bi-calculator-fill ms-2 pe-2 fs-4"></i>
                                    Proses Akhir Periode
                                </router-link>
                            </li>
                           
                            <li>
                                <!-- LAPORAN -->
                                <h4 class="border-bottom">LAPORAN</h4>
                                <router-link to="/laporan/per-pegawai" class="link">
                                    <i class="bi bi-clipboard-data ms-2 pe-2 fs-4"></i>
                                    Laporan per-pegawai
                                </router-link>
                                <router-link to="/laporan/per-wilayah" class="link">
                                    <i class="bi bi-clipboard-data ms-2 pe-2 fs-4"></i>
                                    Laporan per-wilayah
                                </router-link>
                                <router-link to="/laporan/per-upt" class="link">
                                    <i class="bi bi-clipboard-data ms-2 pe-2 fs-4"></i>
                                    Laporan per-UPT
                                </router-link>
                                <router-link to="/laporan/sub/per-wilayah" class="link">
                                    <i class="bi bi-clipboard-data ms-2 pe-2 fs-4"></i>
                                    Laporan sub per-wilayah
                                </router-link>
                                <router-link to="/laporan/sub/per-upt" class="link">
                                    <i class="bi bi-clipboard-data ms-2 pe-2 fs-4"></i>
                                    Laporan sub per-UPT
                                </router-link>
                                <router-link to="/rangking/per-wilayah" class="link">
                                    <i class="bi bi-clipboard-data ms-2 pe-2 fs-4"></i>
                                    Rangking pegawai per-wilayah
                                </router-link>
                                <router-link to="/rangking/per-upt" class="link">
                                    <i class="bi bi-clipboard-data ms-2 pe-2 fs-4"></i>
                                    Rangking pegawai per-UPT
                                </router-link>
                            </li>
                        </ul>

                        <div id="footer" class="border-top pb-3">
                            <i class="bi bi-door-open fs-4"></i>
                            <router-link
                                to="/login"
                                style="color: white; text-decoration: none"
                            >
                                Logout</router-link
                            >
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</template>
<style>

    #footer {
        position: fixed;
        bottom: 0;
        width: 85%;
        /* padding-right: 10px; */
        /* display: inline-block; */
        /* padding-bottom: 10px; */
    /* background: #42a1f5; */
    background: #317af7;
    }
/* .logoIc {
    position: fixed;
    right: 0%;
    padding-right: 50px;
} */
ul li{
    margin-bottom: 20px;
}
.link{
    display: inline-block; 
    width: 100%;
    background: none;
    border-radius: 15px;
    color: white;
    text-decoration: none;
    margin-top: 5px;
}
.active,
.link:hover {
    display: inline-block; 
    width: 100%;
    background: white;
    border-radius: 15px;
    color: black;
    text-decoration: none;
    margin-top: 5px;
}


</style>
