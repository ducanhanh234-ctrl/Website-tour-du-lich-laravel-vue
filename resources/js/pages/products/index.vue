<script setup>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';
import Layout from '../AdminLayout/layout.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import debounce from 'lodash/debounce';
import Pagination_v1 from '@/components/pagination_v1.vue';
const props = defineProps({
    tours: Object,
    filters: Object,
});
const page = usePage();
const format = (format, date) => {
    return new Date(date).toLocaleDateString('vi-VN', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
    });
};
const destroyTour = async (id) => {
    if (window.confirm('Bạn có chắc muốn xóa tour này không?')) {
        await router.delete(route('tours.destroy', id));
    }
};
const search = ref(props.filters.search || '');
watch(
    search,
    debounce((value) => {
        router.get(
            route('tours.index'),
            {
                search: value,
            },
            {
                preserveState: true,
                replace: true,
            },
        );
    }, 500),
);
</script>

<template>
    <Layout :tours="tours" category="Quản Lý Danh Sách Tour">
        <template #title>Danh sách tour du lịch</template>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <Link :href="route('tours.create')" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>
                    Thêm Tour Mới
                </Link>

                <div class="w-25">
                    <input
                        type="text"
                        v-model="search"
                        class="form-control"
                        placeholder="Tìm kiếm tour..."
                    />
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Tour</th>
                        <th>Danh Mục Tour</th>
                        <th>Ngày Tạo</th>
                        <th>Ngày Cập Nhật</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="tour in tours.data" :key="tour.id">
                        <td>{{ tour.id }}</td>
                        <td>{{ tour.name }}</td>
                        <td>{{ tour.category?.name || 'Chưa có danh mục' }}</td>
                        <td>{{ format('d/m/Y H:i:s', tour.created_at) }}</td>
                        <td>{{ format('d/m/Y H:i:s', tour.updated_at) }}</td>
                        <td>
                            <Link
                                :href="route('tours.show', tour.id)"
                                class="btn btn-info btn-sm me-2"
                                >Xem</Link
                            >
                            <Link
                                :href="route('tours.edit', tour.id)"
                                class="btn btn-warning btn-sm me-2"
                                >Sửa</Link
                            >
                            <button
                                @click="destroyTour(tour.id)"
                                class="btn btn-danger btn-sm"
                            >
                                Xóa
                            </button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <Pagination_v1 :tours="tours" :search="search" />
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </Layout>
</template>
