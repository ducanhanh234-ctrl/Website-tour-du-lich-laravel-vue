<template>
    <div class="auth-reset-page">
        <div class="reset-box shadow-lg">
            <div class="reset-logo text-center">
                <a :href="route('home')"><b>Lux</b>Tour</a>
            </div>
            <div class="card reset-card border-0">
                <div class="card-body reset-card-body p-4">
                    <p class="reset-box-msg">Reset Password</p>

                    <form @submit.prevent="resetPassword">
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
                            class="text-danger small mb-2"
                        >
                            {{ form.errors.email }}
                        </div>

                        <!-- Password -->
                        <div
                            class="input-group mb-3 rounded-3 overflow-hidden border border-1"
                        >
                            <span
                                class="input-group-text bg-white"
                                :class="
                                    form.errors.password ? 'border-danger' : ''
                                "
                            >
                                <i
                                    class="bi bi-lock-fill text-primary"
                                    :class="
                                        form.errors.password
                                            ? 'text-danger'
                                            : ''
                                    "
                                ></i>
                            </span>
                            <input
                                :type="showPassword ? 'text' : 'password'"
                                class="form-control"
                                placeholder="Password"
                                v-model="form.password"
                                :class="
                                    form.errors.password ? 'border-danger' : ''
                                "
                                required
                            />
                            <button
                                type="button"
                                class="input-group-text bg-white cursor-pointer"
                                @click="togglePassword"
                                :class="
                                    form.errors.password ? 'border-danger' : ''
                                "
                            >
                                <i
                                    :class="[
                                        showPassword
                                            ? 'bi bi-eye text-primary'
                                            : 'bi bi-eye-slash text-muted',
                                        form.errors.password
                                            ? 'text-danger'
                                            : '',
                                    ]"
                                ></i>
                            </button>
                        </div>
                        <div
                            v-if="form.errors.password"
                            class="text-danger small mb-2"
                        >
                            {{ form.errors.password }}
                        </div>

                        <!-- Confirm Password -->
                        <div
                            class="input-group mb-4 rounded-3 overflow-hidden border border-1"
                        >
                            <span
                                class="input-group-text bg-white"
                                :class="
                                    form.errors.password_confirmation
                                        ? 'border-danger'
                                        : ''
                                "
                            >
                                <i
                                    class="bi bi-lock-fill text-primary"
                                    :class="
                                        form.errors.password_confirmation
                                            ? 'text-danger'
                                            : ''
                                    "
                                ></i>
                            </span>
                            <input
                                :type="
                                    showConfirmPassword ? 'text' : 'password'
                                "
                                class="form-control"
                                placeholder="Confirm Password"
                                v-model="form.password_confirmation"
                                :class="
                                    form.errors.password_confirmation
                                        ? 'border-danger'
                                        : ''
                                "
                                required
                            />
                            <button
                                type="button"
                                class="input-group-text bg-white cursor-pointer"
                                @click="toggleConfirmPassword"
                                :class="
                                    form.errors.password_confirmation
                                        ? 'border-danger'
                                        : ''
                                "
                            >
                                <i
                                    :class="[
                                        showConfirmPassword
                                            ? 'bi bi-eye text-primary'
                                            : 'bi bi-eye-slash text-muted',
                                        form.errors.password_confirmation
                                            ? 'text-danger'
                                            : '',
                                    ]"
                                ></i>
                            </button>
                        </div>
                        <div
                            v-if="form.errors.password_confirmation"
                            class="text-danger small mb-2"
                        >
                            {{ form.errors.password_confirmation }}
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
                                        ? 'Resetting...'
                                        : 'Reset Password'
                                }}
                            </button>
                        </div>
                    </form>

                    <div class="reset-footer mt-4 text-center">
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

const props = defineProps({
    token: String,
    email: String,
});

const showPassword = ref(false);
const showConfirmPassword = ref(false);

const form = useForm({
    token: props.token,
    email: props.email || '',
    password: '',
    password_confirmation: '',
});

const togglePassword = () => {
    showPassword.value = !showPassword.value;
};

const toggleConfirmPassword = () => {
    showConfirmPassword.value = !showConfirmPassword.value;
};

const resetPassword = () => {
    form.post(route('password.update'));
};
</script>

<style scoped>
.auth-reset-page {
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

.reset-box {
    width: 100%;
    max-width: 420px;
    background-color: #ffffff;
    border-radius: 20px;
}

.reset-logo a {
    display: inline-block;
    font-size: 2rem;
    font-weight: 700;
    color: #1f2937;
    letter-spacing: 0.03em;
    margin-bottom: 1rem;
    text-decoration: none;
}

.reset-card {
    border-radius: 1.25rem;
    overflow: hidden;
    background: #ffffff;
}

.reset-card-body {
    padding: 2rem;
}

.reset-box-msg {
    margin-bottom: 1.75rem;
    color: #4b5563;
    font-weight: 600;
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

.reset-footer a {
    color: #2563eb;
    text-decoration: none;
}

.reset-footer a:hover {
    text-decoration: underline;
}

.cursor-pointer {
    cursor: pointer;
}

.btn:disabled {
    opacity: 0.6;
}

@media (max-width: 576px) {
    .auth-reset-page {
        padding: 1.25rem;
    }
}
</style>
