<template>
  <div>
    <div class="row card shadow mt-3 ms-5 me-5 pb-3" style="flex: none">
      <div class="row gx-5 mt-3 ms-1">
        <!-- penilai -->

        <div class="col-6">
          <div class="border bg-light pb-3">
            <div class="row rounded w-75 mt-1 mb-3 gradient">
              <h5 class="pt-1">Penilai</h5>
            </div>

            <div class="row border-top ms-3 me-3">
              <div class="col-md-3">NIP</div>

              <div class="col-md">: {{ penilai.nip }}</div>
            </div>

            <div class="row border-top ms-3 me-3">
              <div class="col-md-3">Nama</div>

              <div class="col-md">: {{ penilai.nama }}</div>
            </div>

            <div class="row border-top ms-3 me-3">
              <div class="col-md-3">Jabatan</div>

              <div class="col-md">: {{ penilai.jabatan }}</div>
            </div>

            <div class="row border-top ms-3 me-3">
              <div class="col-md-3">UPT</div>

              <div class="col-md">: {{ penilai.upt }}</div>
            </div>

            <div class="row border-top border-bottom ms-3 me-3">
              <div class="col-md-3">Wilayah</div>

              <div class="col-md">: {{ penilai.wilayah }}</div>
            </div>
          </div>
        </div>

        <!-- pegawai -->

        <div class="col-6">
          <div class="border bg-light pb-3">
            <div class="row rounded w-75 mt-1 mb-3 gradient">
              <h5 class="pt-1">Dinilai</h5>
            </div>

            <div class="row border-top ms-3 me-3">
              <div class="col-md-3">NIP</div>

              <div class="col-md">: {{ dinilai.nip }}</div>
            </div>

            <div class="row border-top ms-3 me-3">
              <div class="col-md-3">Nama</div>

              <div class="col-md">: {{ dinilai.nama }}</div>
            </div>

            <div class="row border-top ms-3 me-3">
              <div class="col-md-3">Jabatan</div>

              <div class="col-md">: {{ dinilai.jabatan }}</div>
            </div>

            <div class="row border-top ms-3 me-3">
              <div class="col-md-3">UPT</div>

              <div class="col-md">: {{ dinilai.upt }}</div>
            </div>

            <div class="row border-top border-bottom ms-3 me-3">
              <div class="col-md-3">Wilayah</div>

              <div class="col-md">: {{ dinilai.wilayah }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- tutup -->

    <div class="row card shadow mt-3 ms-3 me-3 mb-5">
      <div class="row rounded w-25 mt-3 mb-3 gradient">
        <h3>Master Kuesioner</h3>
      </div>

      <form @click.prevent="updateData()">
        <table class="table table-striped table-hover rounded">
          <thead>
            <tr>
              <!-- <td><b> #</b></td> -->

              <td><b>indikator</b></td>

              <td><b>bobot</b></td>

              <td><b>jawaban</b></td>

              <td><b>rating</b></td>

              <td><b>Nilai terbobot</b></td>
            </tr>
          </thead>

          <tbody>
            <tr v-for="(dt, index) in data_kuesioner">
              <td>{{ dt.kuesioner }}</td>

              <td>{{ dt.bobot }}</td>

              <td>
                <textarea
                  v-model="jawaban[index]"
                  placeholder="komentar.."
                  class="form-control"
                ></textarea>
              </td>

              <!-- <td>{{dt.rating}}</td> -->

              <td>
                <div class="row">
                  <!-- {{$dt}} -->

                  <div class="col-1">
                    1<br />

                    <input type="radio" v-model="rating[index]" value="1" />
                  </div>

                  <div class="col-1">
                    2<br />

                    <input type="radio" v-model="rating[index]" value="2" />
                  </div>

                  <div class="col-1">
                    3<br />

                    <input type="radio" v-model="rating[index]" value="3" />
                  </div>

                  <div class="col-1">
                    4<br />

                    <input type="radio" v-model="rating[index]" value="4" />
                  </div>

                  <div class="col-1">
                    5<br />

                    <input type="radio" v-model="rating[index]" value="5" />
                  </div>
                </div>
              </td>

              <td>{{ dt.bobot * rating[index] }}</td>
            </tr>
          </tbody>
        </table>

        <div class="d-flex justify-content-end mb-5">
          <button
            type="submit"
            @click.prevent="updateData()"
            class="btn btn-primary"
            style="width: 150px"
          >
            Simpan <i class="bi bi-save2"></i>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  props: ["id_periode", "id_user_penilai", "id_user_pegawai"],
  data() {
    return {
      id_master: null,
      masterDt: {
        periode: null,
        penilai: null,
        dinilai: null,
      },
      penilai: {
        nip: null,
        nama: null,
        jabatan: null,
        upt: null,
        wilayah: null,
      },
      dinilai: {
        nip: null,
        nama: null,
        jabatan: null,
        upt: null,
        wilayah: null,
      },
      data_kuesioner: {},
      update_kuesioner: {
        id_penilaian: [],
        jawaban: [],
        rating: [],
      },
      id_penilaian: [],
      rating: [],
      jawaban: [],
      url: "/api/auth/vocs/master?",
    };
  },
  mounted() {
    this.masterDt.periode = this.id_periode;
    this.masterDt.penilai = this.id_user_penilai;
    this.masterDt.dinilai = this.id_user_pegawai;
    if (
      this.masterDt.periode == undefined &&
      this.masterDt.penilai == undefined &&
      this.masterDt.dinilai == undefined
    ) {
      this.$router.push({
        name: "PegawaiVocs",
      });
    } else {
      this.getData();
    }
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

      axios.post("/api/auth/vocs/store", this.masterDt, config).then((response) => {
        // console.log(response.data);
        this.penilai = {
          nip: response.data.pegawai.penilai.nip,
          nama: response.data.pegawai.penilai.nama,
          jabatan: response.data.pegawai.penilai.jabatan.nama,
          upt: response.data.pegawai.penilai.upt.nama,
          wilayah: response.data.pegawai.penilai.wilayah.nama,
        };
        this.dinilai = {
          nip: response.data.pegawai.dinilai.nip,
          nama: response.data.pegawai.dinilai.nama,
          jabatan: response.data.pegawai.dinilai.jabatan.nama,
          upt: response.data.pegawai.dinilai.upt.nama,
          wilayah: response.data.pegawai.dinilai.wilayah.nama,
        };
        this.data_kuesioner = response.data.kuesioner;
        this.update_kuesioner.id_penilaian = response.data.kuesioner[0].id;
        for (let i = 0; i < response.data.kuesioner.length; i++) {
          this.id_penilaian[i] = response.data.kuesioner[i].id;
          this.rating[i] = response.data.kuesioner[i].rating;
          this.jawaban[i] = response.data.kuesioner[i].jawaban;
        }
        this.update_kuesioner.id_penilaian = this.id_penilaian;
        this.update_kuesioner.jawaban = this.jawaban;
        this.update_kuesioner.rating = this.rating;
      });
    },
    updateData() {
      let token = "";
      this.token = localStorage.getItem("JWToken");
      const config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      this.url =
        this.url +
        "&id_user_penilai=" +
        this.id_user_penilai +
        "&id_user_pegawai=" +
        this.id_user_pegawai +
        "&id_periode=" +
        this.id_periode;
      axios.post("/api/auth/vocs/id/master", this.masterDt, config).then((response) => {
        console.log(this.masterDt);
        this.id_master = response.data[0];
        axios
          .post("/api/auth/vocs/update/" + this.id_master, this.update_kuesioner, config)
          .then((response) => {
            // this.id_master = response.data[0].id;
            console.log(response);
          })
          .catch((err) => {
            console.log(err);
          });
        console.log(this.id_master);
      });
      // axios.post("/api/auth/vocs/update/" + this.id_master, this.update_kuesioner, config)
      //     .then((response) => {
      //         // this.id_master = response.data[0].id;
      //         console.log(response);
      //     }).catch((err) => {console.log(err);});
    },
  },
};
</script>
