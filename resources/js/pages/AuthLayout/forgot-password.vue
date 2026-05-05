<template>
    <div class="auth-forgot-page">
        <div class="forgot-box shadow-lg">
            <div class="forgot-logo text-center">
                <a :href="route('home')"><b>Lux</b>Tour</a>
            </div>
            <div class="card forgot-card border-0">
                <div class="card-body forgot-card-body p-4">
                    <p class="forgot-box-msg">Forgot your password?</p>
                    <p class="text-muted small mb-4">
                        No problem. Just let us know your email address and we
                        will email you a password reset link that will allow you
                        to choose a new one.
                    </p>

                    <!-- Success Message -->
                    <div
                        v-if="status"
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                    >
                        {{ status }}
                        <button
                            type="button"
                            class="btn-close"
                            @click="status = null"
                        ></button>
                    </div>

                    <form @submit.prevent="sendReset">
                        <!-- Email -->
                        <div
                            class="input-group mb-3 rounded-3 overflow-hidden border border-1"
                        >
                            <span
                                class="input-group-text bg-white"
                                :class="
                                    form.errors.email ? 'border-danger' : ''
                                "
                            >
                                <i
                                    class="bi bi-envelope text-primary"
                                    :class="
                                        form.errors.email ? 'text-danger' : ''
                                    "
                                ></i>
                            </span>
                            <input
                                type="email"
                                class="form-control"
                                placeholder="Email"
                                v-model="form.email"
                                :class="
                                    form.errors.email
                                        ? 'is-invalid border-danger'
                                        : ''
                                "
                                required
                            />
                        </div>
                        <div
                            v-if="form.errors.email"
                            class="text-danger small mb-3"
                        >
                            {{ form.errors.email }}
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button
                                type="submit"
                                class="btn btn-primary btn-lg"
                                :disabled="form.processing"
                            >
                                <span
                                    v-if="form.processing"
                                    class="spinner-border spinner-border-sm me-2"
                                    role="status"
                                    aria-hidden="true"
                                ></span>
                                {{
                                    form.processing
                                        ? 'Sending...'
                                        : 'Email Password Reset Link'
                                }}
                            </button>
                        </div>
                    </form>

                    <div class="forgot-footer mt-4 text-center">
                        <p class="mb-0">
                            <a :href="route('login')" class="text-secondary"
                                >Back to Login</a
                            >
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { route } from 'ziggy-js';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    status: String,
});

const status = ref(null);

const form = useForm({
    email: '',
});

const sendReset = () => {
    form.post(route('password.email'));
};
</script>

<style scoped>
.auth-forgot-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background:
        radial-gradient(
            circle at top left,
            rgba(59, 130, 246, 0.16),
            transparent 30%
        ),
        linear-gradient(135deg, #4f46e5 0%, #3b82f6 55%, #2563eb 100%);
    padding: 2rem;
}

.forgot-box {
    width: 100%;
    max-width: 420px;
    background-color: #ffffff;
    border-radius: 20px;
}

.forgot-logo a {
    display: inline-block;
    font-size: 2rem;
    font-weight: 700;
    color: #1f2937;
    letter-spacing: 0.03em;
    margin-bottom: 1rem;
    text-decoration: none;
}

.forgot-card {
    border-radius: 1.25rem;
    overflow: hidden;
    background: #ffffff;
}

.forgot-card-body {
    padding: 2rem;
}

.forgot-box-msg {
    margin-bottom: 0.5rem;
    color: #4b5563;
    font-weight: 600;
    font-size: 1.1rem;
}

.input-group-text {
    min-width: 3rem;
    justify-content: center;
    border-right: none;
}

.form-control:focus {
    box-shadow: none;
    border-color: transparent;
}

.btn-primary {
    border-radius: 0.85rem;
}

.forgot-footer a {
    color: #2563eb;
    text-decoration: none;
}

.forgot-footer a:hover {
    text-decoration: underline;
}

.btn:disabled {
    opacity: 0.6;
}

@media (max-width: 576px) {
    .auth-forgot-page {
        padding: 1.25rem;
    }
}
</style>
