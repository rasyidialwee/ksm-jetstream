<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref, reactive } from "vue";

const form = reactive({
    name: null,
    description: null,
    image_name: null,
    start_date: null,
    end_date: null,
});

const errors = ref({});

function submit() {
    console.log("form", form);
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
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Tambah Ceremony
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
                    </div>

                    <div>
                        <label for="">Description</label>
                        <input type="text" v-model="form.description" />
                    </div>

                    <div>
                        <label for="">Image</label>
                        <input type="text" v-model="form.image_name" />
                    </div>

                    <div>
                        <label for="">Start Date</label>
                        <input type="date" v-model="form.start_date" />
                    </div>

                    <div>
                        <label for="">End Date</label>
                        <input type="date" v-model="form.end_date" />
                    </div>

                    <Button label="Simpan" @click="submit" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
