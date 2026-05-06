<script setup>
import { ref } from 'vue';
import Layout from '../AdminLayout/layout.vue';
import { Link, router } from '@inertiajs/vue3';

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
                    <div class="card shadow-lg rounded-4 border-0">
                        <div class="card-body p-4">
                            <!-- NAME -->
                            <h2 class="fw-bold mb-3">{{ tour.name }}</h2>

                            <!-- STATUS -->
                            <span
                                class="badge mb-3"
                                :class="
                                    tour.is_active
                                        ? 'bg-success'
                                        : 'bg-secondary'
                                "
                            >
                                {{
                                    tour.is_active
                                        ? 'Hoạt Động'
                                        : 'Không Hoạt Động'
                                }}
                            </span>

                            <!-- SLUG -->
                            <p class="text-muted mb-2">
                                <strong>Slug:</strong> {{ tour.slug }}
                            </p>

                            <!-- CATEGORY -->
                            <p class="mb-3">
                                <strong>Danh mục:</strong>
                                {{ tour.category?.name || 'Chưa có' }}
                            </p>

                            <hr />

                            <!-- DESCRIPTION -->
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
                                🆔 ID:
                                <strong>{{ tour.id }}</strong>
                            </li>

                            <li class="list-group-item">
                                📂 Danh mục:
                                <strong>
                                    {{ tour.category?.name || 'Chưa có' }}
                                </strong>
                            </li>

                            <li class="list-group-item">
                                🔗 Slug:
                                <strong>{{ tour.slug }}</strong>
                            </li>

                            <li class="list-group-item">
                                📊 Trạng thái:
                                <strong>
                                    {{
                                        tour.is_active
                                            ? 'Hoạt Động'
                                            : 'Không Hoạt Động'
                                    }}
                                </strong>
                            </li>
                        </ul>

                        <Link
                            :href="route('tours.index')"
                            class="btn btn-outline-secondary w-100 mt-3"
                        >
                            ← Quay lại
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
