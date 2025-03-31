<template>
    <header>
        <TheHeader></TheHeader>
    </header>
    <div class="container">
        <router-view></router-view>
    </div>
</template>
<script>
import TheHeader from '../components/TheHeader.vue';
export default {
    components: {
        TheHeader
    }
}
</script>