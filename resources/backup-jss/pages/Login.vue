<template>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4 style="text-align: center; color: #0dcaf0">
                            LOGIN
                        </h4>
                        <hr />
                        <form>
                            <div class="input-login mt-5">
                                <input
                                    type="email"
                                    class="form-control"
                                    placeholder="Email Address"
                                    id="email"
                                />
                                <label for="email">
                                    <span class="icon"
                                        ><i class="bi bi-envelope"></i
                                    ></span>
                                    Email address
                                </label>
                            </div>

                            <div class="input-login mt-5 pb-3">
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Password"
                                    id="password"
                                />
                                <label for="password">
                                    <span class="icon"
                                        ><i class="bi bi-key-fill"></i
                                    ></span>
                                    Password</label
                                >
                            </div>
                            <div class="d-flex justify-content-center">
                                <button
                                    type="submit"
                                    class="btn btn-outline-info"
                                    style="width: 400px"
                                >
                                    LOGIN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
input:focus + label {
    transform: translateX(26px);
}
input:focus + label .icon {
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

<script setup>
import {reactive, ref} from 'vue';
import axios from 'axios';
// import router from '@/router';
import router from '../router';
</script>
