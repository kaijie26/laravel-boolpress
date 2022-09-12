<template>
    <div>
        <div class="container">
            <h1>Lista dei Posts</h1>
            <div class="row row-cols-3">
                <div v-for="post in posts" :key="post.id" class="col mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ post.title }}</h5>
                            <p class="card-text">{{ troncateText(post.content) }}</p>
                            
                        </div>
                    </div>

                </div>

            </div>

        </div>
        
    </div>
    
</template>

<script>
export default {
    name: 'Posts',

    data(){
        return{
            posts:[]


        }
    },

    methods: {
        troncateText(text){
            if(text.length > 80){
                return text.slice(0, 80) + '...';

            };

            return text;

        },

        getPosts(){
            axios.get('/api/posts')
            .then((response)=>{
                this.posts = response.data.results;
                
            })

        }

    }, 

    mounted(){
        this.getPosts();
        

    }
}
</script>