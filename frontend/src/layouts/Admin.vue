<template>
    <header>
        <TheHeaderAdmin></TheHeaderAdmin>
    </header>
    <router-view></router-view>
</template>
<script>
import TheHeaderAdmin from '../components/TheHeaderAdmin.vue';
export default {
    components: {
        TheHeaderAdmin
    }
}
</script>