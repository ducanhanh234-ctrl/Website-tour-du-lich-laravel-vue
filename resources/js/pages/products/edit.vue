<script setup>
import { reactive } from 'vue';
import Layout from '../AdminLayout/layout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    categories: Array,
    tour: Object,
});
const form = useForm({
    id: props.tour.id,
    name: props.tour.name || '',
    category_id: props.tour.category_id || '',
    description: props.tour.description || '',
    slug: props.tour.slug || '',
    is_active: props.tour.is_active?.toString() || '1',
});

const submitForm = () => {
    form.put(`/tours/${form.id}`);
};
</script>

<template>
    <Layout category="Sửa Tour">
        <template #title>Sửa Tour</template>

        <div class="card-body">
            <form @submit.prevent="submitForm">
                <!-- Tên Tour -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên Tour</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        v-model="form.name"
                    />
                    <div v-if="form.errors.name" class="text-danger mt-1">
                        {{ form.errors.name }}
                    </div>
                </div>

                <!-- Danh Mục Tour -->
                <div class="mb-3">
                    <label for="category_id" class="form-label"
                        >Danh Mục Tour</label
                    >
                    <select
                        class="form-control"
                        id="category_id"
                        v-model="form.category_id"
                    >
                        <option value="">Chọn Danh Mục</option>
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                    <div
                        v-if="form.errors.category_id"
                        class="text-danger mt-1"
                    >
                        {{ form.errors.category_id }}
                    </div>
                </div>

                <!-- Mô tả -->
                <div class="mb-3">
                    <label for="description" class="form-label">Mô Tả</label>
                    <textarea
                        class="form-control"
                        id="description"
                        rows="3"
                        v-model="form.description"
                    ></textarea>
                    <div
                        v-if="form.errors.description"
                        class="text-danger mt-1"
                    >
                        {{ form.errors.description }}
                    </div>
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input
                        type="text"
                        class="form-control"
                        id="slug"
                        v-model="form.slug"
                    />
                    <div v-if="form.errors.slug" class="text-danger mt-1">
                        {{ form.errors.slug }}
                    </div>
                </div>

                <!-- Trạng thái -->
                <div class="mb-3">
                    <label for="is_active" class="form-label">Trạng Thái</label>
                    <select
                        class="form-control"
                        id="is_active"
                        v-model="form.is_active"
                    >
                        <option value="1" :selected="form.is_active === '1'">
                            Hoạt Động
                        </option>
                        <option value="0" :selected="form.is_active === '0'">
                            Không Hoạt Động
                        </option>
                    </select>
                </div>

                <!-- Submit -->
                <button
                    type="submit"
                    class="btn btn-primary"
                    :disabled="form.processing"
                >
                    {{ form.processing ? 'Đang Sửa...' : 'Sửa Tour' }}
                </button>
            </form>
        </div>
    </Layout>
</template>
