<template>
    <div>
        <a href="/admin">admin privata</a>
        <Posts />

    </div>
</template>

<script>

import Posts from "../components/Posts.vue";

export default {
    name: 'App',
    components: {
        Posts,
    }
}
</script>