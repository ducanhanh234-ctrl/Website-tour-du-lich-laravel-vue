<script setup>
import { Link, usePage } from '@inertiajs/vue3';

defineProps({
    tours: Object,
    search: String,
});
</script>

<template>
    <div class="text-primary small d-flex justify-content-end">
        Hiển thị {{ tours.from }} - {{ tours.to }} / {{ tours.total }} kết quả
    </div>
    <nav class="mt-3 d-flex justify-content-end">
        <ul class="pagination">
            <!-- Previous -->
            <li class="page-item" :class="{ disabled: !tours.prev_page_url }">
                <Link class="page-link" :href="tours.prev_page_url || ''">
                    « Previous
                </Link>
            </li>

            <!-- Pages -->
            <template v-for="page in tours.last_page" :key="page">
                <!-- First page -->
                <li
                    v-if="
                        page === 1 ||
                        page === tours.last_page ||
                        Math.abs(page - tours.current_page) <= 1
                    "
                    class="page-item"
                    :class="{ active: page === tours.current_page }"
                >
                    <Link
                        class="page-link"
                        :href="route('tours.index', { page, search })"
                    >
                        {{ page }}
                    </Link>
                </li>

                <!-- Dots -->
                <li
                    v-else-if="
                        page === tours.current_page - 2 ||
                        page === tours.current_page + 2
                    "
                    class="page-item disabled"
                >
                    <span class="page-link">...</span>
                </li>
            </template>

            <!-- Next -->
            <li class="page-item" :class="{ disabled: !tours.next_page_url }">
                <Link class="page-link" :href="tours.next_page_url || ''">
                    Next »
                </Link>
            </li>
        </ul>
    </nav>
</template>

<style scoped></style>
