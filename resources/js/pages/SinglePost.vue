<template>
    <div class="container">
        <!-- Single-Post -->
        <div v-if="post">
            <!-- Img -->
            <img v-if="post.cover" class="w-25" :src="post.cover" :alt="post.title">
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
        <div v-else >Loading...</div>

    </div>
</template>

<script>
export default {
    name: 'SinglePost',
    data(){
        return{
            post: null,

        }
    },

    methods: {
        getSinglePost(){
            axios.get('/api/posts/' + this.$route.params.slug)
            .then((response) => {

                if (response.data.success) {
                    this.post = response.data.results;
                }else{
                    this.$router.push({name: 'error'});
                };

        })

        }

    },

    mounted(){
        this.getSinglePost();
        

    }
    
}
</script>