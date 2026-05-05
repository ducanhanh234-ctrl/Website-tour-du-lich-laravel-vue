<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Layout from '../AdminLayout/layout.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
defineProps({
    tours: Array,
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
</script>

<template>
    <Layout :tours="tours" category="Quản Lý Danh Sách Tour">
        <template #title>Danh sách tour du lịch</template>
        <div class="card-body">
            <Link :href="route('tours.create')" class="btn btn-primary mb-3"
                >Thêm Tour Mới
            </Link>
            <table class="table-bordered table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Tour</th>
                        <th>Loại</th>
                        <th>Ngày Tạo</th>
                        <th>Ngày Cập Nhật</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="tour in tours" :key="tour.id">
                        <td>{{ tour.id }}</td>
                        <td>{{ tour.name }}</td>
                        <td>{{ tour.type }}</td>
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
                                @click="
                                    router.delete(
                                        route('tours.destroy', tour.id),
                                    )
                                "
                                class="btn btn-danger btn-sm"
                            >
                                Xóa
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </Layout>
</template>
