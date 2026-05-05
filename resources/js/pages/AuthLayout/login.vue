<template>
    <div class="auth-login-page">
        <div class="login-box shadow-lg">
            <div class="login-logo text-center">
                <a :href="route('home')"><b>Lux</b>Tour</a>
            </div>
            <div class="card login-card border-0">
                <div class="card-body login-card-body p-4">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form @submit.prevent="login">
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
                            class="input-group mb-4 rounded-3 overflow-hidden border border-1"
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
                            v-if="form.errors.email || form.errors.password"
                            class="text-danger mt-1"
                        >
                            Sai email hoặc mật khẩu
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="col-sm-7">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        v-model="form.remember"
                                        id="flexCheckDefault"
                                    />
                                    <label
                                        class="form-check-label small text-muted"
                                        for="flexCheckDefault"
                                    >
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-lg w-100"
                                >
                                    Sign In
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="social-auth-links mb-3 text-center">
                        <p class="mb-3 text-muted">- OR -</p>
                        <a href="#" class="btn btn-outline-primary w-100 mb-2">
                            <i class="bi bi-facebook me-2"></i> Sign in using
                            Facebook
                        </a>
                        <a href="#" class="btn btn-outline-danger w-100">
                            <i class="bi bi-google me-2"></i> Sign in using
                            Google+
                        </a>
                    </div>

                    <div class="login-footer text-center">
                        <p class="mb-1">
                            <a :href="route('password.request')"
                                >I forgot my password</a
                            >
                        </p>
                        <p class="mb-0">
                            <a :href="route('register')" class="text-secondary"
                                >Register a new membership</a
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
    email: '',
    password: '',
    remember: false,
});

const showPassword = ref(false);

const togglePassword = () => {
    showPassword.value = !showPassword.value;
};

const login = () => {
    // Login logic here
    form.post(route('login'));
};
</script>

<style scoped>
.auth-login-page {
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

.login-box {
    width: 100%;
    max-width: 420px;
    background-color: #ffffff;
    border-radius: 20px;
}

.login-logo a {
    display: inline-block;
    font-size: 2rem;
    font-weight: 700;
    color: #1f2937;
    letter-spacing: 0.03em;
    margin-bottom: 1rem;
    text-decoration: none;
}

.login-card {
    border-radius: 1.25rem;
    overflow: hidden;
    background: #ffffff;
}

.login-card-body {
    padding: 2rem;
}

.login-box-msg {
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

@media (max-width: 576px) {
    .auth-login-page {
        padding: 1.25rem;
    }
}
</style>
