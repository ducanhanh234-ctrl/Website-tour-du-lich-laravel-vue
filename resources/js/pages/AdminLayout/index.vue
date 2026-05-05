<template>
    <div class="layout-fixed sidebar-expand-lg bg-body-tertiary">
        <!--begin::App Wrapper-->
        <div class="app-wrapper">
            <!--begin::Header-->
            <Header />
            <!--end::Header-->
            <!--begin::Sidebar-->
            <Aside />
            <!--end::Sidebar-->
            <!--begin::App Main-->
            <main class="app-main">
                <!--begin::App Content Header-->
                <div class="app-content-header">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Dashboard</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li
                                        class="breadcrumb-item active"
                                        aria-current="page"
                                    >
                                        Dashboard
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::App Content Header-->
                <!--begin::App Content-->
                <div class="app-content">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <Box4 />
                            <!--end::Col-->
                            <Box3 />
                            <!--end::Col-->
                            <Box2 />
                            <!--end::Col-->
                            <Box1 />
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row">
                            <!-- Start col -->
                            <div class="col-lg-13 connectedSortable">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <slot name="title" />
                                        </h3>
                                    </div>

                                    <div class="card-body">
                                        <div id="revenue-chart">
                                            <slot />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::App Content-->
            </main>
            <!--end::App Main-->
            <!--begin::Footer-->
            <Footer />
            <!--end::Footer-->
        </div>
        <!--end::App Wrapper-->
    </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import Header from '@/components/header.vue';
import Aside from '@/components/aside.vue';
import Footer from '@/components/footer.vue';
import Index from '../products/index.vue';
import Box1 from '@/components/box1.vue';
import Box2 from '@/components/box2.vue';
import Box3 from '@/components/box3.vue';
import Box4 from '@/components/box4.vue';
defineProps({
    tours: Array,
});
const loadCss = (href: string) => {
    if (document.querySelector(`link[href="${href}"]`)) {
        return;
    }
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = href;
    document.head.appendChild(link);
};

const loadScript = (src: string) => {
    if (document.querySelector(`script[src="${src}"]`)) {
        return Promise.resolve();
    }
    return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = src;
        script.defer = true;
        script.onload = resolve;
        script.onerror = reject;
        document.body.appendChild(script);
    });
};

onMounted(async () => {
    loadCss('/css/adminlte.min.css');
    await loadScript('/js/adminlte.min.js');
});
</script>
