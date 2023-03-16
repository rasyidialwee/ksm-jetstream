<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref, reactive } from "vue";
import useVuelidate from "@vuelidate/core";
import { required } from "@vuelidate/validators";

const props = defineProps({
    ceremony: {
        type: Object,
        default: null,
    },
});

const form = reactive({
    name: props.ceremony ? props.ceremony.name : null,
    description: props.ceremony ? props.ceremony.description : null,
    image_name: props.ceremony ? props.ceremony.image_name : null,
    start_date: props.ceremony ? props.ceremony.start_date : null,
    end_date: props.ceremony ? props.ceremony.end_date : null,
});

const rules = {
    name: { required },
    description: { required },
    image_name: { required },
    start_date: { required },
    end_date: { required },
};

const v$ = useVuelidate(rules, form, { $autoDirty: true });

const errors = ref({});

function submit() {
    props.ceremony ? update() : store();
}

function store() {
    axios
        .post(route("api.ceremonies.store", form))
        .then((resp) => {
            //executed when request complete
            console.log("data berjaya dimasukkan", resp);
        })
        .catch((err) => {
            if (err.response.status === 422) {
                errors.value = err.response.data.errors;
            }
        })
        .finally(() => {
            //always executed
            console.log("end");
        });
}

function update() {
    axios
        .patch(route("api.ceremonies.update", props.ceremony), form)
        .then((resp) => {
            //executed when request complete
            console.log("data berjaya dimasukkan", resp);
        })
        .catch((err) => {
            if (err.response.status === 422) {
                errors.value = err.response.data.errors;
            }
        })
        .finally(() => {
            //always executed
            console.log("end");
        });
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ ceremony !== null ? "Kemaskini" : "Tambah" }} Ceremony
            </h2>
        </template>

        <div v-for="(error, index) in errors" :key="index" class="my-3">
            <div v-for="(message, index) in error" :key="index">
                <p>{{ message }}</p>
            </div>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div>
                        <label for="">Name</label>
                        <input type="text" v-model="form.name" />
                        <div v-if="v$.name.$invalid">
                            <p
                                v-for="(error, index) in v$.name.$errors"
                                :key="index"
                            >
                                {{ error.$message }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <label for="">Description</label>
                        <input type="text" v-model="form.description" />
                        <div v-if="v$.description.$invalid">
                            <p
                                v-for="(error, index) in v$.description.$errors"
                                :key="index"
                            >
                                {{ error.$message }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <label for="">Image</label>
                        <input type="text" v-model="form.image_name" />
                    </div>

                    <div>
                        <label for="">Start Date</label>
                        <input
                            type="datetime-local"
                            v-model="form.start_date"
                        />
                    </div>

                    <div>
                        <label for="">End Date</label>
                        <input type="datetime-local" v-model="form.end_date" />
                    </div>

                    <Button label="Simpan" @click="submit" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
