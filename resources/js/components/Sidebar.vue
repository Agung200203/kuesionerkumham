<template>
  <div>
    <header-component></header-component>
    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav shadow" id="sidenavAccordion">
          <div class="sb-sidenav-menu text" style="background-color: #317af7">
            <div class="nav p-3 mt-3">
              <!-- <ul class="list-group list-group-flush bg-none">
                            <li class="list-group-item">An item</li>
                            <li class="list-group-item">A second item</li>
                            <li class="list-group-item">A third item</li>
                            <li class="list-group-item">A fourth item</li>
                            <li class="list-group-item">And a fifth one</li>
                        </ul> -->
              <ul v-if="role == 1" class="ps-0 ms-0" style="list-style-type: none">
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

                  <a class="link" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                    aria-expanded="false" aria-controls="flush-collapseOne">
                    <i class="bi bi-folder-check ms-2 pe-2 fs-4"></i> Data Kategori
                  </a>
                  <div class="">
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                      data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                        <router-link to="/kategori/voc" class="link">
                          <i class="bi bi-record-fill"></i>
                          VOC
                        </router-link>
                        <router-link to="/kategori/Speedec" class="link">
                          <i class="bi bi-record-fill"></i>
                          Speedec
                        </router-link>
                        <router-link to="/kategori/proact" class="link">
                          <i class="bi bi-record-fill"></i>
                          Proact
                        </router-link>
                        <router-link to="/kategori/xrole" class="link">
                          <i class="bi bi-record-fill"></i>
                          Xrole
                        </router-link>
                      </div>
                    </div>
                  </div>

                  <!-- kuesioner -->
                  <a class="link" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                    aria-expanded="false" aria-controls="flush-collapseTwo">
                    <i class="bi bi-window-plus ms-2 pe-2 fs-4"></i> Data Kuesioner
                  </a>
                  <div class="">
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                      data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                        <router-link to="/kuesioner/voc" class="link">
                          <i class="bi bi-record-fill"></i>
                          VOC
                        </router-link>
                        <router-link to="/kuesioner/speedec" class="link">
                          <i class="bi bi-record-fill"></i>
                          Speedec
                        </router-link>
                        <router-link to="/kuesioner/proact" class="link">
                          <i class="bi bi-record-fill"></i>
                          Proact
                        </router-link>
                        <router-link to="/kuesioner/xrole" class="link">
                          <i class="bi bi-record-fill"></i>
                          Xrole
                        </router-link>
                      </div>
                    </div>
                  </div>
                  <router-link to="/tabel/periode/penilaian" class="link">
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
                  <!-- <router-link to="/Penilaian/periode-vocs" class="link">
                    <i class="bi bi-journal-check ms-2 pe-2 fs-4"></i>
                    Penilaian VOCS
                  </router-link>
                  <router-link to="/proses-akhir-periode" class="link">
                    <i class="bi bi-calculator-fill ms-2 pe-2 fs-4"></i>
                    Proses Akhir Periode
                  </router-link> -->
                  <router-link to="/Penilaian/data-penilaian-vocs" class="link ">
                    <i class="bi bi-list-task"></i>
                    Data Penilaian
                  </router-link>
                </li>

                <li>
                  <!-- LAPORAN -->
                  <h4 class="border-bottom">LAPORAN</h4>
                  <router-link to="/laporan/generate" class="link">
                    <i class="bi bi-clipboard-data ms-2 pe-2 fs-4"></i>
                    Laporan Generate
                  </router-link>
                </li>
                <li class="mb-5">
                  <h4 class="border-bottom">EXTRA</h4>
                  <router-link to="/Export" class="link">
                    <i class="bi bi-journal-check ms-2 pe-2 fs-4"></i>
                    Export
                  </router-link>
                  <router-link to="/Import" class="link">
                    <i class="bi bi-calculator-fill ms-2 pe-2 fs-4"></i>
                    Import
                  </router-link>
                  <router-link to="/profile" class="link">
                    <i class="bi bi-person-fill ms-2 pe-2 fs-4"></i>
                    Profile
                  </router-link>
                </li>
              </ul>

              <!--//////////////////////////////////////Sidebar-user///////////////////////////////////////////////////  -->
              <ul v-else-if="role == 0" class="ps-0 ms-0" style="list-style-type: none">
                <li class="mb-3">
                  <!-- <h4 class="border-bottom">Dashboard</h4> -->
                  <router-link to="/user/home" class="link">
                    <i class="bi bi-house-door-fill ms-2 pe-2 fs-4"></i>
                    Dashboard
                  </router-link>
                </li>
                <li>
                  <!-- PENILAIAN -->
                  <h4 class="border-bottom">PENILAIAN</h4>
                  <router-link to="/Penilaian/periode-vocs" class="link">
                    <i class="bi bi-journal-check ms-2 pe-2 fs-4"></i>
                    Penilaian VOCS
                  </router-link>
                  <router-link to="/proses-akhir-periode" class="link">
                    <i class="bi bi-calculator-fill ms-2 pe-2 fs-4"></i>
                    Proses Akhir Periode
                  </router-link>
                  <router-link to="/proses-akhir-periode" class="link">
                    <i class="bi bi-list-task ms-2 pe-2 fs-4"></i>
                    Data Penilaian
                  </router-link>
                </li>


                <li>
                  <!-- LAPORAN -->
                  <h4 class="border-bottom">LAPORAN</h4>
                  <router-link to="/laporan/generate" class="link">
                    <i class="bi bi-clipboard-data ms-2 pe-2 fs-4"></i>
                    Laporan Generate
                  </router-link>
                </li>
                <!-- extra -->
                <li class="mb-5">
                  <h4 class="border-bottom">EXTRA</h4>
                  <router-link to="/Export" class="link">
                    <i class="bi bi-journal-check ms-2 pe-2 fs-4"></i>
                    Export
                  </router-link>
                  <router-link to="/Import" class="link">
                    <i class="bi bi-calculator-fill ms-2 pe-2 fs-4"></i>
                    Import
                  </router-link>
                  <router-link to="/profile" class="link">
                    <i class="bi bi-person-fill ms-2 pe-2 fs-4"></i>
                    Profile
                  </router-link>
                </li>
              </ul>

              <div id="footer" class="border-top pb-3">
                <i class="bi bi-door-open fs-4"></i>
                <button @click.prevent="logout()"
                  style="color: white; text-decoration: none; background-color: transparent; border-width: 0;">
                  Logout</button>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</template>
