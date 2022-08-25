<template>
  <div style="text-align: center">
  <h1>saya adalah admin</h1>
    <!-- <button v-on:click="muncul = true">Hide the text below</button>
    <h1 v-if="muncul">Saya Adalah Homepage</h1>
    <div>
      <apexchart width="500" type="bar" :options="options" :series="series"></apexchart>
    </div>
    <div>
      <apexchart width="500" type="line" :options="options" :series="series"></apexchart>
    </div> -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      muncul: false
      //   options: {
      //     chart: {
      //       id: "vuechart-example",
      //     },
      //     xaxis: {
      //       categories: [],
      //     },
      //   },
      //   series: [
      //     {
      //       name: "series-1",
      //       data: [],
      //     },
      //   ],
    };
  },
  // mounted: async function () {
  //   axios.get("/api/kota").then((response) => {
  //     // console.log(response);
  //     for (const x in response.data) {
  //       this.options.xaxis.categories.push(response.data[x].nama);
  //       this.series[0].data.push(response.data[x].total);
  //     }
  //   });
  // },
  methods: {
    // getUsers() { },
  },
};
</script>
