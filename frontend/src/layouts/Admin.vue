<template>
    <header>
        <TheHeaderAdmin></TheHeaderAdmin>
    </header>
    <div class="container">
        <router-view></router-view>
    </div>
</template>
<script>
import TheHeaderAdmin from '../components/TheHeaderAdmin.vue';
export default {
    components: {
        TheHeaderAdmin
    }
}
</script>