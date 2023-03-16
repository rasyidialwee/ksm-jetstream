<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref, onMounted } from "vue";

const ceremonies = ref({});

function getCeremonies() {
    axios
        .get(route("api.ceremonies.index"))
        .then((resp) => {
            //executed when request complete
            console.log("ceremonies", resp);
            ceremonies.value = resp.data;
        })
        .catch((err) => {
            // executed when response is error
            console.error("err", err);
        })
        .finally(() => {
            //always executed
            console.log("end");
        });
}

function changePage(url) {
    axios
        .get(url)
        .then((resp) => {
            //executed when request complete
            console.log("ceremonies", resp);
            ceremonies.value = resp.data;
        })
        .catch((err) => {
            // executed when response is error
            console.error("err", err);
        })
        .finally(() => {
            //always executed
            console.log("end");
        });
}

function remove(ceremony) {
    axios
        .delete(route("api.ceremonies.destroy", ceremony))
        .then((resp) => {
            console.log("deleted", resp);
        })
        .catch((err) => {
            // executed when response is error
            console.error("err", err);
        })
        .finally(() => {
            //always executed
            getCeremonies();
        });
}

onMounted(() => {
    getCeremonies();
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Senarai Ceremony
            </h2>
            <a :href="route('ceremonies.create')">
                <Button label="Tambah" />
            </a>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Penerangan</th>
                                <th>Gambar</th>
                                <th>Tarikh dan Masa Mula</th>
                                <th>Tarikh dan Masa Tamat</th>
                                <th>::</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(ceremony, index) in ceremonies.data"
                                :key="index"
                            >
                                <td>{{ ceremony.name }}</td>
                                <td>{{ ceremony.description }}</td>
                                <td>
                                    <img :src="ceremony.image_name" alt="" />
                                </td>
                                <td>{{ ceremony.start_date }}</td>
                                <td>{{ ceremony.end_date }}</td>
                                <td>
                                    <Button
                                        label="Delete"
                                        severity="danger"
                                        @click.prevent="remove(ceremony)"
                                    />
                                    <a
                                        :href="
                                            route('ceremonies.edit', ceremony)
                                        "
                                    >
                                        <Button
                                            label="Edit"
                                            severity="warning"
                                        />
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <span class="p-buttonset">
                        <Button
                            label="Prev"
                            @click.prevent="
                                changePage(ceremonies.prev_page_url)
                            "
                        />
                        <Button
                            label="Next"
                            @click.prevent="
                                changePage(ceremonies.next_page_url)
                            "
                        />
                    </span>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
