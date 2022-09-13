<template>
    <div>
        <Header />
        <main>
            <Posts />

        </main>

    </div>

</template>

<script>
import Posts from "../components/Posts.vue";
import Header from "../components/Header.vue";
export default {
    name: 'BlogPage',
    components: {
        Posts,
        Header,

    }
}
</script>