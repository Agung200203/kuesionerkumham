<template>
    <nav class="sb-topnav navbar navbar-expand navbar-dark shadow" style="background-color: #f5faff">
        <div class="navbar-brand fs-4">

            <div class="container logo">
                <div class="row ">
                    <div class="col-sm-3">
                        <img :src="getImage()" width="50">
                    </div>
                    <div class="col-sm-3 pt-2">
                        <h5><b>KEMENKUMHAM</b></h5>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn btn-link btn-sm order-1 order-lg-0 fs-4 mt-1" id="sidebarToggle" href="#!"
            style="color: #404040;">
            <b>

                <i class="bi bi-list fw-bold"></i>
            </b>
        </button>
        <!-- <router-link to="/home">Home</router-link>
    <router-link to="/about">About</router-link>
    <router-link to="/user">User</router-link>
    <router-link to="/user/registrasi">Registrasi</router-link> -->
    </nav>
    <!-- <component :is="sidebar-component" /> -->
</template>

<style>
.logo {
    text-decoration: none;
    color: #cfcf15;
    padding-left: 20px;
    text-align: right;
}
</style>

<script>

export default {
    mounted() {
        this.getImage();
    },
    methods: {
        getImage() {
            return 'images/Logo_Lapas.png';
        }
    }
}
</script>
