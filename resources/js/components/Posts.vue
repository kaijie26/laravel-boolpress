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

            <nav>
                <ul class="pagination mt-3">
                    <!-- Previous-Button -->
                    <li class="page-item" :class="{'disabled' : currentPagination == 1 }">
                        <a @click="getPosts(currentPagination -1)" class="page-link" href="#">Previous</a>
                    </li>

                    <li v-for="paginationNumb in lastPagination" :key="paginationNumb" :class="{'active' : paginationNumb == currentPagination }" class="page-item">
                        <a @click="getPosts(paginationNumb)" class="page-link" href="#">{{paginationNumb}}</a>
                    </li>

                    <!-- Next-Button -->
                    <li class="page-item" :class="{'disabled' : currentPagination == lastPagination }" >
                        <a @click="getPosts(currentPagination +1)" class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>

        </div>
        
    </div>
    
</template>

<script>
export default {
    name: 'Posts',

    data(){
        return{
            posts:[],
            currentPagination: 1,
            lastPagination: null


        }
    },

    methods: {
        troncateText(text){
            if(text.length > 80){
                return text.slice(0, 80) + '...';

            };

            return text;

        },

        getPosts(pageNumber){
            axios.get('/api/posts', {
                params: {
                    page: pageNumber,

                }
            })
            .then((response)=>{
                this.posts = response.data.results.data;
                this.currentPagination = response.data.results.current_page
                this.lastPagination = response.data.results.last_page
                
            })

        }



    }, 

    mounted(){
        this.getPosts(1);
        

    }
}
</script>