<template>
    <div>
        <div v-if="isLoggedIn == true && this.$router.currentRoute.name != 'Login' && this.$router.currentRoute.name != 'LandingPage'">
            <sidebar-component></sidebar-component>
            <div id="layoutSidenav">
                <div id="layoutSidenav_content">
                    <div class="container-xxl" style="padding-top: 50px">
                        <!-- main -->
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import { EventBus } from "../app";
export default {
    data() {
        return {
            user: null,
            isLoggedIn: false,
            muncul: false,
        };
    },
    methods: {
        eventbus(){
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
        this.eventbus();
        this.setUser();
        // console.log("Name of The App is"+process.env.MIX_APP_NAME);
    },
};
</script>