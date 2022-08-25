<template >
    <div 
        style="width: 100%;height:100vh;  background-image: linear-gradient(to right, #0072FF, #00C6FF) ; background-repeat:no-repeat; background-size:100%; ">
        <div class="container rounded d-flex justify-content-center">
            <div class="card w-75 shadow" style="margin-top:12%">
                <div class="card-body">
                    <h2 class="shadow p-3 border rounded" style="text-align: center; "> PILIH PENILAIAN </h2>
                    <div class="row">
                        <div v-if="role == 1" class="list-group p-3 mt-5">
                            <router-link to="/home"
                                class=" list-group-item list-group-item-action text-center fs-3 pilih"> VOCS
                            </router-link>
                            <router-link to="/Speedec"
                                class=" list-group-item list-group-item-action text-center fs-3 pilih"> SPEEDEC
                            </router-link>
                            <router-link to="/proact"
                                class=" list-group-item list-group-item-action text-center fs-3 pilih"> PROACT
                            </router-link>
                            <router-link to="/xrole"
                                class=" list-group-item list-group-item-action text-center fs-3 pilih"> XROLE
                            </router-link>
                        </div>
                        <div v-else-if="role == 0" class="list-group p-3 mt-5">
                            <router-link to="/user/home"
                                class=" list-group-item list-group-item-action text-center fs-3 pilih"> VOCS
                            </router-link>
                            <router-link to="/Speedec"
                                class=" list-group-item list-group-item-action text-center fs-3 pilih"> SPEEDEC
                            </router-link>
                            <router-link to="/proact"
                                class=" list-group-item list-group-item-action text-center fs-3 pilih"> PROACT
                            </router-link>
                            <router-link to="/xrole"
                                class=" list-group-item list-group-item-action text-center fs-3 pilih"> XROLE
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.pilih:hover {
    background-color: #0d6efd;
    color: white;
}
</style>
<script>
export default {
    data() {
        return {
            role: null,
        }
    },
    mounted() {
        this.role = localStorage.getItem('roleUser')
        console.log(this.role);
    }
}
</script>