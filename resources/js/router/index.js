window.Vue = require("vue").default;
import vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);
const Home = require("../pages/Home.vue").default; //import atau mengambil file di folder
const HomeUser = require("../pages/HomeUser.vue").default; //import atau mengambil file di folder
const About = require("../pages/About.vue").default;
import NotFound from "../pages/NotFound.vue"; // untuk mengimportnya bisa menggunkan ini atau menggunkan yang diatasnya
// import EditUsers from "../pages/MasterData/CreateOrUpdate/EditUsers.vue";
import AksiJabatan from "../pages/MasterData/CreateOrUpdate/AksiJabatan.vue";
import AksiPegawai from "../pages/MasterData/CreateOrUpdate/AksiPegawai.vue";
import AksiWilayah from "../pages/MasterData/CreateOrUpdate/AksiWilayah.vue";
import AksiUpt from "../pages/MasterData/CreateOrUpdate/AksiUpt.vue";
import AksiKategoriSpeedec from "../pages/MasterData/CreateOrUpdate/AksiKategoriSpeedec.vue";
import AksiKategoriVoc from "../pages/MasterData/CreateOrUpdate/AksiKategoriVoc.vue";
import AksiKategoriProact from "../pages/MasterData/CreateOrUpdate/AksiKategoriProact.vue";
import AksiKategoriXrole from "../pages/MasterData/CreateOrUpdate/AksiKategoriXrole.vue";
import AksiUsers from "../pages/MasterData/CreateOrUpdate/AksiUsers.vue";
import AksiKuesionerVoc from "../pages/MasterData/CreateOrUpdate/AksiKuesionerVoc.vue";
import AksiKuesionerSpeed from "../pages/MasterData/CreateOrUpdate/AksiKuesionerSpeedec.vue";
import AksiKuesionerProact from "../pages/MasterData/CreateOrUpdate/AksiKuesionerProact.vue";
import AksiKuesionerXrole from "../pages/MasterData/CreateOrUpdate/AksiKuesionerXrole.vue";
import AksiPeriodePenilaian from "../pages/MasterData/CreateOrUpdate/AksiPeriodePenilaian.vue";
import ResetPassword from "../pages/MasterData/CreateOrUpdate/ResetPassword.vue";
import Profile from "../pages/Profile.vue";
import Export from "../pages/Export.vue";
import Registrasi from "../pages/Auth/Registrasi.vue";
import RegistrasiUser from "../pages/Auth/RegistrasiUser.vue";
import Pegawai from "../pages/MasterData/DataPegawai.vue";
import Jabatan from "../pages/MasterData/DataJabatan.vue";
import Wilayah from "../pages/MasterData/DataWilayah.vue";
import DataUser from "../pages/MasterData/DataUser.vue";
import Upt from "../pages/MasterData/DataUpt.vue";
import KategoriVOC from "../pages/MasterData/KategoriVOC.vue";
import KategoriProact from "../pages/MasterData/KategoriProact.vue";
import KategoriXrole from "../pages/MasterData/KategoriXrole.vue";
import KategoriSpeedec from "../pages/MasterData/KategoriSpeedec.vue";
import KuesionerVOC from "../pages/MasterData/KuesionerVOC.vue";
import KuesionerSpeed from "../pages/MasterData/KuesionerSpeedec.vue";
import KuesionerProact from "../pages/MasterData/KuesionerProact.vue";
import KuesionerXrole from "../pages/MasterData/KuesionerXrole.vue";
import PeriodePenilaian from "../pages/MasterData/PeriodePenilaian.vue";
import PeriodeVocs from "../pages/Penilaian/PeriodeVocs.vue";
import PegawaiVocs from "../pages/Penilaian/PegawaiVocs.vue";
import PenilaianVocs from "../pages/Penilaian/PenilaianVocs.vue";
import DataPenilaianVocs from "../pages/Penilaian/AdminDataPenilai.vue";
import LaporanPerpegawai from "../pages/Laporan/PerPegawai.vue";
import GenerateLaporan from "../pages/Laporan/GenerateLaporan.vue";
import Login from "../pages/Login.vue";
import LandingPage from "../pages/LandingPage.vue";

