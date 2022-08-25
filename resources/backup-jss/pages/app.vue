<template>
    <div>
        <header-component></header-component>
        <sidebar-component></sidebar-component>
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <div class="container-xxl " style="padding-top: 50px;">
                <!-- main -->
                <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>
