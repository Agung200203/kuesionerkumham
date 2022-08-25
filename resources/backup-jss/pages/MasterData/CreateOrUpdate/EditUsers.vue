<template>
    <div>
        <div v-if="id">
            <form @submit.prevent="handleUpdate">
                <b-card-group deck>
                    <b-card header>
                        <template #header>
                            <h3 class="mb-0">Edit Data</h3>
                        </template>
                        <b-card-text
                            ><b-container fluid="sm">
                                <b-row>
                                    <b-col>Nama * </b-col>
                                </b-row>
                                <b-row class="pt-2">
                                    <b-col>
                                        <input
                                            class="form-control"
                                            v-model="user.name"
                                            type="text"
                                            placeholder=""
                                            aria-label="default input example"
                                        />
                                    </b-col>
                                    <div class="error" v-if="errors.name">
                                        {{ errors.name[0] }}
                                    </div>
                                </b-row>
                                <b-row class="pt-2">
                                    <b-col>Email *</b-col>
                                </b-row>
                                <b-row class="pt-2">
                                    <b-col
                                        ><input
                                            class="form-control"
                                            v-model="user.email"
                                            type="text"
                                            placeholder=""
                                            aria-label="default input example"
                                        />
                                    </b-col>
                                    <div class="error" v-if="errors.email">
                                        {{ errors.email[0] }}
                                    </div>
                                </b-row>
                                <div class="pt-2">
                                    <button type="submit" class="button">
                                        Simpan
                                    </button>
                                </div>
                            </b-container></b-card-text
                        >
                    </b-card>
                </b-card-group>
            </form>
        </div>

        <div v-else>
            <form @submit.prevent="handleSubmit">
                <b-card-group deck>
                    <b-card header>
                        <template #header>
                            <h3 class="mb-0">Tambah Data</h3>
                        </template>
                        <b-card-text
                            ><b-container fluid="sm">
                                <b-row>
                                    <b-col>Nama * </b-col>
                                </b-row>
                                <b-row class="pt-2">
                                    <b-col>
                                        <input
                                            class="form-control"
                                            v-model="user.name"
                                            type="text"
                                            placeholder=""
                                            aria-label="default input example"
                                        />
                                    </b-col>
                                    <div class="error" v-if="errors.name">
                                        {{ errors.name[0] }}
                                    </div>
                                </b-row>
                                <b-row class="pt-2">
                                    <b-col>Email *</b-col>
                                </b-row>
                                <b-row class="pt-2">
                                    <b-col
                                        ><input
                                            class="form-control"
                                            v-model="user.email"
                                            type="text"
                                            placeholder=""
                                            aria-label="default input example"
                                        />
                                    </b-col>
                                    <div class="error" v-if="errors.email">
                                        {{ errors.email[0] }}
                                    </div>
                                </b-row>
                                <b-row class="pt-2">
                                    <b-col>Password *</b-col>
                                </b-row>
                                <b-row class="pt-2">
                                    <b-col
                                        ><input
                                            class="form-control"
                                            v-model="user.password"
                                            type="text"
                                            placeholder=""
                                            aria-label="default input example"
                                        />
                                    </b-col>
                                    <div class="error" v-if="errors.password">
                                        {{ errors.password[0] }}
                                    </div>
                                </b-row>
                                <div class="pt-2">
                                    <button type="submit" class="button">
                                        Simpan
                                    </button>
                                </div>
                            </b-container></b-card-text
                        >
                    </b-card>
                </b-card-group>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: ["id"],
    data() {
        return {
            user: {
                name: "",
                email: "",
                password: "",
            },
            errors: {},
        };
    },
    methods: {
        handleSubmit() {
            console.log(this.user);
            axios
                .post("/api/users", this.user)
                .then((response) => {
                    if (response.data.status) {
                        console.log(response);

                        this.$noty.success(response.data.message);
                        this.$router.push({
                            name: "User",
                        });
                    }
                })
                .catch((error) => {
                    if (error.response.status == 403) {
                        this.errors = error.response.data.message;
                    }
                });
        },
        handleUpdate() {
            axios
                .put("/api/users/" + this.id, this.user)
                .then((response) => {
                    if (response.data.status) {
                        this.$noty.success(response.data.message);
                        this.$router.push({
                            name: "User",
                        });
                    }
                })
                .catch((error) => {
                    if (error.response.status == 403) {
                        this.errors = error.response.data.message;
                    }
                });
        },
        getUser() {
            axios.get("/api/users/" + this.id).then((response) => {
                console.log(response);
                this.user = {
                    name: response.data.name,
                    email: response.data.email,
                };
            });
        },
    },
    mounted() {
        this.getUser();
    },
};
</script>

<style>
.input {
    margin-bottom: 5px;
}
.button {
    display: inline-block;
    margin: 0;
    padding: 0.75rem 1rem;
    border: 0;
    border-radius: 0.317rem;
    background-color: #aaa;
    color: #fff;
    text-decoration: none;
    font-weight: 700;
    font-size: 1rem;
    line-height: 1;
    font-family: "Helvetica Neue", Arial, sans-serif;
    cursor: pointer;
    -webkit-appearance: none;
    -webkit-font-smoothing: antialiased;
}

.button:hover {
    opacity: 0.85;
}

.button:active {
    box-shadow: inset 0 3px 4px hsla(0, 0%, 0%, 0.2);
}

.button:focus {
    outline: thin dotted #444;
    outline: 5px auto -webkit-focus-ring-color;
    outline-offset: -2px;
}

.button_primary {
    background-color: #1fa3ec;
}

.button_secondary {
    background-color: #e98724;
}
</style>
