<template>
    <section
        style=" background-image: linear-gradient(to right, #0072FF, #00C6FF) ; background-repeat:no-repeat; background-size:100%; height:100vh;">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="card w-75" style="margin-top:12%">
                    <div class="card-body">
                        <h4 style="text-align: center; "> <b>Silahkan Login</b></h4>
                        <div class="row">
                            <div class="col-md-5 bg-white d-flex justify-content-center align-self-center ">
                                <img src="images/Logo_Lapas.png" class="w-100 rounded mx-auto d-block">
                            </div>
                            <div class="col-md">
                                <form style="padding: 80px 100px;" @submit.prevent="loginForm()">
                                    <div class="mb-3">

                                        <label for="exampleInputEmail1" class="form-label " style="position:static">
                                            <p> Email address</p>
                                        </label>
                                        <input style="margin-top: -25px; border-radius:2rem" v-model="user.email"
                                            type="email" class="form-control" placeholder="Email Address" id="email" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label"
                                            style="position:static">Password</label>
                                        <input style="margin-top: -10px; border-radius:2rem" v-model="user.password"
                                            type="password" class="form-control" placeholder="Password" id="password" />

                                    </div>
                                    <button type="submit" class="btn mx-auto d-block "
                                        style="background-color:#289138; width:50%; text-align:center; border-radius:2rem; color:white">Login</button>
                                                                       <router-link type="text" v-bind:to="{ name: 'Registrasi' }"><u>create an account</u>
                                    </router-link>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style>
.input-login {
    position: relative;
}

input {
    display: block;
    padding: 10px;
    border: none;
    outline: none;
    border-radius: 4px;
    font: inherit;
}

label {
    position: absolute;
    top: -30px;
    left: -26px;
    display: inline-flex;
    column-gap: 10px;
    align-items: center;
    transition: transform 0.25s, opacity 0.25s;
}

.icon {
    display: inline-flex;
    opacity: 0;
}

input:focus+label {
    transform: translateX(26px);
}

input:focus+label .icon {
    opacity: 1;
    transition-delay: 0.1s;
}

input::placeholder {
    transition: opacity 0.25s;
}

input:focus::placeholder {
    opacity: 0;
}
</style>

<script>
import { reactive, ref } from "vue";
// import VueRouter from 'vue-router';
import axios from "axios";
import router from "../router";
import { EventBus } from "../app";
export default {
    setup() {
        //inisialisasi vue router on Composition API
        // const router = VueRouter();

        //state user
        const user = reactive({
            email: "",
            password: "",
            message: "",
        });

        // inisialisasi emit variabel ke App
        // const emit = defineEmits(["muncul"]);

        //state validation
        const validation = ref([]);

        //state loginFailed
        const loginFailed = ref(null);

        // method login
        function loginForm() {
            //define variable
            let email = user.email;
            let password = user.password;

            //send server with axios
            axios
                .post("/api/auth/login", {
                    email,
                    password,
                })
                .then((response) => {
                    // console.log(response.data);
                    // if (response.data.success) {
                    //set token
                    
                    localStorage.setItem("JWToken", response.data.user.original.access_token);
                    localStorage.setItem("roleUser", response.data.user.original.user.lvl_user);
                    localStorage.setItem("idPegawai", response.data.user.original.user.id_pegawai);
                    localStorage.setItem("idUser", response.data.user.original.user.id);
                    localStorage.setItem("email", response.data.user.original.user.email);
                    localStorage.setItem("name", response.data.pegawai.nama);
                    localStorage.setItem("nip", response.data.pegawai.nip);
                    EventBus.$emit('loggedIn', true);

                    //redirect ke halaman dashboard
                    router.push({
                        name: "LandingPage",
                    });
                    //set state loggedIn to true
                    loginFailed.value = true;
                })
                .catch((error) => {
                    //set validation dari error response
                    validation.value = error.response.data;
                });
        }
        return {
            user, // <-- state user
            validation, // <-- state validation
            loginFailed, // <-- state loggedIn
            loginForm, // <-- method login
        };
    },
};
</script>