<script setup>
import Layout from '../AdminLayout/layout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    tour: Object,
});
</script>

<template>
    <Layout :category="'Chi tiết tour'">
        <template #title>Chi tiết tour</template>

        <div class="mt-4 container">
            <div class="row">
                <!-- LEFT -->
                <div class="col-md-8">
                    <div
                        class="card shadow-lg rounded-4 overflow-hidden border-0"
                    >
                        <!-- IMAGE -->
                        <img
                            :src="
                                tour.image ||
                                'https://via.placeholder.com/800x400'
                            "
                            class="w-100"
                            style="height: 400px; object-fit: cover"
                        />

                        <div class="card-body p-4">
                            <h2 class="fw-bold mb-2">{{ tour.name }}</h2>

                            <span class="badge bg-primary mb-3">
                                {{ tour.type }}
                            </span>

                            <h4 class="text-danger fw-bold">
                                {{ tour.price }} VNĐ
                            </h4>

                            <hr />

                            <h5 class="fw-semibold">Mô tả</h5>
                            <p class="text-muted">
                                {{ tour.description || 'Chưa có mô tả' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDEBAR -->
                <div class="col-md-4">
                    <div class="card shadow-sm rounded-4 p-3 border-0">
                        <h5 class="fw-bold mb-3">Thông tin nhanh</h5>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                ⏳ Thời gian:
                                <strong>{{
                                    tour.duration || '3 ngày 2 đêm'
                                }}</strong>
                            </li>
                            <li class="list-group-item">
                                📍 Địa điểm:
                                <strong>{{
                                    tour.location || 'Việt Nam'
                                }}</strong>
                            </li>
                            <li class="list-group-item">
                                👥 Số người:
                                <strong>{{
                                    tour.capacity || '10-20 người'
                                }}</strong>
                            </li>
                        </ul>

                        <button class="btn btn-danger w-100 mt-3">
                            Đặt tour ngay
                        </button>

                        <Link
                            :href="route('tours.index')"
                            class="btn btn-outline-secondary w-100 mt-2"
                        >
                            ← Quay lại
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
