<template>
    <div class="auth-register-page">
        <div class="register-box shadow-lg">
            <div class="register-logo text-center">
                <a :href="route('home')"><b>Lux</b>Tour</a>
            </div>
            <div class="card register-card border-0">
                <div class="card-body register-card-body p-4">
                    <p class="register-box-msg">Register a new membership</p>

                    <form @submit.prevent="register">
                        <!-- Full Name -->
                        <div
                            class="input-group mb-3 rounded-3 overflow-hidden border border-1"
                        >
                            <span
                                class="input-group-text bg-white"
                                :class="form.errors.name ? 'border-danger' : ''"
                            >
                                <i
                                    class="bi bi-person text-primary"
                                    :class="
                                        form.errors.name ? 'text-danger' : ''
                                    "
                                ></i>
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Full Name"
                                v-model="form.name"
                                :class="
                                    form.errors.name
                                        ? 'is-invalid border-danger'
                                        : ''
                                "
                            />
                        </div>
                        <div
                            v-if="form.errors.name"
                            class="text-danger small mb-2"
                        >
                            {{ form.errors.name }}
                        </div>

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

                        <!-- Terms Checkbox -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    v-model="form.terms"
                                    id="termsCheckbox"
                                />
                                <label
                                    class="form-check-label small text-muted"
                                    for="termsCheckbox"
                                >
                                    I agree to the
                                    <a href="#" class="text-primary"
                                        >terms and conditions</a
                                    >
                                </label>
                            </div>
                            <div
                                v-if="form.errors.terms"
                                class="text-danger small mt-1"
                            >
                                {{ form.errors.terms }}
                            </div>
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
                                        ? 'Registering...'
                                        : 'Register'
                                }}
                            </button>
                        </div>
                    </form>

                    <div class="social-auth-links mb-3 text-center">
                        <p class="mb-3 text-muted">- OR -</p>
                        <a href="#" class="btn btn-outline-primary w-100 mb-2">
                            <i class="bi bi-facebook me-2"></i> Sign up using
                            Facebook
                        </a>
                        <a href="#" class="btn btn-outline-danger w-100">
                            <i class="bi bi-google me-2"></i> Sign up using
                            Google+
                        </a>
                    </div>

                    <div class="login-footer text-center">
                        <p class="mb-0">
                            <a :href="route('login')" class="text-secondary"
                                >I already have a membership</a
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

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const showPassword = ref(false);
const showConfirmPassword = ref(false);

const togglePassword = () => {
    showPassword.value = !showPassword.value;
};

const toggleConfirmPassword = () => {
    showConfirmPassword.value = !showConfirmPassword.value;
};

const register = () => {
    form.post(route('register'));
};
</script>

<style scoped>
.auth-register-page {
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

.register-box {
    width: 100%;
    max-width: 450px;
    background-color: #ffffff;
    border-radius: 20px;
}

.register-logo a {
    display: inline-block;
    font-size: 2rem;
    font-weight: 700;
    color: #1f2937;
    letter-spacing: 0.03em;
    margin-bottom: 1rem;
    text-decoration: none;
}

.register-card {
    border-radius: 1.25rem;
    overflow: hidden;
    background: #ffffff;
}

.register-card-body {
    padding: 2rem;
}

.register-box-msg {
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

.btn-outline-primary,
.btn-outline-danger {
    border-radius: 0.85rem;
    padding-top: 0.8rem;
    padding-bottom: 0.8rem;
}

.social-auth-links p {
    color: #6b7280;
}

.login-footer a {
    color: #2563eb;
    text-decoration: none;
}

.login-footer a:hover {
    text-decoration: underline;
}

.cursor-pointer {
    cursor: pointer;
}

.btn:disabled {
    opacity: 0.6;
}

@media (max-width: 576px) {
    .auth-register-page {
        padding: 1.25rem;
    }

    .register-box {
        max-width: 100%;
    }
}
</style>
