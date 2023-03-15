<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { onMounted } from "vue";

const props = defineProps({
    ceremonies: { type: Object, default: {} },
});

function getCeremonies() {
    axios
        .get(route("api.ceremony.index"))
        .then((resp) => {
            //executed when request complete
            console.log("ceremonies", resp);
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
                            </tr>
                        </tbody>
                    </table>

                    <span class="p-buttonset">
                        <a
                            v-if="ceremonies.prev_page_url"
                            :href="ceremonies.prev_page_url"
                        >
                            <Button label="Prev" />
                        </a>
                        <a
                            v-if="ceremonies.next_page_url"
                            :href="ceremonies.next_page_url"
                        >
                            <Button label="Next" />
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
