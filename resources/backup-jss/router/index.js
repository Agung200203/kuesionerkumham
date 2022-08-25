import {createRouter, createWebHistory} from 'vue-router';
// window.Vue = require("vue").default;
// import vue from "vue";
// import VueRouter from "vue-router";
// Vue.use(VueRouter);
const Home = require("../pages/Home.vue").default; //import atau mengambil file di folder
const About = require("../pages/About.vue").default;
import NotFound from "../pages/NotFound.vue"; // untuk mengimportnya bisa menggunkan ini atau menggunkan yang diatasnya
import EditUsers from "../pages/MasterData/CreateOrUpdate/EditUsers.vue";
import User from "../pages/User.vue";
import Profile from "../pages/Profile.vue";
import Registrasi from "../pages/Registrasi.vue";
import Pegawai from "../pages/MasterData/DataPegawai.vue";
import Jabatan from "../pages/MasterData/DataJabatan.vue";
import Wilayah from "../pages/MasterData/DataWilayah.vue";
import Upt from "../pages/MasterData/DataUpt.vue";
import Kategori from "../pages/MasterData/DataKategori.vue";
import LaporanPerpegawai from "../pages/Laporan/PerPegawai.vue";
import Login from "../pages/Login.vue";

// coba stored procedure
import dataTampil from "../pages/storedProcedure/dataTampil.vue";
import editDataTampil from "../pages/storedProcedure/createOrUpdate.vue";

const coba = [{
        name: "Login",
        path: "/login",
        component: Login,
    },
    {
        name: "Home",
        path: "/home", // jalur url
        component: Home, //template yang akan di rennder pada saat urlnya di akses
    },
    {
        name: "About",
        path: "/about",
        component: About,
    },
    {
        name: "User",
        path: "/user",
        component: User,
    },
    {
        name: "Registrasi",
        path: "/user/create",
        component: Registrasi,
    },

    {
        name: "Profile",
        path: "/user/:id",
        component: Profile,
        props: true,
    },
    {
        name: "Edit",
        path: "/user/:id/edit",
        component: EditUsers,
        props: true,
    },
    {
        name: "TabelPegawai",
        path: "/tabel/pegawai",
        component: Pegawai,
    },
    {
        name: "TabelJabatan",
        path: "/tabel/jabatan",
        component: Jabatan,
    },
    {
        name: "TabelWilayah",
        path: "/tabel/wilayah",
        component: Wilayah,
    },
    {
        name: "TabelUpt",
        path: "/tabel/upt",
        component: Upt,
    },
    {
        name: "TabelKategori",
        path: "/tabel/kategori",
        component: Kategori,
    },

    // ===== LAPORAN =================
    {
        name: "LaporanPerpegawai",
        path: "/laporan/per-pegawai",
        component: LaporanPerpegawai,
    },
    // ========== bljr stored procedure ============
    {
        name: "dataTampil",
        path: "/belajar/dataTampil",
        component: dataTampil,
    },

    // membantu user bila salah url
    {
        path: "*", // artinya bila user mengetik url yang tidak terdaftar maka not found
        component: NotFound,
    },
    {
        name: "editDataTampil",
        path: "/belajar/dataTampil/:id/edit",
        component: editDataTampil,
        props: true,
    },
];

const router = new createRouter({
    linkActiveClass: "exact-active",
    mode: "history",
    history: createWebHistory(process.env.BASE_URL),
    routes: coba,
});

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    next();
  });

export default router;