<script>
import router from "../router";
import { EventBus } from "../app";
export default
  {
    data() {
      return {
        token: '',      // <-- state token
        user: '',       // <-- state user
        // logout:''      // <-- method logout
        role: localStorage.getItem('roleUser'),
      };
    },
    methods: {
      logout() {
        let token = ''
        this.token = localStorage.getItem('JWToken')
        axios.defaults.headers.common.Authorization = `Bearer ${this.token}`
        axios.post("/api/auth/logout ").then((response) => {
          // console.log(response);
          this.$noty.success(response.data.message);
          localStorage.removeItem('JWToken')
          localStorage.removeItem('roleUser')
          localStorage.removeItem('idPegawai')
          localStorage.removeItem('idUser')
          localStorage.removeItem('email')
          localStorage.removeItem('name')
          localStorage.removeItem('nip')
          EventBus.$emit('loggedIn', false);
          router.push({
            name: 'Login'
          });
          loginFailed.value = false;
        });
      },
      eventbus() {
        EventBus.$on("loggedIn", loggedIn => {
          this.isLoggedIn = loggedIn
        })
      },
      setUser() {
        this.user = JSON.parse(localStorage.getItem("user"));
        this.isLoggedIn = localStorage.getItem("JWToken") != null;
        console.log(this.isLoggedIn);
      },
    },

    mounted() {
      console.log(this.role);
    },
  };
</script>


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
ul li {
  margin-bottom: 20px;
}

.link {
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