<script setup>
import { ref, reactive, onMounted } from 'vue';
// Lưu menu đang active
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
</script>

<template>
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
            <!--begin::Brand Link-->
            <a href="./index.html" class="brand-link">
                <!--begin::Brand Image-->
                <img
                    src="/img/AdminLTELogo.png"
                    alt="AdminLTE Logo"
                    class="brand-image shadow opacity-75"
                />
                <!--end::Brand Image-->
                <!--begin::Brand Text-->
                <span class="brand-text fw-light">LUXTOUR</span>
                <!--end::Brand Text-->
            </a>
            <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <!--begin::Sidebar Menu-->
                <ul
                    class="nav sidebar-menu flex-column"
                    data-lte-toggle="treeview"
                    role="navigation"
                    aria-label="Main navigation"
                    data-accordion="false"
                    id="navigation"
                >
                    <li class="nav-item menu-open">
                        <Link
                            :href="route('home')"
                            class="nav-link"
                            :class="{ active: page.url === '/' }"
                        >
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                Dashboard
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link
                            :href="route('tours.index')"
                            class="nav-link"
                            :class="{
                                active: page.url.startsWith('/tours'),
                            }"
                        >
                            <i class="nav-icon bi bi-palette"></i>
                            <p>Quản Lý Tour</p>
                        </Link>
                    </li>
                </ul>
                <!--end::Sidebar Menu-->
            </nav>
        </div>
        <!--end::Sidebar Wrapper-->
    </aside>
</template>

<style scoped>
/* Link mặc định */
.nav-link {
    transition: all 0.3s ease;
    border-radius: 8px;
}

/* Hover */
.nav-link:hover {
    background-color: rgba(255, 255, 255, 0.08);
    color: #ffffff !important;
}

/* Active */
.nav-link.active {
    background-color: #0d6efd !important;
    color: white !important;
    font-weight: bold;
    box-shadow: 0 4px 10px rgba(13, 110, 253, 0.4);
}

/* Icon active */
.nav-link.active .nav-icon {
    color: white !important;
}

/* Text active */
.nav-link.active p {
    color: white !important;
}

/* Sidebar spacing */
.sidebar-menu .nav-item {
    margin-bottom: 4px;
}
</style>
