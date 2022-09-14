<template>
    <div class="container">
        <!-- Single-Post -->
        <div v-if="post">
            <!-- Title -->
            <h2>{{post.title}}</h2>
            <!-- Tags -->
            <div v-for="tag in post.tags" :key="tag.id" class="d-inline-flex">
                <span class="badge bg-success text-white mr-2">{{tag.name}}</span>
            </div>
            <!-- Content -->
            <p>{{post.content}}</p>
            <!-- Catgory -->
            <div v-if="post.category">Categoria: {{post.category.name}}</div>

        </div>

    </div>
</template>

<script>
export default {
    name: 'SinglePost',
    data(){
        return{
            post: [],

        }
    },

    methods: {
        getSinglePost(){
            axios.get('/api/posts/' + this.$route.params.slug)
            .then((response) => {
                this.post = response.data.results;

            });

        }

    },

    mounted(){
        this.getSinglePost();
        

    }
    
}
</script>