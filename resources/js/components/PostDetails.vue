<template>
     <div class="card">
        <div class="card-body">
            <!-- Title -->
            <h5 class="card-title">{{ post.title }}</h5>
            <!-- Content -->
            <p class="card-text">{{ troncateText(post.content) }}</p>
            <!-- POst-Link -->
            <router-link class="btn btn-primary" :to="{ name: 'single-post', params: {slug: post.slug} }">Maggiori info</router-link>
        </div>
    </div>
    
</template>

<script>
export default {
    name: 'PostDetails',
    props: {
        post: Object,

    },
    
    methods: {
        troncateText(text){
            if(text.length > 80){
                return text.slice(0, 80) + '...';

            };

            return text;

        },
    }
    
}
</script>