<script>
import Navbar from '@/Components/NavBar.vue'

export default {
    components: {
        Navbar
    }
}

</script>

<template>
    <div>
        <Navbar />
        <slot name="content" />
        <slot name="models" />
    </div>
</template>