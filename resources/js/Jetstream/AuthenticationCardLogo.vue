<template>
    <Link :href="'/'">
        <img src="/img/logo.png" alt="Avicenna Logo" class="h-8 w-auto"/>
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
    })
</script>
