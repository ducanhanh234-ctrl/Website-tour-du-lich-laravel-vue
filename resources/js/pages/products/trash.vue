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
const restoreTour = (id) => {
    if (confirm('Bạn có muốn khôi phục tour này không?')) {
        router.put(route('tours.restore', id));
    }
};
const destroyTour = (id) => {
    if (confirm('Bạn có chắc muốn xóa tour này không?')) {
        router.delete(route('tours.forceDelete', id));
    }
};
const destroyAll = (id) => {
    if (confirm('Bạn có chắc muốn xóa tất cả tour đã xóa không?')) {
        router.delete(route('tours.forceDeleteAll', id));
    }
};
const search = ref(props.filters.search || '');
watch(
    search,
    debounce((value) => {
        router.get(
            route('tours.trash'),
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
        <template #title>Danh sách các tour đã xóa</template>
        <div class="card-body">
            <div
                class="d-flex justify-content-between align-items-center gap-3 mb-3 flex-wrap"
            >
                <!-- Nhóm nút -->
                <div class="d-flex gap-2">
                    <Link :href="route('tours.index')" class="btn btn-primary">
                        <i class="bi bi-arrow-left me-1"></i>
                        Quay Lại
                    </Link>

                    <button class="btn btn-danger" @click="destroyAll(1)">
                        <i class="bi bi-trash"></i>
                        Xóa Tất Cả
                    </button>
                </div>

                <!-- Ô tìm kiếm -->
                <div style="min-width: 300px; max-width: 400px; width: 100%">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>

                        <input
                            type="text"
                            v-model="search"
                            class="form-control"
                            placeholder="Tìm kiếm tour..."
                        />
                    </div>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mã Tour</th>
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
                        <td>{{ tour.tour_code }}</td>
                        <td>{{ tour.name }}</td>
                        <td>{{ tour.category?.name || 'Chưa có danh mục' }}</td>
                        <td>{{ format('d/m/Y H:i:s', tour.created_at) }}</td>
                        <td>{{ format('d/m/Y H:i:s', tour.updated_at) }}</td>
                        <td>
                            <button
                                class="btn btn-success btn-sm me-2"
                                @click="restoreTour(tour.id)"
                            >
                                Khôi Phục
                            </button>
                            <button
                                @click="destroyTour(tour.id)"
                                class="btn btn-danger btn-sm"
                            >
                                Xóa vĩnh viễn
                            </button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <Pagination_v1 :tours="tours" :search="search" />
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </Layout>
</template>