//filter untuk admin dari serangan user (punya admin)
const adminAuth = (to, from, next) => { 
        if (localStorage.getItem("roleUser") != 1) {
            next( { name: 'HomeUser' })
        } else {
            next() 
        }
}
//filter untuk user dari serangan admin (punya user)
const userAuth = (to, from, next) => { 
        if (localStorage.getItem("roleUser") != 0) {
            next({ name: 'Home' })
        } else {
            next() 
        }
}

const coba = [
    //variabel
    {
        name: "Login",
        path: "/",
        component: Login,
    },
    {
        name: "LandingPage",
        path: "/menu/pilih", // jalur url
        component: LandingPage, //template yang akan di rennder pada saat urlnya di akses\
        // beforeEnter: hallo
    },
    {
        name: "Home",
        path: "/home", // jalur url
        component: Home, //template yang akan di rennder pada saat urlnya di akses
        meta:{
            requiresAuth: true,
        },
        beforeEnter: adminAuth
    },
    {
        name: "HomeUser",
        path: "/user/home", // jalur url
        component: HomeUser, //template yang akan di rennder pada saat urlnya di akses
        meta:{
            requiresAuth: true,
        },
        beforeEnter: userAuth 
    },
    {
        name: "About",
        path: "/about",
        component: About,
        meta:{
            requiresAuth: true,
            }
    },
    {
        name: "User",
        path: "/user",
        component: DataUser,
    },
    {
        name: "Registrasi",
        path: "/pegawai/create",
        component: Registrasi,
    },
    {
        name: "RegistrasiUser",
        path: "/user/create",
        component: RegistrasiUser,
    },

    {
        name: "Profile",
        path: "/profile",
        component: Profile,
        props: true,
    },
    // {
    //     name: "Edit",
    //     path: "/user/:id/edit",
    //     component: EditUsers,
    //     props: true,
    // },
    {
        name: "TabelPegawai",
        path: "/tabel/pegawai",
        component: Pegawai,
        meta:{
            requiresAuth:true,
        },
        beforeEnter: adminAuth
    },
    {
        name: "TabelJabatan",
        path: "/tabel/jabatan",
        component: Jabatan,
        beforeEnter: adminAuth
    },
    {
        name: "TabelWilayah",
        path: "/tabel/wilayah",
        component: Wilayah,
        beforeEnter: adminAuth
    },
    {
        
        name: "TabelUpt",
        path: "/tabel/upt",
        component: Upt,
        beforeEnter: adminAuth
    },
    {
        name: "TabelKategoriSpeedec",
        path: "/kategori/Speedec",
        component: KategoriSpeedec,
        beforeEnter: adminAuth
    },
    {
        name: "TabelKategoriVoc",
        path: "/kategori/voc",
        component: KategoriVOC,
        beforeEnter: adminAuth
    },
    {
        name: "TabelKategoriProact",
        path: "/kategori/proact",
        component: KategoriProact,
        beforeEnter: adminAuth
    },
    {
        name: "TabelKategoriXrole",
        path: "/kategori/xrole",
        component: KategoriXrole,
        beforeEnter: adminAuth
    },
    {
        name: "TabelKuesionerVoc",
        path: "/kuesioner/voc",
        component: KuesionerVOC,
        beforeEnter: adminAuth
    },
    {
        name: "TabelKuesionerSpeed",
        path: "/kuesioner/speedec",
        component: KuesionerSpeed,
        beforeEnter: adminAuth
    },
    {
        name: "TabelKuesionerProact",
        path: "/kuesioner/proact",
        component: KuesionerProact,
        beforeEnter: adminAuth
    },
    {
        name: "TabelKuesionerXrole",
        path: "/kuesioner/xrole",
        component: KuesionerXrole,
        beforeEnter: adminAuth
    },
    {
        name: "TabelPeriode",
        path: "/tabel/periode/penilaian",
        component: PeriodePenilaian,
        beforeEnter: adminAuth
    },
    {
        name: "PeriodeVocs",
        path: "/Penilaian/periode-vocs",
        component: PeriodeVocs,
        beforeEnter: userAuth
        
    },
    {
        name: "PegawaiVocs",
        path: "/Penilaian/Pegawai-vocs",
        component: PegawaiVocs,
        props: true,
        beforeEnter: userAuth

    },
    {
        name: "PenilaianVocs",
        path: "/Penilaian/penilaian-vocs",
        component: PenilaianVocs,
        props: true,
        beforeEnter: userAuth

    },
    {
        name: "DataPenilaianVocs",
        path: "/Penilaian/data-penilaian-vocs",
        component: DataPenilaianVocs,
        props: true,
        // beforeEnter: userAuth

    },
    

    // ===== LAPORAN =================
    {
        name: "LaporanPerpegawai",
        path: "/laporan/per-pegawai",
        component: LaporanPerpegawai,
    },
    {
        name: "GenerateLaporan",
        path: "/laporan/generate",
        component: GenerateLaporan,
    },

    // membantu user bila salah url
    {
        path: "*", // artinya bila user mengetik url yang tidak terdaftar maka not found
        component: NotFound,
    },

    // Semua Aksi
    {
        name: "ResetPassword",
        path: "/user/reset-password/:id",
        component: ResetPassword,
        props: true,
    },
    {
        name: "AksiJabatan",
        path: "/jabatan/edit/:id",
        component: AksiJabatan,
        props: true,
    },
    {
        name: "AksiPegawai",
        path: "/pegawai/edit/:id",
        component: AksiPegawai,
        props: true,
    },
    {
        name: "AksiWilayah",
        path: "/wilayah/edit/:id",
        component: AksiWilayah,
        props: true,
    },
    {
        name: "AksiUpt",
        path: "/upt/edit/:id",
        component: AksiUpt,
        props: true,
    },
    {
        name: "AksiKategoriSpeedec",
        path: "/kategori/speedec/edit/:id",
        component: AksiKategoriSpeedec,
        props: true,
    },
    {
        name: "AksiKategoriVoc",
        path: "/kategori/voc/edit/:id",
        component: AksiKategoriVoc,
        props: true,
    },
    {
        name: "AksiKategoriProact",
        path: "/kuesioner/proact/edit/:id",
        component: AksiKategoriProact,
        props: true,
    },
    {
        name: "AksiKategoriXrole",
        path: "/kuesioner/xrole/edit/:id",
        component: AksiKategoriXrole,
        props: true,
    },
    {
        name: "AksiKuesionerVoc",
        path: "/kuesioner/voc/edit/:id",
        component: AksiKuesionerVoc,
        props: true,
    },
    {
        name: "AksiKuesionerSpeed",
        path: "/kuesioner/speed/edit/:id",
        component: AksiKuesionerSpeed,
        props: true,
    },
    {
        name: "AksiKuesionerProact",
        path: "/kuesioner/proact/edit/:id",
        component: AksiKuesionerProact,
        props: true,
    },
    {
        name: "AksiKuesionerXrole",
        path: "/kuesioner/xrole/edit/:id",
        component: AksiKuesionerXrole,
        props: true,
    },
    {
        name: "AksiPeriodePenilaian",
        path: "/periode/penilaian/edit/:id",
        component: AksiPeriodePenilaian,
        props: true,
    },
    {
        name: "AksiUsers",
        path: "/user/edit/:id",
        component: AksiUsers,
        props: true,
    },

    // extra
    {
        name: "Export",
        path: "/Export",
        component: Export,
    },

];

const router = new VueRouter({
    linkActiveClass: "active",
    mode: "history",
    routes: coba,
});

export default router;
